@extends('backend.layouts.index')

@section('content')
    <div class="content-wrap">
        <div class="main">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6 p-r-0 title-margin-right">
                        <div class="page-header">
                            <div class="page-title">
                                <h1>Sayfa Düzenleme<br></h1>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                    <div class="col-lg-6 p-l-0 title-margin-left">
                        <div class="page-header">
                            <div class="page-title">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('backend.home')}}">Anasayfa</a></li>
                                    <li class="breadcrumb-item"><a href="{{route('pages.index')}}">Sayfa</a></li>
                                    <li class="breadcrumb-item"> Sayfa Düzenle</li>
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
                                                    <form action="{{route('pages.update',$pagesEdit->id)}}" method="post" class="form-horizontal" enctype="multipart/form-data">
                                                        @csrf  @method('put')
                                                         <div class="form-group">
                                                             <div class="row">
                                                             <div class="col-sm-1">
                                                                   <img width="80px" height="80px" src="/backend/images/pages/{{$pagesEdit->page_imagepath}}"  >
                                                             </div>
                                                             <div class="col-sm-11">
                                                                 <label class="text-dark"><b>Görseli Değiştir</b></label>
                                                                 <input  type="file" name="page_imagepath" value="{{$pagesEdit->page_imagepath}}" class="form-control" >
                                                             </div>
                                                             </div>
                                                             <div class="row">
                                                             <div class="col-sm-6">

                                                                 <label class="text-dark"><b>Başlık</b></label>
                                                                 <input  type="text" name="page_title" value="{{$pagesEdit->page_title}}" class="form-control" >
                                                             </div>

                                                             <input type="hidden"  name="oldFile" value="{{$pagesEdit->page_imagepath}}">

                                                             <div class="col-sm-6">
                                                                 <label class="text-dark"><b>Seo Link</b></label>
                                                                 <input  type="text" name="page_slug" value="{{$pagesEdit->page_slug}}" class="form-control"  >
                                                             </div>
                                                             </div>
                                                             </div>
                                                             <div class="col-sm-12">
                                                                 <div class="form-group">
                                                                     <label class="text-dark mt-2"><b>Başlık 1</b></label>
                                                                     <input type="text" name="page_title1"  class="form-control  " value="{{$pagesEdit->page_title1}}">
                                                                     <label class="text-dark mt-2"><b>Başlık 2</b></label>

                                                                     <input type="text" name="page_title2" class="form-control" value="{{$pagesEdit->page_title2}}">

                                                                 </div>
                                                                 <label class="text-dark"><b>Açıklama</b></label>
                                                                 <textarea id="editor"  type="text" name="page_description">{{$pagesEdit->page_description}}</textarea>
                                                             </div>

                                                        </div>
                                                        <div  class="box-footer">
                                                            <div class="col-md-6 ">
                                                                <button type="submit" class="btn btn-success btn-block">Güncelle</button>
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
                    @section('js')
                        <script>
                            ClassicEditor.create( document.querySelector( '#editor' ));
                        </script>
                    @endsection
