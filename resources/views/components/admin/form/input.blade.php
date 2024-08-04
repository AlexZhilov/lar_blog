@props([
    'id' => $id ?? $name,
    'name',
    'title',
    'value' => null,
    'required' => false,
    'type' => 'text'
])

<div {{ $attributes->merge(['class' => 'form-group']) }}>

    <label
            for="{{ $id }}"
            class="{{ $required ? 'required' : '' }} form-label @error($name) text-danger @enderror">
        {{ $title }}
    </label>

    <input
            id="{{ $id }}"
            name="{{ $name }}"
            type="{{ $type }}"
            class="form-control @error($name) is-invalid @enderror"
            value="{{ old($name, $value) }}"
            {{ $required ? 'required' : '' }}/>

    <x-admin.form.base.error name="{{ $name }}"/>

</div>