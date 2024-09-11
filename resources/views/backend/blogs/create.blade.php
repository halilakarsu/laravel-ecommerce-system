@extends('backend.layouts.index')
@section('content')
    <div class="content-wrap">
        <div class="main">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6 p-r-0 title-margin-right">
                        <div class="page-header">
                            <div class="page-title">
                                <h1>Yeni Blog Ekleme<br></h1>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                    <div class="col-lg-6 p-l-0 title-margin-left">
                        <div class="page-header">
                            <div class="page-title">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('backend.home')}}">Anasayfa</a></li>
                                    <li class="breadcrumb-item"><a href="{{route('blogs.index')}}">Blog</a></li>
                                    <li class="breadcrumb-item"> Blog Ekle</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                </div>
                <!-- /# row -->
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
                                                    <form action="{{route('blogs.store')}}" class="form-horizontal" method="post" enctype="multipart/form-data">
                                                        @csrf
                                                         <div class="form-group">
                                                             <div class="col-sm-12">
                                                                 <label class="text-dark"><b>Başlık</b></label>
                                                                <input  type="text" name="blog_title" value="" class="form-control" placeholder="Lütfen blog başlığı giriniz." >
                                                                   </div>
                                                             <div class="col-sm-12">
                                                                 <label class="text-dark"><b>Görsel</b></label>
                                                                 <input  type="text" name="blog_imagepath" value="" class="form-control" placeholder="Lütfen blog başlığı giriniz." >
                                                             </div>
                                                             <div class="col-sm-12">
                                                                 <label class="text-dark"><b>Sıra</b></label>
                                                                 <input  type="text" name="blog_sort" value="" class="form-control" placeholder="Lütfen blog başlığı giriniz." >
                                                             </div>
                                                             <div class="col-sm-12">
                                                                 <label class="text-dark"><b>Durum</b></label>
                                                                 <input  type="text" name="blog_status" value="" class="form-control" placeholder="Lütfen blog başlığı giriniz." >
                                                             </div>
                                                             <div class="col-sm-12">
                                                                 <label class="text-dark"><b>Açıklama</b></label>
                                                                 <input  type="text" name="blog_description" value="" class="form-control" placeholder="Lütfen blog başlığı giriniz." >
                                                             </div>
                                                             <div class="col-sm-12">
                                                                 <label class="text-dark"><b>Seo Link</b></label>
                                                                 <input  type="text" name="blog_slug" value="" class="form-control" placeholder="Lütfen blog başlığı giriniz." >
                                                             </div>
                                                        </div>
                                                        <div  align="right" class="box-footer">
                                                            <div class="col-md-6 ">
                                                                <button type="submit" class="btn btn-success btn-block">Ekle</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /# card -->
                        </div>
                        <!-- /# column -->
                    </div>
                    <!-- /# row -->
                 @endsection

