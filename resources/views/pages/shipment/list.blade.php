@php use App\Models\Shipment; @endphp
@section('title', 'Verzendingen overzicht')
<x-app-layout>

    <div class="flex flex-col w-full justify-center lg:items-start overflow-y-hidden">
        <table class="w-full text-sm text-left text-gray-500 table-auto">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-2">
                    ID
                </th>
                <th scope="col" class="px-6 py-2">
                    Ordernummer
                </th>
                <th scope="col" class="px-6 py-2">
                    Actie
                </th>
            </tr>
            </thead>
            <tbody>
            @php /** @var $shipment Shipment */ @endphp
            @foreach($shipments as $shipment)
                <tr class="bg-white border-b text-gray-900">
                    <th scope="row" class="px-6 py-2 font-medium whitespace-nowrap">
                        {{ $shipment->id }}
                    </th>
                    <td class="px-6 py-2">
                        {{ $shipment->getOrder()->getNumber() }}
                    </td>
                    <td class="px-6 py-2">
                        <ul>
                            <li>
                                <a class="font-medium text-sky-600 hover:underline" href="{{ route('shipment.view', ['shipment' => $shipment]) }}">Bekijk verzending</a>
                            </li>
                            <li>
                                <a class="font-medium text-sky-600 hover:underline" href="{{ route('shipment.show.packing-slip', ['shipment' => $shipment]) }}">Bekijk pakbon</a>
                            </li>
                            <li>
                                <a class="font-medium text-sky-600 hover:underline" href="{{ route('shipment.download.packing-slip', ['shipment' => $shipment]) }}">Download pakbon</a>
                            </li>
                        </ul>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $shipments->links() }}
    </div>
</x-app-layout>
