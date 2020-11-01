@extends('layouts.admin')
@section('header')
    <h1>
        POSTS
        <small>Crear publicación</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('admin')}}"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li><a href="{{route('admin.posts.index')}}"><i class="fa fa-list"></i> Posts</a></li>
        <li class="active">Crear</li>
    </ol>
@endsection
@section('content')
    <div class="row">
        <form action="">
            <div class="col-md-8">
                <div class="box box-primary">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="title">Título de la publicación</label>
                            <input type="text" name="title" id="title" class="form-control" placeholder="Ingresa aquí el título de la publicación">
                        </div>
                        <div class="form-group">
                            <label for="body">Contenido de la publicación</label>
                            <textarea class="form-control" name="body" id="body" rows="10" placeholder="Ingresa el contenido completo de la publicación"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="box box-primary">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="excerpt">Extracto de la publicación</label>
                            <textarea class="form-control" name="excerpt" id="excerpt" placeholder="Ingresa un extracto de la publicación"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection