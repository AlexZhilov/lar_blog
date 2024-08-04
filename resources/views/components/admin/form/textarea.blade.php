@props([
    'name',
    'title',
    'value',
    'summernote' => false,
    'required' => false,
    'cols' => 30,
    'rows' => 10
])

<div {{ $attributes->merge(['class' => 'form-group']) }}>

    <label
            for="{{ $name }}"
            class="{{ $required ? 'required' : '' }} form-label @error($name) text-danger @enderror">
        {{ $title }}
    </label>

    <textarea
            class="form-control @error($name) is-invalid @enderror {{ $summernote ? 'summernote' : '' }}"
            name="{{ $name }}"
            id="{{ $name }}"
            cols="{{ $cols }}"
            rows="{{ $rows }}">{{ old($name, $value) }}</textarea>

    <x-admin.form.base.error name="{{ $name }}"/>

</div>
