@extends('backend.layouts.index')
@section('content')
    <div class="content-wrap">
        <div class="main">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-8 p-r-0 title-margin-right">
                        <div class="page-header">
                            <div class="page-title">
                                <h1>Genel Ayarlar Sayfası <br><span>Tüm site genel ayarlama işlemleriniz bu sayfada yapılmaktadır.</span></h1>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                    <div class="col-lg-4 p-l-0 title-margin-left">
                        <div class="page-header">
                            <div class="page-title">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('backend.home')}}">Anasayfa</a></li>
                                    <li class="breadcrumb-item active">Ayarlar</li>
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
                                <div class="card-title py-3 text-center bg-primary ">
                                    <h4 class="text-light">Site Genel Ayar İşlemleri</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                          <tbody>
                                            @foreach($settings as $key)
                                            <tr>
                                                <th class="text-right" scope="row"><b>{{$key->settings_description}}:</b></th>
                                                <td>{{$key->settings_value}}</td>
                                                <td><a href="{{route('settings.edit',['id'=>$key->id])}}"><i class="ti-pencil-alt"></i></a>
                                                    <a href=""><i class=" ml-3 ti-trash"></i></a></td>
                                            </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- /# card -->
                        </div>
                        <!-- /# column -->
                    </div>
                    <!-- /# row -->
                 @endsection
