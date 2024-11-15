@php use App\Models\Client\QlsApi; @endphp
<form class="container flex flex-row flex-wrap"
      id="create-shipment"
      method="POST"
      data-shipment-method-getter="{{ route('shipment.methods') }}"
      action="{{ route('shipment.store') }}">
    @csrf
    <x-input-text id="shipment_order_id"
                  name="shipment_order_id"
                  value="{{ old('shipment_order_id') }}"
                  required="required"
                  autocomplete="off"
                  type="hidden"
                  class="order_id_input"
    ></x-input-text>
    <div class="flex flex-col w-full flex-grow justify-center lg:items-start overflow-y-hidden">
        <h2 class="text-2xl pb-4">Verzending</h2>

        <div class="flex flex-row w-full justify-start items-center">
            <div class="flex flex-wrap w-full md:w-2/5 -mx-3 mb-6">
                <div class="w-full px-3">
                    <x-input-label class="form-label"
                                   required="required"
                                   for="shipping_method">
                        Verzendmethode
                    </x-input-label>
                    <x-input-select name="shipping_method"
                                    id="shipping_method"
                                    required="required"
                                    autocomplete="off"
                    >
                        <option value="{{ QlsApi::DEFAULT_SHIPMENT_METHOD_ID }}">
                            {{ QlsApi::DEFAULT_SHIPMENT_METHOD_LABEL }}
                        </option>
                    </x-input-select>
                    <x-input-error />
                </div>
            </div>
            <div class="flex flex-wrap w-full md:w-2/5 -mx-3 mb-6 pl-10">
                <div class="w-full px-3 hidden">
                    <x-input-label class="form-label"
                                   for="shipping_method_options">
                        Verzend opties
                    </x-input-label>
                    <x-input-select name="shipping_method_option"
                                    id="shipping_method_option"
                                    autocomplete="off"
                    >
                        <option value="{{ QlsApi::DEFAULT_SHIPMENT_METHOD_OPTION_ID }}">
                            {{ QlsApi::DEFAULT_SHIPMENT_METHOD_OPTION_LABEL }}
                        </option>
                    </x-input-select>
                    <x-input-error />
                </div>
            </div>
        </div>
        <div class="flex flex-col w-full md:w-1/2 justify-center lg:items-start mt-5 overflow-y-hidden">
            <button type="submit" class="btn btn-primary">Verzending aanmaken</button>
        </div>
    </div>
</form>
