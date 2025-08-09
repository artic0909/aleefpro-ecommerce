<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <title>{{$product->product_name}}</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />

  <!-- SEO -->
  <!-- SEO Meta Tags -->
  <meta name="title" content="{{ $product->product_name }} - Buy Online at Best Price | Aleef Pro">
  <meta name="description" content="{{ Str::limit(strip_tags($product->description), 160) }}">
  <meta name="keywords" content="{{ $product->product_name }}, {{ $subCategory->sub_category_name }}, {{ $product->subCategory->mainCategory->main_category_name }}, buy online, Aleef Pro">
  <meta name="robots" content="index, follow">
  <link rel="canonical" href="{{ url()->current() }}">

  <!-- Open Graph / Facebook -->
  <meta property="og:type" content="product">
  <meta property="og:title" content="{{ $product->product_name }} - Aleef Pro">
  <meta property="og:description" content="{{ Str::limit(strip_tags($product->description), 160) }}">

  @php
  $images = json_decode($product->images, true);
  $firstImage = isset($images[0]) ? str_replace('\/', '/', $images[0]) : null;
  @endphp

  @if ($firstImage)
  <meta property="og:image" content="{{ asset('storage/' . $firstImage) }}">
  @endif

  <meta property="og:url" content="{{ url()->current() }}">
  <meta property="og:site_name" content="Aleef Pro">

  <!-- Twitter -->
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="{{ $product->product_name }} - Aleef Pro">
  <meta name="twitter:description" content="{{ Str::limit(strip_tags($product->description), 160) }}">
  <meta name="twitter:image" content="{{ asset('storage/' . str_replace('\/', '/', $images[0] ?? 'img/default.png')) }}">



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

  <style>
    .custom-success-popup,
    .custom-error-popup {
      position: fixed;
      top: 20px;
      right: 20px;
      padding: 15px 20px;
      border-radius: 5px;
      color: white;
      z-index: 9999;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
      animation: fadeInOut 4s ease-in-out forwards;
    }

    .custom-success-popup {
      background-color: #4CAF50;
    }

    .custom-error-popup {
      background-color: #f44336;
    }

    @keyframes fadeInOut {
      0% {
        opacity: 0;
        transform: translateY(-10px);
      }

      10% {
        opacity: 1;
        transform: translateY(0);
      }

      90% {
        opacity: 1;
      }

      100% {
        opacity: 0;
        transform: translateY(-10px);
      }
    }
  </style>



</head>

