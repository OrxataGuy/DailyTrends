@extends('layouts.main')
@section('content')
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
        <div class="col-md-2">
            <aside class="widget size-16 post-col box aside-left-news"></aside>
        </div>
        <!-- End col-md-2 -->
        <div class="col-md-6">
            <div class="slider-one-item box space-30 main-news"></div>
        </div>
        @include('template.maylike')
    </div>
</div>
<!-- End container -->
<div id="back-to-top">
    <i class="fa fa-long-arrow-up"></i>
</div>
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
            mountMainFeeds()
            mountLeftFeeds()
            mountMiddleFeeds()
            mountMayLikeFeeds()
        })

    }
    function mountMainFeeds() {
        const first = $(".main-new-first"),
            second = $(".main-new-second"),
            third = $(".main-new-third"),
            template = feed => {
                return  `<span class="lable">${feed.publisher}</span>
                    <a class="images" href="post/${feed.id}" title="images"><img class='img-responsive' src="${feed.image}" alt="images"></a>
                    <div class="text">
                        <h2><a href="post/${feed.id}" title="title">${feed.title}</a></h2>
                        <div class="tag">
                            <p class="date"><i class="fa fa-clock-o"></i>May 06,2014</p>
                        </div>
                    </div>`;
            }


        first.toArray().forEach(e => {
            $(e).html(template(feeds[0]))
            $(e).addClass('cat-'+feeds[0].publisher_id)
        });
        second.toArray().forEach(e => {
            $(e).html(template(feeds[1]))
            $(e).addClass('cat-'+feeds[1].publisher_id)
        });
        third.toArray().forEach(e => {
            $(e).html(template(feeds[2]))
            $(e).addClass('cat-'+feeds[2].publisher_id)
        });
    }

    function mountLeftFeeds() {
        const container = $(".aside-left-news")[0],
            min=3,
            count = 6,
            template = feed => {
                return `<div class="post-item ver3 overlay">
                    <div class="wrap-images">
                        <a class="images" href="post/${feed.id}" title="images"><img class='img-responsive' src="${feed.image}" alt="images"></a>
                    </div>
                    <div class="text">
                        <h2><a href="post/${feed.id}" title="title">${feed.title}</a></h2>
                        <div class="tag">
                            <p class="date"><i class="fa fa-clock-o"></i>May 06,2014</p>
                        </div>
                    </div>
                </div>`;
            };

        for(let i=0; i<count; i++)
            $(container).append(template(feeds[min+i]))
    }

    function mountMiddleFeeds() {
        const container = $(".main-news")[0],
            min=10,
            count = 4,
            template = feed => {
                return `<div class="post-item cat-${feed.publisher_id} ver1 overlay">
                    <span class="lable">${feed.publisher}</span>
                    <a class="images" href="post/${feed.id}" title="images"><img class='img-responsive' src="${feed.image}" alt="images"></a>
                    <div class="text">
                        <h2><a href="post/${feed.id}" title="${feed.title}">${feed.title}</a></h2>
                        <div class="tag">
                            <p class="date"><i class="fa fa-clock-o"></i>May 06,2014</p>
                        </div>
                    </div>
                </div>`;
            };
            for(let i=0; i<count; i++)
                $(container).append(template(feeds[min+i]))
    }

    function mountMayLikeFeeds() {
        const container = $('.aside-right-news')[0],
            templateFirst = feed => {
                return `<div class="post-item ver1 overlay">
                <a class="images" href="post/${feed.id}" title="images"><img class='img-responsive' src="${feed.image}" alt="images"></a>
                    <div class="text">
                        <h2><a href="post/${feed.id}" title="${feed.title}">${feed.title}</a></h2>
                        <div class="tag">
                            <p class="date"><i class="fa fa-clock-o"></i>May 06,2014</p>
                        </div>
                    </div>
                </div>`
            },
            min = 15,
            count = 10,
            template = feed => {
                return `<div class="post-item ver2 overlay">
                <a class="images" href="post/${feed.id}" title="images"><img class='img-responsive' src="${feed.image}" alt="images"></a>
                    <div class="text">
                        <h2><a href="post/${feed.id}" title="${feed.title}">${feed.title}</a></h2>
                        <div class="tag">
                            <p class="date"><i class="fa fa-clock-o"></i>May 06,2014</p>
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
