@php /** @var $role \App\Models\Role\Role */ @endphp
@extends('adminlte::page')

@section('content')

    <div class="row p-2">
        <div class="col-12">

            <form action="{{ $role->exists ? route('admin.roles.update', $role->id) : route('admin.roles.store') }}" method="post" enctype="multipart/form-data"
                  class="row g-3">
                @csrf
                @if( $role->exists )
                    @method('PATCH')
                @endif
                <div class="col-md-8">
                    @include('admin.role.includes.edit_main')
                </div>
                <div class="col-md-3">
                    @include('admin.role.includes.edit_sidebar')
                </div>
            </form>

        </div>
        @include('admin.role.includes.delete_bar')
    </div>

@endsection