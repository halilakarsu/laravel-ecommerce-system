@extends('backend.layouts.index')
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.css" />
    <link rel="stylesheet" href="/backend/assets/css/custom.css"
@endsection
@section('content')
    <div class="content-wrap">
        <div class="main">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6 p-r-0 title-margin-right">
                        <div class="page-header">
                            <div class="page-title">
                                <h1>Ürün Görsel İşlemleri</h1>
                                <p>Ürüne ait birden fazla resim yüklemek için lğt</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 p-l-0 title-margin-left">
                        <div class="page-header">
                            <div class="page-title">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('backend.home')}}">Anasayfa</a></li>
                                    <li class="breadcrumb-item"><a href="{{route('products.index')}}">Ürünler</a></li>
                                    <li class="breadcrumb-item"> Ürün Görsel İşlemleri</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <section id="main-content">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <div class="card">
                                            @if($errors->any())
                                                @foreach($errors->all() as $error)
                                                    <script>
                                                        alertify.error('{{$error}}');
                                                    </script>
                                                @endforeach
                                            @endif
                                            <div class="card-body">
                                                <form action="{{ route('products.dropzone') }}" method="POST" enctype="multipart/form-data" id="image-upload" class="dropzone mt-5">
                                                    @csrf <br>

                                                    <input name="product_id" type="hidden" value="{{$productId->id}}">
                                                </form>
                                                <div class="horizontal-form text-center mt-5">
                                                    <a class="btn btn-success btn-sm" href="{{route('products.dropzoneShow',$productId->id)}}"> Devam Et </a>
                                                    <a class="btn btn-danger btn-sm" href="{{route('products.index')}}"> Vazgeç </a>
                                                    <hr>
                                                    @if($galery->isNotEmpty())
                                                    <h5>{{$productId->product_title}}  galeri fotoğrafları </h5>
                                                    <div class="row">
                                                    @foreach($galery as $row)
                                                        <div class="col-md-3">
                                                            <a href="{{ route('products.dropzoneDelete', ['id' => $row->id]) }}" class="btn btn-danger btn-sm">X</a><br>
                                                        <img width="150px" height="150px" src="/backend/images/products/dropzone/{{$row->file_name}}">
                                                        </div>
                                                    @endforeach
                                                    </div>
                                                    <hr>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.js"></script>

       <script>
           Dropzone.options.myDropzone = {
               paramName: "file",
               maxFilesize: 2,
               maxFiles: 5,
               dictDefaultMessage: "++Ürüne çoklu resim yükle",
               url: "{{ route('products.dropzone') }}",
               headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               },
               acceptedFiles: ".jpeg,.jpg,.png,.gif",
               success: function (file, response) {
                   console.log(response); // Yanıtı kontrol et
                   window.location.reload();
               },
               error: function (file, response) {
                   console.error(response); // Hata durumunu kontrol et
                   return false;
               }
           }

       </script>
@endsection

