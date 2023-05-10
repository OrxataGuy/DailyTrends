@extends('layouts.main')
@section('content')
<header>
    <nav class="mega-menu">
        <!-- Brand and toggle get grouped for better mobile display -->
          <ul class="nav navbar-nav" id="navbar">
            <li class="level1 hover-menu">
                <a href="{{ env('app_url') }}" title="Página principal">Página principal</a>
            </li>
            @foreach(\App\Models\Publisher::all() as $publisher)
            @if($publisher->enabled == 1)
            <li class="level1 hover-menu @if($publisher->id == $publisher_id) active @endif">
                <a href="{{ env('app_url') }}/publisher/{{ $publisher->id }}" title="{{ $publisher->site }}">{{ $publisher->name }}</a>
            </li>
            @else
            <li class="level1 hover-menu unloaded" style="background-color:lightgray">
                <a href="#">{{ $publisher->name }}</a>
            </li>
            @endif

            @endforeach
            <li class="level1 hover-menu pull-right">
                <a href="{{ route('article.create') }}" class="btn btn-primary">Crear artículo</a>
            </li>
          </ul>
        </nav>

        <!-- End megamenu -->
</header>


<div class="home3-banner box space-30">
    <div class="container">
        <div class="row hidden-desktop">
            <div class="col-md-8">
                <div class="post-item ver1 overlay main-new-first"></div>
                <!-- End item -->
            </div>
            <!-- End col-md-8 -->
            <div class="col-md-4">
                <div class="post-item ver1 overlay main-new-second"></div>
                <!-- End item -->
                <div class="post-item ver1 overlay main-new-third"></div>
                <!-- End item -->
            </div>
            <!-- End col-md-4 -->
        </div>
        <div class="slide-owl-mobile home3-slide-owl nav-ver5">
            <div class="item">
                <div class="post-item ver1 overlay main-new-first"></div>
            </div>
            <!-- End item -->
            <div class="item">
                <div class="post-item ver1 overlay main-new-second"></div>
            </div>
            <!-- End item -->
            <div class="item">
                <div class="post-item ver1 overlay main-new-third"></div>
            </div>
            <!-- End item -->
        </div>
        <!-- End Slide home3 -->
    </div>
</div>
<!-- End banner-home -->

<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="single-post">
                <div class="blog-post-item cat-1 box">
                    <div class="title-v1 box">
                        <h3>Todas las noticias</h3>
                    </div>
                    <div class="box center space-30">
                        <nav class="pagination">
                        </nav>
                    </div>
                    <!-- End title -->
                    <div class="technnology box space-30" id="posts">


                    </div>
                    <!-- End technnology -->
                </div>
                <!-- End bogpost -->
            </div>
            <!-- End signle-post -->
            <div class="box center float-left space-30">

                <!-- End pagination -->
            </div>
            <!-- End float-left -->
        </div>
        @include('template.maylike')

                </div>

            </div>
    </div>
</div>
<!-- End container -->
<div id="back-to-top">
    <i class="fa fa-long-arrow-up"></i>
</div>
@endsection

@section('styles')
<style>
    .mega-menu ul.navbar-nav li.level1.unloaded:hover:before {
        display:none;
    }
    .mega-menu ul.navbar-nav li.level1.unloaded>a {
        color:gray;
    }
    img.img-middle {
        width: 36em;
        max-height: 20em;

    }
    img.main-primary {
        height: 33em;
    }

    img.main-secondary {
        height: 15.4em;
    }

    img[src*="/assets/images/logo"] {
        vertical-align: middle;
        height: auto;
        width: auto;
    }

    li.paginationjs-page.J-paginationjs-page,
    li.paginationjs-ellipsis.disabled,
    li.paginationjs-prev.J-paginationjs-previous,
    li.paginationjs-next.J-paginationjs-next,
    li.paginationjs-prev,
    li.paginationjs-next
    {
        cursor:pointer;
    }

    li.paginationjs-page.J-paginationjs-page>a,
    li.paginationjs-ellipsis.disabled>a,
    li.paginationjs-prev.disabled>a,
    li.paginationjs-prev.J-paginationjs-previous>a,
    li.paginationjs-prev>a,
    li.paginationjs-next.disabled>a,
    li.paginationjs-next.J-paginationjs-next>a,
    li.paginationjs-next>a,
    select.J-paginationjs-size-select {
        font-size: x-large;
        padding: 5px;
    }

    li.paginationjs-page.J-paginationjs-page>a:hover,
    li.paginationjs-prev.J-paginationjs-previous>a:hover,
    li.paginationjs-next.J-paginationjs-next>a:hover {
        color:#db2e1c;
        filter: brightness(130%)
    }

    li.paginationjs-page.J-paginationjs-page.active>a {
        color:#db2e1c;
    }

