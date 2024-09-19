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
                                <h1>Ürün Ekleme</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 p-l-0 title-margin-left">
                        <div class="page-header">
                            <div class="page-title">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('backend.home')}}">Anasayfa</a></li>
                                    <li class="breadcrumb-item"><a href="{{route('products.index')}}">Ürünler</a></li>
                                    <li class="breadcrumb-item"> Ürün Ekle</li>
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
                                                <div class="horizontal-form">
                                                        <form action="{{route('products.store')}}" class="form-horizontal" method="post" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-sm-6">
                                                                    <label class="text-dark"><b>Ürün Adı</b></label>
                                                                    <input type="text" name="product_title" value="" class="form-control" placeholder="Lütfen ürün başlığı giriniz.">
                                                                </div>
                                                            <div class="col-sm-6">
                                                                <label class="text-dark"><b>Ürün Görseli</b></label>
                                                                <input type="file" name="product_imagepath" value="" class="form-control">
                                                            </div>

                                                            </div>
                                                            <div class="row">
                                                            <div class="col-sm-6">
                                                                <label class="text-dark"><b>Seo Link</b></label>
                                                                <input type="text" name="product_slug" value="" class="form-control" placeholder="Lütfen ürün linki giriniz.">
                                                            </div>
                                                            <div class="col-sm-3">
                                                                <label class="text-dark"><b>Ürün Cinsi</b></label>

                                                                <select name="product_type_id" class="form-control">
                                                                    <option>Seçiniz</option>
                                                                    @foreach($types as $row)
                                                                    <option value="{{$row->id}}">{{$row->type_title}}</option>
                                                                    @endforeach
                                                                 </select>
                                                            </div>
                                                                <div class="col-sm-3">
                                                                    <label class="text-dark"><b>Durum</b></label>
                                                                    <select name="product_status" class="form-control">
                                                                        <option value="0">Pasif</option>
                                                                        <option value="1">Aktif</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                                <div class="col-sm-12">
                                                                <label class="text-dark"><b>Ürün Detayı</b></label>
                                                                <textarea  id="editor"  name="product_description" placeholder="Lütfen ürün başlığı giriniz." class="form-control"></textarea>
                                                            </div>
                                                        </div>
                                                        <div  class="box-footer">
                                                            <div class="col-md-6">
                                                                <button type="submit" class="btn btn-success btn-block">Kaydet</button>
                                                            </div>
                                                        </div>
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
@endsection

