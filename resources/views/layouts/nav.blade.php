<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="/"><img src="{{ asset('/images/logo.png') }}" width="264" height="83"
                class="img-fluid" alt=""></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 d-flex align-items-center">
                <li class="nav-item">
                    <a class="nav-link {{ $title =='Tentang Kami' ? 'active' : "" }}" aria-current="page"
                        href="{{ route('tentang-kami') }}">Tentang Kami</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ $title =='Informasi' ? 'active' : "" }}" href="#"
                        id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Informasi
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="{{ '/informasi/1' }}">Autisma</a></li>
                        <li><a class="dropdown-item" href="{{ '/informasi/2' }}">Ragam Disabilitas</a></li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ $title =='Kuisioner' ? 'active' : "" }}" aria-current="page"
                        href="{{ route('kuisioner') }}">Kuisioner Autisma</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $title =='Berita' ? 'active' : "" }}" aria-current="page"
                        href="{{ route('berita') }}">Berita & Artikel</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $title =='Artikel' ? 'active' : "" }}" aria-current="page"
                        href="{{ route('artikel') }}">Perkumpulan Pemuda/i Autisma Yogasmara</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $title =='Yogasmarashop' ? 'active' : "" }}" aria-current="page"
                        href="{{ route('shop') }}">Shop</a>
                </li>
                <div class=" divider-nav d-none d-lg-block">
                </div>
                <li class="nav-item">
                    <a class="nav-link logo" target="_blank" href="{{ $setting->youtube }}"><img
                            src="{{ asset('/images/iconoir_youtube.svg') }}" width="32" height="32" alt=""></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link logo" target="_blank" href="{{ $setting->instagram }}"><img
                            src="{{ asset('/images/akar-icons_instagram-fill.svg') }}" width="32" height="32"
                            alt=""></a>
                </li>
            </ul>

        </div>
    </div>
</nav>
