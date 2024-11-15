@php use App\Models\Shipment; @endphp
<form class="container flex flex-row flex-wrap" id="create-address" method="POST" action="{{ route('address.store') }}">
    @csrf
    <x-input-text id="address_order_id"
                  name="address_order_id"
                  value="{{ old('address_order_id') }}"
                  required="required"
                  autocomplete="off"
                  type="hidden"
                  class="order_id_input"
    ></x-input-text>
    <div class="flex flex-col w-full justify-center lg:items-start">
        <h2 class="text-2xl pb-4">Adres gegevens</h2>
    </div>
    <div class="flex flex-col w-full md:w-2/5 lg:items-start">
        <div class="flex flex-wrap -mx-3 mb-6">
            <h3 class="block text-1xl pb-4 w-full px-3">
                Bezorgadres
            </h3>
            <div class="w-full px-3">
                <x-input-label class="form-label"
                               required="required"
                               for="shipping_name">
                    Naam ontvanger
                </x-input-label>
                <x-input-text id="shipping_name"
                              name="shipping_name"
                              value="{{ old('shipping_name') }}"
                              placeholder="Jan Jansen"
                              required="required"
                              autocomplete="name"
                ></x-input-text>
                <x-input-error />
            </div>
            <div class="w-full px-3">
                <x-input-label class="form-label"
                               required="required"
                               for="shipping_email">
                    Email adres
                </x-input-label>
                <x-input-text id="shipping_email"
                              name="shipping_email"
                              value="{{ old('shipping_email') }}"
                              placeholder="j.jansen@qls.nl"
                              required="required"
                              type="email"
                              autocomplete="email"
                ></x-input-text>
                <x-input-error />
            </div>
            <div class="w-full px-3">
                <x-input-label class="form-label"
                               required="required"
                               for="shipping-phone">
                    Telefoonnummer
                </x-input-label>
                <x-input-text id="shipping_phone"
                              name="shipping_phone"
                              value="{{ old('shipping_phone') }}"
                              placeholder="0612345678"
                              required="required"
                              autocomplete="tel"
                ></x-input-text>
                <x-input-error />
            </div>
            <div class="w-full px-3">
                <x-input-label class="form-label"
                               required="required"
                               for="shipping_country">
                    Land
                </x-input-label>
                <x-input-select name="shipping_country"
                                id="shipping_country"
                                autocomplete="country"
                >
                    @foreach(Shipment::getShippingCountries() as $value => $label)
                        <option value="{{ $value }}">{{ $label }}</option>
                    @endforeach
                </x-input-select>
                <x-input-error />
            </div>
            <div class="w-full px-3">
                <x-input-label class="form-label"
                               required="required"
                               for="shipping_city">
                    Stad
                </x-input-label>
                <x-input-text id="shipping_city"
                              name="shipping_city"
                              value="{{ old('shipping_city') }}"
                              placeholder="Dordrecht"
                              required="required"
                              autocomplete="address-level2"
                ></x-input-text>
                <x-input-error />
            </div>
            <div class="w-full md:w-2/5 px-3">
                <x-input-label class="form-label"
                               required="required"
                               for="shipping_zipcode">
                    Postcode
                </x-input-label>
                <x-input-text id="shipping_zipcode"
                              name="shipping_zipcode"
                              value="{{ old('shipping_zipcode') }}"
                              placeholder="1234 AB"
                              autocomplete="postal-code"
                ></x-input-text>
                <x-input-error />
            </div>
            <div class="w-full md:w-2/5 px-3 pl-1">
                <x-input-label class="form-label"
                               required="required"
                               for="shipping_street">
                    Straat
                </x-input-label>
                <x-input-text id="shipping_street"
                              name="shipping_street"
                              value="{{ old('shipping_street') }}"
                              placeholder="Kerkeplaat"
                              autocomplete="street-address address-line1"
                ></x-input-text>
                <x-input-error />
            </div>
            <div class="w-full md:w-1/5 px-3 pl-1">
                <x-input-label class="form-label"
                               required="required"
                               for="shipping_house_number">
                    Huisnummer
                </x-input-label>
                <x-input-text id="shipping_house_number"
                              name="shipping_house_number"
                              value="{{ old('shipping_house_number') }}"
                              placeholder="123 AB"
                              autocomplete="street-address address-line1"
                ></x-input-text>
                <x-input-error />
            </div>
            <div class="w-full px-3 mb-6 md:mb-0">
                <x-input-label class="form-label"
                               for="shipping_address_line_2">
                    Adres toevoeging
                </x-input-label>
                <x-input-text id="shipping_address_line_2"
                              name="shipping_address_line_2"
                              value="{{ old('shipping_address_line_2') }}"
                              placeholder="Gebouw 1, Suite 2"
                              autocomplete="street-address address-line2"
                ></x-input-text>
                <x-input-error />
            </div>
            <div class="w-full px-3 mb-6 md:mb-0">
                <x-input-label class="form-label" for="shipping_company_name">
                    Bedrijfsnaam
                </x-input-label>
                <x-input-text id="shipping_company_name"
                              name="shipping_company_name"
                              value="{{ old('shipping_company_name') }}"
                              placeholder="QLS"
                              autocomplete="organization"
                ></x-input-text>
                <x-input-error />
            </div>
        </div>
    </div>
    <div class="flex flex-col w-full md:w-2/5 lg:items-start pl-10" id="billing-address">
        <div class="flex flex-wrap -mx-3 mb-6">
            <div class=" flex flex-nowrap justify-center w-full px-3 mb-6 md:mb-0">
                <h3 class="text-1xl w-1/4 pb-4">
                    Factuuradres
                </h3>
                <x-input-checkbox class="!w-3/4 !pt-0"
                                  id="shipping_is_billing"
                                  name="shipping_is_billing"
                                  checked="checked"
                                  value="1"
                >
                    Factuuradres is hetzelfde als het bezorgadres
                </x-input-checkbox>
            </div>
            <div class="w-full px-3">
                <x-input-label class="form-label"
                               required="required"
                               for="billing_name">
                    Naam ontvanger
                </x-input-label>
                <x-input-text id="billing_name"
                              name="billing_name"
                              value="{{ old('billing_name') }}"
                              placeholder="Jan Jansen"
                              disabled="disabled"
                              autocomplete="name"
                              required="required"
                ></x-input-text>
                <x-input-error />
            </div>
            <div class="w-full px-3">
                <x-input-label class="form-label"
                               required="required"
                               for="billing_email">
                    Email adres
                </x-input-label>
                <x-input-text id="billing_email"
                              name="billing_email"
                              value="{{ old('billing_email') }}"
                              placeholder="j.jansen@qls.nl"
                              disabled="disabled"
                              autocomplete="email"
                              required="required"
                              type="email"
                ></x-input-text>
                <x-input-error />
            </div>
            <div class="w-full px-3">
                <x-input-label class="form-label"
                               required="required"
                               for="billing_phone">
                    Telefoonnummer
                </x-input-label>
                <x-input-text id="billing_phone"
                              name="billing_phone"
                              value="{{ old('billing_phone') }}"
                              placeholder="0612345678"
                              disabled="disabled"
                              autocomplete="tel"
                              required="required"
                ></x-input-text>
                <x-input-error />
            </div>
            <div class="w-full px-3">
                <x-input-label class="form-label"
                               required="required"
                               for="billing_country">
                    Land
                </x-input-label>
                <x-input-select name="billing_country"
                                id="billing_country"
                                disabled="disabled"
                                autocomplete="country">
                    @foreach(Shipment::getShippingCountries() as $value => $label)
                        <option value="{{ $value }}">{{ $label }}</option>
                    @endforeach
                </x-input-select>
                <x-input-error />
            </div>
            <div class="w-full px-3">
                <x-input-label class="form-label"
                               required="required"
                               for="billing_city">
                    Stad
                </x-input-label>
                <x-input-text id="billing_city"
                              name="billing_city"
                              value="{{ old('billing_city') }}"
                              placeholder="Dordrecht"
                              disabled="disabled"
                              autocomplete="address-level2"
                              required="required"
                ></x-input-text>
                <x-input-error />
            </div>
            <div class="w-full md:w-2/5 px-3">
                <x-input-label class="form-label"
                               required="required"
                               for="billing_zipcode">
                    Postcode
                </x-input-label>
                <x-input-text id="billing_zipcode"
                              name="billing_zipcode"
                              value="{{ old('billing_zipcode') }}"
                              placeholder="1234 AB"
                              disabled="disabled"
                              autocomplete="postal-code"
                ></x-input-text>
                <x-input-error />
            </div>
            <div class="w-full md:w-2/5 px-3 pl-1">
                <x-input-label class="form-label"
                               required="required"
                               for="billing_street">
                    Straat
                </x-input-label>
                <x-input-text id="billing_street"
                              name="billing_street"
                              value="{{ old('billing_street') }}"
                              placeholder="Kerkeplaat"
                              disabled="disabled"
                              autocomplete="street-address address-line1"
                ></x-input-text>
                <x-input-error />
            </div>
            <div class="w-full md:w-1/5 px-3 pl-1">
                <x-input-label class="form-label"
                               required="required"
                               for="billing_house_number">
                    Huisnummer
                </x-input-label>
                <x-input-text id="billing_house_number"
                              name="billing_house_number"
                              value="{{ old('billing_house_number') }}"
                              placeholder="123 AB"
                              disabled="disabled"
                              autocomplete="street-address address-line1"
                ></x-input-text>
                <x-input-error />
            </div>
            <div class="w-full px-3 mb-6 md:mb-0">
                <x-input-label class="form-label"
                               for="billing_address_line_2">
                    Adres toevoeging
                </x-input-label>
                <x-input-text id="billing_address_line_2"
                              name="billing_address_line_2"
                              value="{{ old('billing_address_line_2') }}"
                              placeholder="Gebouw 1, Suite 2"
                              disabled="disabled"
                              autocomplete="street-address address-line2"
                ></x-input-text>
                <x-input-error />
            </div>
            <div class="w-full px-3 mb-6 md:mb-0">
                <x-input-label class="form-label" for="billing_company_name">
                    Bedrijfsnaam
                </x-input-label>
                <x-input-text id="billing_company_name"
                              name="billing_company_name"
                              value="{{ old('billing_company_name') }}"
                              placeholder="QLS"
                              autocomplete="organization"
                ></x-input-text>
                <x-input-error />
            </div>
        </div>
    </div>
    <div class="flex flex-col w-full md:w-1/2 justify-center lg:items-start overflow-y-hidden">
        <button type="submit" class="btn btn-primary">Door naar verzend opties</button>
    </div>
</form>
