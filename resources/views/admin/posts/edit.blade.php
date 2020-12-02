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
        <form action="{{route('admin.posts.update', $post)}}" method="POST">
            @csrf
            @method('PUT')
            <div class="col-md-8">
                <div class="box box-primary">
                    <div class="box-body">
                        <div class="form-group {{$errors->has('title') ? 'has-error' : ''}}">
                            <label for="title">Título de la publicación</label>
                            <input
                                value="{{old('title', $post->title)}}"
                                type="text"
                                name="title" id="title"
                                class="form-control"
                                placeholder="Ingresa aquí el título de la publicación">
                            {!! $errors->first('title', '<span class="help-block">:message</span>') !!}
                        </div>
                        <div class="form-group {{$errors->has('body') ? 'has-error' : ''}}">
                            <label for="body">Contenido de la publicación</label>
                            <textarea class="form-control" name="body" id="editor1" rows="10" placeholder="Ingresa el contenido completo de la publicación">
                                {{old('body', $post->body)}}
                            </textarea>
                            {!! $errors->first('body', '<span class="help-block">:message</span>') !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="box box-primary">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="published_at">Fecha de publicación:</label>
                            <div class="input-group date">
                                <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                                </div>
                                <input
                                    value="{{old('published_at', $post->published_at ? $post->published_at->format('m/d/Y') : null)}}"
                                    name="published_at"
                                    type="text"
                                    class="form-control pull-right"
                                    id="datepicker">
                            </div>
                            <!-- /.input group -->
                        </div>
                        <div class="form-group {{$errors->has('category') ? 'has-error' : ''}}">
                            <label for="category_id">Categorías</label>
                            <select name="category" id="category" class="form-control">
                                <option value="">Selecciona una categoría</option>
                                @foreach ($categories as $category)
                                    <option value="{{$category->id}}" {{old('category', $post->category_id) == $category->id ? 'selected' : ''}}>{{$category->name}}</option>
                                @endforeach
                            </select>
                            {!! $errors->first('category', '<span class="help-block">:message</span>') !!}
                        </div>
                        <div class="form-group {{$errors->has('tags') ? 'has-error' : ''}}">
                            <label>Etiquetas</label>
                            <select
                                class="form-control select2"
                                multiple="multiple"
                                name="tags[]"
                                data-placeholder="Seleciona una o más etiquetas"
                                style="width: 100%;"
                            >
                                @foreach($tags as $tag)
                                    <option {{collect(old('tags', $post->tags->pluck('id')))->contains($tag->id) ? 'selected' : ''}} value="{{ $tag->id }}">{{$tag->name}}</option>
                                @endforeach
                            </select>
                            {!! $errors->first('tags', '<span class="help-block">:message</span>') !!}
                        </div>
                        <div class="form-group {{$errors->has('excerpt') ? 'has-error' : ''}}">
                            <label for="excerpt">Extracto de la publicación</label>
                            <textarea class="form-control" name="excerpt" id="excerpt" placeholder="Ingresa un extracto de la publicación">
                                {{old('excerpt', $post->excerpt)}}
                            </textarea>
                            {!! $errors->first('excerpt', '<span class="help-block">:message</span>') !!}
                        </div>
                        <div class="form-group">
                            <div class="dropzone"></div>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary btn-block" type="submit">Guardar publicación</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('styles')
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="/adminlte/plugins/datepicker/datepicker3.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="/adminlte/plugins/select2/select2.min.css">
    <!-- Dropzone -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.2/dropzone.css">
@endpush

@push('scripts')
    <!-- Dropzone -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.2/min/dropzone.min.js"></script>
    <!-- bootstrap datepicker -->
    <script src="/adminlte/plugins/datepicker/bootstrap-datepicker.js"></script>
    <!-- CK Editor -->
    <script src="https://cdn.ckeditor.com/4.15.0/standard/ckeditor.js"></script>
    <!-- Select2 -->
    <script src="/adminlte/plugins/select2/select2.full.min.js"></script>
    <script>
        $(document).ready(function (){
            //Initialize Select2 Elements
            $('.select2').select2();
            //Date picker
            $('#datepicker').datepicker({
            autoclose: true
            });
            CKEDITOR.replace('editor1');
            // Dropzone
            let myDropzone = new Dropzone('.dropzone', {
                url: '/admin/posts/{{ $post->slug }}/photos',
                paramName: 'photo',
                acceptedFiles: 'image/*',
                maxFilesize: 2,
                headers: {
                    'X-CSRF-TOKEN': '{{csrf_token()}}'
                },
                dictDefaultMessage: 'Arrastra las fotos aquí para subirlas'
            })

            myDropzone.on('error', function (file, res) {
                let msg = res.errors.photo[0];
                $('.dz-error-message:last > span').text(msg);
            })

            Dropzone.autoDiscover = false
        });
    </script>
@endpush

