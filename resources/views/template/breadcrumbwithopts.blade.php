<div class="container space-20 space-padding-tb-20">
    <ul class="breadcrumb">
        <li><a href="{{ route('index') }}">Página principal</a></li>
        <li class="active">{{ $post->title }}</li>
   </ul>
</div>
<div class="container space-20 space-padding-tb-20">
    <button class="btn btn-primary" onclick="location.href='{{ route('post.edit', ['post' => $post->id]) }}'">Editar Artículo</button>
    <button class="btn btn-primary" onclick="deletePost({{ $post->id }})">Eliminar Artículo</button>
</div>
