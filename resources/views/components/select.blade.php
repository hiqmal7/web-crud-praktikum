@props(['label', 'name', 'id' => null, 'options' => [], 'value' => null, 'required' => false, 'optionValue' => 'id', 'optionLabel' => 'name', 'placeholder' => '-- Pilih --'])

<div class="mb-3">
    @if($label)
        <label for="{{ $id ?? $name }}" class="form-label fw-semibold">
            {{ $label }}
            @if($required)<span class="text-danger">*</span>@endif
        </label>
    @endif
    <select
        name="{{ $name }}"
        id="{{ $id ?? $name }}"
        class="form-select @error($name) is-invalid @enderror"
        {{ $required ? 'required' : '' }}
    >
        @if($placeholder)
            <option value="">{{ $placeholder }}</option>
        @endif
        @foreach($options as $option)
            <option value="{{ $option->$optionValue }}"
                {{ old($name, $value) == $option->$optionValue ? 'selected' : '' }}>
                {{ $option->$optionLabel }}
            </option>
        @endforeach
    </select>
    @error($name)
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>