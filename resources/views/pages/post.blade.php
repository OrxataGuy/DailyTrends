@extends('layouts.post')
@section('publisher', 'MARCA')
@section('title', 'Lorem Ipsum')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="single-post">
                <div class="blog-post-item cat-1 box">
                    <div class="blog-post-images">
                        <a class="hover-images" href="#" title="Post"><img class="img-responsive" src="{{ env('app_url') }}/assets/images/blog/23.jpg" alt=""></a>
                    </div>
                    <div class="content">
                        <h3>Facebook's website now uses HTML5 instead of Flash forall videos</h3>
                        <div class="tag">
                            <p class="label">Techology</p>
                            <p class="date"><i class="fa fa-clock-o"></i>May 06,2014</p>
                        </div>
                        <p>Adipisicing nam cras consequat ipsum. Donec excepteur aptent incididunt class. Congue natoque varius bibendum primis. Maecenas fermentum integer eleifend feugiat nisi.</p>
                        <p>Ac nostrud porta lacinia vulputate. Volutpat etiam inceptos sociosqu eros. Ut tristique nascetur pede pretium diam. Ut fames ac do condimentum mi. Laoreet imperdiet eros aliquip feugiat fugiat. Euismod placerat pharetra malesuada porttitor habitant. Posuere ipsum iaculis curabitur imperdiet tristique.</p>
                        <div class="row content-text">
                            <div class="col-md-6 bold border">
                                <p>Adipisicing nam cras consequat ipsum. Donec excepteur aptent incididunt class. Congue natoque varius maecenas feugiat nisi.</p>
                            </div>
                            <!-- End col-md-6 -->
                            <div class="col-md-6">
                                <p>Adipisicing nam cras consequat ipsum. Donec excepteur aptent incididunt class. Congue natoque varius bibendum primis. Maecenas fermentum integer eleifend feugiat nisi.</p>
                            </div>
                            <!-- End col-md-6 -->
                        </div>
                        <!-- End content-text -->
                        <p>Adipisicing nam cras consequat ipsum. Donec excepteur aptent incididunt class. Congue natoque varius bibendum primis. Maecenas fermentum integer eleifend feugiat nisi.</p>
                        <p>Ac nostrud porta lacinia vulputate. Volutpat etiam inceptos sociosqu eros. Ut tristique nascetur pede pretium diam. Ut fames ac do condimentum mi. Laoreet imperdiet eros aliquip feugiat fugiat. Euismod placerat pharetra malesuada porttitor habitant. Posuere ipsum iaculis curabitur imperdiet tristique. Nostra pretium per scelerisque enim conubia. Praesent id justo bibendum pede. Congue magna mus venenatis vestibulum. Lectus magna sollicitudin per aliquip nullam.</p>
                        <p>Anim tincidunt odio massa esse per. Nisl neque iaculis ad urna non. Metus vestibulum tortor occaecat dolor. Hendrerit euismod quam excepteur ut. Mollis ante nulla nibh ex. Arcu torquent maecenas lectus vulputate</p>
                        <p>Tortor nunclorem anim nibh molestie. Ad sint litora faucibus elit. Eros lacinia esse reprehenderit gravida. Ut iaculis incididunt deserunt proident. Lacinia turpis porttitor ullamco lacus. Ea aliquip tincidunt placerat nisl. Justo habitant ea nulla fringilla.</p>
                        <p>Ullamcorper taciti class justo eros. Pede fusce dapibus vehicula porta cras. Malesuada eros minim accumsan ultrices. Praesent massa auctor vel scelerisque vulputate. Curabitur rhoncus ultrices sunt ipsum pariatur. Commodo donec nascetur nisl vehicula. Congue incididunt pellentesque rhoncus scelerisque a. Morbi tempus habitant ad proident.</p>
                    </div>
                    <div class="pagination">
                        <div class="prev">
                            <a href="#" title="prev">
                                <div class="icon-box">
                                    <i class="icon"></i>
                                </div>
                                <div class="text">
                                    <p class="control">PREVIOUS POST</p>
                                    <p class="title">Mossberg: The next big thing didn't show up this year</p>
                                </div>
                            </a>
                        </div>
                        <div class="next">
                            <a href="#" title="next">
                                <div class="text">
                                    <p class="control">NEXT POST</p>
                                    <p class="title">Tim Cook calls Apple tax evasion cla\ims 'total political crap</p>
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
                        <div class="post-item ver3 overlay">
                            <div class="wrap-images">
                                <a class="images" href="#" title="images"><img class='img-responsive' src="{{ env('app_url') }}/assets/images/blog/9.jpg" alt="images"></a>
                            </div>
                            <div class="text">
                                <h2><a href="" title="title">The Perfect theme for Games</a></h2>
                                <div class="tag">
                                    <p class="date"><i class="fa fa-clock-o"></i>May 06,2014</p>
                                </div>
                                <p>Praesent adipiscing. Phasellus ullamcorper ipsum rutrum nunc. Nunc nonummy metus. Vestibulum volutpat pretium libero. Cras id dui. Aenean ut eros et nisl sagittis vestibulum. Donec mollis hendrerit risus...</p>
                                <a class="read-more" href="#" title="read more">read more</a>
                            </div>
                        </div>
                        <!-- End item -->
                        <div class="post-item ver3 overlay">
                            <div class="wrap-images">
                                <a class="images" href="#" title="images"><img class='img-responsive' src="{{ env('app_url') }}/assets/images/blog/9.jpg" alt="images"></a>
                            </div>
                            <div class="text">
                                <h2><a href="" title="title">The Perfect theme for Games</a></h2>
                                <div class="tag">
                                    <p class="date"><i class="fa fa-clock-o"></i>May 06,2014</p>
                                </div>
                                <p>Praesent adipiscing. Phasellus ullamcorper ipsum rutrum nunc. Nunc nonummy metus. Vestibulum volutpat pretium libero. Cras id dui. Aenean ut eros et nisl sagittis vestibulum. Donec mollis hendrerit risus...</p>
                                <a class="read-more" href="#" title="read more">read more</a>
                            </div>
                        </div>
                        <!-- End item -->
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
