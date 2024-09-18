

<div class="sidebar sidebar-hide-to-small sidebar-shrink sidebar-gestures">
    <div class="nano">
        <div class="nano-content ">
            <ul>
                <div class="logo"><a href="{{route('backend.home')}}">
                        <!-- <img src="/backend/assets/images/logo.png" alt="" /> --><span>E-TİCARET SİSTEMİ</span></a></div>
                <li class="label">Yönetim Paneli</li>
                <li><a href="{{route('backend.home')}}" ><i class=
                                                                "ti-home"></i> Anasayfa</a> </li>
                <li class="label">Ürün İşlemleri</li>
                <li><a href="{{route('products.index')}}"><i class="ti-shopping-cart"></i> Ürünler </a></li>
                <li><a class="sidebar-sub-toggle"><i class="ti-user"></i>Kategoriler<span
                            class="sidebar-collapse-icon ti-angle-down"></span></a>
                    <ul>
                        <li><a href="{{route('categories.index')}}">Üst Kategoriler</a></li>
                        <li><a href="{{route('types.index')}}">Alt Kategoriler</a></li>
                    </ul>
                </li>
                <li><a href="#"><i class="ti-basketball"></i> Siparişler</a></li>
                <li><a href="#"><i class="ti-user"></i> Müşteriler</a></li>
                 <li class="label">Ayarlar</li>
                <li><a href="{{route('settings.home')}}"  ><i class="ti-settings"></i> Genel Ayarlar </a>
                               </li>
                <li><a class="sidebar-sub-toggle"><i class="ti-video-camera"></i>İçerik Ayarları<span
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
                        <li><a href="invoice-editable.html">Editable</a></li>
                    </ul>
                </li>
                <li><a><i class="ti-close"></i> Çıkış</a></li>
            </ul>
        </div>
    </div>
</div>
<!-- /# sidebar -->

