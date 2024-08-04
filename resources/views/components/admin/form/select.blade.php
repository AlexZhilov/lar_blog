@props([
    'name',
    'id' => $id ?? $name,
    'title',
    'required' => false,
    'multiple' => false
])

<div {{ $attributes->merge(['class' => 'form-group']) }}>

    <label
            for="{{ $id }}"
            class="{{ $required ? 'required' : '' }} form-label @error($name) text-danger @enderror">
        {{ $title }}
    </label>

    <select
            @if($multiple) multiple @endif
            id="{{ $id }}"
            class="one-select2 form-control browser-default custom-select @error($name) is-invalid @enderror {{ $multiple ? 'multiple' : '' }}"
            name="{{ $name }}">
        {{ $slot }}
    </select>

    <x-admin.form.base.error name="{{ $name }}"/>

</div>