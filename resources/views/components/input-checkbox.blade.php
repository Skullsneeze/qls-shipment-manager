<label {{ $attributes->merge(['class' => 'form-input-checkbox ' . ($disabled ? 'disabled' : '')]) }}>
    <input class="mr-2 leading-tight"
           type="checkbox"
           name="{{ $name }}"
           id="{{ $id }}"
           {{ $checked ? 'checked' : '' }}
           {{ $disabled ? 'disabled' : '' }}/>
    <span class="text-sm">
        {{ $slot }}
    </span>
    @if($required)
        <span class="text-red-500">*</span>
    @endif
</label>
