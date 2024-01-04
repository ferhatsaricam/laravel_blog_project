@extends('front.layouts.master')

@section('title', $article->title)

@section('bg', $article->image)

@section('content')
<!-- Main Content-->


<div class="container px-4 px-lg-5">
    <div class="row gx-4 gx-lg-5 justify-content-center ">

            <div class="col-md-8 col-xl-7">
                 
                    {{$article->content}}
                    <br><br><br>
                    <span class="text-red">Okunma sayısı : <b>{{$article->hit}}</span>
            </div>
        
            @include('front.widgets.categoryWidget')

    </div>

</div>



@endsection