<input class="form-input form-input-text {{ $class }} {{ $required ? 'input-required' : '' }} {{ $disabled ? 'disabled' : '' }} @error($name) border-red-500 @enderror"
       id="{{ $id }}"
       name="{{ $name }}"
       type="{{ $type }}"
       placeholder="{{ $placeholder }}"
       {{ $required ? 'required' : '' }}
       {{ $disabled ? 'disabled' : '' }}
       {{ $attributes->get('value') ? $attributes->merge(['value' => '']) : '' }}
       {{ $attributes->get('autocomplete') ? $attributes->merge(['autocomplete' => '']) : '' }}
       {{ $attributes->get('min') ? $attributes->merge(['min' => '']) : '' }}
       {{ $attributes->get('max') ? $attributes->merge(['max' => '']) : '' }}
       {{ $attributes->get('step') ? $attributes->merge(['step' => '']) : '' }}/>
