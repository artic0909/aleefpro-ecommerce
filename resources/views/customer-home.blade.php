<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <title>Aleef Pro</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />


  <!--SEO-->
  <!-- SEO Meta Tags -->
  <meta name="title" content="Aleef Pro | Wholesale Safety Products Manufacturer & Supplier">
  <meta name="description" content="Aleef Pro is a leading manufacturer and wholesale supplier of certified safety products in India. Explore industrial safety gear, apparel, and custom branding options at factory prices.">
  <meta name="keywords" content="Aleef Pro, safety products wholesale, industrial safety gear, certified safety apparel, custom safety branding, bulk safety products, PPE supplier, factory direct safety supplies">
  <meta name="robots" content="index, follow">
  <link rel="canonical" href="https://" />

  <!-- Open Graph / Facebook -->
  <meta property="og:type" content="website">
  <meta property="og:url" content="https://">
  <meta property="og:title" content="Aleef Pro | Wholesale Safety Products Manufacturer & Supplier">
  <meta property="og:description" content="Buy bulk safety products directly from Aleef Pro. From PPE kits to safety clothing — we offer certified solutions for all industrial needs.">
  <meta property="og:image" content="{{asset('./img/logo1.webp')}}">

  <!-- Twitter -->
  <meta property="twitter:card" content="summary_large_image">
  <meta property="twitter:url" content="https://www.aleefpro.com/">
  <meta property="twitter:title" content="Aleef Pro | Wholesale Safety Products Manufacturer & Supplier">
  <meta property="twitter:description" content="India’s trusted wholesale supplier for industrial safety gear. Explore certified products at competitive prices.">
  <meta property="twitter:image" content="{{asset('./img/logo1.webp')}}">


  <!-- Favicon -->
  <link href="img/favicon.ico" rel="icon" />

  <!-- Google Web Fonts -->
  <link rel="preconnect" href="https://fonts.gstatic.com" />
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet" />

  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet" />

  <!-- Libraries Stylesheet -->
  <link href="{{ asset('lib/animate/animate.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet" />

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
    integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!-- Customized Bootstrap Stylesheet -->
  <link href="{{ asset('css/style.css') }}" rel="stylesheet" />
  <link href="{{ asset('css/serach-responsive.css') }}" rel="stylesheet">
  <link rel="shortcut icon" href="{{ asset('./img/logo1.webp') }}" />
</head>

