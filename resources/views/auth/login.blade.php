<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>LOGIN</title>
  <link rel="shortcut icon" type="image/png" href="assets/images/logo.png')}}" />
  <link rel="stylesheet" href="{{asset('user5/css/styles.min.css')}}" />
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <div
      class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
      <div class="d-flex align-items-center justify-content-center w-100">
        <div class="row justify-content-center w-100">
          <div class="col-md-8 col-lg-6 col-xxl-3">
            <div class="card mb-0">
              <div class="card-body">
                <a href="#" class="text-nowrap logo-img text-center d-block py-3 w-100">
                  <div class="d-flex align-items-center justify-content-center">
                  <!-- <img src="assets/images/logo.png" width="60" alt=""> -->
                  <h5 class="ms-2 fw-bold">BUBIN CATERING</h5>
                  </div>
                 
                </a>
                <p class="text-center">Silahkan Login Terlebih Dahulu</p>
                <form method="POST" action="{{ route('login') }}" >
                @csrf
                  <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Masukkan email">
                  </div>
                  <div class="mb-4">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder=" masukkan Password">
                  </div>
                  <div class="d-flex align-items-center justify-content-between mb-4">
                    
                  </div>
                  <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">Login</button>
                 
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="{{asset('user5/libs/jquery/dist/jquery.min.js')}}"></script>
  <script src="{{asset('user5/libs/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
</body>

</html>