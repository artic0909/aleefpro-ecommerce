<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Offers Add</title>
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
                        <a class="nav-link nav-active" href="/admin/offers-add">
                            <i class="icon-paper menu-icon active-color"></i>
                            <span class="menu-title active-color">Offers Add</span>
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
                        <a class="nav-link" href="/admin/products">
                            <i class="icon-paper menu-icon"></i>
                            <span class="menu-title">Products</span>
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
                                <h4 class="card-title">Offers Post</h4>

                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>SL</th>
                                                <th>Banners</th>
                                                <th>Offer Percentage</th>
                                                <th>Product Link</th>
                                                <th>Edit</th>
                                                <th>delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($offers as $offer)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td><img src="{{ asset('storage/' . $offer->image) }}" class="img-fluid" alt="" style="width: 110px; height: 50px; border-radius: 10px;"></td>
                                                <td>{{$offer->offer_percentage}}</td>
                                                <td><a href="{{$offer->offer_percentage}}" target="_black" class="btn btn-warning">Link</a></td>
                                                <td><button data-bs-toggle="modal" data-bs-target="#scrollEditModal{{ $offer->id }}" class="btn btn-success">Edit</button></td>
                                                <td><button data-bs-toggle="modal" data-bs-target="#scrollDeleteModal{{ $offer->id }}" class="btn btn-danger">Delete</button></td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                @php
                use App\Models\Offer;
                $offerCount = Offer::count();
                @endphp

                @if($offerCount < 2)
                    <a type="button" class="float-button" data-bs-toggle="modal" data-bs-target="#scrollAddModal">
                    ADD
                    </a>
                    @endif


                    <!-- Add Modal -->
                    <div class="modal fade" id="scrollAddModal" tabindex="-1" aria-labelledby="scrollAddModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <form action="{{route('admin.offer.store')}}" method="POST" class="modal-content" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-header">
                                    <h5 class="modal-title" id="scrollAddModalLabel">Add Offers</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div>
                                        <input type="file" name="image" id="image" class="form-control">
                                    </div>

                                    <div>
                                        <label for="offer_percentage" class="form-label">Add Offer<span class="text-danger">*</span></label>
                                        <input type="text" name="offer_percentage" id="offer_percentage" class="form-control" placeholder="Ex- 20%">
                                    </div>

                                    <div>
                                        <label for="link" class="form-label">Add Product Link<span class="text-danger">*</span></label>
                                        <input type="text" name="link" id="link" class="form-control">
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
                    @foreach($offers as $offer)
                    <div class="modal fade" id="scrollEditModal{{ $offer->id }}" tabindex="-1" aria-labelledby="scrollEditModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <form action="{{route('admin.offer.edit', $offer->id)}}" method="POST" class="modal-content" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-header">
                                    <h5 class="modal-title" id="scrollEditModalLabel{{ $offer->id }}">Edit Offers</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div>
                                        <img src="{{ asset('storage/' . $offer->image) }}" class="img-fluid" alt="" width="100%" style="border-radius: 10px; margin-bottom: 10px;">

                                        <input type="file" name="image" id="image" class="form-control">
                                    </div>

                                    <div>
                                        <label for="offer_percentage" class="form-label">Add Offer<span class="text-danger">*</span></label>
                                        <input type="text" name="offer_percentage" id="offer_percentage" class="form-control" value="{{$offer->offer_percentage}}">
                                    </div>

                                    <div>
                                        <label for="link" class="form-label">Add Product Link<span class="text-danger">*</span></label>
                                        <input type="text" name="link" id="link" class="form-control" value="{{$offer->link}}">
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
                    @foreach($offers as $offer)
                    <div class="modal fade" id="scrollDeleteModal{{ $offer->id }}" tabindex="-1" aria-labelledby="scrollDeleteModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <form action="{{route('admin.offer.delete', $offer->id)}}" method="POST" class="modal-content" enctype="multipart/form-data">
                                @csrf

                                <div class="modal-body">
                                    <div>
                                        <h2 class="text-danger">You want to this image?</h2>
                                        <img src="{{ asset('storage/' . $offer->image) }}" class="img-fluid" alt="" width="100%" style="border-radius: 10px; margin-top: 10px;">

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


                    <!-- content-wrapper ends -->
                    <!-- partial:partials/_footer.html -->
                    <footer class="footer">
                        <div class="d-sm-flex justify-content-center justify-content-sm-between">
                            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2024. Premium <a href="https://github.com/artic0909" target="_blank">Saklin admin template</a> - All rights reserved.</span>
                            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Easy-To-Use & made with <i class="ti-heart text-danger ml-1"></i></span>
                        </div>
                        <div class="d-sm-flex justify-content-center justify-content-sm-between">
                            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Distributed by <a href="https://github.com/artic0909" target="_blank">SaklinMustak</a></span>
                        </div>
                    </footer>
                    <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->

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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const successPopup = document.getElementById('successPopup');
            const errorPopup = document.getElementById('errorPopup');

            if (successPopup) setTimeout(() => successPopup.remove(), 4000);
            if (errorPopup) setTimeout(() => errorPopup.remove(), 4000);
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
</body>

</html>