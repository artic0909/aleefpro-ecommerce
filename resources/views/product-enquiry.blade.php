<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>{{$product->product_name}} | Product Enquiry</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

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

        @media (min-width: 992px) {
            #top-bar-desk {
                display: none !important;
            }
        }
    </style>
</head>

<body>
    <!-- Topbar Start -->
    <div class="container-fluid">
        <div class="row bg-secondary py-1 px-xl-5" id="top-bar-desk">
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
                    @foreach($abouts as $about)
                    <img src="{{ asset('storage/' . $about->header_logo) }}" class="img-fluid" width="55" alt="logo" />
                    @endforeach
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
                <h6 class="m-0">{{ $social->mobile }}</h6>
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
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="#">{{$product->subCategory->mainCategory->main_category_name}}</a>
                    <span class="breadcrumb-item active">{{$product->subCategory->sub_category_name}}</span>
                    <span class="breadcrumb-item active">{{$product->product_name}}</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->


    <!-- Product Enquiry Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-8">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Enquiry
                        Now</span></h5>
                <div class="bg-light p-30 mb-5">
                    <form action="{{ route('customer.product.enquiry.send') }}" method="POST" class="row">
                        @csrf

                        <div class="col-md-6 form-group">
                            <label>Product Name</label>
                            <input class="form-control" type="text" name="product_name" value="{{$product->product_name}}" readonly>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Product Code</label>
                            <input class="form-control" type="text" name="product_code" value="{{$product->product_code}}" readonly>
                        </div>

                        <div class="col-md-6 form-group">
                            <label>Price</label>
                            <input class="form-control" type="number" name="price" value="{{$product->selling_price}}" readonly>
                        </div>

                        <div class="col-md-6 form-group">
                            <label>Main/Sub Category</label>
                            <input class="form-control" type="text" name="main_sub_category" value="{{$product->subCategory->mainCategory->main_category_name}} / {{ $product->subCategory->sub_category_name}}" readonly>
                        </div>


                        @php
                        $productColors = explode(',', $product->colors);
                        $productSizes = explode(',', $product->sizes);
                        @endphp

                        <!-- Product Colors -->
                        <div class="col-md-6 form-group">
                            <label>Add Colors</label> <br>
                            @foreach ($productColors as $color)
                            <input class="mr-2 color-checkbox" type="checkbox" value="{{ $color }}" checked style="scale: 1.5;">
                            <label>{{ $color }}</label> <br>
                            @endforeach
                        </div>

                        <!-- Input with comma-separated Colors -->
                        <div class="col-md-6 form-group" style="display: none;">
                            <label>Add Colors</label> <br>
                            <input class="form-control" type="text" name="colors" id="colorsInput" placeholder="Enter colors(,)" value="{{ $product->colors }}">
                        </div>

                        <!-- Product Sizes -->
                        <div class="col-md-6 form-group">
                            <label>Add Sizes</label> <br>
                            @foreach ($productSizes as $size)
                            <input class="mr-2 size-checkbox" type="checkbox" value="{{ $size }}" checked style="scale: 1.5;">
                            <label>{{ $size }}</label> <br>
                            @endforeach
                        </div>

                        <!-- Input with comma-separated Sizes -->
                        <div class="col-md-6 form-group" style="display: none;">
                            <label>Add Sizes</label>
                            <input class="form-control" type="text" name="sizes" id="sizesInput" placeholder="Enter sizes(,)" value="{{ $product->sizes }}">
                        </div>

                        <div class="col-md-6 form-group">
                            <label>Required Units</label>
                            <input class="form-control" type="text" name="units" placeholder="Minimum 12 units" min="12" required>
                        </div>


                        <div class="col-md-6 form-group">
                            <label>Your Name</label>
                            <input class="form-control" name="customer_name" type="text" value="{{Auth::user()->name}}">
                        </div>

                        <div class="col-md-6 form-group">
                            <label>Email</label>
                            <input class="form-control" name="customer_email" type="text" value="{{Auth::user()->email}}">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Mobile</label>
                            <input class="form-control" type="text" name="customer_mobile" value="{{Auth::user()->mobile}}">
                        </div>
                        <div class="col-md-12 form-group">
                            <label>Address</label>
                            <textarea name="customer_address" id="" class="form-control" placeholder="Enter your full address"
                                rows="3"></textarea>
                        </div>
                        <div class="col-md-12 form-group">
                            <label>Detail Enquiry</label>
                            <textarea name="detail_enquiry" id="" class="form-control" placeholder="Write your custom quote"
                                rows="5"></textarea>

                        </div>
                        <div class="col-md-12">
                            <button class="btn btn-block btn-primary2 font-weight-bold py-3">Send Enquiry</button>
                        </div>
                    </form>
                </div>

            </div>
            <div class="col-lg-4">
                <h5 class="section-title position-relative text-uppercase mb-3"><span
                        class="bg-secondary pr-3">Criteria</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom">
                        <h6 class="mb-3">Products</h6>
                        <div class="d-flex justify-content-between">
                            <p>Minimum order 30 units</p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <p>Must describe your queries</p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <p>Must provide the full address</p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <p>Price of the product nagotiable</p>
                        </div>



                    </div>

                </div>
                <div class="mb-5">
                    <h5 class="section-title position-relative text-uppercase mb-3"><span
                            class="bg-secondary pr-3">Payment Accept</span></h5>
                    <div class="bg-light p-30">

                        <div class="form-group">
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" name="cash" id="">
                                <label class="custom-control-label" for="paypal">Cash</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" name="payment" id="">
                                <label class="custom-control-label" for="paypal">Paypal</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" name="payment" id="">
                                <label class="custom-control-label" for="directcheck">Direct Check</label>
                            </div>
                        </div>
                        <div class="form-group mb-4">
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" name="payment" id="">
                                <label class="custom-control-label" for="banktransfer">Bank Transfer</label>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Product Enquiry End -->



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
    <div class="container-fluid bg-blue text-secondary mt-5 pt-5">
        <div class="row px-xl-5 pt-5">
            <div class="col-lg-4 col-md-12 mb-5 pr-3 pr-xl-5">
                @foreach($abouts as $about)
                <img src="{{ asset('storage/' . $about->footer_logo) }}" class="img-fluid fade-edges" width="400" alt="logo" />
                @endforeach

                @foreach($socials as $social)
                <p class="mb-2 mt-2">
                    <i class="fa fa-map-marker-alt text-primary mr-3"></i>{{$social->address}}
                </p>
                <p class="mb-2">
                    <i class="fa fa-envelope text-primary mr-3"></i>{{$social->email}}
                </p>
                <p class="mb-0">
                    <i class="fa fa-phone text-primary mr-3"></i>{{$social->mobile}}
                </p>
                @endforeach
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
                            @foreach($socials as $social)
                            <a class="btn btn-primary2 btn-square mr-2" href="{{$social->twitter}}" target="_blank"><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-primary2 btn-square mr-2" href="{{$social->fb}}" target="_blank"><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-primary2 btn-square mr-2" href="{{$social->linkedin}}" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                            <a class="btn btn-primary2 btn-square" href="{{$social->insta}}" target="_blank"><i class="fab fa-instagram"></i></a>
                            @endforeach
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
    <a href="{{ route('catalogue.download', $catalogue->id) }}" target="_blank" class="btn btn-primary2 back-to-top1"><i class="fa fa-file"></i></a>



    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const successPopup = document.getElementById('successPopup');
            const errorPopup = document.getElementById('errorPopup');

            if (successPopup) setTimeout(() => successPopup.remove(), 4000);
            if (errorPopup) setTimeout(() => errorPopup.remove(), 4000);
        });
    </script>

    <!-- JavaScript to update input fields on checkbox change -->
    <script>
        function updateCheckedValues(className, inputId) {
            const checkboxes = document.querySelectorAll(`.${className}`);
            const selectedValues = [];
            checkboxes.forEach(cb => {
                if (cb.checked) selectedValues.push(cb.value);
            });
            document.getElementById(inputId).value = selectedValues.join(',');
        }

        // Add event listeners
        document.querySelectorAll('.color-checkbox').forEach(cb => {
            cb.addEventListener('change', () => updateCheckedValues('color-checkbox', 'colorsInput'));
        });

        document.querySelectorAll('.size-checkbox').forEach(cb => {
            cb.addEventListener('change', () => updateCheckedValues('size-checkbox', 'sizesInput'));
        });
    </script>


    <script>
        document.querySelector('form').addEventListener('submit', function(e) {
            const unitsInput = document.querySelector('[name="units"]');
            if (parseInt(unitsInput.value) < 12) {
                e.preventDefault(); // Stop form submission
                alert("Minimum units required is 12.");
            }
        });
    </script>




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