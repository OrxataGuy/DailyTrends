<div class="container space-20 space-padding-tb-20">
    <ul class="breadcrumb">
       <li><a href="{{ route('index') }}">Página principal</a></li>
       <li><a href="{{ env('app_url') }}/post/{{$post->id}}">{{ $post->title }}</a></li>
       <li class="active">Edición de artículo</li>
   </ul>
</div>
