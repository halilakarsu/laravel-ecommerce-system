@extends('backend.layouts.index')
@section('content')
    <div class="content-wrap">
        <div class="main">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6 p-r-0 title-margin-right">
                        <div class="page-header">
                            <div class="page-title">
                                <h1>Yeni Menü Ekleme<br> <small>Eğer </small></h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 p-l-0 title-margin-left">
                        <div class="page-header">
                            <div class="page-title">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('backend.home')}}">Anasayfa</a></li>
                                    <li class="breadcrumb-item"><a href="{{route('menus.index')}}">Menüler</a></li>
                                    <li class="breadcrumb-item"> Menü Ekle</li>
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
                                                    <form action="{{route('menus.store')}}" class="form-horizontal" method="post" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-sm-4">
                                                                    <label class="text-dark"><b>Menü Adı</b></label>
                                                                    <input type="text" name="menu_title" value="" class="form-control" placeholder="Lütfen menü adı giriniz.">
                                                                </div>
                                                                <div class="col-sm-4">
                                                                <label class="text-dark"><b>Link</b></label>
                                                                <input type="text" name="menu_slug" value="" class="form-control" placeholder="Lütfen menü linki giriniz.">
                                                            </div>
                                                                <div class="col-sm-4">

                                                                    <select name="menu_ust" class="form-control">

                                                                        @foreach($menus as $menu)
                                                                          <option value="{{$menu->id}}">{{$menu->menu_title}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                           </div>
                                                        <div  class="box-footer">
                                                            <div class="col-md-12">
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

