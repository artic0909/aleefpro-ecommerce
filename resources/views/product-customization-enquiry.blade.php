<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>{{$product->product_name}} | Customization</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta content="Free HTML Templates" name="keywords" />
    <meta content="Free HTML Templates" name="description" />

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon" />

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet" />

    <link href="https://fonts.googleapis.com/css2?family=Roboto&family=Open+Sans&family=Lobster&family=Oswald&family=Montserrat&family=Raleway&family=Playfair+Display&family=Indie+Flower&family=Bebas+Neue&family=Pacifico&family=Dancing+Script&family=Great+Vibes&family=Permanent+Marker&family=Courier+Prime&family=Shadows+Into+Light&family=Amatic+SC&family=Caveat&family=Architects+Daughter&family=Anton&family=Baloo+2&family=Fredoka&family=Quicksand&family=Teko&family=Zilla+Slab&family=Yanone+Kaffeesatz&family=Rubik&family=Titillium+Web&family=Fira+Sans&family=Cabin&display=swap" rel="stylesheet">



    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css"
        integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('lib/animate/animate.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/serach-responsive.css') }}" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('./img/logo1.webp') }}" />



    <style>
        #logoTextPreview {
            position: absolute;
            top: 110px;
            /* adjust as needed */
            left: 180px;
            /* adjust as needed */
            width: 200px;
            /* set max width of text area */
            height: 100px;
            /* or auto, but fixed height helps with scaling */
            overflow: hidden;
            /* hide anything outside the box */
            text-overflow: ellipsis;
            /* optional for single line */
            word-wrap: break-word;
            /* allow wrapping */
            white-space: normal;
            /* allow multiple lines */
            border: 2px dashed orange;
            padding: 5px;
        }

        .cap-container {
            border: 1px solid #ccc;
            position: relative;
            margin-bottom: 20px;
            overflow: hidden;
            background-color: #f8f8f8;
        }

        .cap-container img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .logo-box {
            position: absolute;
            top: 200px;
            left: 200px;
            width: 100px;
            height: 60px;
            border: 2px dashed orange;
            touch-action: none;
            transform-origin: center center;
            z-index: 10;
        }

        .logo-box img {
            object-fit: contain;
            pointer-events: none;
            width: auto !important;
            height: auto !important;
            max-width: 100% !important;
            max-height: 100% !important;
            pointer-events: none;
            display: block;
            margin: auto;
        }

        .controls {
            margin-top: 20px;
        }

        #rotateHandle {
            width: 12px;
            height: 12px;
            background: orange;
            border-radius: 50%;
            position: absolute;
            top: -20px;
            left: 50%;
            transform: translateX(-50%);
            cursor: grab;
        }

        .radio-group {
            margin-bottom: 10px;
        }

        .hide-controls .logo-box {
            border: none !important;
        }

        .hide-controls #rotateHandle {
            display: none !important;
        }


        /* alert */
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


    <!-- Product Customize Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-6">
                <h5 class="section-title position-relative text-uppercase mb-3">
                    <span class="bg-secondary pr-3">Live View</span>
                </h5>
                <div class="bg-light p-30 mb-5">
                    <div class="" style="display: flex; justify-content: space-between; align-items: center;">
                        <h6 class="mb-3">Add Your Logo</h6>
                        <button class="btn" id="ssButton"><i class="fa-solid fa-download text-org"
                                style="font-size: 1.3rem;"></i>Download</button>
                    </div>
                    <small>Lorem ipsum dolor sit amet consectetur adipisicing elit. At
                        accusamus maxime fugiat sequi doloremque alias ut cum. Nobis,
                        beatae suscipit.</small>
                    <div class="border-bottom mt-3" id="screenShootArea">
                        <div class="cap-container" id="capWrapper">
                            <img id="capImage" src="{{ asset('storage/' . $product->front_customize) }}" class="img-fluid" alt="Cap" />
                            <div id="logoContainer" class="logo-box" data-x="0" data-y="0" data-angle="0" overflow="hidden">
                                <div id="rotateHandle" style="cursor: grab;"></div>
                                <img id="uploadedLogo" src="" alt="Logo Preview" />
                                <div id="textLogoPreview" style="position: absolute; display: none; font-size: 24px;">
                                    Sample
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <h5 class="section-title position-relative text-uppercase mb-3">
                    <span class="bg-secondary pr-3">Customization</span>
                </h5>
                <form action="{{route('customer.product.customize.send')}}" method="POST" enctype="multipart/form-data" class="bg-light p-30 mb-5">
                    @csrf

                    <h6 class="section-title position-relative text-uppercase mb-3">
                        <span class="bg-secondary pr-3">Choose Side</span>
                    </h6>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label><input type="radio" name="logo_placement" value="front" checked />
                                Front</label>
                        </div>

                        <div class="col-md-6 form-group">
                            <label><input type="radio" name="logo_placement" value="back" />
                                Back</label>
                        </div>
                    </div>

                    <h6 class="section-title position-relative text-uppercase mb-3">
                        <span class="bg-secondary pr-3">Logo Type</span>
                    </h6>

                    <div class="row">

                        <div class="col-md-6 form-group">
                            <label><input type="radio" name="logo_type" value="image" checked />
                                Add Logo</label>
                        </div>

                        <div class="col-md-6 form-group">
                            <label><input type="radio" name="logo_type" value="text" />
                                Add Text</label>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-12 form-group controls" id="logoInput">
                            <label for="logoInput">Upload Logo</label>
                            <input type="file" class="form-control" id="logoUploader" name="company_logo" accept="image/*" />
                            <small class="text-muted">Upload high quality logo</small>
                        </div>

                        <div class="col-md-12 form-group controls" id="textInput">
                            <label for="logoInput">Add Text</label>

                            <!-- Font Selector -->
                            <select name="font_name" id="fontSelector" class="form-control mb-3">
                                <option value="Roboto">Roboto</option>
                                <option value="Open Sans">Open Sans</option>
                                <option value="Lobster">Lobster</option>
                                <option value="Oswald">Oswald</option>
                                <option value="Montserrat">Montserrat</option>
                                <option value="Raleway">Raleway</option>
                                <option value="Playfair Display">Playfair Display</option>
                                <option value="Indie Flower">Indie Flower</option>
                                <option value="Bebas Neue">Bebas Neue</option>
                                <option value="Pacifico">Pacifico</option>
                                <option value="Dancing Script">Dancing Script</option>
                                <option value="Great Vibes">Great Vibes</option>
                                <option value="Permanent Marker">Permanent Marker</option>
                                <option value="Courier Prime">Courier Prime</option>
                                <option value="Shadows Into Light">Shadows Into Light</option>
                                <option value="Amatic SC">Amatic SC</option>
                                <option value="Caveat">Caveat</option>
                                <option value="Architects Daughter">Architects Daughter</option>
                                <option value="Anton">Anton</option>
                                <option value="Baloo 2">Baloo 2</option>
                                <option value="Fredoka">Fredoka</option>
                                <option value="Quicksand">Quicksand</option>
                                <option value="Teko">Teko</option>
                                <option value="Zilla Slab">Zilla Slab</option>
                                <option value="Yanone Kaffeesatz">Yanone Kaffeesatz</option>
                                <option value="Rubik">Rubik</option>
                                <option value="Titillium Web">Titillium Web</option>
                                <option value="Fira Sans">Fira Sans</option>
                                <option value="Cabin">Cabin</option>
                            </select>

                            <!-- Text input -->
                            <input type="text" class="form-control mb-3" name="company_text_logo" id="textInputField" placeholder="Enter Text Here" />

                            <!-- Color Picker -->
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Color</span>
                                </div>
                                <input type="color" class="form-control" name="company_text_color_code" id="colorPicker" value="#ff0000">
                            </div>

                            <!-- Font Size -->
                            <div class="form-group mb-3">
                                <label for="fontSizeSlider">Font Size</label>
                                <input type="range" class="form-control-range" id="fontSizeSlider" min="12" max="100" value="24">
                            </div>


                            <!-- Output -->
                            <div class="form-group">
                                <label for="output">Your Customize Output</label>
                                <div id="outputPreview" style="border: 1px solid #ccc; padding: 15px; font-size: 24px; text-transform: none;">
                                    <!-- Preview will show here -->
                                </div>
                            </div>
                        </div>

                    </div>

                    <hr>

                    <div class="row">

                        <div class="col-md-12 form-group controls">
                            <label for="product_customize_image">Upload Liveshoot</label>
                            <input type="file" class="form-control" id="product_customize_image" name="product_customize_image" accept="image/*" />
                            <small class="text-muted">Upload the dowloaded preview</small>
                        </div>


                        <div class="col-md-12 form-group">
                            <label>Print Quality</label>
                            <select name="print_quality" id="print_quality" class="form-control">
                                <option value="" selected>Select Print Quality</option>
                                <option value="print">Print</option>
                                <option value="embroidery">Embroidery</option>
                            </select>
                        </div>

                        <div class="col-md-12 form-group">
                            <!-- <label>Logo Size</label>
                            <p id="logo_size_instruction" style="color: red;"></p> -->

                            <!-- <div class="row">
                                <div class="col-md-12 form-group d-flex" style="align-items: center;">
                                    <input type="number" class="form-control" id="logo_width" placeholder="Width" required>
                                    &nbsp;&nbsp;X&nbsp;&nbsp;
                                    <input type="number" class="form-control" id="logo_height" placeholder="Height" required>
                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                    <select id="logo_height_unit" class="form-control">
                                        <option value="" selected>Select Unit</option required>
                                        <option value="cm">CM</option>
                                        <option value="inch">INCH</option>
                                        <option value="mm">MM</option>
                                        <option value="meter">METER</option>
                                        <option value="feet">FEET</option>
                                    </select>

                                    <input type="text" name="logo_size" id="showLogoSize" class="form-control">
                                </div>
                            </div> -->


                            <label>Logo Size</label>
                            <p id="logo_size_instruction" style="color: red;"></p>

                            <div class="row">
                                <div class="col-md-4 form-group">
                                    <input type="text" class="form-control" id="widthInput" placeholder="Width">
                                </div>
                                <div class="col-md-4 form-group">
                                    <input type="text" class="form-control" id="heightInput" placeholder="Height">
                                </div>
                                <div class="col-md-4 form-group">
                                    <select id="sizeUnit" class="form-control">
                                        <option value="" selected>Select Unit</option>
                                        <option value="cm">CM</option>
                                        <option value="inch">INCH</option>
                                        <option value="mm">MM</option>
                                        <option value="meter">METER</option>
                                        <option value="feet">FEET</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Readonly result -->
                            <div class="form-group">
                                <input type="text" name="logo_size" id="showLogoSize" class="form-control" readonly>
                            </div>

                        </div>



                        <div class="col-md-6 form-group">
                            <label>Product Name</label>
                            <input class="form-control" name="product_name" type="text" value="{{$product->product_name}}" readonly />
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Product Code</label>
                            <input class="form-control" name="product_code" type="text" value="{{$product->product_code}}" readonly />
                        </div>

                        <div class="col-md-6 form-group">
                            <label>Price</label>
                            <input class="form-control" name="price" type="text" value="{{$product->selling_price}}.00" readonly />
                        </div>

                        <div class="col-md-6 form-group">
                            <label>Main/Sub Category</label>
                            <input class="form-control" name="main_sub_category" type="text" value="{{$product->subCategory->mainCategory->main_category_name}} / {{ $product->subCategory->sub_category_name}}" readonly />
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
                            <input class="form-control" name="units" type="number" placeholder="Minimum 12 units" min="12" required />
                        </div>



                        <div class="col-md-6 form-group">
                            <label>Your Name</label>
                            <input class="form-control" name="customer_name" type="text" value="{{Auth::user()->name}}" />
                        </div>

                        <div class="col-md-6 form-group">
                            <label>Email</label>
                            <input class="form-control" name="customer_email" type="text" value="{{Auth::user()->email}}" />
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Mobile</label>
                            <input class="form-control" name="customer_mobile" type="text" value="{{Auth::user()->mobile}}" />
                        </div>
                        <div class="col-md-12 form-group">
                            <label>Address</label>
                            <textarea name="customer_address" id="" class="form-control" placeholder="Enter your full address" rows="3"></textarea>
                        </div>
                        <div class="col-md-12 form-group">
                            <label>Detail Enquiry</label>
                            <textarea name="detail_enquiry" id="" class="form-control" placeholder="Write your custom quote" rows="5"></textarea>
                        </div>

                        <div class="col-md-12">
                            <button id="submitButton" class="btn btn-block btn-primary2 font-weight-bold py-3">
                                Send Enquiry
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Product Customize End -->




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







    <script src="https://cdn.jsdelivr.net/npm/html2canvas@1.4.1/dist/html2canvas.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/interactjs/dist/interact.min.js"></script>

    <script>
        const capImage = document.getElementById("capImage");
        const logoContainer = document.getElementById("logoContainer");
        const uploadedLogo = document.getElementById("uploadedLogo");
        const textLogoPreview = document.getElementById("textLogoPreview");

        const companyTextLogoInput = document.querySelector("input[name='company_text_logo']");
        const colorPicker = document.querySelector("input[name='company_text_color_code']");
        const fontSelector = document.getElementById("fontSelector");
        const fontSizeSlider = document.getElementById("fontSizeSlider");

        // === Cap Side Toggle ===
        document.querySelectorAll("input[name='logo_placement']").forEach((radio) => {
            radio.addEventListener("change", function() {
                capImage.src = this.value === "front" ?
                    "{{ asset('storage/' . $product->front_customize) }}" :
                    "{{ asset('storage/' . $product->back_customize) }}";
            });
        });

        // === Logo Upload Preview ===
        document.getElementById("logoUploader").addEventListener("change", function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(evt) {
                    uploadedLogo.src = evt.target.result;
                    uploadedLogo.style.display = "block";
                    textLogoPreview.style.display = "none";
                };
                reader.readAsDataURL(file);
            }
        });

        // === Text Logo Realtime Preview ===
        function updateTextLogo() {
            const text = companyTextLogoInput.value;
            const font = fontSelector.value;
            const color = colorPicker.value;
            const size = fontSizeSlider.value;

            if (text.trim() === "") {
                textLogoPreview.style.display = "none";
                return;
            }

            textLogoPreview.textContent = text;
            textLogoPreview.style.fontFamily = font;
            textLogoPreview.style.color = color;
            textLogoPreview.style.fontSize = `${size}px`;

            textLogoPreview.style.display = "block";
            uploadedLogo.style.display = "none";
        }

        companyTextLogoInput.addEventListener("input", updateTextLogo);
        colorPicker.addEventListener("input", updateTextLogo);
        fontSelector.addEventListener("change", updateTextLogo);
        fontSizeSlider.addEventListener("input", updateTextLogo);

        // === Drag and Resize for logoContainer ===
        interact("#logoContainer")
            .draggable({
                modifiers: [
                    interact.modifiers.restrictRect({
                        restriction: "#capWrapper",
                        endOnly: true,
                    }),
                ],
                listeners: {
                    move(event) {
                        const target = event.target;
                        const x = (parseFloat(target.getAttribute("data-x")) || 0) + event.dx;
                        const y = (parseFloat(target.getAttribute("data-y")) || 0) + event.dy;
                        const angle = parseFloat(target.getAttribute("data-angle")) || 0;

                        target.style.transform = `translate(${x}px, ${y}px) rotate(${angle}deg)`;
                        target.setAttribute("data-x", x);
                        target.setAttribute("data-y", y);
                    },
                },
            })
            .resizable({
                edges: {
                    top: true,
                    left: true,
                    bottom: true,
                    right: true
                },
                listeners: {
                    move(event) {
                        const target = event.target;
                        let x = parseFloat(target.getAttribute("data-x")) || 0;
                        let y = parseFloat(target.getAttribute("data-y")) || 0;

                        target.style.width = `${event.rect.width}px`;
                        target.style.height = `${event.rect.height}px`;

                        x += event.deltaRect.left;
                        y += event.deltaRect.top;

                        const angle = parseFloat(target.getAttribute("data-angle")) || 0;
                        target.style.transform = `translate(${x}px, ${y}px) rotate(${angle}deg)`;
                        target.setAttribute("data-x", x);
                        target.setAttribute("data-y", y);
                    },
                },
                modifiers: [
                    interact.modifiers.restrictEdges({
                        outer: "#capWrapper"
                    }),
                    interact.modifiers.restrictSize({
                        min: {
                            width: 50,
                            height: 30
                        },
                        max: {
                            width: 300,
                            height: 300
                        },
                    }),
                ],
            });

        // === Rotation ===
        const rotateHandle = document.getElementById("rotateHandle");
        let rotating = false;

        rotateHandle.addEventListener("mousedown", (e) => {
            e.preventDefault();
            rotating = true;
        });

        document.addEventListener("mousemove", (e) => {
            if (!rotating) return;

            const rect = logoContainer.getBoundingClientRect();
            const centerX = rect.left + rect.width / 2;
            const centerY = rect.top + rect.height / 2;
            const angle = (Math.atan2(e.clientY - centerY, e.clientX - centerX) * 180) / Math.PI;

            logoContainer.setAttribute("data-angle", angle);
            const x = parseFloat(logoContainer.getAttribute("data-x")) || 0;
            const y = parseFloat(logoContainer.getAttribute("data-y")) || 0;

            logoContainer.style.transform = `translate(${x}px, ${y}px) rotate(${angle}deg)`;
        });

        document.addEventListener("mouseup", () => {
            rotating = false;
        });
    </script>



    <script>
        document.getElementById('ssButton').addEventListener('click', function() {
            const screenshotArea = document.getElementById('screenShootArea');
            const controls = document.querySelectorAll('.controls, #ssButton');

            // 1. Hide other controls
            controls.forEach(el => el.style.visibility = 'hidden');

            // 2. Add class to hide border and dot
            screenshotArea.classList.add('hide-controls');

            setTimeout(() => {
                html2canvas(screenshotArea, {
                    backgroundColor: null,
                    scale: 2
                }).then(canvas => {
                    // 3. Restore everything
                    controls.forEach(el => el.style.visibility = 'visible');
                    screenshotArea.classList.remove('hide-controls');

                    // 4. Trigger download
                    const link = document.createElement('a');
                    link.download = 'custom-logo-preview.png';
                    link.href = canvas.toDataURL('image/png');
                    link.click();
                });
            }, 100);
        });
    </script>


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




    <!-- hide / show -->
    <script>
        $(document).ready(function() {
            // Initially show logo section and hide text section
            $('#logoInput').show();
            $('#textInput').hide();

            // Handle radio button changes
            $('input[name="logo_type"]').on('change', function() {
                if ($(this).val() === 'image') {
                    $('#logoInput').show();
                    $('#textInput').hide();
                } else if ($(this).val() === 'text') {
                    $('#logoInput').hide();
                    $('#textInput').show();
                }
            });
        });
    </script>


    <script>
        $(document).ready(function() {
            function updatePreview() {
                const font = $('#fontSelector').val();
                const text = $('#textInputField').val();
                const color = $('#colorPicker').val();

                $('#outputPreview').text(text);
                $('#outputPreview').css({
                    'font-family': font,
                    'color': color
                });
            }

            // Bind change events
            $('#fontSelector').on('change', updatePreview);
            $('#textInputField').on('input', updatePreview);
            $('#colorPicker').on('input', updatePreview);

            // Initialize on page load
            updatePreview();
        });
    </script>


    <!-- Logo Size -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const placementRadios = document.querySelectorAll('input[name="logo_placement"]');
            const printQualitySelect = document.getElementById("print_quality");
            const logoInstruction = document.getElementById("logo_size_instruction");

            const widthInput = document.getElementById("widthInput");
            const heightInput = document.getElementById("heightInput");
            const sizeUnit = document.getElementById("sizeUnit");
            const showLogoSize = document.getElementById("showLogoSize");
            const submitButton = document.getElementById("submitButton");

            const alertMsg = document.createElement("p");
            alertMsg.style.color = "red";
            showLogoSize.parentNode.appendChild(alertMsg);

            // Max sizes in inches
            const maxSizes = {
                front: {
                    print: {
                        w: 3,
                        h: 3
                    },
                    embroidery: {
                        w: 2.5,
                        h: 2.5
                    }
                },
                back: {
                    print: {
                        w: 12,
                        h: 12
                    },
                    embroidery: {
                        w: 10,
                        h: 10
                    }
                }
            };

            let currentMax = {
                w: 0,
                h: 0
            };

            function updateInstruction() {
                const placement = document.querySelector('input[name="logo_placement"]:checked').value;
                const quality = printQualitySelect.value;

                if (placement && quality) {
                    currentMax = maxSizes[placement][quality];
                    logoInstruction.textContent = `Max sizes ${placement}: ${currentMax.w} X ${currentMax.h} Inch`;
                } else {
                    logoInstruction.textContent = "";
                    currentMax = {
                        w: 0,
                        h: 0
                    };
                }
                validateSize();
            }

            function convertToInches(value, unit) {
                const conversions = {
                    cm: value / 2.54,
                    inch: value,
                    mm: value / 25.4,
                    meter: value * 39.3701,
                    feet: value * 12
                };
                return conversions[unit] || 0;
            }

            function validateSize() {
                const widthVal = parseFloat(widthInput.value);
                const heightVal = parseFloat(heightInput.value);
                const unit = sizeUnit.value;

                if ((!widthVal && widthVal !== 0) || (!heightVal && heightVal !== 0) || !unit) {
                    showLogoSize.value = "";
                    alertMsg.textContent = "";
                    submitButton.disabled = false;
                    return;
                }

                const widthInches = convertToInches(widthVal, unit);
                const heightInches = convertToInches(heightVal, unit);

                showLogoSize.value = `${widthInches.toFixed(2)} X ${heightInches.toFixed(2)} Inch`;

                if (
                    currentMax.w &&
                    (widthInches > currentMax.w || heightInches > currentMax.h)
                ) {
                    alertMsg.textContent = `⚠️ Size exceeds max allowed: ${currentMax.w} X ${currentMax.h} Inch`;
                    submitButton.disabled = true;
                } else {
                    alertMsg.textContent = "";
                    submitButton.disabled = false;
                }
            }

            // Event listeners
            placementRadios.forEach(r => r.addEventListener("change", updateInstruction));
            printQualitySelect.addEventListener("change", updateInstruction);
            widthInput.addEventListener("input", validateSize);
            heightInput.addEventListener("input", validateSize);
            sizeUnit.addEventListener("change", validateSize);
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