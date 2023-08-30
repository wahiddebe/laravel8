<footer class="d-flex flex-wrap justify-content-between  ">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 mb-5">
                <a class="logo-footer mb-4" href="">
                    <img src="/images/logo-footer.png" class="img-fluid" alt="">
                </a>
                <div class="medsos mt-1">
                    <a href="{{ 'mailto:'.$setting->email }}" class="text-decoration-none" target="_blank">
                        <div class="medsos-item d-flex align-items-center mb-4">
                            <img class="img-fluid me-3" src="/images/sms.svg" alt="">
                            <p class="my-0">{{ $setting->email }}</p>
                        </div>
                    </a>
                    <div class="medsos-item d-flex align-items-center mt-1">
                        <img class="img-fluid me-3" src="/images/call.svg" alt="">
                        <p class="my-0">{{ $setting->no_hp }}</p>
                    </div>

                </div>
            </div>
            <div class="nav col-lg-8 d-flex justify-content-lg-end justify-content-center p-0">
                <ul class="nav ">
                    <li class="nav-item">
                        <a class="nav-link logo" target="_blank" href="{{ $setting->youtube }}" ><img src="/images/iconoir_youtube.svg" width="32" height="32" alt=""></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link logo" target="_blank" href="{{ $setting->instagram
                            }}" ><img
                                src="/images/akar-icons_instagram-fill.svg" width="32" height="32" alt=""></a>
                    </li>
                </ul>
                <ul class="nav mt-2 d-flex justify-content-md-between justify-content-center w-100">
                    <li class="nav-item"><a href="{{ route('tentang-kami') }}" class="nav-link p-md-0 text-dark">TENTANG
                            KAMI</a></li>
                    <li class="nav-item"><a href="/informasi/1" class="nav-link p-md-0 text-dark">APA ITU AUTISME</a>
                    </li>
                    <li class="nav-item"><a href="/informasi/2" class="nav-link p-md-0 text-dark">APA ITU
                            DISABILITAS</a>
                    </li>
                    <li class="nav-item"><a href="{{ route('kuisioner') }}"
                            class="nav-link p-md-0 text-dark">QUISIONER</a></li>
                    <li class="nav-item"><a href="{{ route('berita') }}" class="nav-link p-md-0 text-dark">BERITA</a>
                    </li>
                </ul>
                <div class="w-100">
                    <div class="d-block divider-nav my-5"></div>
                </div>
                <div class=" w-100">
                    <p class="fs-18 text-bn400 text-lg-end text-center">
                        ©2022 All rights reserved by Look Website by <span><a class="text-decoration-none"
                                href="https://aksantara.com/">Aksantara
                                Digital</a></span>
                    </p>
                </div>
            </div>
        </div>
    </div>
</footer>
