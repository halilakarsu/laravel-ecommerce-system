@extends('backend.layouts.index')
@section('content')
    <div class="content-wrap">
        <div class="main">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6 p-r-0 title-margin-right">
                        <div class="page-header">
                            <div class="page-title">
                                <h1>Yeni Sayfa Ekleme<br></h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 p-l-0 title-margin-left">
                        <div class="page-header">
                            <div class="page-title">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('backend.home')}}">Anasayfa</a></li>
                                    <li class="breadcrumb-item"><a href="{{route('pages.index')}}">Sayfa</a></li>
                                    <li class="breadcrumb-item"> Sayfa Ekle</li>
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
                                                    <form action="{{route('pages.store')}}" class="form-horizontal" method="post" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-sm-6">
                                                                    <label class="text-dark"><b>Sayfa Adı</b></label>
                                                                    <input type="text" name="page_title" value="" class="form-control" placeholder="Lütfen sayfa adı giriniz.">
                                                                </div>
                                                            <div class="col-sm-2">
                                                                <label class="text-dark"><b>Görsel</b></label>
                                                                <input type="file" name="page_imagepath" value="" class="form-control">
                                                            </div>


                                                            <div class="col-sm-4">
                                                                <label class="text-dark"><b>Seo Link</b></label>
                                                                <input type="text" name="page_slug" value="" class="form-control" placeholder="Lütfen sayfa linki giriniz.">
                                                            </div>

                                                            </div>
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                <label class="text-dark mt-2"><b>Başlık 1</b></label>
                                                                <input type="text" name="page_title1" value="" class="form-control  " placeholder="Lütfen birinci başlığı giriniz.">
                                                                <label class="text-dark mt-2"><b>Başlık 2</b></label>

                                                                <input type="text" name="page_title2" value="" class="form-control" placeholder="Lütfen ikinci başlığı giriniz.">

                                                                </div>
                                                                <label clas s="text-dark mt-3"><b>Sayfa Detayı</b></label>
                                                                <textarea  id="editor"  name="page_description" placeholder="Lütfen sayfa başlığı giriniz." class="form-control"></textarea>
                                                            </div>

                                                        </div>
                                                        <div  class="box-footer">
                                                            <div class="col-md-6">
                                                                <button type="submit" class="btn btn-success btn-block"> Ekle</button>
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
    <script>
        ClassicEditor.create( document.querySelector( '#editor' ));
    </script>
@endsection

