@extends('layouts.admin')
@section('header')
    <h1>
        POSTS
        <small>Listado</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('admin')}}"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Posts</li>
    </ol>
@endsection
@section('content')
    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">Todas las publicaciones</h3>
            <button class="btn btn-primary pull-right" data-toggle="modal" data-target="#exampleModal">
                <i class="fa fa-plus"></i> Crear publicación
            </button>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table id="posts-table" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Extracto</th>
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($posts as $post)
                        <tr>
                            <td>{{$post->id}}</td>
                            <td>{{$post->title}}</td>
                            <td>{{$post->excerpt}}</td>
                            <td>
                                <a href="#" class="btn btn-xs btn-secondary"><i class="fa fa-eye"></i></a>
                                <a href="#" class="btn btn-xs btn-info"><i class="fa fa-pencil"></i></a>
                                <a href="#" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.box-body -->
    </div>
@endsection
@push('styles')
    <!-- DataTables -->
    <link rel="stylesheet" href="/adminlte/plugins/datatables/dataTables.bootstrap.css">
@endpush
@push('scripts')
    <!-- DataTables -->
    <script src="/adminlte/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="/adminlte/plugins/datatables/dataTables.bootstrap.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#posts-table').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false
            });
        });
    </script>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <form action="{{route('admin.posts.store')}}" method="POST">
            @csrf
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agrega el título de tu nueva publicación</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group {{$errors->has('title') ? 'has-error' : ''}}">
                            <input
                                value="{{old('title')}}"
                                type="text"
                                name="title" id="title"
                                class="form-control"
                                placeholder="Ingresa aquí el título de la publicación">
                            {!! $errors->first('title', '<span class="help-block">:message</span>') !!}
                        </div>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary">Crear publicación</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endpush
