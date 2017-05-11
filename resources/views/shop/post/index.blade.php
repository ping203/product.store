@extends('shop/layout/blog')

@section('content')

<div id="post-index" class="container">

    @include('shop/partials/blog/nav')

    <div class="block-1 slider hot-posts">
        <div class="row">
            @include('shop/post/partials/slider')
        </div>
    </div>

    {{-- Tin trong từng danh mục --}}
    @foreach($postCategories as $category)
        @include('shop/post/partials/post-in-category')
    @endforeach
</div>

@stop