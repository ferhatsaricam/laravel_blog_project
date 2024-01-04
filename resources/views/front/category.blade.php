@extends('front.layouts.master')

@section('title', $category->name)  

@section('content')
<!-- Main Content-->


<div class="container px-4 px-lg-5">
    <div class="row gx-4 gx-lg-5 justify-content-center">
        <div class="col-md-10 col-lg-8 col-xl-7">

            @if(count($articles) > 0)
            <!-- Post preview-->
            @foreach($articles as $article)
            <div class="post-preview">
                <a href="{{route('single', [$article->getCategory->slug, $article->slug])}}">
                    <h2 class="post-title">{{$article->title}}</h2>
                    <img src="{{$article->image}}" alt="">
                    <h3 class="post-subtitle">{{Str::limit($article->content,50)}}</h3>
                </a>
                <p class="post-meta">Kategori:
                    <a href="#!">{{$article->getCategory->name}}</a>
                    <span class="float-end">{{$article->created_at->diffForHumans()}}</span>
                </p>
                
            </div>
            <hr class="my-4" />

            @endforeach

            @else
            <div class="alert alert-danger">
                <h2>Bu kategoriye ait yazı bulunamadı</h2>
            </div>

            @endif

            {{$articles->links()}}

        </div>

        @include('front.widgets.categoryWidget')

    </div>
</div>



@endsection