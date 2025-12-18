<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Products</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('./Admin/vendors/feather/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('./Admin/vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('./Admin/vendors/css/vendor.bundle.base.css') }}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{ asset('Admin/vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('Admin/vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('Admin/js/select.dataTables.min.css') }}">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('./Admin/css/vertical-layout-light/style.css') }}">
    <!-- endinject -->
    <link rel="shortcut icon" href="{{ asset('./img/logo1.webp') }}" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <style>
        * {
            a {
                text-decoration: none !important;
            }
        }

        .image-preview {
            position: relative;
            width: 120px;
            height: 120px;
            margin-bottom: 10px;
        }

        .image-preview img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 8px;
            border: 1px solid #ddd;
        }

        .image-preview .remove-btn {
            position: absolute;
            top: -6px;
            right: -6px;
            background: red;
            color: white;
            border-radius: 50%;
            padding: 2px 6px;
            cursor: pointer;
            font-size: 14px;
            line-height: 1;
        }

        .selected-image-preview {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .selected-image-preview .img-wrapper {
            position: relative;
            width: 100px;
            height: 100px;
        }

        .selected-image-preview img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 8px;
            border: 1px solid #ddd;
        }

        .selected-image-preview .remove-btn {
            position: absolute;
            top: -6px;
            right: -6px;
            background: red;
            color: white;
            border-radius: 50%;
            padding: 2px 6px;
            cursor: pointer;
            font-size: 14px;
            line-height: 1;
        }


        .float-button {
            position: fixed;
            width: 60px;
            height: 60px;
            bottom: 20px;
            right: 20px;
            background-color: #fd7e14;
            /* Customize (orange used here) */
            color: white;
            font-size: 1.1rem;
            border-radius: 50%;
            text-align: center;
            /* font-size: 28px; */
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
            line-height: 60px;
            z-index: 999;
            transition: background 0.3s ease;
        }

        .float-button:hover {
            background-color: #e96500;
            text-decoration: none;
            color: white;
        }

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
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                <a class="navbar-brand brand-logo mr-5" href="/admin/dashboard" style="font-weight: 900;">ALEEF PRO</a>
                <a class="navbar-brand brand-logo-mini" href="/admin/dashboard"><img src="{{asset('./img/logo1.webp')}}" alt="logo" /></a>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
                <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                    <span class="icon-menu"></span>
                </button>
                <ul class="navbar-nav mr-lg-2">
                    <li class="nav-item nav-search d-none d-lg-block">
                        <div class="input-group">
                            <div class="input-group-prepend hover-cursor" id="navbar-search-icon">
                                <span class="input-group-text" id="search">
                                    <i class="icon-search"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control" id="navbar-search-input" placeholder="Search now" aria-label="search" aria-describedby="search">
                        </div>
                    </li>
                </ul>
                <ul class="navbar-nav navbar-nav-right">

                    <li class="nav-item nav-profile dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
                            <img src="{{asset('./img/logo1.webp')}}" alt="profile" />
                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">

                            <form method="POST" action="{{ route('admin.logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item">
                                    <i class="ti-power-off text-primary"></i>
                                    Logout
                                </button>
                            </form>
                        </div>
                    </li>

                </ul>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
                    <span class="icon-menu"></span>
                </button>
            </div>
        </nav>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">



            <!-- partial -->
            <!-- partial:partials/_sidebar.html -->
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link" href="/admin/dashboard">
                            <i class="icon-grid menu-icon"></i>
                            <span class="menu-title">Dashboard</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="/admin/scroll-banners">
                            <i class="icon-paper menu-icon"></i>
                            <span class="menu-title">Scroll Banners</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="/admin/offers-add">
                            <i class="icon-paper menu-icon"></i>
                            <span class="menu-title">Offers Add</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="/admin/orders">
                            <i class="icon-paper menu-icon"></i>
                            <span class="menu-title">Orders</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="/admin/colors">
                            <i class="icon-paper menu-icon"></i>
                            <span class="menu-title">Add Colors</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="/admin/sizes">
                            <i class="icon-paper menu-icon"></i>
                            <span class="menu-title">Add Sizes</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                            <i class="icon-layout menu-icon"></i>
                            <span class="menu-title">Categories</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="ui-basic">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link" href="/admin/main-category">Main Category</a></li>
                                <li class="nav-item"> <a class="nav-link" href="/admin/sub-category">Sub Category</a></li>
                            </ul>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link nav-active" href="/admin/products">
                            <i class="icon-paper menu-icon active-color"></i>
                            <span class="menu-title active-color">Products</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="/admin/blogs">
                            <i class="icon-paper menu-icon"></i>
                            <span class="menu-title">Blogs</span>
                        </a>
                    </li>



                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#form-elements" aria-expanded="false" aria-controls="form-elements">
                            <i class="icon-columns menu-icon"></i>
                            <span class="menu-title">Inquiry</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="form-elements">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"><a class="nav-link" href="/admin/contact-us/inquiry">Contact Us</a></li>
                                <li class="nav-item"><a class="nav-link" href="/admin/cart-inquiry">Cart Inquiry</a></li>
                                <li class="nav-item"><a class="nav-link" href="/admin/product-inquiry">Product Inquiry</a></li>
                                <li class="nav-item"><a class="nav-link" href="/admin/customization-inquiry">Custom Inquiry</a></li>
                            </ul>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="/admin/all-users">
                            <i class="icon-paper menu-icon"></i>
                            <span class="menu-title">Users</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="/admin/all-partners">
                            <i class="icon-paper menu-icon"></i>
                            <span class="menu-title">Partners</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#form-elements1" aria-expanded="false" aria-controls="form-elements1">
                            <i class="icon-columns menu-icon"></i>
                            <span class="menu-title">Company Details</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="form-elements1">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"><a class="nav-link" href="/admin/faq">FAQ</a></li>
                                <li class="nav-item"><a class="nav-link" href="/admin/about-us">About Us</a></li>
                                <li class="nav-item"><a class="nav-link" href="/admin/social-handels">Social Handels</a></li>
                            </ul>
                        </div>
                    </li>

                </ul>
            </nav>
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="card col-12">
                            <div class="card-body">
                                <h4 class="card-title">All Products</h4>

                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>SL</th>
                                                <th>Images</th>
                                                <th>Front Image</th>
                                                <th>Back Image</th>
                                                <th>Main Category Name</th>
                                                <th>Sub Category Name</th>
                                                <th>Product Name</th>
                                                <th>Product Code</th>
                                                <th>Sizes</th>
                                                <th>Colors</th>
                                                <th>Actual Price</th>
                                                <th>Selling Price</th>
                                                <th>Min Purchase</th>
                                                <th>Size Chart</th>
                                                <th>Stock Status</th>
                                                <th>Description</th>
                                                <th>Information</th>
                                                <th>Edit</th>
                                                <th>Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($products as $product)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>
                                                    @php
                                                    $images = json_decode($product->images);
                                                    @endphp

                                                    @if ($images && count($images) > 0)
                                                    <img src="{{ asset('storage/' . $images[0]) }}" class="img-fluid" alt="">
                                                    @else
                                                    <span>No image</span>
                                                    @endif
                                                </td>

                                                <td><img src="{{ asset('storage/' . $product->front_customize) }}" class="img-fluid" alt=""></td>
                                                <td><img src="{{ asset('storage/' . $product->back_customize) }}" class="img-fluid" alt=""></td>

                                                <td>{{$product->subCategory->mainCategory->main_category_name}}</td>
                                                <td>{{$product->subCategory->sub_category_name}}</td>
                                                <td>{{$product->product_name}}</td>
                                                <td>{{$product->product_code}}</td>
                                                <td>{{$product->sizes}}</td>
                                                <td>{{$product->colors}}</td>
                                                <td>{{$product->actual_price}}</td>
                                                <td>{{$product->selling_price}}</td>
                                                <td>{{$product->min_purchase}}</td>

                                                <td><img src="{{ asset('storage/' . $product->size_chart_image) }}" class="img-fluid" alt=""></td>

                                                <td>
                                                    <p class="m-0 badge 
    {{ $product->stock_status === 'stock' ? 'badge-success' : 'badge-danger' }}"
                                                        style="text-transform: capitalize;">
                                                        {{ str_replace('_', ' ', $product->stock_status) }}
                                                    </p>

                                                </td>

                                                <td><button data-bs-toggle="modal" data-bs-target="#scrollDescriptionModal{{ $product->id }}" class="btn btn-warning">Desccription</button></td>
                                                <td><button data-bs-toggle="modal" data-bs-target="#scrollInfoModal{{ $product->id }}" class="btn btn-info">Info</button></td>
                                                <td><button data-bs-toggle="modal" data-bs-target="#scrollEditModal{{$product->id}}" class="btn btn-success">Edit</button></td>
                                                <td><button data-bs-toggle="modal" data-bs-target="#scrollDeleteModal{{$product->id}}" class="btn btn-danger">Delete</button></td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>


                <a type="button" class="float-button" data-bs-toggle="modal" data-bs-target="#scrollAddModal">
                    ADD
                </a>



                <!-- Add Modal -->
                <div class="modal fade" id="scrollAddModal" tabindex="-1" aria-labelledby="scrollAddModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl modal-dialog-scrollable">
                        <form action="{{ route('admin.product.store') }}" method="POST" class="modal-content" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title" id="scrollAddModalLabel">Add Product</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">

                                <div class="mt-3">
                                    <label for="image" class="form-label">Product Images<span class="text-danger">*</span></label>
                                    <input type="file" name="images[]" id="images" class="form-control d-none" multiple required> <br>
                                    <button type="button" class="btn btn-outline-primary w-100" id="browseBtn">Choose Files</button> <br>
                                    <span id="fileNames" class="ms-2 text-muted"></span>
                                </div>

                                <div class="selected-image-preview mt-3"></div>



                                <div class="mt-3">
                                    <label for="front_customize" class="form-label">Customize Front Image<span class="text-danger">*</span></label>
                                    <input type="file" name="front_customize" id="front_customize" class="form-control" required>
                                </div>

                                <!-- Front Image Preview -->
                                <div class="mb-3 mt-3" id="front-preview-container"></div>

                                <div class="mt-3">
                                    <label for="back_customize" class="form-label">Customize Back Image<span class="text-danger">*</span></label>
                                    <input type="file" name="back_customize" id="back_customize" class="form-control" required>
                                </div>

                                <!-- Back Image Preview -->
                                <div class="mb-3 mt-3" id="back-preview-container"></div>

                                <div class="mt-3">
                                    <label for="main_category_name" class="form-label">Main Category<span class="text-danger">*</span></label>
                                    <select name="main_category_id" id="main_category_id" class="form-select">
                                        <!-- existing main category show here-->
                                        <option value="" selected>Select Main Category</option>

                                        <!-- normal main category drop down function like add product-->
                                        @foreach ($mainCategories as $mainCategory)
                                        <option value="{{ $mainCategory->id }}">{{ $mainCategory->main_category_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mt-3">
                                    <label for="sub_category_id" class="form-label">Sub Category<span class="text-danger">*</span></label>
                                    <select name="sub_category_id" id="sub_category_id" class="form-select">
                                        <!-- existing sub category show here-->
                                        <option value="" selected>Select Sub Category</option>

                                        <!-- normal sub category drop down function show using ajax like add product-->

                                    </select>
                                </div>

                                <div class="mt-3">
                                    <label for="product_name" class="form-label">Product Name<span class="text-danger">*</span></label>
                                    <input type="text" name="product_name" id="product_name" class="form-control" required>
                                </div>

                                <div class="mt-3">
                                    <label for="product_code" class="form-label">Product Code<span class="text-danger">*</span></label>
                                    <input type="text" name="product_code" id="product_code" class="form-control" required>
                                </div>

                                <div class="mt-3">
                                    <label class="form-label">Sizes<span class="text-danger">*</span></label> <br>
                                    @foreach ($sizes as $size)
                                    <input type="checkbox" class="size-checkbox" value="{{ $size->size }}" style="scale: 1.2;">&nbsp;
                                    <label class="form-label mr-2">{{ $size->size }}</label>
                                    @endforeach
                                </div>

                                <div class="mt-3" style="display: none;">
                                    <input type="text" name="sizes" id="sizes" class="form-control" placeholder="e.g. S,M,L" required>
                                </div>

                                <div class="mt-3">
                                    <label class="form-label">Colors<span class="text-danger">*</span></label> <br>
                                    @foreach ($colors as $color)
                                    <input type="radio" name="colorr" class="color-checkbox" value="{{ $color->color }}" style="scale: 1.2;">&nbsp;
                                    <label class="form-label mr-2">{{ $color->color }}</label>
                                    @endforeach
                                </div>

                                <div class="mt-3" style="display: none;">
                                    <input type="text" name="colors" id="colors" class="form-control" placeholder="e.g. Red,Blue,Green" required>
                                </div>

                                <div class="mt-3">
                                    <label for="actual_price" class="form-label">Actual Price<span class="text-danger">*</span></label>
                                    <input type="text" name="actual_price" id="actual_price" class="form-control" required>
                                </div>

                                <div class="mt-3">
                                    <label for="selling_price" class="form-label">Selling Price<span class="text-danger">*</span></label>
                                    <input type="text" name="selling_price" id="selling_price" class="form-control" required>
                                </div>

                                <div class="mt-3">
                                    <label for="min_purchase" class="form-label">Min Purchase<span class="text-danger">*</span></label>
                                    <input type="number" name="min_purchase" id="min_purchase" class="form-control" min="1" value="1" required>
                                </div>

                                <div class="mt-3">
                                    <label for="description" class="form-label">Description<span class="text-danger">*</span></label>
                                    <textarea name="description" id="description" class="form-control" rows="3" required></textarea>
                                </div>


                                <div class="mt-3">
                                    <label for="information" class="form-label">Information<span class="text-danger">*</span></label>
                                    <textarea name="information" id="information" class="form-control" rows="3" required></textarea>
                                </div>

                                <div class="mt-3">
                                    <label for="size_chart_image" class="form-label">Size Chart Image<span class="text-danger">*</span></label>
                                    <input type="file" name="size_chart_image" id="size_chart_image" class="form-control" required>
                                </div>



                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>



                <!-- Edit Modal -->
                @foreach ($products as $product)
                <div class="modal fade" id="scrollEditModal{{ $product->id }}" tabindex="-1" aria-labelledby="scrollEditModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl modal-dialog-scrollable">
                        <form id="form-{{ $product->id }}" action="{{ route('admin.product.update', $product->id) }}" method="POST" class="modal-content" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="deleted_images" id="deleted_images_{{ $product->id }}">

                            <div class="modal-header">
                                <h5 class="modal-title">Edit Product</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <div class="modal-body">

                                <div class="mt-3 mb-3">
                                    <label for="image" class="form-label">Stock Status Update<span class="text-danger">*</span></label>
                                    <select name="stock_status" class="form-control" id="">
                                        <option value="stock" {{ $product->stock_status == 'stock' ? 'selected' : '' }}>In Stock</option>
                                        <option value="out_of_stock" {{ $product->stock_status == 'out_of_stock' ? 'selected' : '' }}>Out Of Stock</option>
                                    </select>
                                </div>

                                <!-- Existing Images with Remove Button -->
                                <label for="existing-images-{{ $product->id }}" class="form-label">Existing images show below</label>
                                <div id="existing-images-{{ $product->id }}" class="d-flex flex-wrap gap-2">
                                    @php $images = json_decode($product->images); @endphp
                                    @if($images)
                                    @foreach($images as $img)
                                    <div class="position-relative edit-image-wrapper">
                                        <img src="{{ asset('storage/' . $img) }}" class="img-thumbnail" width="100" height="100">
                                        <button type="button" class="btn btn-sm btn-danger position-absolute top-0 end-0 remove-existing" data-image="{{ $img }}">×</button>
                                    </div>
                                    @endforeach
                                    @endif
                                </div>

                                <!-- Add More Images -->
                                <div class="mt-3">
                                    
                                    <label for="edit-images-{{ $product->id }}" class="form-label">Product Image<span class="text-danger">*</span></label>
                                    <input type="file" name="images[]" id="edit-images-{{ $product->id }}" class="form-control" multiple>
                                    <label for="edit-images-{{ $product->id }}" class="form-label">Newly added images show below</label>
                                    <div class="d-flex flex-wrap gap-2 mt-2" id="preview-new-{{ $product->id }}"></div>
                                </div>

                                <!-- Front Image -->
                                <div class="mt-3 mb-3">
                                    <label for="">Front Image<span class="text-danger">*</span></label>
                                    <input type="file" name="front_customize" id="front-input-{{ $product->id }}" class="form-control mt-2"> <br>
                                    <div class="position-relative d-inline-block" id="front-preview-wrapper-{{ $product->id }}">
                                        @if($product->front_customize)
                                        <img src="{{ asset('storage/' . $product->front_customize) }}" class="img-thumbnail" width="100">
                                        <button type="button" class="btn btn-sm btn-danger position-absolute top-0 end-0 remove-front">×</button>
                                        @endif
                                    </div>
                                </div>

                                <!-- Back Image -->
                                <div class="mt-3 mb-3">
                                    <label for="">Back Image<span class="text-danger">*</span></label>
                                    <input type="file" name="back_customize" id="back-input-{{ $product->id }}" class="form-control mt-2"> <br>
                                    <div class="position-relative d-inline-block" id="back-preview-wrapper-{{ $product->id }}">
                                        @if($product->back_customize)
                                        <img src="{{ asset('storage/' . $product->back_customize) }}" class="img-thumbnail" width="100">
                                        <button type="button" class="btn btn-sm btn-danger position-absolute top-0 end-0 remove-back">×</button>
                                        @endif
                                    </div>
                                </div>

                                <div class="mt-3">
                                    <label for="main_category_name" class="form-label">Main Category<span class="text-danger">*</span></label>
                                    <select name="main_category_id" class="form-select main-category-select" data-product-id="{{ $product->id }}">
                                        <option value="">Select Main Category</option>
                                        @foreach ($mainCategories as $mainCategory)
                                        <option value="{{ $mainCategory->id }}" {{ $mainCategory->id == $product->subCategory->main_category_id ? 'selected' : '' }}>
                                            {{ $mainCategory->main_category_name }}
                                        </option>
                                        @endforeach
                                    </select>


                                </div>

                                <div class="mt-3">
                                    <label for="sub_category_id" class="form-label">Sub Category<span class="text-danger">*</span></label>
                                    <select name="sub_category_id" id="sub_category_id_{{ $product->id }}" class="form-select sub-category-select">
                                        <option value="">Select Sub Category</option>
                                        @foreach ($subCategories as $subCategory)
                                        @if ($subCategory->main_category_id == $product->subCategory->main_category_id)
                                        <option value="{{ $subCategory->id }}" {{ $subCategory->id == $product->sub_category_id ? 'selected' : '' }}>
                                            {{ $subCategory->sub_category_name }}
                                        </option>
                                        @endif
                                        @endforeach
                                    </select>

                                </div>

                                <div class="mt-3">
                                    <label for="product_name" class="form-label">Product Name<span class="text-danger">*</span></label>
                                    <input type="text" name="product_name" id="product_name" class="form-control" value="{{ $product->product_name }}">
                                </div>

                                <div class="mt-3">
                                    <label for="product_code" class="form-label">Product Code<span class="text-danger">*</span></label>
                                    <input type="text" name="product_code" id="product_code" class="form-control" value="{{ $product->product_code }}">
                                </div>

                                <div class="mt-3">
                                    <label class="form-label">Sizes<span class="text-danger">*</span></label> <br>
                                    <!-- Sizes -->
                                    @php
                                    $selectedSizes = explode(',', $product->sizes);
                                    @endphp
                                    @foreach ($sizes as $size)
                                    <input type="checkbox"
                                        class="size-checkbox-{{ $product->id }}"
                                        value="{{ $size->size }}"
                                        style="scale: 1.2;"
                                        {{ in_array($size->size, $selectedSizes) ? 'checked' : '' }}>
                                    <label class="form-label mr-2">{{ $size->size }}</label>
                                    @endforeach
                                </div>


                                <div class="mt-3" style="display: none;">
                                    <label for="sizes" class="form-label">Sizes<span class="text-danger">*</span></label>
                                    <input type="text" name="sizes" id="sizes" class="form-control" value="{{ $product->sizes }}">
                                </div>

                                <div class="mt-3">
                                    <label class="form-label">Colors<span class="text-danger">*</span></label> <br>
                                    <!-- Colors -->
                                    @php
                                    $selectedColors = explode(',', $product->colors);
                                    @endphp
                                    @foreach ($colors as $color)
                                    <input type="radio" name="colorr"
                                        class="color-checkbox-{{ $product->id }}"
                                        value="{{ $color->color }}"
                                        style="scale: 1.2;"
                                        {{ in_array($color->color, $selectedColors) ? 'checked' : '' }}>
                                    <label class="form-label mr-2">{{ $color->color }}</label>
                                    @endforeach
                                </div>

                                <div class="mt-3" style="display: none;">
                                    <label for="colors" class="form-label">Colors<span class="text-danger">*</span></label>
                                    <input type="text" name="colors" id="colors" class="form-control" value="{{ $product->colors }}">
                                </div>

                                <div class="mt-3">
                                    <label for="actual_price" class="form-label">Actual Price<span class="text-danger">*</span></label>
                                    <input type="text" name="actual_price" id="actual_price" value="{{ $product->actual_price }}" class="form-control">
                                </div>

                                <div class="mt-3">
                                    <label for="selling_price" class="form-label">Selling Price<span class="text-danger">*</span></label>
                                    <input type="text" name="selling_price" id="selling_price" value="{{ $product->selling_price }}" class="form-control">
                                </div>

                                <div class="mt-3">
                                    <label for="min_purchase" class="form-label">Min Purchase<span class="text-danger">*</span></label>
                                    <input type="number" name="min_purchase" id="min_purchase" class="form-control" min="1" value="{{ $product->min_purchase }}">
                                </div>

                                <div class="mt-3">
                                    <label for="description" class="form-label">Description<span class="text-danger">*</span></label>
                                    <textarea name="description" id="description" class="form-control" rows="3">{{ $product->description }}</textarea>
                                </div>


                                <div class="mt-3">
                                    <label for="information" class="form-label">Information<span class="text-danger">*</span></label>
                                    <textarea name="information" id="information" class="form-control" rows="3">{{ $product->information }}</textarea>
                                </div>

                                <div class="mt-3">
                                    <img src="{{ asset('storage/' . $product->size_chart_image) }}" alt="" class="img-fluid" width="100" height="100">
                                </div>

                                <div class="mt-3">
                                    <label for="size_chart_image" class="form-label">Size Chart Image<span class="text-danger">*</span></label>
                                    <input type="file" name="size_chart_image" id="size_chart_image" class="form-control">
                                </div>



                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
                @endforeach

                <!-- Delete Modal -->
                @foreach ($products as $product)
                <div class="modal fade" id="scrollDeleteModal{{ $product->id }}" tabindex="-1" aria-labelledby="scrollDeleteModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <form action="{{route('admin.product.delete', $product->id)}}" method="POST" class="modal-content" enctype="multipart/form-data">
                            @csrf

                            <div class="modal-body">
                                <div>
                                    <h2 class="text-danger">You want to this Product?</h2>
                                    <h3>{{ $product->product_name }}</h3>

                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </div>
                        </form>
                    </div>
                </div>
                @endforeach

                <!-- Description Modal -->
                @foreach ($products as $product)
                <div class="modal fade" id="scrollDescriptionModal{{ $product->id }}" tabindex="-1" aria-labelledby="scrollDescriptionModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="scrollDescriptionModalLabel">Product Description</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div>
                                    <h4 class="text-danger">{{ $product->product_name}}</h4>
                                    <h5>Description: {{ $product->description }}</h5>

                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

                <!-- Information Modal -->
                @foreach ($products as $product)
                <div class="modal fade" id="scrollInfoModal{{ $product->id }}" tabindex="-1" aria-labelledby="scrollInfoModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="scrollInfoModalLabel">Product Information</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>

                            <div class="modal-body">
                                <div>
                                    <h4 class="text-danger">{{ $product->product_name}}</h4>
                                    <h5>Information: {{ $product->information }}</h5>

                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach




                <!-- content-wrapper ends -->
                <!-- partial:partials/_footer.html -->
                
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $('#main_category_id').on('change', function() {
            var mainCategoryId = $(this).val();
            $('#sub_category_id').empty().append('<option value="">Loading...</option>');

            if (mainCategoryId) {
                $.ajax({
                    url: "{{ route('getSubCategories') }}",
                    type: "GET",
                    data: {
                        main_category_id: mainCategoryId
                    },
                    success: function(response) {
                        $('#sub_category_id').empty().append('<option value="">Select Sub Category</option>');
                        $.each(response.subcategories, function(key, subcategory) {
                            $('#sub_category_id').append(
                                `<option value="${subcategory.id}">${subcategory.sub_category_name}</option>`
                            );
                        });
                    },
                    error: function() {
                        $('#sub_category_id').empty().append('<option value="">Error loading data</option>');
                    }
                });
            }
        });
    </script>


    <script>
        $(document).ready(function() {
            // EDIT MODAL: Subcategory update based on main category
            $('.main-category-select').on('change', function() {
                let mainCategoryId = $(this).val();
                let productId = $(this).data('product-id');
                let subCategorySelect = $('#sub_category_id_' + productId);

                subCategorySelect.empty().append('<option value="">Loading...</option>');

                if (mainCategoryId) {
                    $.ajax({
                        url: "{{ route('getSubCategories') }}",
                        type: "GET",
                        data: {
                            main_category_id: mainCategoryId
                        },
                        success: function(response) {
                            subCategorySelect.empty().append('<option value="">Select Sub Category</option>');
                            $.each(response.subcategories, function(key, subcategory) {
                                subCategorySelect.append(
                                    `<option value="${subcategory.id}">${subcategory.sub_category_name}</option>`
                                );
                            });
                        },
                        error: function() {
                            subCategorySelect.empty().append('<option value="">Error loading data</option>');
                        }
                    });
                }
            });
        });
    </script>

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

    @if ($errors->any())
    <div id="errorPopup" class="custom-error-popup">
        @foreach ($errors->all() as $error)
        <div>{{ $error }}</div>
        @endforeach
    </div>
    @endif

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const successPopup = document.getElementById('successPopup');
            const errorPopup = document.getElementById('errorPopup');

            if (successPopup) setTimeout(() => successPopup.remove(), 4000);
            if (errorPopup) setTimeout(() => errorPopup.remove(), 4000);
        });
    </script>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const checkboxes = document.querySelectorAll('.color-checkbox');
            const colorsInput = document.getElementById('colors');

            checkboxes.forEach(function(checkbox) {
                checkbox.addEventListener('change', function() {
                    const selectedColors = [];
                    checkboxes.forEach(function(cb) {
                        if (cb.checked) {
                            selectedColors.push(cb.value);
                        }
                    });
                    colorsInput.value = selectedColors.join(',');
                });
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const checkboxes = document.querySelectorAll('.size-checkbox');
            const colorsInput = document.getElementById('sizes');

            checkboxes.forEach(function(checkbox) {
                checkbox.addEventListener('change', function() {
                    const selectedColors = [];
                    checkboxes.forEach(function(cb) {
                        if (cb.checked) {
                            selectedColors.push(cb.value);
                        }
                    });
                    colorsInput.value = selectedColors.join(',');
                });
            });
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            @foreach($products as $product)
            // Sizes
            document.querySelectorAll('.size-checkbox-{{ $product->id }}').forEach(function(checkbox) {
                checkbox.addEventListener('change', function() {
                    const checkedValues = Array.from(document.querySelectorAll('.size-checkbox-{{ $product->id }}:checked'))
                        .map(cb => cb.value);
                    document.querySelector('#scrollEditModal{{ $product->id }} input[name="sizes"]').value = checkedValues.join(',');
                });
            });

            // Colors
            document.querySelectorAll('.color-checkbox-{{ $product->id }}').forEach(function(checkbox) {
                checkbox.addEventListener('change', function() {
                    const checkedValues = Array.from(document.querySelectorAll('.color-checkbox-{{ $product->id }}:checked'))
                        .map(cb => cb.value);
                    document.querySelector('#scrollEditModal{{ $product->id }} input[name="colors"]').value = checkedValues.join(',');
                });
            });
            @endforeach
        });
    </script>




    <!-- plugins:js -->
    <script src="{{ asset('./Admin/vendors/js/vendor.bundle.base.js') }}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="{{ asset('Admin/vendors/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('Admin/vendors/datatables.net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('Admin/vendors/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ asset('Admin/js/dataTables.select.min.js') }}"></script>

    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{ asset('./Admin/js/off-canvas.js') }}"></script>
    <script src="{{ asset('./Admin/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('./js/template.js') }}"></script>
    <script src="{{ asset('./js/settings.js') }}"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="{{ asset('Admin/js/dashboard.js') }}"></script>
    <script src="{{ asset('Admin/js/Chart.roundedBarCharts.js') }}"></script>



    <!-- Product Image Show JS -->


    <script>
        // Front Customize Preview
        const frontInput = document.getElementById('front_customize');
        const frontPreviewContainer = document.getElementById('front-preview-container');

        frontInput.addEventListener('change', function() {
            showSinglePreview(this, frontPreviewContainer);
        });

        // Back Customize Preview
        const backInput = document.getElementById('back_customize');
        const backPreviewContainer = document.getElementById('back-preview-container');

        backInput.addEventListener('change', function() {
            showSinglePreview(this, backPreviewContainer);
        });

        // Reusable function for single preview
        function showSinglePreview(input, container) {
            container.innerHTML = ""; // Clear old preview
            const file = input.files[0];
            if (!file) return;

            const reader = new FileReader();
            reader.onload = function(e) {
                const wrapper = document.createElement('div');
                wrapper.className = "image-preview";

                const img = document.createElement('img');
                img.src = e.target.result;

                const removeBtn = document.createElement('span');
                removeBtn.innerHTML = "×";
                removeBtn.className = "remove-btn";

                // On remove, clear everything
                removeBtn.onclick = () => {
                    container.innerHTML = "";
                    input.value = "";
                };

                wrapper.appendChild(img);
                wrapper.appendChild(removeBtn);
                container.appendChild(wrapper);
            };
            reader.readAsDataURL(file);
        }
    </script>

    <!-- Add Modal -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let imagesInput = document.getElementById('images');
            let browseBtn = document.getElementById('browseBtn');
            let fileNames = document.getElementById('fileNames');
            const previewContainer = document.querySelector('.selected-image-preview');

            let selectedFiles = [];

            // Open file dialog
            browseBtn.addEventListener('click', () => imagesInput.click());

            // Handle file selection
            imagesInput.addEventListener('change', function(e) {
                const files = Array.from(e.target.files);
                selectedFiles = [...selectedFiles, ...files]; // keep files in array
                updateFileNames();
                renderPreviews();
                // do NOT clear imagesInput.value here
            });

            function updateFileNames() {
                fileNames.textContent = selectedFiles.length > 0 ?
                    selectedFiles.map(f => f.name).join(", ") :
                    "No file chosen";
            }

            function renderPreviews() {
                previewContainer.innerHTML = "";
                previewContainer.style.display = "flex";
                previewContainer.style.flexWrap = "wrap";
                previewContainer.style.gap = "10px";

                selectedFiles.forEach((file, index) => {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const wrapper = document.createElement('div');
                        wrapper.classList.add('position-relative');
                        wrapper.style.width = "120px";
                        wrapper.style.height = "120px";

                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.classList.add('img-thumbnail');
                        img.style.width = "100%";
                        img.style.height = "100%";
                        img.style.objectFit = "cover";

                        const removeBtn = document.createElement('span');
                        removeBtn.innerHTML = "×";
                        removeBtn.classList.add('position-absolute', 'top-0', 'end-0', 'bg-danger', 'text-white', 'px-2', 'rounded');
                        removeBtn.style.cursor = "pointer";

                        removeBtn.addEventListener('click', () => {
                            selectedFiles.splice(index, 1);
                            updateFileNames();
                            renderPreviews();
                        });

                        wrapper.appendChild(img);
                        wrapper.appendChild(removeBtn);
                        previewContainer.appendChild(wrapper);
                    };
                    reader.readAsDataURL(file);
                });
            }

            // On submit attach files before sending
            const form = document.querySelector('#scrollAddModal form');
            form.addEventListener('submit', function(e) {
                if (selectedFiles.length === 0) {
                    alert("Please select at least one product image!");
                    e.preventDefault();
                    return;
                }

                const dataTransfer = new DataTransfer();
                selectedFiles.forEach(file => dataTransfer.items.add(file));
                imagesInput.files = dataTransfer.files; // re-attach files here
            });
        });
    </script>

    <!-- Edit Modal -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            @foreach($products as $product)
                (function() {
                    let deletedImages = [];
                    let productId = "{{ $product->id }}";
                    let deletedInput = document.getElementById("deleted_images_" + productId);

                    // Remove existing images
                    document.querySelectorAll("#existing-images-" + productId + " .remove-existing").forEach(btn => {
                        btn.addEventListener("click", function() {
                            let wrapper = this.closest(".edit-image-wrapper");
                            let image = this.dataset.image;
                            deletedImages.push(image);
                            deletedInput.value = JSON.stringify(deletedImages);
                            wrapper.remove();
                        });
                    });

                    // New images preview
                    let newImagesInput = document.getElementById("edit-images-" + productId);
                    let previewContainer = document.getElementById("preview-new-" + productId);
                    newImagesInput.addEventListener("change", function() {
                        previewContainer.innerHTML = "";
                        Array.from(this.files).forEach(file => {
                            let reader = new FileReader();
                            reader.onload = e => {
                                let div = document.createElement("div");
                                div.classList.add("position-relative");
                                div.style.width = "100px";
                                div.style.height = "100px";
                                div.innerHTML = `<img src="${e.target.result}" class="img-thumbnail" style="width:100%;height:100%">
                                     <button type="button" class="btn btn-sm btn-danger position-absolute top-0 end-0">×</button>`;
                                previewContainer.appendChild(div);

                                div.querySelector("button").addEventListener("click", () => div.remove());
                            };
                            reader.readAsDataURL(file);
                        });
                    });

                    // Front image replace
                    let frontInput = document.getElementById("front-input-" + productId);
                    let frontWrapper = document.getElementById("front-preview-wrapper-" + productId);
                    if (frontWrapper.querySelector(".remove-front")) {
                        frontWrapper.querySelector(".remove-front").addEventListener("click", () => {
                            frontWrapper.innerHTML = "";
                        });
                    }
                    frontInput.addEventListener("change", function() {
                        frontWrapper.innerHTML = "";
                        let file = this.files[0];
                        if (file) {
                            let reader = new FileReader();
                            reader.onload = e => {
                                frontWrapper.innerHTML = `<div class="position-relative"><img src="${e.target.result}" class="img-thumbnail" width="100">
                                               <button type="button" class="btn btn-sm btn-danger position-absolute top-0 end-0">×</button></div>`;
                                frontWrapper.querySelector("button").addEventListener("click", () => {
                                    frontWrapper.innerHTML = "";
                                    frontInput.value = "";
                                });
                            };
                            reader.readAsDataURL(file);
                        }
                    });

                    // Back image replace
                    let backInput = document.getElementById("back-input-" + productId);
                    let backWrapper = document.getElementById("back-preview-wrapper-" + productId);
                    if (backWrapper.querySelector(".remove-back")) {
                        backWrapper.querySelector(".remove-back").addEventListener("click", () => {
                            backWrapper.innerHTML = "";
                        });
                    }
                    backInput.addEventListener("change", function() {
                        backWrapper.innerHTML = "";
                        let file = this.files[0];
                        if (file) {
                            let reader = new FileReader();
                            reader.onload = e => {
                                backWrapper.innerHTML = `<div class="position-relative"><img src="${e.target.result}" class="img-thumbnail" width="100">
                                              <button type="button" class="btn btn-sm btn-danger position-absolute top-0 end-0">×</button></div>`;
                                backWrapper.querySelector("button").addEventListener("click", () => {
                                    backWrapper.innerHTML = "";
                                    backInput.value = "";
                                });
                            };
                            reader.readAsDataURL(file);
                        }
                    });

                })();
            @endforeach
        });
    </script>






</body>

</html>