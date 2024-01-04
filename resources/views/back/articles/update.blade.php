@extends('back.layouts.master')

@section('title', $article->title.' makalesini güncelle')
@section('content')

<div class="card shadow mb-4">
    <div class="card-header py-3">
    </div>
    <div class="card-body">
        @if($errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </div>
        @endif
        <form action="{{route('admin.makaleler.update', $article->id)}}" method="post" enctype="multipart/form-data">
            method('PUT')
            @csrf
            <div class="form-group">
                <label for="">Makale Başlığı</label>
                <input type="text" name="title" value="{{$article->title}}" class="form-control" required></input>
            </div>

            <div class="form-group">
                <label for="">Makale Kategori</label>
                <select class="form-control" name="category" id="" required>
                    <option value="">Seçim Yapınız</option>
                    @foreach ($categories as $category)
                        <option @if($article->category_id==$category->id) selected @endif value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </select>      
            </div>

            <div class="form-group">
                <label for="">Makale Fotoğrafı</label><br>
                <img src="{{asset($article->image)}}" width="300" class="rounded img-thumbnail" alt="">
                <input type="file" name="image" class="form-control"></input>
            </div>

            <div class="form-group">
                <label for="">Makale İçeriği</label>
                <textarea name="content" class="form-control" id="editor" cols="30" rows="4">{!!$article->content!!}</textarea>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block">Makaleyi Güncelle</button>

            </div>
      
        </form>    
    </div>
</div>

@endsection

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script>
        $(document).ready(function() 
        {
        $('#editor').summernote({'height':300});
        });
    </script>
@endsection