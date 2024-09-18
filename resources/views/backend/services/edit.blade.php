@extends('backend.layouts.index')

@section('content')
    <div class="content-wrap">
        <div class="main">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6 p-r-0 title-margin-right">
                        <div class="page-header">
                            <div class="page-title">
                                <h1>Hizmet Düzenleme<br></h1>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                    <div class="col-lg-6 p-l-0 title-margin-left">
                        <div class="page-header">
                            <div class="page-title">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('backend.home')}}">Anasayfa</a></li>
                                    <li class="breadcrumb-item"><a href="{{route('blogs.index')}}">Hizmet</a></li>
                                    <li class="breadcrumb-item"> Hizmet Düzenle</li>
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
                                                    <form action="{{route('blogs.update',$blogsEdit->id)}}" method="post" class="form-horizontal" enctype="multipart/form-data">
                                                        @csrf  @method('put')
                                                         <div class="form-group">
                                                             <div class="row">
                                                             <div class="col-sm-1">
                                                                   <img width="80px" height="80px" src="/backend/images/blogs/{{$blogsEdit->service_imagepath}}"  >
                                                             </div>
                                                             <div class="col-sm-11">
                                                                 <label class="text-dark"><b>Görseli Değiştir</b></label>
                                                                 <input  type="file" name="service_imagepath" value="{{$blogsEdit->service_imagepath}}" class="form-control" >
                                                             </div>
                                                             </div>
                                                             <div class="col-sm-12">

                                                                 <label class="text-dark"><b>Başlık</b></label>
                                                                 <input  type="text" name="service_title" value="{{$blogsEdit->service_title}}" class="form-control" >
                                                             </div>
                                                             <input type="hidden"  name="oldFile" value="{{$blogsEdit->service_imagepath}}">
                                                             <div class="row">
                                                             <div class="col-sm-10">
                                                                 <label class="text-dark"><b>Seo Link</b></label>
                                                                 <input  type="text" name="service_slug" value="{{$blogsEdit->service_slug}}" class="form-control"  >
                                                             </div>
                                                             <div class="col-sm-2">
                                                                 <label class="text-dark"><b>Durum</b></label>
                                                                 <select class="form-control"  name="service_status" >
                                                                     <option value="0" {{$blogsEdit->service_status==0 ? "selected": ""}} >Pasif</option>
                                                                     <option value="1" {{$blogsEdit->service_status==1 ? "selected": ""}} >Aktif</option>
                                                                 </select>
                                                             </div>
                                                             </div>
                                                             <div class="col-sm-12">
                                                                 <label class="text-dark"><b>Açıklama</b></label>
                                                                 <textarea id="editor"  type="text" name="service_description">{{$blogsEdit->service_description}}</textarea>
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
