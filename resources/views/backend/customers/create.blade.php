@extends('backend.layouts.index')
@section('content')
    <div class="content-wrap">
        <div class="main">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6 p-r-0 title-margin-right">
                        <div class="page-header">
                            <div class="page-title">
                                <h1>Yeni Müşteri Ekleme<br></h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 p-l-0 title-margin-left">
                        <div class="page-header">
                            <div class="page-title">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('backend.home')}}">Anasayfa</a></li>
                                    <li class="breadcrumb-item"><a href="{{route('customers.index')}}">Müşteriler</a></li>
                                    <li class="breadcrumb-item"> Müşteri Ekle</li>
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
                                                    <form action="{{route('customers.store')}}" class="form-horizontal" method="post" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-sm-4">
                                                                    <label class="text-dark"><b>Adı Soyadı</b></label>
                                                                    <input type="text" name="customer_name" value="" class="form-control" placeholder="Müşterinin adı soyadı">
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <label class="text-dark"><b>Telefon Numarası</b></label>
                                                                    <input type="text" name="customer_phone" value="" class="form-control" placeholder="Telefon numarası">
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <label class="text-dark"><b>E-Mail</b></label>
                                                                    <input type="text" name="customer_email" value="" class="form-control" placeholder="E-mail adresi">
                                                                </div>

                                                            </div>
                                                            <div class="row">
                                                                <div class="col-sm-4">
                                                                    <label class="text-dark"><b>Posta Kodu</b></label>
                                                                    <input type="text" name="customer_postCode" value="" class="form-control" placeholder="Posta kodu giriniz.">
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <label class="text-dark"><b>İl</b></label>
                                                                    <input type="text" name="customer_il" value="" class="form-control" placeholder="İl adını giriniz.">
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <label class="text-dark"><b>İlçe</b></label>
                                                                    <input type="text" name="customer_ilce" value="" class="form-control" placeholder="İlçe adını giriniz.">
                                                                </div>

                                                            </div>
                                                            <div class="row">
                                                                     <div class="col-sm-12">
                                                                    <label class="text-dark"><b>Adres</b></label>
                                                                    <input type="text" name="customer_address" value="" class="form-control" placeholder="Müşteriye ait açık adres giriniz.">
                                                                </div>

                                                            </div>
                                                            <div class="col-sm-12">
                                                                <label class="text-dark"><b>Müşteri Detayı</b></label>

                                                                <textarea  id="editor"  name="customer_description" placeholder="Müşteriye ait varsa açıklama girebilirsiniz." class="form-control"></textarea>
                                                            </div>
                                                        </div>
                                                        <div  class="box-footer">
                                                            <div class="col-md-12">
                                                                <button type="submit" class="btn btn-success btn-block"> Müşteriyi Sisteme Ekle</button>
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