<body>
  <!-- Topbar Start -->
  <div class="container-fluid">
    <div class="row bg-secondary py-1 px-xl-5">
      <div class="col-lg-6 d-none d-lg-block">
        <div class="d-inline-flex align-items-center h-100">
          <a class="text-body mr-3" href="/about">About</a>
          <a class="text-body mr-3" href="/contact">Contact</a>
          <a class="text-body mr-3" href="/faq">FAQs</a>
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
                <i class="fa-solid fa-gear"></i> Orders
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
              <a href="/" class="nav-item nav-link">Home</a>
              <a href="/product-categories" class="nav-item nav-link active">Products</a>
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

  <!-- Breadcrumb Start -->
  <div class="container-fluid">
    <div class="row px-xl-5">
      <div class="col-12">
        <img src="img/product-details-banner.png" class="img-fluid" width="100%" alt="" />
        <nav class="breadcrumb bg-light mb-30">
          <a class="breadcrumb-item text-dark" href="#">{{$subCategory->sub_category_name}}</a>
          <span class="breadcrumb-item active">{{$product->product_name}}</span>
        </nav>
      </div>
    </div>
  </div>
  <!-- Breadcrumb End -->

  <!-- Shop Detail Start -->
  <div class="container-fluid pb-5">
    <div class="row px-xl-5">
      <div class="col-lg-5 mb-30">
        <div id="product-carousel" class="carousel slide" data-ride="carousel">
          @php
          $images = json_decode($product->images, true);
          @endphp

          <div class="carousel-inner bg-light">
            @foreach ($images as $key => $img)
            <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
              <img class="w-100 h-100" src="{{ asset('storage/' . str_replace('\/', '/', $img)) }}" alt="{{ $product->product_name }}" />
            </div>
            @endforeach
          </div>
          <a class="carousel-control-prev" href="#product-carousel" data-slide="prev">
            <i class="fa fa-2x fa-angle-left text-dark"></i>
          </a>
          <a class="carousel-control-next" href="#product-carousel" data-slide="next">
            <i class="fa fa-2x fa-angle-right text-dark"></i>
          </a>
        </div>
      </div>

      <form action="{{ route('customer.cart.add') }}" method="POST" class="col-lg-7 h-auto mb-30">
        @csrf

        <div class="h-100 bg-light p-30">

          <input type="hidden" name="product_id" value="{{ $product->id }}">

          <h3>{{$product->product_name}}</h3>
          <div class="d-flex mb-3">
            <div class="text-primary mr-2">
              <small class="fas fa-star"></small>
              <small class="fas fa-star"></small>
              <small class="fas fa-star"></small>
              <small class="fas fa-star-half-alt"></small>
              <small class="far fa-star"></small>
            </div>
          </div>
          <h3 class="font-weight-semi-bold mb-4">${{$product->selling_price}}</h3>
          <h6 class="text-muted"><del>${{ $product->actual_price }}</del></h6>


          <!-- Size -->
          <div class="d-flex mb-3">
            <strong class="text-dark mr-3">Sizes:</strong>
            <div>
              @php $sizes = explode(',', $product->sizes); @endphp
              @foreach ($sizes as $index => $size)
              <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" class="custom-control-input" id="size-{{ $index }}" name="size" value="{{ trim($size) }}">
                <label class="custom-control-label" for="size-{{ $index }}">{{ strtoupper(trim($size)) }}</label>
              </div>
              @endforeach


            </div>
          </div>

          <!-- Color -->
          <div class="d-flex mb-4">
            <strong class="text-dark mr-3">Colors:</strong>
            <div>
              @php $colors = explode(',', $product->colors); @endphp
              @foreach ($colors as $index => $color)
              <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" class="custom-control-input" id="color-{{ $index }}" name="color" value="{{ trim($color) }}">
                <label class="custom-control-label" for="color-{{ $index }}">{{ ucfirst(trim($color)) }}</label>
              </div>
              @endforeach

            </div>
          </div>

          <!-- Quantity -->
          <div class="input-group quantity mr-3" style="width: 130px">
            <div class="input-group-btn">
              <button type="button" class="btn btn-primary2 btn-minus">
                <i class="fa fa-minus"></i>
              </button>
            </div>
            <input type="text" name="quantity" class="form-control bg-secondary border-0 text-center" value="20" />
            <div class="input-group-btn">
              <button type="button" class="btn btn-primary2 btn-plus">
                <i class="fa fa-plus"></i>
              </button>
            </div>
          </div>

          <div class="d-flex align-items-center mb-4 pt-2 mt-3">





            <!-- Add to Cart Button -->
            @if($product->stock_status == 'out_of_stock')
            <span class="btn btn-primary2 px-3">
              <i class="fa fa-times-circle me-1"></i> Sold Out
            </span>
            @else
            <button type="submit" class="btn btn-primary2 px-3">
              <i class="fa fa-shopping-cart mr-1"></i>
            </button>
            @endif


            &nbsp;&nbsp;&nbsp;
            <a href="{{ route('customer.product.enquiry', [
       'mainSlug' => $product->subCategory->mainCategory->slug,
       'subSlug' => $product->subCategory->slug,
       'productSlug' => $product->slug
   ]) }}" class="btn btn-primary2 px-3">
              <i class="fa fa-info-circle mr-1"></i> Enquiry
            </a>

            &nbsp;&nbsp;&nbsp;
            <a href="{{ route('customer.product.customize', [
       'mainSlug' => $product->subCategory->mainCategory->slug,
       'subSlug' => $product->subCategory->slug,
       'productSlug' => $product->slug
   ]) }}" class="btn btn-primary2 px-3">
              <i class="fa fa-pen-to-square mr-1"></i> Customize
            </a>



          </div>

          <!-- others things -->
          <div class="d-flex pt-2">
            <strong class="text-dark mr-2">Share on:</strong>
            <div class="d-inline-flex">
              <a class="text-dark px-2" href="">
                <i class="fab fa-facebook-f"></i>
              </a>
              <a class="text-dark px-2" href="">
                <i class="fab fa-twitter"></i>
              </a>
              <a class="text-dark px-2" href="">
                <i class="fab fa-linkedin-in"></i>
              </a>
              <a class="text-dark px-2" href="">
                <i class="fab fa-pinterest"></i>
              </a>
            </div>
          </div>


        </div>

      </form>




    </div>
    <div class="row px-xl-5">
      <div class="col">
        <div class="bg-light p-30">
          <div class="nav nav-tabs mb-4">
            <a class="nav-item nav-link text-dark active" data-toggle="tab" href="#tab-pane-1">Description</a>
            <a class="nav-item nav-link text-dark" data-toggle="tab" href="#tab-pane-2">Information</a>
            <a class="nav-item nav-link text-dark" data-toggle="tab" href="#tab-pane-3">Size Chart</a>
          </div>
          <div class="tab-content">
            <div class="tab-pane fade show active" id="tab-pane-1">
              <h4 class="mb-3">Product Description</h4>
              <p>{{ $product->description }}</p>

            </div>
            <div class="tab-pane fade" id="tab-pane-2">
              <h4 class="mb-3">Additional Information</h4>
              <p>{{ $product->information }}</p>

            </div>
            <div class="tab-pane fade" id="tab-pane-3">
              <div class="row">
                <div class="col-md-6">
                  <h4 class="mb-4">Our Standard Size Chart</h4>

                  <img src="{{ asset('storage/' . $product->size_chart_image) }}" class="img-fluid" alt="Size Chart" />

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Shop Detail End -->

  <!-- Products Start -->
  <div class="container-fluid py-5">
    <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4">
      <span class="bg-secondary pr-3">You May Also Like</span>
    </h2>
    <div class="row px-xl-5">
      <div class="col">
        <div class="owl-carousel related-carousel">
          @foreach($allProducts as $product)
          @php
          $images = json_decode($product->images, true);
          $firstImage = isset($images[0]) ? str_replace('\/', '/', $images[0]) : null;
          @endphp
          <div class="product-item bg-org">
            <div class="product-img position-relative overflow-hidden">

              <a href="{{ route('customer.product-details', [
       'mainSlug' => $product->subCategory->mainCategory->slug,
       'subSlug' => $product->subCategory->slug,
       'productSlug' => $product->slug
   ]) }}">
                @if ($firstImage)
                <img class="img-fluid w-100" src="{{ asset('storage/' . $firstImage) }}" alt="" />
                @endif
              </a>

            </div>
            <div class="text-center py-4">
              <a class="h5 text-decoration-none text-white" href="{{ route('customer.product-details', [
       'mainSlug' => $product->subCategory->mainCategory->slug,
       'subSlug' => $product->subCategory->slug,
       'productSlug' => $product->slug
   ]) }}">{{$product->product_name}}</a>
              <div class="d-flex align-items-center justify-content-center mt-2">
                <h5 class="text-white">${{$product->selling_price}}</h5>
                <h6 class="text-blue ml-2"><del>${{$product->actual_price}}</del></h6>
              </div>
              <div class="d-flex align-items-center justify-content-center mb-1">
                <small class="fa fa-star text-white mr-1"></small>
                <small class="fa fa-star text-white mr-1"></small>
                <small class="fa fa-star text-white mr-1"></small>
                <small class="fa fa-star text-white mr-1"></small>
                <small class="fa fa-star text-white mr-1"></small>

              </div>

              <div class="product-actions mt-3" style="display: flex; justify-content: space-evenly; padding: 10px; gap: 30px;">

                <a class="btn btn-outline-dark btn-square" style="width: 100%;" href="{{ route('customer.product.customize', [
       'mainSlug' => $product->subCategory->mainCategory->slug,
       'subSlug' => $product->subCategory->slug,
       'productSlug' => $product->slug
   ]) }}"><i class="fa-solid fa-pen-to-square"></i></a>

                <a class="btn btn-outline-dark btn-square" style="width: 100%;" href="{{ route('customer.product-details', [
       'mainSlug' => $product->subCategory->mainCategory->slug,
       'subSlug' => $product->subCategory->slug,
       'productSlug' => $product->slug
   ]) }}"><i class="fa-solid fa-circle-info"></i></a>
              </div>
            </div>
          </div>
          @endforeach

        </div>
      </div>
    </div>
  </div>
  <!-- Products End -->


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




  @if (session('success'))
  <div id="successPopup" class="custom-success-popup">
    {{ session('success') }}
  </div>
  @endif

  @if (session('error'))
  <div id="errorPopup" class="custom-error-popup">
    {{ session('error') }}
  </div>
  @endif


  <!-- Back to Top -->
  <a href="#" class="btn btn-primary2 back-to-top"><i class="fa fa-angle-double-up"></i></a>


  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const successPopup = document.getElementById('successPopup');
      const errorPopup = document.getElementById('errorPopup');

      if (successPopup) setTimeout(() => successPopup.remove(), 4000);
      if (errorPopup) setTimeout(() => errorPopup.remove(), 4000);
    });
  </script>

  <!-- JavaScript Libraries -->
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>

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