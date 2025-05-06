@php /** @var $user \App\Models\User\User */ @endphp
@extends('adminlte::page')

@section('content')

        <div class="row p-2 pt-4">
            <div class="col-12">

                <form action="{{ $user->exists ? route('admin.user.update', $user->id) : route('admin.user.store') }}" method="post" enctype="multipart/form-data" class="row g-3">
                    @csrf
                    @if( $user->exists ) @method('PATCH') @endif
                    <div class="col-md-8">
                        @include('admin.user.includes.edit_main')
                    </div>
                    <div class="col-md-3">
                        @include('admin.user.includes.edit_sidebar')
                    </div>
                </form>

            </div>
            @include('admin.user.includes.delete_bar')
        </div>

@endsection