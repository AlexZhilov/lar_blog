@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>

@stop

@section('content')
    @role('admin')
        Вы админ
    @endrole

    {{ dump(Gate::allows('admin-access')) }}


    <p>Welcome to this beautiful admin panel.</p>
@stop