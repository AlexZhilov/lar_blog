@php /** @var $permission \App\Models\Permission\Permission */ @endphp

@if($permission->exists)

    <div class="col-md-8">
        <div class="card mt-2">
            <div class="card-body d-flex justify-content-end">
                <x-admin.form.btn-delete
                        :route="route('admin.permissions.destroy', $permission->id)"
                        :id="$permission->id"
                        :name="$permission->name"
                />
            </div>
        </div>
    </div>

@endif