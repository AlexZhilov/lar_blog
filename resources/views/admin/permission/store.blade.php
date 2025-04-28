@php /** @var $permission \App\Models\Permission\Permission */ @endphp
@extends('adminlte::page')

@section('content')

    <div class="row p-2">
        <div class="col-12">

            <form action="{{ $permission->exists ? route('admin.permissions.update', $permission->id) : route('admin.permissions.store') }}" method="post" enctype="multipart/form-data"
                  class="row g-3">
                @csrf
                @if( $permission->exists )
                    @method('PATCH')
                @endif
                <div class="col-md-8">
                    @include('admin.permission.includes.edit_main')
                </div>
                <div class="col-md-3">
                    @include('admin.permission.includes.edit_sidebar')
                </div>
            </form>

        </div>
        @include('admin.permission.includes.delete_bar')
    </div>

@endsection