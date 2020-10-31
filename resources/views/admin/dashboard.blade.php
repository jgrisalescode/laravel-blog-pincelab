@extends('layouts.admin')
@section('content')
    <h1>Dashboard</h1>
    <p>Usuarios autenticado: {{auth()->user()->name}}</p>
@endsection
