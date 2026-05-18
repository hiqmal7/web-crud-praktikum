@props(['label', 'name', 'id' => null, 'type' => 'text', 'value' => null, 'required' => false])

<div class="mb-3">
    @if($label)
        <label for="{{ $id ?? $name }}" class="form-label fw-semibold">
            {{ $label }}
            @if($required)<span class="text-danger">*</span>@endif
        </label>
    @endif
    <input
        type="{{ $type }}"
        name="{{ $name }}"
        id="{{ $id ?? $name }}"
        class="form-control @error($name) is-invalid @enderror"
        value="{{ old($name, $value) }}"
        {{ $required ? 'required' : '' }}
        {{ $attributes }}
    >
    @error($name)
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>