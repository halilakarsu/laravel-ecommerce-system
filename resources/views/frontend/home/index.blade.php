@extends('frontend.layouts.index')
@section('content')
<!-- Carousel Start -->
<div class="container-fluid p-0">
    <div id="header-carousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
        <div class="carousel-inner">
            @php($counter=0)
            @foreach($sliders as $slider)
            <div class="carousel-item {{ $counter==0 ? "active" : "" }}">
                <img class="w-100" src="/backend/images/sliders/{{$slider->slider_imagepath}}" alt="Image">
                <div class="carousel-caption top-0 bottom-0 start-0 end-0 d-flex flex-column align-items-center justify-content-center">
                    <div class="text-start p-5" style="max-width: 900px;">
                        <h3 class="text-white">{{$slider->slider_big_title}}</h3>
                        <h1 class="display-1 text-white mb-md-4">{{$slider->slider_small_title}}</h1>
                        <a href="" class="btn btn-primary py-md-3 px-md-5 me-3">Explore</a>
                        <a href="" class="btn btn-secondary py-md-3 px-md-5">Contact</a>
                    </div>
                </div>
            </div>
               @php(++$counter)
            @endforeach
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel"
                data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#header-carousel"
                data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>
<!-- Carousel End -->





@endsection
