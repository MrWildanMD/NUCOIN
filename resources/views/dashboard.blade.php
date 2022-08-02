<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Koin NU</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{ asset('assets/css/main/app.css') }}">

    <link rel="shortcut icon" href="{{ asset('assets/images/logo/favicon.ico') }}" type="image/x-icon">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.dataTables.min.css">

    <link rel="stylesheet" href="{{ asset('assets/css/shared/iconly.css') }}">
</head>

<body>
    <div id="app">
        <div id="main" class="layout-horizontal">
            <header class="mb-5">
                <div class="header-top">
                    <div class="container">
                        <div class="logo">
                            <a href="{{ route('dashboard') }}">
                                <img src="{{ asset('assets/images/logo/logo.png') }}" alt="logo">
                                <p>Ranting Mejono</p>
                            </a>
                        </div>
                        <a href="{{ route('dashboard') }}" class="d-inline-block align-text-start mt-1 fs-3">Koin NU</a>

                        <div class="header-top-right">
                            <div class="dropdown">
                                <a href="#" class="user-dropdown d-flex" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <div class="avatar avatar-md2">
                                        <img src="{{ asset('assets/images/faces/1.jpg') }}" alt="Avatar">
                                    </div>
                                    <div class="text">
                                        <h6 class="user-dropdown-name">Welcome, <br>
                                            {{ Auth::check() ? auth()->user()->name : 'Guest' }}</h6>
                                        {{-- <p class="user-dropdown-status text-sm text-muted">Guest</p> --}}
                                    </div>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end shadow-lg"
                                    aria-labelledby="dropdownMenuButton1" style="min-width: 11rem;">
                                    <li>
                                        @if (Route::has('login'))
                                            {{-- cek auth user login? kalo logged in tampilin control panel + logout button --}}
                                            @auth
                                                <a class="dropdown-item" href="{{ route('dashboard') }}">
                                                    <i class="icon-mid bi bi-gear-fill me-2"></i>Control Panel</a>
                                                <form action="{{ route('logout') }}" method="POST">
                                                    {{ csrf_field() }}
                                                    <button class="dropdown-item" type="submit"><i
                                                            class="icon-mid bi bi-box-arrow-left me-2"></i>Logout</button>
                                                </form>
                                            @else
                                                <a class="dropdown-item" href="{{ route('login') }}">
                                                    <i class="icon-mid bi bi-box-arrow-right me-2"></i>Login</a>
                                            @endauth
                                        @endif
                                    </li>
                                </ul>
                            </div>
                            <!-- Burger button responsive -->
                            <a href="#" class="burger-btn d-block d-xl-none">
                                <i class="bi bi-justify fs-3"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <nav class="main-navbar">
                    <div class="container">
                        <ul class="justify-content-center">
                            <li class="menu-item">
                                <a href="#beranda" class='menu-link'>
                                    <i class="bi bi-house-fill mb-2"></i>
                                    <span>Beranda</span>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="#pengguna" class='menu-link'>
                                    <i class="bi bi-people-fill mb-2"></i>
                                    <span>Daftar Pengguna</span>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="#galeri" class='menu-link'>
                                    <i class="bi bi-images mb-2"></i>
                                    <span>Galeri</span>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="#faq" class='menu-link'>
                                    <i class="bi bi-question-circle-fill mb-2"></i>
                                    <span>FAQ</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
            <div class="content-wrapper container">
                <div class="page-content">
                    <section id="beranda">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Apa itu Koin NU?</h4>
                                    </div>
                                    <div class="card-body text-center">
                                        <img src="{{ asset('assets/images/logo/logo.png') }}" alt="logo"
                                            width="200" height="200">
                                        <h5>KOIN NU (KOtak INfaq NU) adalah implementasi pelaksanaan Zakat, Infaq,
                                            Shodaqoh (ZIS) yang didalamnya mencakup pelaksanaan perintah Allah SWT dalam
                                            mewujudkan masyarakat yang sejahtera melalui pembiasaan berinfaq dan
                                            bershodaqoh, sekaligus membantu program pemerintah dalam upaya pengentasan
                                            kemiskinan.</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section id="pengguna">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Daftar Pengguna Yang Sudah Terdaftar</h4>
                                    </div>
                                    <div class="card-body">
                                        {{ $dataTable->table() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section id="galeri">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Galeri Ranting Mejono</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="row gallery">
                                            @foreach ($coins as $coin)
                                                <div class="col-6 col-sm-6 col-lg-3 mt-2 mt-md-0 mb-md-0 mb-2">
                                                    <img class="w-100" src="{{ url('images/' . $coin->proof) }}">
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section id="faq">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Pertanyaan yang sering ditanyakan</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="accordion" id="accordionfaq">
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="headingOne">
                                                    <button class="accordion-button" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#collapseOne"
                                                        aria-expanded="true" aria-controls="collapseOne">
                                                        Bagaimana awal mula merintis Gerakan Koin NU?
                                                    </button>
                                                </h2>
                                                <div id="collapseOne" class="accordion-collapse collapse show"
                                                    aria-labelledby="headingOne" data-bs-parent="#accordionfaq">
                                                    <div class="accordion-body">
                                                        Kita punya ide. Setelah punya ide, kita coba di tingkat MWC
                                                        (Majelis Wakil Cabang atau tingkat kecamatan, red.) dan ternyata
                                                        berhasil. Keberhasilan kami membuat NU dari daerah-daerah lain
                                                        seperti NU Tulungagung tertarik dan mereka studi banding ke NU
                                                        Kediri.
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="headingTwo">
                                                    <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#collapseTwo"
                                                        aria-expanded="false" aria-controls="collapseTwo">
                                                        Berarti dari PCNU, MWC hingga Pengurus Ranting NU di Kabupaten
                                                        Kediri melakukan gerakan Koin NU?
                                                    </button>
                                                </h2>
                                                <div id="collapseTwo" class="accordion-collapse collapse"
                                                    aria-labelledby="headingTwo" data-bs-parent="#accordionfaq">
                                                    <div class="accordion-body">
                                                        Dari tingkat PCNU, MWCNU sampai Ranting (tingkat desa) NU
                                                        melakukan. Secara profesional ada Undang-Undang Zakat,
                                                        pengelolaan sepenuhnya ke LAZISNU. Kita sudah membentuk unit
                                                        pelayanan zakat, infak, sedekah untuk LAZISNU di tingkat MWC dan
                                                        juga unit pelayanan zakat, infak, dan sedekah LAZISNU di tingkat
                                                        ranting. Pelaksanaannya sendiri dilakukan oleh ibu-ibu karena
                                                        yang sabar mengurusi itu ibu-ibu. Jadi kami melibatkan badan
                                                        otonom terutama Muslimat dan Fatayat NU.
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="headingThree">
                                                    <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#collapseThree"
                                                        aria-expanded="false" aria-controls="collapseThree">
                                                        Pada awal-awal merintis, apakah ada kendala?
                                                    </button>
                                                </h2>
                                                <div id="collapseThree" class="accordion-collapse collapse"
                                                    aria-labelledby="headingThree" data-bs-parent="#accordionfaq">
                                                    <div class="accordion-body">
                                                        Ada. Itu wajar. Setiap ada aksi pasti ada reaksi. Begitu juga
                                                        masyarakat, ada yang setuju dan ada juga yang tidak setuju. Yang
                                                        tidak setuju biasanya karena sistemnya dianggap ribet, karena
                                                        harus ada pencatatan. Yang jelas persoalan utamanya pada pola
                                                        pikir, tapi alhamdulillah bisa diatasi.
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="headingFour">
                                                    <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#collapseFour"
                                                        aria-expanded="false" aria-controls="collapseFour">
                                                        Kotak sebagai tempat koin sendiri sekarang sudah ada berapa?
                                                    </button>
                                                </h2>
                                                <div id="collapseFour" class="accordion-collapse collapse"
                                                    aria-labelledby="headingFour" data-bs-parent="#accordionfaq">
                                                    <div class="accordion-body">
                                                        41 ribu kotak, tetapi belum keseluruhan, masih ada yang belum
                                                        mendapatkan. Kotak ini tidak diberikan, tapi permintaan
                                                        masyarakat sendiri. Karena kalau dikasih nanti, mereka terkesan
                                                        terpaksa. Kita akan mengubah itu. Kalau mereka minta, berarti
                                                        atas kesadaran mereka sendiri. Bahkan sekarang berkembang, satu
                                                        rumah bisa terdapat lebih dari satu kotak. Suami satu kotak,
                                                        istri satu kotak, anak juga satu kotak. Ini yang menarik.

                                                        Terus mereka kalau minta kotak untuk ditaruh di rumah
                                                        masing-masing, tidak ke PCNU atau MWCNU, tetapi ke ranting
                                                        masing-masing karena ada sistem, ada kodenya.
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="headingFive">
                                                    <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#collapseFive"
                                                        aria-expanded="false" aria-controls="collapseFive">
                                                        Sekarang Gerakan Koin NU berjalan hampir dua tahun dengan kotak
                                                        sebanyak 41 ribu. Kalau boleh tahu, omsetnya sudah berapa?
                                                    </button>
                                                </h2>
                                                <div id="collapseFive" class="accordion-collapse collapse"
                                                    aria-labelledby="headingFive" data-bs-parent="#accordionfaq">
                                                    <div class="accordion-body">
                                                        Sekitar Rp. 5.200.000.000 (lima miliar dua ratus juta). Kita
                                                        tidak bisa meremehkan yang kecil karena dari yang kecil bisa
                                                        menjadi besar.
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="headingSix">
                                                    <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#collapseSix"
                                                        aria-expanded="false" aria-controls="collapseSix">
                                                        Hasil dari Koin NU itu disalurkan ke mana dan atau untuk apa?
                                                    </button>
                                                </h2>
                                                <div id="collapseSix" class="accordion-collapse collapse"
                                                    aria-labelledby="headingSix" data-bs-parent="#accordionfaq">
                                                    <div class="accordion-body">
                                                        Hasilnya untuk membangun gedung NU, untuk pendidikan, beasiswa
                                                        anak-anak Ma’arif NU yang kurang mampu, untuk fakir miskin, dan
                                                        yatim-piatu, seperti waktu Hari Santri kami santuni 1000 santri
                                                        dhuafa. Bahkan dari koin itu kami punya mobil bus untuk
                                                        dijadikan jasa travel. Sekarang baru punya satu bus. Untuk
                                                        menutupi saat ada orang yang butuh jasa travel, kami bekerja
                                                        sama dengan pihak yang punya mobil bus dulu.
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="headingSeven">
                                                    <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#collapseSeven"
                                                        aria-expanded="false" aria-controls="collapseSeven">
                                                        Apa harapan atas kesuksesan Gerakan Koin NU ini?
                                                    </button>
                                                </h2>
                                                <div id="collapseSeven" class="accordion-collapse collapse"
                                                    aria-labelledby="headingSeven" data-bs-parent="#accordionfaq">
                                                    <div class="accordion-body">
                                                        Yang jelas kami berharap, mudah-mudahan NU di daerah-daerah lain
                                                        bisa meniru gerakan seperti kami agar bisa mandiri.
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="headingEight">
                                                    <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#collapseEight"
                                                        aria-expanded="false" aria-controls="collapseEight">
                                                        Kalau pemerintah daerah sendiri mendukung Gerakan Koin NU apa
                                                        tidak?
                                                    </button>
                                                </h2>
                                                <div id="collapseEight" class="accordion-collapse collapse"
                                                    aria-labelledby="headingEight" data-bs-parent="#accordionfaq">
                                                    <div class="accordion-body">
                                                        Pemda (Pemerintah Daerah) men-support.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>

            <footer>
                <div class="container">
                    <div class="footer clearfix mb-0 text-muted">
                        <div class="float-start">
                            <p>2021 &copy; Mazer UI</p>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <script src="{{ asset('assets/js/pages/horizontal-layout.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js"
        integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js"
        integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous">
    </script>
    {{ $dataTable->scripts() }}
</body>

</html>
