@extends('backend.layouts.index')

@section('content')
    <div class="content-wrap">
        <div class="main">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6 p-r-0 title-margin-right">
                        <div class="page-header">
                            <div class="page-title">
                                <h1>Müşteri Düzenleme<br></h1>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                    <div class="col-lg-6 p-l-0 title-margin-left">
                        <div class="page-header">
                            <div class="page-title">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('backend.home')}}">Anasayfa</a></li>
                                    <li class="breadcrumb-item"><a href="{{route('customers.index')}}">Blog</a></li>
                                    <li class="breadcrumb-item"> Müşteri Düzenle</li>
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
                                                    <form action="{{route('customers.update',$customersEdit->id)}}" method="post" class="form-horizontal" enctype="multipart/form-data">
                                                        @csrf  @method('put')

                                                         <div class="form-group">
                                                             <div class="row">
                                                                 <div class="col-sm-4">
                                                                     <label class="text-dark"><b>Adı Soyadı</b></label>
                                                                     <input type="text" name="customer_name"  class="form-control" value="{{$customersEdit->customer_name}}">
                                                                 </div>
                                                                 <div class="col-sm-4">
                                                                     <label class="text-dark"><b>Telefon Numarası</b></label>
                                                                     <input type="text" name="customer_phone" class="form-control" value="{{$customersEdit->customer_phone}}">
                                                                 </div>
                                                                 <div class="col-sm-4">
                                                                     <label class="text-dark"><b>E-Mail</b></label>
                                                                     <input type="text" name="customer_email"  class="form-control" value="{{$customersEdit->customer_email}}">
                                                                 </div>

                                                             </div>
                                                             <div class="row">
                                                                 <div class="col-sm-4">
                                                                     <label class="text-dark"><b>Posta Kodu</b></label>
                                                                     <input type="text" name="customer_postCode" class="form-control" value="{{$customersEdit->customer_postCode}}">
                                                                 </div>
                                                                 <div class="col-sm-4">
                                                                     <label class="text-dark"><b>İl</b></label>
                                                                     <input type="text" name="customer_il"  class="form-control" value="{{$customersEdit->customer_il}}">
                                                                 </div>
                                                                 <div class="col-sm-4">
                                                                     <label class="text-dark"><b>İlçe</b></label>
                                                                     <input type="text" name="customer_ilce"  class="form-control" value="{{$customersEdit->customer_ilce}}">
                                                                 </div>

                                                             </div>
                                                             <div class="row">
                                                                 <div class="col-sm-12">
                                                                     <label class="text-dark"><b>Adres</b></label>
                                                                     <input type="text" name="customer_address"  class="form-control" value="{{$customersEdit->customer_description}}">
                                                                 </div>

                                                             </div>
                                                             <div class="col-sm-12">
                                                                 <label class="text-dark"><b>Müşteri Detayı</b></label>

                                                                 <textarea  id="editor"  name="customer_description" class="form-control">{{$customersEdit->customer_description}}</textarea>
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