<body>
  <!-- Topbar Start -->
  <div class="container-fluid">
    <div class="row bg-secondary py-1 px-xl-5">
      <div class="col-lg-6 d-none d-lg-block">
        <div class="d-inline-flex align-items-center h-100">
          <a class="text-body mr-3" href="/about">About</a>
          <a class="text-body mr-3" href="/contact">Contact</a>
          <a class="text-body mr-3" href="{{ route('catalogue.download', $catalogue->id) }}" target="_blank">Catalogue</a>
        </div>
      </div>


      <div class="col-lg-6 text-center text-lg-right">
        <div class="d-inline-flex align-items-center">

          <div class="btn-group">
            <button type="button" class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown">
              <i class="fa-regular fa-user"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-right">

              @auth('customers')
              <a href="/customer/profile" class="dropdown-item" type="button">
                <i class="fa-solid fa-gear"></i> Profile
              </a>
              <a href="/customer/orders" class="dropdown-item" type="button">
                <i class="fa-solid fa-boxes-stacked"></i> Orders
              </a>
              <a href="{{ route('customer.logout') }}" class="dropdown-item" type="button">
                <i class="fa-solid fa-power-off"></i> Logout
              </a>
              @else
              <a href="/customer/login" class="dropdown-item" type="button">Login</a>
              <a href="/customer/register" class="dropdown-item" type="button">Signup</a>
              @endauth



            </div>
          </div>

          &nbsp;


          <div class="btn-group">
            <div id="google_translate_element" class="btn btn-sm btn-light"></div>

          </div>

          &nbsp;


          <div class="btn-group initial-hide">
            <div style="display: flex; gap: 5px;">
              <form action="{{ route('search.products') }}" method="GET">
                <div class="input-group">
                  <input type="text" name="query" class="form-control" placeholder="Search for products" />
                  <div class="input-group-append">
                    <span class="input-group-text bg-transparent text-primary">
                      <i class="fa fa-search"></i>
                    </span>
                  </div>
                </div>
              </form>

              @auth('customers')
              <a href="/customer/cart" class="btn px-0">
                <i class="fas fa-shopping-cart text-primary"></i>
                <span class="badge text-danger border border-warning rounded-circle">{{$cartCount}}</span>
              </a>
              @else
              <a href="/customer/cart" class="btn px-0">
                <i class="fas fa-shopping-cart text-primary"></i>
                <span class="badge text-danger border border-warning rounded-circle">0</span>
              </a>
              @endauth
            </div>


          </div>


        </div>
      </div>
    </div>
    <div class="row align-items-center bg-light py-3 px-xl-5 d-none d-lg-flex">
      <div class="col-lg-4">
        <a href="/" class="text-decoration-none d-flex align-items-center">
          <img src="{{asset('img/logo1.webp')}}" class="img-fluid" width="55" alt="logo" />
          <div class="">
            <span class="h1 text-uppercase text-white bg-org px-2">Aleef</span>
            <span class="h1 text-uppercase text-white bg-blue px-2 ml-n1">Pro</span>
          </div>
        </a>
      </div>
      <div class="col-lg-4 col-6 text-left">
        <form action="{{ route('search.products') }}" method="GET">
          <div class="input-group">
            <input type="text" name="query" class="form-control" placeholder="Search for products" />
            <div class="input-group-append">
              <span class="input-group-text bg-transparent text-primary">
                <i class="fa fa-search"></i>
              </span>
            </div>
          </div>
        </form>


      </div>
      <div class="col-lg-4 col-6 text-right">
        <p class="m-0">Customer Service</p>
        @foreach ($socials as $social)
        <h6 class="m-0">+{{ $social->mobile }}</h6>
        @endforeach
      </div>
    </div>
  </div>
  <!-- Topbar End -->

  <!-- Navbar Start -->
  <div class="container-fluid bg-blue mb-30">
    <div class="row px-xl-5">
      <div class="col-lg-3 d-none d-lg-block">
        <a class="btn d-flex align-items-center justify-content-between bg-org text-white w-100" data-toggle="collapse"
          href="#navbar-vertical" style="height: 65px; padding: 0 30px">
          <h6 class="text-white m-0">
            <i class="fa fa-bars mr-2"></i>Categories
          </h6>
          <i class="fa fa-angle-down text-white"></i>
        </a>
        <nav class="collapse position-absolute navbar navbar-vertical navbar-light align-items-start p-0 bg-light"
          id="navbar-vertical" style="width: calc(100% - 30px); z-index: 999">
          <div class="navbar-nav w-100">
            @foreach($maincategories as $main)
            <div class="nav-item dropdown dropright">
              <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                {{ $main->main_category_name }}
                <i class="fa fa-angle-right float-right mt-1"></i>
              </a>
              <div class="dropdown-menu position-absolute rounded-0 border-0 m-0">
                @foreach($main->subCategory as $sub)
                <a href="{{ route('customer.all-products', ['mainSlug' => $sub->mainCategory->slug, 'subSlug' => $sub->slug]) }}" class="dropdown-item">
                  {{ $sub->sub_category_name }}
                </a>
                @endforeach
              </div>
            </div>
            @endforeach
          </div>
        </nav>

      </div>
      <div class="col-lg-9">
        <nav class="navbar navbar-expand-lg bg-blue navbar-dark py-3 py-lg-0 px-0">
          <a href="/" class="text-decoration-none d-block d-lg-none">
            <span class="h1 text-uppercase text-white bg-org px-2">Aleef</span>
            <span class="h1 text-uppercase text-white bg-blue px-2 ml-n1">Pro</span>
          </a>
          <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
            <div class="navbar-nav mr-auto py-0">
              <a href="/" class="nav-item nav-link active">Home</a>
              <a href="/product-categories" class="nav-item nav-link">Products</a>
              <a href="/blogs" class="nav-item nav-link">Blogs</a>
              <a href="/contact" class="nav-item nav-link">Contact</a>
            </div>
            <div class="navbar-nav ml-auto py-0 d-none d-lg-block">

              @auth('customers')
              <button class="btn px-0">
                <i class="fas fa-user text-primary"></i>
                <span class="badge text-success" style="padding-bottom: 2px">✔</span>
              </button>

              <a href="/customer/cart" class="btn px-0 ml-3">
                <i class="fas fa-shopping-cart text-primary"></i>
                <span class="badge text-secondary border border-secondary rounded-circle"
                  style="padding-bottom: 2px">{{$cartCount}}</span>
              </a>
              @else
              <a href="/customer/login" class="btn px-0">
                <i class="fas fa-user text-primary"></i>
                <span class="badge text-warning" style="padding-bottom: 2px">X</span>
              </a>

              <a href="/customer/cart" class="btn px-0 ml-3">
                <i class="fas fa-shopping-cart text-primary"></i>
                <span class="badge text-secondary border border-secondary rounded-circle"
                  style="padding-bottom: 2px">0</span>
              </a>
              @endauth
            </div>
          </div>
        </nav>
      </div>
    </div>
  </div>
  <!-- Navbar End -->

  <!-- Carousel Start -->
  <div class="container-fluid mb-3">
    <div class="row px-xl-5">
      <div class="col-lg-8">
        <div id="header-carousel" class="carousel slide carousel-fade mb-30 mb-lg-0" data-ride="carousel">
          <ol class="carousel-indicators">
            @foreach($scrollingBanners as $index => $banner)
            <li data-target="#header-carousel" data-slide-to="{{ $index }}" class="{{ $index == 0 ? 'active' : '' }}"></li>
            @endforeach

          </ol>
          <div class="carousel-inner" style="border-radius: 10px;">
            @foreach($scrollingBanners as $index => $banner)
            <div class="carousel-item position-relative {{ $index == 0 ? 'active' : '' }}" style="height: 430px">
              <img class="position-absolute w-100 h-100" src="{{ asset('storage/' . $banner->image) }}" style="object-fit: cover" />
            </div>
            @endforeach
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        @foreach($offers as $offer)
        <div class="product-offer mb-30" style="height: 200px; border-radius: 10px;">
          <img class="img-fluid" src="{{ asset('storage/' . $offer->image) }}" alt="" />
          <div class="offer-text">
            <h6 class="text-white text-uppercase">Save {{$offer->offer_percentage}}</h6>
            <h3 class="text-white mb-3">Special Offer</h3>
            <a href="{{$offer->link}}" class="btn btn-primary2 text-white" style="border-radius: 5px;">Shop Now</a>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </div>
  <!-- Carousel End -->

  <!-- Featured Start -->
  <div class="container-fluid pt-5">
    <div class="row px-xl-5 pb-3">
      <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
        <div class="d-flex align-items-center bg-blue mb-4" style="padding: 30px">
          <h1 class="text-primary m-0 mr-3">
            <i class="fa-solid fa-medal"></i>
          </h1>
          <h5 class="font-weight-semi-bold text-white m-0">
            Certified Apparel
          </h5>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
        <div class="d-flex align-items-center bg-blue mb-4" style="padding: 30px">
          <h1 class="text-primary m-0 mr-2">
            <i class="fa-solid fa-boxes-stacked"></i>
          </h1>
          <h5 class="font-weight-semi-bold text-white m-0">Bulk Inquiry</h5>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
        <div class="d-flex align-items-center bg-blue mb-4" style="padding: 30px">
          <h1 class="text-primary m-0 mr-3">
            <i class="fa-solid fa-file"></i>
          </h1>
          <h5 class="font-weight-semi-bold text-white m-0">
            Product Catalog
          </h5>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
        <div class="d-flex align-items-center bg-blue mb-4" style="padding: 30px">
          <h1 class="text-primary m-0 mr-3">
            <i class="fa-solid fa-pen-to-square"></i>
          </h1>
          <h5 class="font-weight-semi-bold text-white m-0">
            Custom Branding
          </h5>
        </div>
      </div>
    </div>
  </div>
  <!-- Featured End -->

  <!-- Categories Start -->
  <div class="container-fluid pt-5">
    <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4">
      <span class="bg-secondary pr-3">Categories</span>
    </h2>
    <div class="row px-xl-5 pb-3">

      @foreach($subCategories as $sub)
      <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
        <a class="text-decoration-none" href="{{ route('customer.all-products', ['mainSlug' => $sub->mainCategory->slug, 'subSlug' => $sub->slug]) }}">
          <div class="cat-item d-flex align-items-center mb-4" style="box-shadow: 0 0 10px #d8d8d8">
            <div class="overflow-hidden" style="width: 100px; height: 100px">
              <img class="img-fluid" src="img/category.webp" alt="" />
            </div>
            <div class="flex-fill pl-3">
              <h4 class="m-0 p-0">{{$sub->sub_category_name}}</h4>
              <small>{{$sub->mainCategory->main_category_name}}</small>
              <p class="text-body p-0 m-0">{{$sub->products->count()}} Products</p>
            </div>
          </div>
        </a>
      </div>
      @endforeach


    </div>
  </div>
  <!-- Categories End -->

  <!-- Offer Start -->
  <div class="container-fluid pt-5 pb-3">
    <div class="row px-xl-5">
      @foreach($offers as $offer)
      <div class="col-md-6">
        <div class="product-offer mb-30" style="height: 300px">
          <img class="img-fluid" src="{{ asset('storage/' . $offer->image) }}" alt="" />
          <div class="offer-text">
            <h6 class="text-white text-uppercase">Save {{$offer->offer_percentage}}</h6>
            <h3 class="text-white mb-3">Special Offer</h3>
            <a href="{{$offer->link}}" class="btn btn-primary2">Shop Now</a>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
  <!-- Offer End -->

  <!-- Products Start -->
  <div class="container-fluid pt-5 pb-3">
    <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4">
      <span class="bg-secondary pr-3">Safety Products</span>
    </h2>
    <div class="row px-xl-5">

      @foreach($products as $product)
      <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
        <div class="product-item bg-light mb-4">
          <div class="product-img position-relative overflow-hidden">

            <a href="{{ route('customer.product-details', [
       'mainSlug' => $product->subCategory->mainCategory->slug,
       'subSlug' => $product->subCategory->slug,
       'productSlug' => $product->slug
   ]) }}">
              <img class="img-fluid w-100" src="{{ asset('storage/' . $product->image) }}" alt="" />
            </a>


          </div>
          <div class="text-center py-4 p-3">
            <a class="h6 text-decoration-none text-cl" href="{{ route('customer.product-details', [
       'mainSlug' => $product->subCategory->mainCategory->slug,
       'subSlug' => $product->subCategory->slug,
       'productSlug' => $product->slug
   ]) }}">{{$product->product_name}}</a>
            <div class="d-flex align-items-center justify-content-center mt-2">
              <h5>${{$product->selling_price}}</h5>
              <h6 class="text-muted ml-2"><del>${{$product->actual_price}}</del></h6>
            </div>
            <div class="d-flex align-items-center justify-content-center mb-1">
              <small class="fa fa-star text-primary mr-1"></small>
              <small class="fa fa-star text-primary mr-1"></small>
              <small class="fa fa-star text-primary mr-1"></small>
              <small class="fa fa-star text-primary mr-1"></small>
              <small class="fa fa-star text-primary mr-1"></small>
            </div>

            <div class="product-actions mt-3" style="display: flex; justify-content: space-evenly; gap: 30px;">

              <a class="btn w-full btn-outline-dark btn-square" href="{{ route('customer.product.customize', [
       'mainSlug' => $product->subCategory->mainCategory->slug,
       'subSlug' => $product->subCategory->slug,
       'productSlug' => $product->slug
   ]) }}" style="width: 100%;"><i class="fa-solid fa-pen-to-square" style="font-size: 18px;"></i></a>

              <a class="btn w-full btn-outline-dark btn-square" href="{{ route('customer.product-details', [
       'mainSlug' => $product->subCategory->mainCategory->slug,
       'subSlug' => $product->subCategory->slug,
       'productSlug' => $product->slug
   ]) }}" style="width: 100%;"><i class="fa-solid fa-circle-info" style="font-size: 18px;"></i></a>
            </div>
          </div>
        </div>
      </div>
      @endforeach



    </div>
  </div>
  <!-- Products End -->



  <!-- Vendor Start -->
  <div class="container-fluid py-5">
    <div class="row px-xl-5">
      <div class="col">
        <div class="owl-carousel vendor-carousel">
          @foreach($partners as $partner)
          <div class="bg-light p-4">
            <img src="{{ asset('storage/' . $partner->image) }}" alt="" />
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
  <!-- Vendor End -->


  <!-- Footer Start -->
  @foreach($socials as $social)
  <div class="container-fluid bg-blue text-secondary mt-5 pt-5">
    <div class="row px-xl-5 pt-5">
      <div class="col-lg-4 col-md-12 mb-5 pr-3 pr-xl-5">
        <img src="{{ asset('img/logo1.jpg') }}" class="img-fluid fade-edges" width="400" alt="logo" />
        <p class="mb-2 mt-2">
          <i class="fa fa-map-marker-alt text-primary mr-3"></i>{{$social->address}}
        </p>
        <p class="mb-2">
          <i class="fa fa-envelope text-primary mr-3"></i>{{$social->email}}
        </p>
        <p class="mb-0">
          <i class="fa fa-phone text-primary mr-3"></i>{{$social->mobile}}
        </p>
      </div>
      <div class="col-lg-8 col-md-12">
        <div class="row">
          <div class="col-md-6 mb-5">
            <h5 class="text-secondary text-uppercase mb-4">Direct Links</h5>
            <div class="d-flex flex-column justify-content-start">
              <a class="text-secondary mb-2" href="/faq"><i class="fa fa-angle-right mr-2"></i>FAQs</a>
              <a class="text-secondary mb-2" href="/blogs"><i class="fa fa-angle-right mr-2"></i>Blogs</a>
              <a class="text-secondary mb-2" href="/about"><i class="fa fa-angle-right mr-2"></i>About US</a>
              <a class="text-secondary mb-2" href="/contact"><i class="fa fa-angle-right mr-2"></i>Contact Us</a>
              <a class="text-secondary mb-2" href="/product-categories"><i class="fa fa-angle-right mr-2"></i>Product Categories</a>
            </div>
          </div>

          <div class="col-md-6 mb-5">
            <h5 class="text-secondary text-uppercase mb-4">Newsletter</h5>
            <p>Send us your email &amp; get latest updates!</p>
            <form action="">
              <div class="input-group">
                <input type="text" class="form-control" placeholder="Your Email Address" />
                <div class="input-group-append">
                  <button class="btn btn-primary2">SEND</button>
                </div>
              </div>
            </form>
            <h6 class="text-secondary text-uppercase mt-4 mb-3">Follow Us</h6>
            <div class="d-flex">
              <a class="btn btn-primary2 btn-square mr-2" href="{{$social->twitter}}" target="_blank"><i class="fab fa-twitter"></i></a>
              <a class="btn btn-primary2 btn-square mr-2" href="{{$social->fb}}" target="_blank"><i class="fab fa-facebook-f"></i></a>
              <a class="btn btn-primary2 btn-square mr-2" href="{{$social->linkedin}}" target="_blank"><i class="fab fa-linkedin-in"></i></a>
              <a class="btn btn-primary2 btn-square" href="{{$social->insta}}" target="_blank"><i class="fab fa-instagram"></i></a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row border-top mx-xl-5 py-4" style="border-color: rgba(256, 256, 256, 0.1) !important">
      <div class="col-md-6 px-xl-0">
        <p class="mb-md-0 text-center text-md-left text-secondary">
          &copy; <a class="text-primary" href="#">Domain</a>. All Rights
          Reserved. Designed by
          <a class="text-primary" href="">Aleef Pro Factory Showroom</a>
        </p>
      </div>
      <div class="col-md-6 px-xl-0 text-center text-md-right">
        <img class="img-fluid" src="img/payments.png" alt="" />
      </div>
    </div>
  </div>
  @endforeach
  <!-- Footer End -->

  <!-- Back to Top -->
  <a href="#" class="btn btn-primary2 back-to-top"><i class="fa fa-angle-double-up"></i></a>

  <!-- JavaScript Libraries -->
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
  <script src="{{ asset('lib/easing/easing.min.js') }}"></script>
  <script src="{{ asset('lib/owlcarousel/owl.carousel.min.js') }}"></script>



  <!-- Template Javascript -->
  <script src="{{ asset('js/main.js') }}"></script>

  <!-- Google Translate -->
  <script type="text/javascript">
    function googleTranslateElementInit() {
      new google.translate.TranslateElement({
          pageLanguage: 'en', // Default language
          includedLanguages: 'en,fr,es', // Available languages (English, French, Spanish)
          layout: google.translate.TranslateElement.InlineLayout.SIMPLE
        },
        'google_translate_element'
      );
    }
  </script>

  <script src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
</body>

</html>