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
                                                <td><img width="100px" src="/backend/images/blogs/{{$key->blog_imagepath}}" alt=""></td>
                                                <td>{{$key->blog_title}}</td>
                                                <td>{{$key->blog_status}}</td>
                                                <td>
                                                    <a title="Düzenle" class="button btn-success btn-sm" href="{{route('blogs.edit',$key->id)}}"><span  class="ti-pencil-alt"></span></a>
                                                    <a title="Sil" data-id="{{$key->id}}" class="button btn-danger btn-sm " href="#"><span class="ti-trash"></span></a>
                                                </td>
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
 <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script>
 $('.dataTables_filter input').attr('placeholder', 'Arama yapın...');
 $(document).ready(function() {
     $.ajaxSetup(
         {
             headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             }
         });
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
 $(document).on('click', '.btn-danger', function() {
     var blogId = $(this).data('id'); // Tıklanan butondan blog ID'yi al
     var $row = $(this).closest('tr'); // Silinen blogun satırını seç
         alertify.confirm('Lütfen Silme İşlemini Onaylayın','Bu işlem bir daha geri alınmayacaktır',
             function () {
                 $.ajax({
                     type:"DELETE",
                     url: '/blogs/' + blogId,  // DELETE isteği için URL
                     success:function(response){
                         if(response){
                             toastr.success('Silme işlemi başarılı', 'Başarılı');
                             $row.remove(); // Tablo satırını DOM'dan kaldır
                         } else
                             toastr.error('Silme işlemi başarısız', 'Hata');
                     }
                 })
             },
             function(){
                 alertify.error('Silme işlemi iptal edildi.');
             })
     });
 });
</script>
@endsection
