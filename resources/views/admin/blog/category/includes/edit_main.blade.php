@php /** @var $category \App\Models\Blog\Category */ @endphp
<div class="card">
    <div class="card-body">

        <div class="row">
            <x-admin.form.input
                    class="col-md-6"
                    name="title"
                    :value="$category->title"
                    :title="__('Title')"/>

        </div>

        <div class="row">

            <x-admin.form.input
                    class="col"
                    name="slug"
                    :value="$category->slug"
                    :title="__('URL')"/>

            <x-admin.form.select class="col" name="parent_id" :title="__('Parent')">
                <option>{{ __('Choose...') }}</option>
                @foreach($categories as $id => $title)
                    <option {{ old('parent_id') == $id || $category->parent_id == $id ? 'selected' : ''}} value="{{ $id }}">{{ $title }}</option>
                @endforeach
            </x-admin.form.select>

            <x-admin.form.textarea
                    class="col-md-12"
                    required
                    summernote
                    name="description"
                    :value="$category->description"
                    :title=" __('Description')"
            />

        </div>

    </div>
</div>