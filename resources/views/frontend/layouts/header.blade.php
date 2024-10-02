<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>{{$title}}</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="{{$keywords}}" name="keywords">
    <meta content="{{$description}}" name="description">

    <!-- Favicon -->
    <link href="/frontend/img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="/frontend/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="/frontend/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="/frontend/css/style.css" rel="stylesheet">
</head>

<body>
<!-- Topbar Start -->
<div class="container-fluid px-5 d-none d-lg-block">
    <div class="row gx-5 py-3 align-items-center">
        <div class="col-lg-3">
            <div class="d-flex align-items-center justify-content-start">
                <i class="bi bi-phone-vibrate fs-1 text-primary me-2"></i>
                <h2 class="mb-0">{{$phone}}</h2>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="d-flex align-items-center justify-content-center">
                <a href="index.html" class="navbar-brand ms-lg-5">
                    <h1 class="m-0 display-4 text-primary"><span class="text-secondary">Doğal Köy </span>Ürünlerim</h1>
                </a>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="d-flex align-items-center justify-content-end">
                @foreach($social as $row)
                <a class="btn btn-primary btn-square rounded-circle me-2" href="{{$row->social_link}}"> {!! $row->social_icon !!}</a>
                @endforeach
            </div>
        </div>
    </div>
</div>
<!-- Topbar End -->
<!-- Navbar Start -->
<nav class="navbar navbar-expand-lg bg-primary navbar-dark shadow-sm py-3 py-lg-0 px-3 px-lg-5">
    <a href="index.html" class="navbar-brand d-flex d-lg-none">
        <h1 class="m-0 display-4 text-secondary"><span class="text-white">Doğal Köy </span>Ürünlerim</h1>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav mx-auto py-0">
            @foreach($menuUst as $menu)
                @if($menu->menu_status==1)
                    <div class="nav-item dropdown">
                    <a href="{{$menu->menu_slug}}"  @if($menuAlt->contains('menu_ust', $menu->id))  class="nav-link dropdown-toggle"
                       data-bs-toggle="dropdown" @else class="nav-link" @endif>{{$menu->menu_title}}</a>
                    <div class="dropdown-menu m-0">
                        @foreach($menuAlt as $alt)
                            @if($menu->id == $alt->menu_ust && $alt->menu_status==1)
                                <a href="blog.html" class="dropdown-item">{{$alt->menu_title}}</a>
                            @endif
                        @endforeach
                    </div>
                </div>
                @endif
            @endforeach
        </div>
    </div>
</nav>
<!-- Navbar End -->
