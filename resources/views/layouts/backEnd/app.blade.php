<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  @php
    $setting = \App\Models\Setting::orderBy('id','desc')->first();
  @endphp
  <link rel="icon" type="image/png" href="{{ asset('upload/'.$setting->favicon) }}">

  <title>@yield('title')</title>

  <!-- Custom fonts for this template-->
  <link href="{{ asset('backEnd/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">

  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="{{ asset('backEnd/css/sb-admin-2.min.css') }}" rel="stylesheet">

  <!-- DataTable -->
  <link href="{{ asset('backEnd/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

  <!-- Select2 -->
  <link rel="stylesheet" href="{{ asset('backEnd/plugins/select2/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('backEnd/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">

  <!-- success alert -->
  <link href="{{ asset('css/iziToast.css') }}" rel="stylesheet">

  <!-- writting style -->
  <link rel="stylesheet" href="{{ asset('backEnd/css/summernote-bs4.min.css') }}">

  <!-- date picker -->
  <link href="{{ asset('backEnd/css/jquery-ui.css') }}" rel="stylesheet">

  <!-- custom css -->
  <link href="{{ asset('backEnd/css/custom.css') }}" rel="stylesheet">

  @stack('css')
</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">
  	@include('layouts.backEnd.partials.sidebar')
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
      <!-- Main Content -->
      <div id="content">
      	@include('layouts.backEnd.partials.header')
      	@yield('content')
      </div>
      <!-- End of Main Content -->
      	@include('layouts.backEnd.partials.footer')
    </div>
    <!-- End of Content Wrapper -->
  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Bootstrap core JavaScript-->
  <script src="{{ asset('backEnd/js/jquery-3.6.0.min.js') }}"></script>
  <script src="{{ asset('backEnd/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

  <!-- Core plugin JavaScript-->
  <script src="{{ asset('backEnd/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

  <!-- Custom scripts for all pages-->
  <script src="{{ asset('backEnd/js/sb-admin-2.min.js') }}"></script>

  <!-- Data Table -->
  <script src="{{ asset('backEnd/vendor/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('backEnd/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('backEnd/js/demo/datatables-demo.js') }}"></script>

  <!-- sweetalert2  delete-->
  <script type="text/javascript" src="{{ asset('backEnd/js/sweetalert2@11.js') }}"></script>
  <script type="text/javascript" src="{{ asset('backEnd/js/customSweetalert2.js') }}"></script>

  <!-- success alert -->
  <script type="text/javascript" src="{{ asset('backEnd/js/iziToast.js') }}"></script>

  <!-- writting style -->
  <script src="{{ asset('backEnd/js/summernote-bs4.min.js') }}"></script>

  <!-- Select2 -->
  <script src="{{ asset('backEnd/plugins/select2/js/select2.full.min.js') }}"></script>

  <script>
    //image section
    $(document).ready(function(){
      $('#image').on('change',function(e){
        var reader = new FileReader();
        reader.onload = function(e){
          $('#showImage').attr('src',e.target.result);
        }
        reader.readAsDataURL(e.target.files['0']);
      });

      $('#banner').on('change',function(e){
        var reader = new FileReader();
        reader.onload = function(e){
          $('#showBanner').attr('src',e.target.result);
        }
        reader.readAsDataURL(e.target.files['0']);
      });
    });

    $(function () {
      //Initialize Select2 Elements
      $('.select2').select2()

      //Initialize Select2 Elements
      $('.select2bs4').select2({
        theme: 'bootstrap4'
      })

    });

    //date picker
    $( function() {
      $(".datepicker" ).datepicker({
        dateFormat: "yy-mm-dd"
      });
    } );

    //summer note
    $('.summernote').summernote({
      tabsize: 2,
      height: 300
    });

    $('.summernote2').summernote({
      tabsize: 2,
      height: 200
    });



  </script>

  @stack('js')
  @include('vendor.lara-izitoast.toast')

  @if ($errors->any())
        @foreach ($errors->all() as $error)
            <script>
                iziToast.error({
                    title: '',
                    position: 'topRight',
                    message: '{{ $error }}',
                });
            </script>
        @endforeach
    @endif

    @if(session()->get('error'))
        <script>
            iziToast.error({
                title: '',
                position: 'topRight',
                message: '{{ session()->get("error") }}',
            });
        </script>
    @endif

</body>

</html>
