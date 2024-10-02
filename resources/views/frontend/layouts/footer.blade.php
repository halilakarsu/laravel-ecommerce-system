<!-- Footer Start -->
<div class="container-fluid bg-footer bg-primary text-white mt-5">
    <div class="container">
        <div class="row gx-5">
            <div class="col-lg-8 col-md-6">
                <div class="row gx-5">
                    <div class="col-lg-4 col-md-12 pt-5 mb-5">
                        <h4 class="text-white mb-4">Bize Ulaşın</h4>
                        <div class="d-flex mb-2">
                            <i class="bi bi-geo-alt text-white me-2"></i>
                            <p class="text-white mb-0">{{$adress}}</p>
                        </div>
                        <div class="d-flex mb-2">
                            <i class="bi bi-envelope-open text-white me-2"></i>
                            <p class="text-white mb-0">{{$mail}}</p>
                        </div>
                        <div class="d-flex mb-2">
                            <i class="bi bi-telephone text-white me-2"></i>
                            <p class="text-white mb-0">{{$phone}}</p>
                        </div>
                        <div class="d-flex mt-4">
                            @foreach($social as $row)
                                <a class="btn btn-secondary btn-square rounded-circle me-2" href="{{$row->social_link}}"> {!! $row->social_icon !!}</a>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 pt-0 pt-lg-5 mb-5">
                        <h4 class="text-white mb-4">Ürünlerimiz</h4>
                        <div class="d-flex flex-column justify-content-start">
                            <a class="text-white mb-2" href="#"><i class="bi bi-arrow-right text-white me-2"></i>Home</a>
                            </div>
                    </div>
                    <div class="col-lg-4 col-md-12 pt-0 pt-lg-5 mb-5">
                        <h4 class="text-white mb-4">Kurumsal</h4>
                        <div class="d-flex flex-column justify-content-start">
                            @foreach($menuUst as $row)
                            <a class="text-white mb-2" href="#"><i class="bi bi-arrow-right text-white me-2"></i>{{$row->menu_title}}</a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mt-lg-n5">
                <div class="d-flex flex-column align-items-center justify-content-center text-center h-100 bg-secondary p-5">
                    <h4 class="text-white">Abone Ol</h4>
                    <h6 class="text-white">Abone olmak çok kolay!</h6>
                    <p>Sadece e-posta adresiniz ile abone olabilirsiniz.</p>
                    <form action="">
                        <div class="input-group">
                            <input type="text" class="form-control border-white p-3" placeholder="E-mail adresiniz">
                            <button class="btn btn-primary">Üye ol</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid bg-dark text-white py-4">
    <div class="container text-center">
        <p class="mb-0">&copy; <a class="text-secondary fw-bold" href="https://halilakarsu.com"></a>Tüm hakları saklıdır. <a class="text-secondary fw-bold" href="https://halilakarsu.com">Halil Akarsu tasarlanmıştır.</a></p>
        <br>Projeleriniz için lütfen bizimle iletişime geçiniz: <a class="text-secondary fw-bold" href="https://halilakarsu.com" target="_blank">-></a>
    </div>
</div>
<!-- Footer End -->


<!-- Back to Top -->
<a href="#" class="btn btn-secondary py-3 fs-4 back-to-top"><i class="bi bi-arrow-up"></i></a>


<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="lib/easing/easing.min.js"></script>
<script src="lib/waypoints/waypoints.min.js"></script>
<script src="lib/counterup/counterup.min.js"></script>
<script src="lib/owlcarousel/owl.carousel.min.js"></script>

<!-- Template Javascript -->
<script src="js/main.js"></script>
</body>

</html>