@media (max-width : 320px) {
    img.main-primary {
        height: 33em;
    }

    img.main-secondary {
        height: 33em;
    }
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
            url: "{{ route('feed.for', ['id' => $publisher_id]) }}"
        });
    }

    function initialize() {
        loadFeed().then(res => {
            feeds = res.value;
            mountMainFeeds()
            mountPaginator()
            mountMayLikeFeeds()
        })

    }
    function mountMainFeeds() {
        const first = $(".main-new-first"),
            second = $(".main-new-second"),
            third = $(".main-new-third"),
            templateP = feed => {
                return  `<span class="lable">${feed.publisher}</span>
                    <a class="images" href="{{ env('app_url') }}/post/${feed.id}" title="images"><img class='img-responsive main-primary' src="${feed.image}" alt="images"></a>
                    <div class="text">
                        <h2><a href="{{ env('app_url') }}/post/${feed.id}" title="${feed.title}">${feed.title}</a></h2>
                        <div class="tag">
                            <p class="date"><i class="fas fa-calendar-alt"></i>${moment(feed.updated_at).format('LL')}</p>
                        </div>
                    </div>`;
            },
            template = feed => {
                return  `<span class="lable">${feed.publisher}</span>
                    <a class="images" href="{{ env('app_url') }}/post/${feed.id}" title="images"><img class='img-responsive main-secondary' src="${feed.image}" alt="images"></a>
                    <div class="text">
                        <h2><a href="{{ env('app_url') }}/post/${feed.id}" title="${feed.title}">${feed.title}</a></h2>
                        <div class="tag">
                            <p class="date"><i class="fas fa-calendar-alt"></i>${moment(feed.updated_at).format('LL')}</p>
                        </div>
                    </div>`;
            };


        first.toArray().forEach(e => {
            $(e).append(templateP(feeds[0]))
            $(e).addClass('cat-'+feeds[0].publisher_id)
        });
        second.toArray().forEach(e => {
            $(e).append(template(feeds[1]))
            $(e).addClass('cat-'+feeds[1].publisher_id)
        });
        third.toArray().forEach(e => {
            $(e).append(template(feeds[2]))
            $(e).addClass('cat-'+feeds[2].publisher_id)
        });
    }

    function stipHtml(item) {
        let tmp = document.createElement("DIV");
        tmp.innerHTML = item;
        return tmp.textContent || tmp.innerText || "";
    }

    function mountPaginator() {
        console.log(feeds);
        const template = (data) => {
            let html = "";
            data.forEach(feed => {
                html += `<div class="post-item ver2">
                            <a class="images" href="{{ env('app_url')}}/post/${feed.id}" title="images"><img class='img-responsive img-middle' src="${feed.image}" alt="images"></a>
                            <div class="text">
                                <h2><a href="" title="title">${feed.title}</a></h2>
                                <div class="tag">
                                    <p class="date"><i class="fas fa-calendar-alt"></i>${moment(feed.updated_at).format('LL')}</p>
                                </div>
                                <p class="description">${stipHtml(feed.body).trim().substring(0, 100)}...</p>
                                <a class="read-more" href="#" title="readMore">Leer artículo</a>
                            </div>
                        </div>`
            })
            return html
        }

        $('.pagination').pagination({
            dataSource: feeds,
            pageSize: 2,
            showSizeChanger: true,
            callback: function(data, pagination) {
                // template method of yourself
                var html = template(data);
                $("#posts").html(html);
            }
        })
    }

    function mountMayLikeFeeds() {
        const container = $('.aside-right-news')[0],
            templateFirst = feed => {
                return `<div class="post-item ver1 overlay">
                <a class="images" href="{{ env('app_url') }}/post/${feed.id}" title="images"><img class='img-responsive' src="${feed.image}" alt="images"></a>
                    <div class="text">
                        <h2><a href="{{ env('app_url') }}/post/${feed.id}" title="${feed.title}">${feed.title}</a></h2>
                        <div class="tag">
                            <p class="date"><i class="fas fa-calendar-alt"></i>${moment(feed.updated_at).format('LL')}</p>
                        </div>
                    </div>
                </div>`
            },
            min = 15,
            count = 10,
            template = feed => {
                return `<div class="post-item ver2 overlay">
                <a class="images" href="{{ env('app_url') }}/post/${feed.id}" title="images"><img class='img-responsive' src="${feed.image}" alt="images"></a>
                    <div class="text">
                        <h2><a href="{{ env('app_url') }}/post/${feed.id}" title="${feed.title}">${feed.title}</a></h2>
                        <div class="tag">
                            <p class="date"><i class="fas fa-calendar-alt"></i>${moment(feed.updated_at).format('LL')}</p>
                        </div>
                    </div>
                </div>`
            };
            for(let i=0; i<count; i++)
                if(i==0) $(container).append(templateFirst(feeds[min+i]))
                else $(container).append(template(feeds[min+i]))
    }
</script>
@endsection
