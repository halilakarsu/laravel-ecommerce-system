@extends('backend.layouts.index')
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.css" />
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
                                                <div class="horizontal-form text-center">
                                                      <h5>{{$productId->product_title}} için galeri fotoğrafları yükle </h5>
                                                    <hr>
                                                    <div class="col-md-12">
                                                    @foreach($galery as $row)

                                                        <img src="/backend/images/products/galery/{{$row->file_name}}">

                                                    @endforeach
                                                    </div>
                                                    <hr>
                                                   <form action="{{ route('products.dropzone') }}" method="POST" enctype="multipart/form-data" id="image-upload" class="dropzone mt-5">
                                                   @csrf <br>
                                                       <span class="fa fa-cloud-upload"></span>
                                                    </form>
                                                        <form action="{{route('products.dropzoneUpdate')}}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                            <input name="product_id" type="hidden" value="{{$productId->id}}">
                                                        <button type="submit" class="btn btn-success mt-3">Ürüne Yükle</button>
                                                            <button type="submit" class="btn btn-danger mt-3">Vazgeç</button>
                                                    </form>
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
           $(document).ready(function() {
               // Sayfa yüklendiğinde value değerini değiştir
               $('.dz-button').val("ddddd");
           });
           Dropzone.options.myDropzone = {
            paramName: "file",
            maxFilesize: 2,
            maxFiles: 5,
            dictDefaultMessage:"++Ürüne çoklu resim yükle",
            url: "{{ route('products.dropzone') }}",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            acceptedFiles: ".jpeg,.jpg,.png,.gif",
            success: function(file, response) {
                window.location.href = "{{ url('/') }}"
            },
            error: function(file, response) {
                return false;
            }
        }
    </script>
@endsection

