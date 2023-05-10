@extends('layouts.post')
@section('publisher', $post->publisher)
@section('title', $post->title)
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="single-post">
                <div class="blog-post-item cat-{{ $post->publisher_id }} box">
                    <div class="blog-post-images">
                        <a class="hover-images" href="#" title="Post"><img class="img-responsive" src="{{$post->image }}" alt="{{ $post->title }}"></a>
                    </div>
                    <div class="content">
                        <h3>{{ $post->title }}</h3>
                        <div class="tag">
                            <p class="label">{{ $post->publisher }}</p>
                            <p class="date"><i class="fa fa-clock-o"></i>May 06,2014</p>
                        </div>

                        {!! $post->body !!}
                    </div>
                    <div class="pagination">
                        <div class="prev">
                            <a href="{{ env('app_url') }}/post/{{ $post->getPrevious()->id }}" title="prev">
                                <div class="icon-box">
                                    <i class="icon"></i>
                                </div>
                                <div class="text">
                                    <p class="control">ARTÍCULO ANTERIOR</p>
                                    <p class="title">{{ $post->getPrevious()->title }}</p>
                                </div>
                            </a>
                        </div>
                        <div class="next">
                            <a href="{{ env('app_url') }}/post/{{ $post->getNext()->id }}" title="next">
                                <div class="text">
                                    <p class="control">SIGUIENTE ARTÍCULO</p>
                                    <p class="title">{{ $post->getNext()->title }}</p>
                                </div>
                                <div class="icon-box">
                                    <i class="icon"></i>
                                </div>
                            </a>
                        </div>
                    </div>
                    <!-- End pagination -->
                    <div class="title-v1 box">
                        <h3>Artículos relacionados</h3>
                    </div>
                    <!-- End title -->
                    <div class="slider-two-item box float-left space-40 nav-ver2 nav-white">
                        @foreach($post->getRelated(5) as $related)
                            <div class="post-item ver3 overlay">
                                <div class="wrap-images">
                                    <a class="images related-img" href="{{ env('app_url') }}/post/{{ $related->id }}" title="images"><img class='img-responsive related-img' src="{{ $related->image }}" alt="images"></a>
                                </div>
                                <div class="text">
                                    <h2><a href="" title="title">{{ $related->title }}</a></h2>
                                    <div class="tag">
                                        <p class="date"><i class="fa fa-clock-o"></i>May 06,2014</p>
                                    </div>
                                    <a class="read-more" href="#" title="read more">Leer artículo</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <!-- End slider -->

                </div>
            </div>
            <!-- End signle-post -->
        </div>
        @include('template.maylike')
    </div>
</div>
<!-- End container -->
<div id="back-to-top">
    <i class="fa fa-long-arrow-up"></i>
</div>
@endsection

@section('styles')
<style>
    img {
        vertical-align: middle;
        height: auto;
        width: 50em;
    }

    img[src*="/assets/images/logo.png"] {
        vertical-align: middle;
        height: auto;
        width: auto;
    }

    img.img-responsive {
        height: auto;
        width: 50em;
    }
    .link {
        display: initial;
    }

    .related-img {
        height: 240px;
        max-height: 240px;
    }
</style>
@endsection

@section('scripts')
<script>
    initialize()
    var feeds;
    function loadFeed() {
        return $.ajax({
            method: 'GET',
            url: "{{ route('feed') }}"
        });
    }

    function initialize() {
        loadFeed().then(res => {
            feeds = res.value;
            mountMayLikeFeeds()
        })
    }

    function deletePost(id) {
        Swal.fire({
            title: "Espera un segundo",
            html: "<p>Si borras este artículo, no se volverá a recargar. Sabiendo esto...</p><br/><h1>¿Quieres borrar el artículo?</h1>",
            icon: 'warning',
            confirmButtonText: 'Sí',
            confirmButtonColor: '#db2e1c',
            showDenyButton: true,
            denyButtonText: 'No',
            denyButtonColor: 'darkgray',
        }).then(res => {
            if(res.isConfirmed) _deletePost(id)
        })
    }

    function _deletePost(id) {
        $.ajax({
            method: 'DELETE',
            url: "{{ route('article.destroy', ['article' => ':id']) }}".replace(':id', id),
            success: Swal.fire({
                title: "Artículo borrado correctamente",
                text: "Se le va a redirigir a la página de inicio",
                confirmButtonColor: '#db2e1c',
            }).then(e => {location.href = "{{ route('index') }}"}),
        });
    }

    function mountMayLikeFeeds() {
        const container = $('.aside-right-news')[0],
            templateFirst = feed => {
                return `<div class="post-item ver1 overlay">
                <a class="images" href="{{ env('app_url') }}/post/${feed.id}" title="images"><img class='img-responsive' src="${feed.image}" alt="images"></a>
                    <div class="text">
                        <h2><a href="{{ env('app_url') }}/post/${feed.id}" title="${feed.title}">${feed.title}</a></h2>
                        <div class="tag">
                            <p class="date"><i class="fa fa-clock-o"></i>May 06,2014</p>
                        </div>
                    </div>
                </div>`
            },
            count = 10,
            template = feed => {
                return `<div class="post-item ver2 overlay">
                <a class="images" href="{{ env('app_url') }}/post/${feed.id}" title="images"><img class='img-responsive' src="${feed.image}" alt="images"></a>
                    <div class="text">
                        <h2><a href="{{ env('app_url') }}/post/${feed.id}" title="${feed.title}">${feed.title}</a></h2>
                        <div class="tag">
                            <p class="date"><i class="fa fa-clock-o"></i>May 06,2014</p>
                        </div>
                    </div>
                </div>`
            };
            for(let i=0; i<count; i++)
                if(i==0) $(container).append(templateFirst(feeds[i]))
                else $(container).append(template(feeds[i]))
    }
</script>
@endsection

