<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Allef Pro Admin Login</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="{{ asset('./Admin/vendors/feather/feather.css') }}">
  <link rel="stylesheet" href="{{ asset('./Admin/vendors/ti-icons/css/themify-icons.css') }}">
  <link rel="stylesheet" href="{{ asset('./Admin/vendors/css/vendor.bundle.base.css') }}">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="{{ asset('./Admin/css/vertical-layout-light/style.css') }}">
  <!-- endinject -->
  <link rel="shortcut icon" href="{{ asset('./img/logo1.webp') }}" />
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div class="brand-logo">
                <img src="{{asset('./img/logo1.jpg')}}" alt="logo" style="width:100%;">
              </div>
              <h4>Hello! let's start</h4>
              <h6 class="font-weight-light">Sign in to continue.</h6>


              <form class="pt-3" action="{{ route('admin.login.post') }}" method="POST">
                @csrf
                <div class="form-group">
                  <input type="email" class="form-control form-control-lg" id="email" name="email" placeholder="Email">
                </div>

                <div class="form-group">
                  <input type="password" class="form-control form-control-lg" id="password" name="password" placeholder="Password">
                </div>

                <p id="erroMsgShow" class="text-danger m-0 p-0">
                  @if ($errors->any())
                  {{ $errors->first() }}
                  @endif
                </p>

                <div class="mt-3">
                  <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" type="submit">SIGN IN</button>
                </div>


                <div class="text-center mt-4 font-weight-light">
                  No Account ? Don't Worry <a href="/admin/register" class="text-primary">Create</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
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
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="{{ asset('./Admin/js/off-canvas.js') }}"></script>
  <script src="{{ asset('./Admin/js/hoverable-collapse.js') }}"></script>
  <script src="{{ asset('./js/template.js') }}"></script>
  <script src="{{ asset('./js/settings.js') }}"></script>
  <script src="{{ asset('./js/todolist.js') }}"></script>
  <!-- endinject -->
</body>

</html>