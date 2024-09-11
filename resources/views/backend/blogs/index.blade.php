@extends('backend.layouts.index')
@section('css')
    <!-- DataTables CSS CDN -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    <style>
    .dataTables_filter{
     float:left !important;
    }
        </style>
@endsection
@section('content')
    <div class="content-wrap">
        <div class="main">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-8 p-r-0 title-margin-right">
                        <div class="page-header">
                            <div class="page-title">
                                <h1>Blog Sayfası <br><span>Siteye ait blog detayları bu sayfada düzenlenmektedir.</span>
                                </h1>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                    <div class="col-lg-4 p-l-0 title-margin-left">
                        <div class="page-header">
                            <div class="page-title">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('backend.home')}}">Anasayfa</a></li>
                                    <li class="breadcrumb-item active">Blog</li>
                                    <a href="{{route('blogs.create')}}" class="btn btn-success btn-sm mt-5">+ Ekle</a>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                </div>
                <!-- /# row -->
                <section style="margin-top:-35px" id="main-content" >
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="bootstrap-data-table-panel">
                                    <div class="table-responsive">
                                        <table id="example" class="display" style="width:100%">
                                            <thead>
                                            <tr>
                                                <th>Görsel</th>
                                                <th>Başlık</th>
                                                <th>Tarih</th>
                                                <th>işlemler</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($blogsCreate as $key)
                                            <tr>
                                                <td>{{$key->blog_imagepath}}</td>
                                                <td>{{$key->blog_title}}</td>
                                                <td>{{$key->blog_status}}</td>
                                                <td width="50%"><a href="{{route('blogs.edit',$key->id)}}" class="btn btn-success btn-sm text-light">Düzenle</a></td>
                                            </tr>
                                            @endforeach
                                            <!-- Daha fazla veri buraya eklenebilir -->
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
 @section('js')

                        <!-- DataTables JS CDN -->
 <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

                        <!-- DataTables Buttons JS (for Excel, PDF, etc.) -->
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>

<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.68/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.68/vfs_fonts.js"></script>

<script>
 $(document).ready(function() {
  $('#example').DataTable({
         language: {
        searchPlaceholder: 'Arama'
                   },
                dom:'frtp',
             language: {

                    "sSearch": "Ara:",
                  "sZeroRecords": "Eşleşen kayıt bulunamadı",
                  "oPaginate": {
                    "sFirst": "İlk",
                       "sLast": "Son",
                        "sNext": "Sonraki",
                          "sPrevious": "Önceki"
                           }
                            },

                    });
$('.dataTables_filter input').attr('placeholder', 'Arama yapın...');

      });
    d</script>
@endsection
