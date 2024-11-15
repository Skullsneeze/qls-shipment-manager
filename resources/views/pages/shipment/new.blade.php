@php
    use App\Models\Shipment;
@endphp
@section('title', 'Verzending aanmaken')
<x-app-layout>
    @section('header.scripts')
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite([
                'resources/js/shipment/product-table.js',
                'resources/js/shipment/address-toggle.js',
                'resources/js/shipment/step-handler.js'
                ])
        @endif
    @endsection
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <!--Left Col-->
    <div class="flex flex-col w-full justify-center lg:items-start overflow-y-hidden">
        <h1 class="page-title">
            Maak een verzending aan
        </h1>
        <div id="steps-wrapper">
            <div data-step="1" class="step mb-10 relative">
                @include('partials.forms.create-order')
            </div>
            <div data-step="2" class="step mb-10 relative has-mask">
                <div class="step-mask"></div>
                @include('partials.forms.create-address')
            </div>
            <div data-step="3" class="step mb-10 relative has-mask">
                <div class="step-mask"></div>
                @include('partials.forms.create-shipment')
            </div>
        </div>
    </div>
</x-app-layout>
