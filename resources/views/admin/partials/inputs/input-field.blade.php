<label class="form-label">
    {{ $label ?? "" }}
    @if(isset($required) && $required)
        <span class="text-danger">*</span>
    @endif
</label>
<input
    type="{{ $type ?? "text" }}"
    name="{{ $name ?? "" }}"
    class="form-control {{ $classes ?? "" }}"
    placeholder="{{ $label ?? "" }}"
    value="{{ $value ?? "" }}"
    {{ (isset($required) && $required) ? "required" : '' }}
/>
