@extends('backend.layouts.index')

@section('content')
    <div class="content-wrap">
        <div class="main">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6 p-r-0 title-margin-right">
                        <div class="page-header">
                            <div class="page-title">
                                <h1>ALt Kategori Düzenleme<br></h1>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                    <div class="col-lg-6 p-l-0 title-margin-left">
                        <div class="page-header">
                            <div class="page-title">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('backend.home')}}">Anasayfa</a></li>
                                    <li class="breadcrumb-item"><a href="{{route('types.index')}}">Kategori</a></li>
                                    <li class="breadcrumb-item"> Alt Kategori Düzenle</li>
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
                                                    <form action="{{route('types.update',$typesEdit->id)}}" method="post" class="form-horizontal" enctype="multipart/form-data">
                                                        @csrf  @method('put')
                                                         <div class="form-group">

                                                             <div class="col-sm-12">

                                                                 <label class="text-dark"><b>Alt Kategori</b></label>
                                                                 <input  type="text" name="type_title" value="{{$typesEdit->type_title}}" class="form-control" >
                                                             </div>
                                                             <input type="hidden"  name="oldFile" value="{{$typesEdit->type_imagepath}}">
                                                             <div class="row">
                                                             <div class="col-sm-10">
                                                                 <label class="text-dark"><b>Üst Kategori</b></label>
                                                                 <select  type="text" name="categori_id" value="{{$typesEdit->type_slug}}" class="form-control">
                                                                     @foreach($categories  as $row )
                                                                     <option value="{{$row->id}}" {{$typesEdit->categori_id==$row->id ? "selected" : ""}}>{{$row->categori_title}}</option>
                                                                     @endforeach
                                                                 </select>
                                                             </div>
                                                             <div class="col-sm-2">
                                                                 <label class="text-dark"><b>Durum</b></label>
                                                                 <select class="form-control"  name="type_status" >
                                                                     <option value="0" {{$typesEdit->type_status==0 ? "selected": ""}} >Pasif</option>
                                                                     <option value="1" {{$typesEdit->type_status==1 ? "selected": ""}} >Aktif</option>
                                                                 </select>
                                                             </div>
                                                             </div>
                                                             <div class="col-sm-12">
                                                                 <label class="text-dark"><b>Açıklama</b></label>
                                                                 <textarea id="editor"  type="text" name="type_description">{{$typesEdit->type_description}}</textarea>
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
