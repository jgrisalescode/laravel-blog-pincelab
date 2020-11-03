@extends('layouts.admin')
@section('content')
    <h1>Dashboard</h1>
    <p>Usuarios autenticado: {{auth()->user()->name}}</p>
    <a href="{{route('logout')}}"
        onclick="event.preventDefault();
        document.getElementById('logout-form').submit();"
    >
        Cerrar sesión
    </a>
    <form action="{{route('logout')}}" method="post" class="d-none" id="logout-form">
        @csrf
    </form>
@endsection
