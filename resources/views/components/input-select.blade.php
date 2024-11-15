<div {{ $attributes->merge(['class' => 'form-input inline-block relative w-full pb-3']) }}>
    <select name="{{ $name }}"
            id="{{ $id }}"
            class="form-input-select {{ $selectClass }} {{ $required ? 'input-required' : '' }} {{ $disabled ? 'disabled' : '' }} @error($name) border-red-500 @enderror"
            {{ $required ? 'required' : '' }}
            {{ $disabled ? 'disabled' : '' }}
            {{ $attributes->get('value') ? $attributes->merge(['value' => '']) : '' }}>
        {{ $slot }}
    </select>
    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 pb-3 text-gray-700">
        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
    </div>
</div>
