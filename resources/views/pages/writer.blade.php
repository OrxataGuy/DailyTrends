@extends('layouts.writer')
@section('publisher', 'Edición de artículo')
@section('title', $post->title)
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="single-post">
                <div class="blog-post-item cat-{{ $post->publisher_id }} box">
                    <div class="content">
                        <div style="margin-bottom: 2em;">
                            <h2>Edición del artículo:</h2>
                            <sub>Haciendo doble click sobre el título podrás editarlo.</sub>
                            <h3 contenteditable="true" id="post-title">{{ $post->title }}</h3>
                            <div class="input-group">
                            <input type="text" value="{{ $post->image }}" class="form-control" id="img-url" style="width:70%" placeholder="URL de la imágen principal" />
                                <button class="btn btn-primary" style="height:47px;" onclick="call_upload_img()">Subir imagen</button>
                            </div>
                            <form id="img-form" action="{{ route('upload') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="file" name="image" id="img-upload" style="display:none" />
                            </form>
                        </div>
                       <div style="margin-bottom: 2em;">
                            <textarea class="post">{!! $post->body !!}</textarea>
                       </div>
                       <div class="align-right">
                        <button class="btn btn-primary" onclick="submitPost()">Enviar artículo</button>
                       </div>

                    </div>
                </div>
            </div>
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

    function submitPost() {
        let body = $('.richText-editor')[0].innerHTML,
        title = $('#post-title').text(),
        image = $('#img-url').val();

        $.ajax({
            method: 'PUT',
            url: "{{ route('article.update', ['article' => $post->id ]) }}",
            data: {
                body: body,
                title: title,
                image: image
            },
            success: e => Swal.fire({
                title: 'Artículo editado correctamente',
                text: 'La página se redirigirá a su artículo',
                confirmButtonColor: '#db2e1c'
            }).then(() => location.href = "{{ env('app_url') }}/post/{{$post->id}}")
        });
    }

    function call_upload_img() {
        $("#img-upload").trigger("click");
    }

    function prepareImageUploader() {
        $('#img-form').on('submit',(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        console.log(formData);

        $.ajax({
            type:'POST',
            url: $(this).attr('action'),
            data:formData,
            cache:false,
            contentType: false,
            processData: false,
            success:function(data){
                if(data.status == 200)
                $("#img-url").val(`{{ env('app_url') }}/images/${data.value}`)
            },
            error: function(data){
                console.log("error");
                console.log(data);
            }
        });
    }));

    $("#img-upload").on("change", function() {
        $("#img-form").submit();
    });
    }

    function initialize() {
       prepareImageUploader();

        $('.post').richText({

            // text formatting
            bold: true,
            italic: true,
            underline: true,

            // lists
            ol: true,
            ul: true,

            // title
            heading: true,

            // fonts
            fonts: true,
            fontList: ["Arial",
            "Arial Black",
            "Comic Sans MS",
            "Courier New",
            "Geneva",
            "Georgia",
            "Helvetica",
            "Impact",
            "Lucida Console",
            "Tahoma",
            "Times New Roman",
            "Verdana"
            ],
            fontColor: true,
            fontSize: true,

            // uploads
            imageUpload: true,
            fileUpload: true,

            // link
            urls: true,

            // tables
            table: true,

            // code
            removeStyles: false,
            code: true,

            // colors
            colors: [],

            // dropdowns
            fileHTML: '',
            imageHTML: '',

            // translations
            translations: {
            'title': 'Título',
            'white': 'Blanco',
            'black': 'Negro',
            'brown': 'Marrón',
            'beige': 'Beige',
            'darkBlue': 'Azul Oscuro',
            'blue': 'Azul',
            'lightBlue': 'Azul Claro',
            'darkRed': 'Rojo Oscuro',
            'red': 'Rojo',
            'darkGreen': 'Verde Oscuro',
            'green': 'Verde',
            'purple': 'Morado',
            'darkTurquois': 'Turquesa Oscuro',
            'turquois': 'Turquesa',
            'darkOrange': 'Naranja Oscuro',
            'orange': 'Naranja',
            'yellow': 'Amarillo',
            'imageURL': 'URL de la imágen',
            'fileURL': 'URL del archivo',
            'linkText': 'Texto del enlace',
            'url': 'URL',
            'size': 'Tamaño',
            'responsive': '<a href="https://www.jqueryscript.net/tags.php?/Responsive/">Responsive</a>',
            'text': 'Texto',
            'openIn': 'Abrir en',
            'sameTab': 'Misma columna',
            'newTab': 'Nueva columna',
            'align': 'Alinear',
            'left': 'Izquierda',
            'justify': 'Justificar',
            'center': 'Centrar',
            'right': 'Derecha',
            'rows': 'Lineas',
            'columns': 'Columnas',
            'add': 'Añadir',
            'pleaseEnterURL': 'Introduzca una URL',
            'videoURLnotSupported': 'URL de video inválida',
            'pleaseSelectImage': 'Seleccione una imagen',
            'pleaseSelectFile': 'Seleccione un archivo',
            'bold': 'Negrita',
            'italic': 'Cursiva',
            'underline': 'Subrallado',
            'alignLeft': 'Alinear a la izquierda',
            'alignCenter': 'Alinear a centro',
            'alignRight': 'Alinear a la derecha',
            'addOrderedList': 'Añadir lista numerada',
            'addUnorderedList': 'Añadir lista',
            'addHeading': 'Añadir título',
            'addFont': 'Añadir fuente',
            'addFontColor': 'Añadir color',
            'addFontSize': 'Tamaño de fuente',
            'addImage': 'Añadir imagen',
            'addVideo': 'Añadir video',
            'addFile': 'Añadir archivo',
            'addURL': 'Añadir URL',
            'addTable': 'Añadir tabla',
            'removeStyles': 'Borrar estilos',
            'code': 'Mostrar código HTML',
            'undo': 'Deshacer',
            'redo': 'Rehacer',
            'close': 'Cerrar'
            },

            // privacy
            youtubeCookies: false,

            // preview
            preview: false,

            // placeholder
            placeholder: 'Escribe tu artículo',

            // dev settings
            useSingleQuotes: false,
            height: 0,
            heightPercentage: 0,
            id: "post-body",
            class: "",
            useParagraph: true,
            maxlength: 0,
            useTabForNext: false,

            // callback function after init
            callback: undefined,

            });


        loadFeed().then(res => {
            feeds = res.value;
            mountMayLikeFeeds()
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

