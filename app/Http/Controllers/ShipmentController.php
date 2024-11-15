<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateShipmentRequest;
use App\Models\Api\ShipmentInterface;
use App\Models\Client\QlsApi;
use App\Models\Client\Request\CreateShipment;
use App\Models\Order;
use App\Models\Shipment;
use Illuminate\Http\Request;

class ShipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view(
            'pages.shipment.list',
            ['shipments' => Shipment::paginate(10)]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.shipment.new');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateShipmentRequest $request)
    {
        $requestData = $request->safe()->all();

        /** @var Order $order */
        $order = Order::find($requestData['shipment_order_id']);
        $shipmentOption = (int)($requestData['shipping_method_option'] ?? QlsApi::DEFAULT_SHIPMENT_METHOD_OPTION_ID);

        $createShipmentRequest = CreateShipment::fromOrder($order);
        $createShipmentRequest->setProductId((int)$requestData['shipping_method']);
        $createShipmentRequest->setProductCombinationId($shipmentOption);

        $qlsApi = new QlsApi();
        $response = $qlsApi->createShipment($createShipmentRequest);

        $responseData = $response->json('data');

        $shipment = new Shipment();
        $shipment->setOrderId($order->id);
        $shipment->setQlsId($responseData['id'] ?? ShipmentInterface::NO_LABEL_ID);
        $shipment->setQlsToken($responseData['token'] ?? ShipmentInterface::NO_LABEL_ID);
        $shipment->save();

        if (!$shipment->canHaveLabel()) {
            if ($request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'redirect_uri' => route('shipment.view', ['shipment' => $shipment]),
                ]);
            }

            return;
        }

        $packingSlipFile = $shipment->getPackingSlip();

        if (!$packingSlipFile) {
            $packingSlipFile = "packing-slips/{$shipment->getQlsId()}.pdf";

            $viewData = [
                'shipment' => $shipment,
                'labelImgSrc' => $shipment->getLabelImage(),
                'order' => $order,
                'orderItems' => $order->getItems(),
                'shippingAddress' => $order->getShippingAddress(),
            ];
            $packingSlip = $shipment->generatePackingSlip($viewData, "{$shipment->getQlsId()}.pdf");
            $packingSlip->disk('public');
            $packingSlip->save($packingSlipFile);

            $shipment->setPackingSlip($packingSlipFile);
            $shipment->save();
        }

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'redirect_uri' => route('shipment.view', ['shipment' => $shipment]),
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Shipment $shipment)
    {
        $order = $shipment->getOrder();

        return view(
            'pages.shipment.view',
            [
                'shipment' => $shipment,
                'order' => $order,
                'orderItems' => $order->getItems(),
                'shippingAddress' => $order->getShippingAddress(),
            ]
        );
    }

    /**
     * Display the specified resource.
     */
    public function showPackingSlip(Shipment $shipment)
    {
        $imagePath = $shipment->getLabelImage();

        $order = $shipment->getOrder();

        $viewData = [
            'shipment' => $shipment,
            'labelImgSrc' => $imagePath,
            'order' => $order,
            'orderItems' => $order->getItems(),
            'shippingAddress' => $order->getShippingAddress(),
        ];

        return $shipment->generatePackingSlip($viewData, "Pakbon {$order->getNumber()}");
    }

    /**
     * Display the specified resource.
     */
    public function downloadPackingSlip(Shipment $shipment)
    {
        $imagePath = $shipment->getLabelImage();

        $order = $shipment->getOrder();

        $viewData = [
            'shipment' => $shipment,
            'labelImgSrc' => $imagePath,
            'order' => $order,
            'orderItems' => $order->getItems(),
            'shippingAddress' => $order->getShippingAddress(),
        ];

        $fileName = "Pakbon {$order->getNumber()}";

        return $shipment->generatePackingSlip($viewData, $fileName)->download($fileName);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function getMethods(Request $request)
    {
        $qlsApi = new QlsApi();
        $response = $qlsApi->getShippingMethods();
        $methods = $response->json('data');

        $mappedMethods = [];
        $mappedMethodOptions = [];
        foreach ($methods as $method) {
            if ($method['type'] !== 'delivery') {
                continue;
            }
            $group = $method['product_family']['name'] ?? 'Overige';
            $mappedMethods[$group][] = [
                'value' => $method['id'],
                'label' => $method['name'],
            ];

            $mappedMethodOptions[$method['id']][] = [
                'value' => QlsApi::DEFAULT_SHIPMENT_METHOD_OPTION_ID,
                'label' => QlsApi::DEFAULT_SHIPMENT_METHOD_OPTION_LABEL,
            ];

            if ($method['combinations']) {
                foreach ($method['combinations'] as $combination) {
                    if ($combination['product_options']) {
                        $combinationLabels = array_map(
                            static fn($option): string => $option['name'],
                            $combination['product_options']
                        );
                        $mappedMethodOptions[$method['id']][] = [
                            'value' => $combination['id'],
                            'label' => implode(' + ', $combinationLabels)
                        ];
                    }
                }
            }
        }

        return response()->json([
            'shipping_methods' => $mappedMethods,
            'shipping_method_options' => $mappedMethodOptions,
        ]);
    }


}
