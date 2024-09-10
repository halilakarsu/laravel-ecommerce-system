@extends('backend.layouts.index')
@section('content')
    <div class="content-wrap">
        <div class="main">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6 p-r-0 title-margin-right">
                        <div class="page-header">
                            <div class="page-title">
                                <h1>E-ticaret sistemi ayar güncelleme işlemleri<br></h1>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                    <div class="col-lg-6 p-l-0 title-margin-left">
                        <div class="page-header">
                            <div class="page-title">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('backend.home')}}">Anasayfa</a></li>
                                    <li class="breadcrumb-item"><a href="{{route('settings.home')}}">Ayarlar</a></li>
                                    <li class="breadcrumb-item">{{$editSettings->settings_description}} Güncelle</li>
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
                                            <div class="card-title">
                                                <h4>{{$editSettings->settings_description}} Güncelle</h4>

                                            </div>
                                            @if($errors->any())
                                             @foreach($errors->all() as $error)
                                                    <script>
                                                        alertify.error('{{$error}}');
                                                    </script>
                                                 @endforeach

                                            @endif
                                            <div class="card-body">
                                                <div class="horizontal-form">
                                                    <form action="{{route('settings.update',['id'=>$editSettings->id])}}" class="form-horizontal" method="post" enctype="multipart/form-data">
                                                        @csrf
                                                         <div class="form-group">
                                                                  <div class="col-sm-12">
                                                            @if($editSettings->settings_type=="file")
                                                                          <h2 class="py-3">Yüklü Resim</h2><br>
                                                                <img class="my-3"  width="150px" src="/backend/images/settings/{{$editSettings->settings_value}}">
                                                                      <br>
                                                                <input type="file" name="settings_value" value="{{$editSettings->settings_value}}" class="form-control" >
                                                             @endif
                                                             @if($editSettings->settings_type=='text')
                                                                 <input type="text" name="settings_value" value="{{$editSettings->settings_value}}" class="form-control" >
                                                             @endif
                                                             @if($editSettings->settings_type=='textarea')
                                                                 <textarea  class="form-control" type="text" name="settings_value">{{$editSettings->settings_value}}" </textarea>
                                                             @endif
                                                            </div>
                                                        </div>
                                                        <div  align="right" class="box-footer">
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
                    <script src="/backend/assets/dist/toast/toasty.min.js"></script>
                    <script>
                        var toast = new Toasty();
                        toast.info("Here is some information!");
                    </script>
