<form class="container flex flex-row flex-wrap" id="create-order" method="POST" action="{{ route('order.store') }}">
    @csrf
    <div class="flex flex-col w-full flex-grow justify-center lg:items-start overflow-y-hidden">
        <h2 class="text-2xl pb-4">Order info</h2>
        <div class="flex flex-wrap w-full md:w-2/5 -mx-3 mb-6">
            <div class="w-full px-3">
                <x-input-label class="form-label"
                               required="required"
                               for="order_number">
                    Ordernummer
                </x-input-label>
                <x-input-text id="order_number"
                              name="order_number"
                              placeholder="#12345678"
                              required="required"
                              value="{{ old('order_number') }}"
                              autocomplete="off"
                ></x-input-text>
                <x-input-error />
            </div>
        </div>
    </div>
    <div class="flex flex-col w-full justify-center lg:items-start">
        <h2 class="text-2xl pb-4 w-full">Producten</h2>
        <div class="flex flex-wrap w-full -mx-3 mb-2 product-row" id="product-0">
            <div class="w-[35%] px-3 mb-2 md:mb-0">
                <x-input-label class="form-label" for="products[0][name]">
                    Naam
                </x-input-label>
                <x-input-text id="products[0][name]"
                              name="products[0][name]"
                              value="{{ old('products[0][name]') }}"
                              placeholder="Rode trui (Maat L)"
                              required="required"
                ></x-input-text>
                <x-input-error />
            </div>
            <div class="w-[15%] px-3 mb-2 md:mb-0">
                <x-input-label class="form-label" for="products[0][price]">
                    Prijs
                </x-input-label>
                <span class="form-input-price-icon">€</span>
                <x-input-text id="products[0][price]"
                              class="form-input-price"
                              name="products[0][price]"
                              value="{{ old('products[0][price]') }}"
                              placeholder="49.95"
                              required="required"
                              type="number"
                              min="0.01"
                              step="0.01"
                ></x-input-text>
                <x-input-error />
            </div>
            <div class="w-[10%] px-3 mb-2 md:mb-0">
                <x-input-label class="form-label" for="products[0][qty]">
                    Aantal
                </x-input-label>
                <x-input-text id="products[0][qty]"
                              name="products[0][qty]"
                              placeholder="1"
                              type="number"
                              min="1"
                              step="any"
                              required="required"
                              value="{{ old('products[0][qty]', 1) }}"
                ></x-input-text>
                <x-input-error />
            </div>
            <div class="w-[20%] px-3 mb-2 md:mb-0">
                <x-input-label class="form-label" for="products[0][sku]">
                    SKU
                </x-input-label>
                <x-input-text id="products[0][sku]"
                              name="products[0][sku]"
                              value="{{ old('products[0][sku]') }}"
                              placeholder="rode-trui-l"
                              required="required"
                ></x-input-text>
                <x-input-error />
            </div>
            <div class="w-[20%] px-3 mb-2 md:mb-0">
                <x-input-label class="form-label" for="products[0][ean]">
                    EAN
                </x-input-label>
                <x-input-text id="products[0][ean]"
                              name="products[0][ean]"
                              value="{{ old('products[0][ean]') }}"
                              placeholder="1234567890123"
                              required="required"
                ></x-input-text>
                <x-input-error />
            </div>
        </div>
        <div class="flex flex-wrap w-full -mx-3 mb-2">
            <button class="btn btn-small btn-secondary btn-icon ml-3 add-product" type="button">
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="currentColor"><path d="M440-440H200v-80h240v-240h80v240h240v80H520v240h-80v-240Z"/></svg>
                <span>Product toevoegen</span>
            </button>
        </div>
        <div class="flex flex-col w-full md:w-1/2 justify-center lg:items-start mt-5 overflow-y-hidden">
            <button type="submit" class="btn btn-primary">Door naar adresgegevens</button>
        </div>
    </div>
</form>
<div class="flex flex-wrap w-full -mx-3 mb-2 product-template-row">
    <div class="w-[35%] px-3 mb-2 md:mb-0">
        <x-input-text id="products[ARRAY_KEY][name]"
                      name="products[ARRAY_KEY][name]"
                      placeholder="Rode trui (Maat L)"
                      required="required"
        ></x-input-text>
        <x-input-error />
    </div>
    <div class="w-[15%] px-3 mb-2 md:mb-0">
        <span class="form-input-price-icon">€</span>
        <x-input-text id="products[ARRAY_KEY][price]"
                      class="form-input-price"
                      name="products[ARRAY_KEY][price]"
                      value="{{ old('products[ARRAY_KEY][price]') }}"
                      placeholder="49.95"
                      required="required"
                      type="number"
                      min="0.01"
                      step="0.01"
        ></x-input-text>
        <x-input-error />
    </div>
    <div class="w-[10%] px-3 mb-2 md:mb-0">
        <x-input-text id="products[ARRAY_KEY][qty]"
                      name="products[ARRAY_KEY][qty]"
                      placeholder="1"
                      type="number"
                      min="1"
                      step="any"
                      value="1"
        ></x-input-text>
        <x-input-error />
    </div>
    <div class="w-[20%] px-3 mb-2 md:mb-0">
        <x-input-text id="products[ARRAY_KEY][sku]"
                      name="products[ARRAY_KEY][sku]"
                      placeholder="rode-trui-l"
        ></x-input-text>
        <x-input-error />
    </div>
    <div class="w-[20%] px-3 mb-2 md:mb-0">
        <x-input-text id="products[ARRAY_KEY][ean]"
                      name="products[ARRAY_KEY][ean]"
                      placeholder="1234567890123"
        ></x-input-text>
        <x-input-error />
    </div>
</div>
