<label {{ $attributes->merge(['class' => 'form-label']) }} for="{{ $for }}">
    {{ $slot }}
    @if($required)
        <span class="text-red-500">*</span>
    @endif
</label>
