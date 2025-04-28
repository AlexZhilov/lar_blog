@php /** @var $role \App\Models\Role\Role */ @endphp

@if($role->exists)

    <div class="col-md-8">
        <div class="card mt-2">
            <div class="card-body d-flex justify-content-end">
                <x-admin.form.btn-delete
                        :route="route('admin.permissions.destroy', $role->id)"
                        :id="$role->id"
                        :name="$role->name"
                />
            </div>
        </div>
    </div>

@endif