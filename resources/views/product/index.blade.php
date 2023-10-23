<!DOCTYPE html>
<html lang="en">

<head>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!--=============== FAVICON ===============-->
        <link rel="shortcut icon" href="{{url('assets/img/favicon/favicon.ico')}}" type="image/x-icon">

        <!--=============== BO  1XICONS ===============-->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">

        <!--=============== SWIPER CSS ===============-->
        <link rel="stylesheet" href="{{url('assets/css/swiper-bundle.min.css')}}">

        <!-- Scripts -->
        {{-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) --}}

        <!--=============== CSS ===============-->
        <!-- <link rel="stylesheet" href="css/search.scss"> -->
        <link rel="stylesheet" href="{{('assets/product/css/style.css')}}">
        <!--=============== FONT AWESOME ===============-->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
            integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

        <title>JCLothes || Create Your Des</title>
    </head>

<body>
    <header class="header" id="header">
        <nav class="nav container primary-navigation">
            <a href="#" class="nav__logo "><img src="../assets/img/logoBlackMode.png"
                    class="nav__logo">JCLothes</a>

            <div class="nav__menu" id="nav-menu">
                <ul class="nav__list">
                    <li class="nav__item">
                        <a href="/home" class="nav__link ">Home</a>
                    </li>
                    <li class="nav__item">
                        <a href="/design" class="nav__link ">Design Own &dtrif;</a>
                        <ul class="dropdown ">
                            <li><a href="#">T-Shirt</a></li>
                            <li><a href="#">Long Sleeves</a></li>
                            <li><a href="#">Hoodie</a></li>
                            <li><a href="#">Sweater</a></li>
                            <li><a href="#">Crewneck</a></li>
                            <li><a href="#">Jacket</a></li>
                            <li><a href="#">Varsity</a></li>
                        </ul>
                    <li class="nav__item">
                        <a href="index.html" class="nav__link active-link">Our Product</a>
                    </li>
                    <li class="nav__item">
                        <a href="#new" class="nav__link">Contact</a>
                    </li>
                </ul>

                <!-- close tab navbar responsive -->

                <div class="nav__close" id="nav-close">
                    <i class="bx bx-x"></i>
                </div>
            </div>
            <!-- navButton dark mode dan chart -->
            <div class="nav__btns">
                <!-- Theme change button -->
                <i class='bx bx-moon change-theme' id="theme-button"></i>

                <div class="nav__shop" id="cart-shop">
                    <?php
                    $pesanan_utama = App\Models\Pesanan::where('user_id', Auth::user()->id)
                        ->where('status', 0)
                        ->first();
                    if (!empty($pesanan_utama)) {
                        $notif = App\Models\PesananDetail::where('pesanan_id', $pesanan_utama->id)->count();
                    }
                    ?>
                    <i class='bx bx-shopping-bag'></i>
                    @if (!empty($notif))
                        <span class="badge"
                            style="visibility: <?= $notif == 0 ? 'hidden' : 'visible' ?>">{{ $notif }}</span>
                    @endif
                </div>

                <div class="nav__toggle" id="nav-toggle">
                    <i class='bx bx-grid-alt'></i>
                </div>

                <div>
                    <!-- Authentication Links -->
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @endif

                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="dropdown-toggle fw-bold" href="" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ url('profile') }}">
                                    Profile
                                </a>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </div>
            </div>
        </nav>
    </header>
    <!--==================== CART ====================-->
    <div class="cart" id="cart">
        <i class='bx bx-x cart__close' id="cart-close"></i>

        <h2 class="cart__title-center">Keranjang saya</h2>

        <div class="cart__container">
            <?php
            if (!empty($pesanan_utama)) {
                $pesanan_details = App\Models\PesananDetail::where('pesanan_id', $pesanan->id)->get();
            }
            ?>
            @if (!empty($pesanan_details))
                @foreach ($pesanan_details as $pesanan_detail)
                    <article class="cart__card">
                        <div class="cart__box">
                            <img src="{{ url('assets/img/product/' . $pesanan_detail->barang->gambar) }}" alt=""
                                class="cart__img">
                        </div>

                        <div class="cart__details">
                            <h3 class="cart__title">{{ $pesanan_detail->barang->nama_barang }}</h3>
                            <span class="cart__price">Rp.{{ number_format($pesanan_detail->barang->harga) }}</span>
                        </div>
                    </article>
                @endforeach
            @endif
        </div>
        <div class="cart__prices">
            <a href="/checkout">detail</a>
        </div>
    </div>

    <!-- Main / hero -->
    <div class="main">

        <div class="home__container container grid">
            <div class="Main">
                <div class="product__page__title">
                    <h1 class="page__title">Product</h1>

                    <div class="container__sidebar">
                        <!-- search -->
                        <div class="container__search">
                            <div class="text__search">
                                <input type="text" class="search__text" placeholder="Search">

                            </div>
                        </div>
                        <!-- checkbox -->

                        <div class="sidebar__checkbox">
                            <div class="category__title">
                                <h1 class="text__category">Category</h1>
                                <label class="checkbox" for="check1">
                                    <input type="checkbox" id="check1" value="1">
                                    <div>
                                        <svg class="check" viewBox="-2 -2 35 35" aria-hidden="true">
                                            <title>checkmark-circle</title>
                                            <polyline points="7.57 15.87 12.62 21.07 23.43 9.93" />
                                        </svg>
                                    </div>
                                    <div class="text__checkbox">T-Shirt</div>
                                </label>
                                <label class="checkbox" for="check2">
                                    <input type="checkbox" id="check2" value="2">
                                    <div>
                                        <svg class="check" viewBox="-2 -2 35 35" aria-hidden="true">
                                            <title>checkmark-circle</title>
                                            <polyline points="7.57 15.87 12.62 21.07 23.43 9.93" />
                                        </svg>
                                    </div>
                                    <div class="text__checkbox">Long Sleeves</div>
                                </label>
                                <label class="checkbox" for="check3">
                                    <input type="checkbox" id="check3" value="3">
                                    <div>
                                        <svg class="check" viewBox="-2 -2 35 35" aria-hidden="true">
                                            <title>checkmark-circle</title>
                                            <polyline points="7.57 15.87 12.62 21.07 23.43 9.93" />
                                        </svg>
                                    </div>
                                    <div class="text__checkbox">Hoodie</div>
                                </label>
                                <label class="checkbox" for="check4">
                                    <input type="checkbox" id="check4" value="4">
                                    <div>
                                        <svg class="check" viewBox="-2 -2 35 35" aria-hidden="true">
                                            <title>checkmark-circle</title>
                                            <polyline points="7.57 15.87 12.62 21.07 23.43 9.93" />
                                        </svg>
                                    </div>
                                    <div class="text__checkbox">Varsity</div>
                                </label>
                                <label class="checkbox" for="check5">
                                    <input type="checkbox" id="check5" value="5">
                                    <div>
                                        <svg class="check" viewBox="-2 -2 35 35" aria-hidden="true">
                                            <title>checkmark-circle</title>
                                            <polyline points="7.57 15.87 12.62 21.07 23.43 9.93" />
                                        </svg>
                                    </div>
                                    <div class="text__checkbox">Sweater</div>
                                </label>
                                <label class="checkbox" for="check6">
                                    <input type="checkbox" id="check6" value="6">
                                    <div>
                                        <svg class="check" viewBox="-2 -2 35 35" aria-hidden="true">
                                            <title>checkmark-circle</title>
                                            <polyline points="7.57 15.87 12.62 21.07 23.43 9.93" />
                                        </svg>
                                    </div>
                                    <div class="text__checkbox">Crewneck</div>
                                </label>
                                <label class="checkbox" for="check7">
                                    <input type="checkbox" id="check7" value="7">
                                    <div>
                                        <svg class="check" viewBox="-2 -2 35 35" aria-hidden="true">
                                            <title>checkmark-circle</title>
                                            <polyline points="7.57 15.87 12.62 21.07 23.43 9.93" />
                                        </svg>
                                    </div>
                                    <div class="text__checkbox">Jacket</div>
                                </label>
                                <!-- <button onclick="clearCheck()" class="button__clear">Clear All</button> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container__card__product">
            <section class="products section container" id="products">
                <div class="products__container grid">
                    <?php 
                        $barangs = App\Models\Barang::paginate(20);   
                    ?>
                    @foreach ($barangs as $barang)
                        <article class="products__card">
                            <a href="pesan/{{ $barang->id }}">
                                <div
                                    style="width: 100%; height: 100%; position: absolute; top: 0; background-color: <?= $barang->stok == 0 ? 'rgba(0,0,0,0.5)' : '' ?>">
                                </div>
                                <img src="{{ url('assets/img/product/' . $barang->gambar) }}" alt=""
                                    class="products__img">
    
                                <h3 class="products__title">{{ $barang->nama_barang }}</h3>
                                <span class="products__price">Rp{{ number_format($barang->harga) }}</span>
    
                                <a href="pesan/{{ $barang->id }}" class="products__button">
                                    <i class='bx bx-shopping-bag'></i>
                                </a>
                            </a>
                        </article>
                    @endforeach
                </div>
            </section>
        </div>
    </div>
    </div>
    <!-- <button class="button__card__product"><h1 class="btn__text__card">Design My Own</h1></button>
            </div> -->


    <footer class="footer section">
        <div class="footer__container container grid">
            <div class="footer__content">
                <h3 class="footer__title">Our information</h3>

                <ul class="footer__list">
                    <li>Email : jantur29@gmail.com</li>
                    <li>Purwokerto, Banyumas, Jawa Tengah</li>
                    <li>No Telepon : 089542277317</li>
                </ul>
            </div>
            <div class="footer__content">
                <h3 class="footer__title">About Us</h3>

                <ul class="footer__links">
                    <li>
                        <a href="#" class="footer__link">Support Center</a>
                    </li>
                    <li>
                        <a href="#" class="footer__link">Customer Support</a>
                    </li>
                    <li>
                        <a href="#" class="footer__link">About Us</a>
                    </li>
                    <li>
                        <a href="#" class="footer__link">Copy Right</a>
                    </li>
                </ul>
            </div>

            <div class="footer__content">
                <h3 class="footer__title">Our Supplier</h3>

                <ul class="footer__links">
                    <li>
                        <a href="#" class="footer__link">BBA Salon</a>
                    </li>
                    <li>
                        <a href="#" class="footer__link">TeeLaunch</a>
                    </li>
                    <li>
                        <a href="#" class="footer__link">T-Pop</a>
                    </li>
                    <li>
                        <a href="#" class="footer__link">Other Printing</a>
                    </li>
                </ul>
            </div>

            <div class="footer__content">
                <h3 class="footer__title">Social Media Kami</h3>

                <ul class="footer__social">
                    <a href="https://www.facebook.com/" target="_blank" class="footer__social-link">
                        <i class='bx bxl-facebook'></i>
                    </a>

                    <a href="https://twitter.com/" target="_blank" class="footer__social-link">
                        <i class='bx bxl-twitter'></i>
                    </a>

                    <a href="https://www.instagram.com/" target="_blank" class="footer__social-link">
                        <i class='bx bxl-instagram'></i>
                    </a>
                </ul>
            </div>
        </div>

        <span class="footer__copy">&#169; Jantur Dev || JCLothes</span>
    </footer>



    <!-- end main -->

    <a href="#" class="scrollup" id="scroll-up">
        <i class='bx bx-up-arrow-alt scrollup__icon'></i>
    </a>
    <!--=============== SWIPER JS ===============-->
    <script src="{{ url('assets/js/swiper-bundle.min.js') }}"></script>

    <!--=============== MAIN JS ===============-->
    <script src="{{ url('assets/js/main.js') }}"></script>
</body>

</html>
