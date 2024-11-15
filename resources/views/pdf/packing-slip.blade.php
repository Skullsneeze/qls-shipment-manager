@php
    use App\Models\Address;
    use App\Models\Order;
    use App\Models\OrderItem;
    use App\Models\Shipment;

    /**
     * @var $shipment Shipment
     * @var $labelImgSrc string
     * @var $order Order
     * @var $orderItems OrderItem[]
     * @var $shippingAddress Address
     */
@endphp
@section('title', 'Pakbon ' . $order->getNumber())
<x-pdf-layout>
    <div class="flex flex-row w-full justify-start items-start">
        <div class="w-1/2 justify-center text-sky-500 font-bold text-lg">
            <img src="{{ public_path('images/logo.png') }}" alt="package" width="32" class="inline mr-3" /> QLS Verzending management
            <h1 class="mt-5 text-orange-500">
                Bestelling {{ $order->getNumber() }}
            </h1>
        </div>
        <div class="flex flex-col w-1/2 justify-self-end justify-end text-right">
            <h2 class="divide-y divide-gray-200 text-orange-500 font-bold text-lg">
                Ontvanger
            </h2>
            <dl class="text-sm text-gray-900 divide-y divide-gray-200">
                @if ($shippingAddress->getCompanyName())
                <div class="flex flex-col pb-1">
                    <dt class="text-gray-500">Bedrijfsnaam</dt>
                    <dd class="font-semibold">{{ $shippingAddress->getCompanyName() }}</dd>
                </div>
                @endif
                <div class="flex flex-col py-1">
                    <dt class="text-gray-500">Naam</dt>
                    <dd class="font-semibold">{{ $shippingAddress->getName() }}</dd>
                </div>
                <div class="flex flex-col py-1">
                    <dt class="text-gray-500">Adres</dt>
                    <dd class="font-semibold">
                        {{ $shippingAddress->getFormattedAddress() }}<br>
                        {{ $shippingAddress->getCity() }}<br>
                        {{ $shippingAddress->getCountryLabel() }}
                    </dd>
                </div>
                <div class="flex flex-col py-1">
                    <dt class="text-gray-500">Telefoonnummer</dt>
                    <dd class="font-semibold">{{ $shippingAddress->getPhone() }}</dd>
                </div>
                <div class="flex flex-col pt-1">
                    <dt class="text-gray-500">Emailadres</dt>
                    <dd class="font-semibold">{{ $shippingAddress->getEmail() }}</dd>
                </div>
            </dl>
        </div>
    </div>
    <div class="pt-3 flex flex-col w-full justify-center overflow-y-hidden">
        <hr>
        <h2 class="text-lg font-bold text-orange-500 w-full my-3">Bestelde Producten</h2>
        <table class="w-full text-sm text-left text-gray-500 table-auto">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-2">
                    Product
                </th>
                <th scope="col" class="px-6 py-2">
                    Aantal
                </th>
                <th scope="col" class="px-6 py-2">
                    SKU
                </th>
                <th scope="col" class="px-6 py-2">
                    EAN
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($orderItems as $orderItem)
            <tr class="bg-white border-b text-gray-900">
                <th scope="row" class="px-6 py-2 font-medium whitespace-nowrap">
                    {{ $orderItem->getName() }}
                </th>
                <td class="px-6 py-2">
                    {{ $orderItem->getQty() }}
                </td>
                <td class="px-6 py-2">
                    {{ $orderItem->getSku() }}
                </td>
                <td class="px-6 py-2">
                    {{ $orderItem->getEan() }}
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="flex flex-col w-full items-center absolute bottom-20">
        <div class="absolute -right-16 -left-20 mt-5 h-[1px] border-t border-gray-700 border-dashed"></div>
        <img class="absolute left-0 mt-3" width="23" src="{{ public_path('images/scissor.png') }}">
        <img width="300" class="rotate-90" src="{{ $labelImgSrc }}" alt="Verzendlabel" />
    </div>
</x-pdf-layout>
