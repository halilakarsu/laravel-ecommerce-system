
@extends('backend.layouts.index')
@section('css')

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="/backend/assets/css/custom.css">

@endsection
@section('content')

    <div class="content-wrap">
        <div class="main">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-8 p-r-0 title-margin-right">
                        <div class="page-header">
                            <div class="page-title">
                                <h1>Müşteriler Sayfası <br><span>Siteye ait müşteri detayları bu sayfada düzenlenmektedir.</span>
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
                                    <li class="breadcrumb-item active">Müşteriler</li>
                                    <a href="{{route('customers.create')}}" class="btn btn-success mini mt-5"><i class="fa fa fa-plus-circle"></i><small> Ekle</small></a>
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
                                                <th>Müşteri Adı</th>
                                                <th >Telefonu</th>
                                                <th >Durumu</th>
                                                <th class="text-right">İşlemler</th>
                                            </tr>
                                            </thead>
                                            <tbody id="sortable">
                                            @foreach($customers as $key)
                                                <tr id="item-{{$key->id}}">
                                                    <td>{{$key->customer_name}}</td>
                                                    <td>{{$key->customer_phone}}</td>
                                                    <td>  <div style="margin-left:-40px;margin-top:10px" class="form-check form-switch text-lg-left ">
                                                            <label class="custom-switch">
                                                                <input data-id="{{$key->id}}" type="checkbox" class="custom-switch-input" {{$key->customer_status==1 ? "checked": ""}}>
                                                                <span class="custom-switch-slider"></span>
                                                            </label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <a title="Düzenle" class="button btn-success btn mini" href="{{route('customers.edit',$key->id)}}">  <i class="fa fa-edit"></i></a>
                                                        <a title="Sil" data-id="{{$key->id}}" class="btn-danger btn mini text-light" ><i  class="fa fa-trash-o"></i></a>
                                                    </td>
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
                                    var customerId = $(this).data('id'); // Tıklanan butondan customer ID'yi al
                                    var $row = $(this).closest('tr'); // Silinen customerun satırını seç
                                    alertify.confirm('Lütfen Silme İşlemini Onaylayın','Bu işlem bir daha geri alınmayacaktır',
                                        function () {
                                            $.ajax({
                                                type:"DELETE",
                                                url: '/customers/' + customerId,  // DELETE isteği için URL
                                                success:function(response){
                                                    if(response){
                                                        toastr.success('Silme işlemi başarılı', 'Başarılı');
                                                        $row.remove(); // Tablo satırını DOM'dan kaldır
                                                    } else {
                                                        toastr.error('Silme işlemi başarısız', 'Hata');
                                                    }
                                                }
                                            })
                                        },
                                        function(){
                                            alertify.error('Silme işlemi iptal edildi.');
                                        })
                                });
                                $(document).on('click', '.custom-switch-input', function() {
                                    var itemId = $(this).data('id');
                                    var switchStatus  = $(this).is(':checked') ? '1' : '0';

                                    $.ajax({
                                        type: "POST",
                                        url: '/customers/switch/' + itemId,
                                        data: {sts: switchStatus}
                                    });
                                });
                            });
                            $(document).ready(function(){
                                $('#sortable').sortable({
                                    revert:true,
                                    handle:".sortable",
                                    stop:function (event,ui){
                                        var data= $(this).sortable('serialize');
                                        $.ajax({
                                            type:"POST",
                                            data:data,
                                            url:"{{route('customers.sortable')}}",
                                            success:function (msg){
                                                if(msg) {
                                                    alertify.success("islem basarili");
                                                } else {
                                                    alertify.error("islem basarisiz.");
                                                }
                                            }
                                        });
                                    }
                                });
                                $('#sortable').disableSelection();
                            });
                        </script>
                        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

@endsection
