@extends('frontend.layouts.index')
@section('content')

<!-- Blog Start -->
<div class="container-fluid py-5">
    <div class="container">
        <div class="mx-auto text-center mb-5" style="max-width: 500px;">
            <h6 class="text-primary text-uppercase">Blog Sayfamız</h6>
            <h1 class="display-5">Ürünlerimizle ilgili yazılar..</h1>
        </div>
        <div class="row g-5">
            <div class="col-lg-4">
                <div class="blog-item position-relative overflow-hidden">
                    <img class="img-fluid" src="/frontend/img/blog-1.jpg" alt="">
                    <a class="blog-overlay" href="">
                        <h4 class="text-white">Lorem elitr magna stet eirmod labore amet</h4>
                        <span class="text-white fw-bold">Jan 01, 2050</span>
                    </a>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="blog-item position-relative overflow-hidden">
                    <img class="img-fluid" src="/frontend/img/blog-2.jpg" alt="">
                    <a class="blog-overlay" href="">
                        <h4 class="text-white">Lorem elitr magna stet eirmod labore amet</h4>
                        <span class="text-white fw-bold">Jan 01, 2050</span>
                    </a>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="blog-item position-relative overflow-hidden">
                    <img class="img-fluid" src="/frontend/img/blog-3.jpg" alt="">
                    <a class="blog-overlay" href="">
                        <h4 class="text-white">Lorem elitr magna stet eirmod labore amet</h4>
                        <span class="text-white fw-bold">Jan 01, 2050</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Blog End -->


@endsection
