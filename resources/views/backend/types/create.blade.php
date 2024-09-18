@extends('backend.layouts.index')
@section('content')
    <div class="content-wrap">
        <div class="main">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6 p-r-0 title-margin-right">
                        <div class="page-header">
                            <div class="page-title">
                                <h1>Alt Kategori Ekleme<br></h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 p-l-0 title-margin-left">
                        <div class="page-header">
                            <div class="page-title">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('backend.home') }}">Anasayfa</a></li>
                                    <li class="breadcrumb-item"><a href="{{ route('types.index') }}">Alt Kategori</a></li>
                                    <li class="breadcrumb-item">Ekle</li>
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
                                    @if($errors->any())
                                        @foreach($errors->all() as $error)
                                            <script>
                                                alertify.error('{{$error}}');
                                            </script>
                                        @endforeach
                                    @endif
                                    <div class="horizontal-form">
                                        <form action="{{ route('types.store') }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <label class="text-dark"><b>Başlık</b></label>
                                                        <input type="text" name="type_title" class="form-control" placeholder="Lütfen alt type başlığı giriniz.">
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <label class="text-dark"><b>Kategori</b></label>
                                                        <select name="categori_id" class="form-control">
                                                            @foreach($categories as $row)
                                                            <option value="{{$row->id}}"> {{$row->categori_title}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <label class="text-dark"><b>Durum</b></label>
                                                        <select name="type_status" class="form-control">
                                                            <option value="0">Pasif</option>
                                                            <option value="1">Aktif</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="box-footer">
                                                <div class="col-md-6">
                                                    <button type="submit" class="btn btn-success btn-block">Ekle</button>
                                                </div>
                                            </div>
                                        </form>
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
        ClassicEditor.create(document.querySelector('#editor'));
    </script>
@endsection
