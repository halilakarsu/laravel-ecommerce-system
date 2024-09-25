

<div class="sidebar sidebar-hide-to-small sidebar-shrink sidebar-gestures">
    <div class="nano">
        <div class="nano-content ">
            <ul>
                <div class="logo"><a href="{{route('backend.home')}}">
                        <!-- <img src="/backend/assets/images/logo.png" alt="" /> --><span>E-TİCARET SİSTEMİ</span></a></div>
                    <li><a href="{{route('backend.home')}}" ><i class=
                                                                "ti-home"></i> Anasayfa</a> </li>
                   <li><a class="sidebar-sub-toggle"><i class="ti-shopping-cart"></i> Ürün İşlemleri<span
                            class="sidebar-collapse-icon ti-angle-down"></span></a>
                    <ul>
                        <li><a href="{{route('products.index')}}">Ürünler </a></li>
                        <li><a href="{{route('categories.index')}}">Üst Kategoriler</a></li>
                        <li><a href="{{route('types.index')}}">Alt Kategoriler</a></li>
                    </ul>
                </li>
                <li><a href="{{route('orders.index')}}"><i class="ti-basketball"></i> Siparişler</a></li>
                <li><a href="{{route('customers.index')}}"><i class="ti-user"></i> Müşteriler</a></li>
                 <li><a class="sidebar-sub-toggle"><i class="ti-settings"></i>Genel Ayarlar<span
                            class="sidebar-collapse-icon ti-angle-down"></span></a>
                    <ul>
                        <li><a href="{{route('menus.index')}}">Menü Ayarları</a></li>
                        <li><a href="{{route('settings.home')}}">Site Ayarları</a></li>
                        <li><a href="{{route('pages.index')}}">Sayfalar</a></li>
                        <li><a href="{{route('services.index')}}">Hizmetler</a></li>
                   </ul>
                </li>
                <li><a class="sidebar-sub-toggle"><i class="ti-video-camera"></i>İçerik Ayaları<span
                            class="sidebar-collapse-icon ti-angle-down"></span></a>
                    <ul>
                        <li><a href="{{route('sliders.index')}}">Slider</a></li>
                        <li><a href="{{route('blogs.index')}}">Blog</a></li>
                        <li><a href="{{route('videos.index')}}">Videolar</a></li>
                        <li><a href="{{route('slogans.index')}}">Sloganlar</a></li>
                        <li><a href="{{route('sss.index')}}">Sık Sorulan Sorular</a></li>
                   </ul>
                </li>
                <li><a class="sidebar-sub-toggle"><i class="ti-user"></i>Kullanıcı Ayarları<span
                            class="sidebar-collapse-icon ti-angle-down"></span></a>
                    <ul>
                        <li><a href="{{route('members.index')}}">Üyeler</a></li>
                       </ul>
                </li>
                <li><a><i class="ti-close"></i> Çıkış</a></li>
            </ul>
        </div>
    </div>
</div>
<!-- /# sidebar -->

