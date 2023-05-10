<style>
    .ico {
        width: 30px;
        height: 30px;
    }

    .btn-ico {
        border: none; /* Remove borders */
        background-color: white; /* White text */
       /* padding: 12px 16px; /* Some padding */
        font-size: 16px; /* Set a font size */
        cursor: pointer; /* Mouse pointer on hover */
        width: 30px;
        height: 30px;
    }

    .btn-ico-disabled {
        border: none; /* Remove borders */
        background-color: white; /* White text */
       /* padding: 12px 16px; /* Some padding */
        font-size: 16px; /* Set a font size */
        cursor: pointer; /* Mouse pointer on hover */
        width: 30px;
        height: 30px;
        filter: brightness(50%);
    }

    .btn-ico:hover {
        filter: brightness(75%);
    }
</style>


<header id="header" class="header-v1">
    <div class="header-top">
            <div class="container">
            <div class="box float-left">
                <p class="icon-menu-mobile"><i class="fa fa-bars" ></i></p>
                <div class="logo"><a href="{{ route('index') }}" title="Página principal">
                <img class="logo" src="{{ env('app_url') }}/assets/images/logo.png" alt="images">
                </a></div>
                <div class="logo-mobile"><a href="#" title="Xanadu"><img src="{{ env('app_url') }}/assets/images/logo.png" alt="Xanadu-Logo"></a></div>

                <div class="box-right">
                    <div class="social">
                        @foreach(\App\Models\Publisher::where('id', '<>', 2)->get() as $publisher)
                            <a href="#" title="{{ $publisher->name }}" onclick="togglePublisher({{ $publisher->id }})" class="btn-ico @if($publisher->enabled==0) btn-ico-disabled @endif"><img src="{{ $publisher->icon }}" class="ico" /></a>
                        @endforeach
                    </div>
                    <div class="search dropdown" data-toggle="modal" data-target=".bs-example-modal-lg" style="display:none;">
                        <i class="icon"></i>
                    </div>
                </div>
            </div>
            </div>
            <!-- End container -->
        </div>
        <!-- End header-top -->
        <!-- End megamenu -->
</header><!-- /header -->

<script>
    function togglePublisher(id) {
        $.ajax({
            method: 'PUT',
            url: "{{ route('toggle.publisher') }}",
            data: {id: id},
            beforeSend: () => $(".awe-page-loading").fadeIn(),
            success: res => location.reload()
        });
    }
</script>
