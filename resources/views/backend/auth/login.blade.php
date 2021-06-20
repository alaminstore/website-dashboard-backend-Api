<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
      <title>Antopolis</title>
      <meta content="Admin Dashboard" name="description" />
      <meta content="Themesbrand" name="author" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <!-- App css -->
      <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
      <link href="{{asset('assets/css/icons.css')}}" rel="stylesheet" type="text/css" />
      <link href="{{asset('assets/css/style.css')}}" rel="stylesheet" type="text/css" />
      <style>
          p {
                margin-bottom: 0rem!important;
            }
      </style>
   </head>
   <body>
      <!-- Loader -->
      {{--
      <div id="preloader">
         <div id="status">
            <div class="spinner"></div>
         </div>
      </div>
      --}}
      <!-- Begin page -->
      <div class="accountbg"></div>
      <div class="wrapper-page">
         <div class="card">
            <div class="card-body">
               <h3 class="text-center m-0">
                  <a href="index.html" class="logo logo-admin border" style="border-radius: 50%;"><img src="{{asset('assets/images/users/avatar-1.jpg')}}" height="60" alt="logo"></a>
               </h3>
               <div class="p-3">
                  <h4 class="text-muted font-18 m-b-5 text-center">Welcome To Antopolis Login Page !</h4>
                  <p class="text-muted text-center">Sign in to continue to Dashboard.</p>
                  <form class="form-horizontal m-t-30" action="{{ route('auth.check') }}" method="post">
                     @if(Session::get('fail'))
                     <div class="alert alert-danger">
                        <p class="text-center">{{ Session::get('fail') }}</p>
                     </div>
                     @elseif (Session::get('unauthorized'))
                     <p class="text-center">{{ Session::get('unauthorized') }}</p>
                     @endif
                     @csrf
                     {{-- <div class="form-group">
                        <label>Email</label>
                        <input type="text" class="form-control" name="email" placeholder="Enter email address" value="{{ old('email') }}">
                        <span class="text-danger">@error('email'){{ $message }} @enderror</span>
                     </div>
                     <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Enter password">
                        <span class="text-danger">@error('password'){{ $message }} @enderror</span>
                     </div> --}}

                     <div class="form-group">
                        <label for="username">Email</label>
                        <input type="text" class="form-control" id="email" name="email" placeholder="Enter email" required>
                        <span class="text-danger">@error('email'){{ $message }} @enderror</span>
                    </div>

                    <div class="form-group">
                        <label for="userpassword">Password</label>
                        <input type="password" class="form-control" id="userpassword" name="password" placeholder="Enter password" required>
                        <span class="text-danger">@error('password'){{ $message }} @enderror</span>
                    </div>
                     <div class="form-group row m-t-20">
                        <div class="col-sm-6">
                           {{-- <div class="custom-control custom-checkbox">
                              <input type="checkbox" class="custom-control-input" id="customControlInline">
                              <label class="custom-control-label" for="customControlInline">Remember me</label>
                           </div> --}}
                        </div>
                        <div class="col-sm-6 text-right">
                           <button type="submit" class="btn btn-primary w-md waves-effect waves-light" >Log In</button>
                        </div>
                     </div>
                     <br>
                  </form>
               </div>
            </div>
         </div>
         <div class="m-t-40 text-center">
            <p>© 2021 ANTOPOLIS</p>
         </div>
      </div>
      <!-- jQuery  -->
      <script src="{{asset('assets/js/jquery.min.js')}}"></script>
      <script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
      <script src="{{asset('assets/js/modernizr.min.js')}}"></script>
      <script src="{{asset('assets/js/jquery.min.js')}}"></script>
      <script src="{{asset('assets/js/jquery.nicescroll.js')}}"></script>
      <script src="{{asset('assets/js/jquery.scrollTo.min.js')}}"></script>
      <!-- Parsley js -->
      <script src="{{asset('assets/plugins/parsleyjs/parsley.min.js')}}"></script>
      <script src="{{asset('assets/js/jquery-toast-plugin/jquery.toast.min.js')}}"></script>
      <script>
         $(document).ready(function() {
             $('form').parsley();
         });
      </script>
      <script type="text/javascript">
         $(document).ajaxStart(function () {
             $("#overlay").show();
         });
         $(document).ajaxComplete(function () {
             $("#overlay").hide();
         });
         @if(Session::has('message'))
         var type = "{{ Session::get('alert-type', 'info') }}";
         switch (type) {
             case 'info':
                 toastr.info("{{ Session::get('message') }}");
                 break;

             case 'warning':
                 toastr.warning("{{ Session::get('message') }}");
                 break;
             case 'success':
                 toastr.success("{{ Session::get('message') }}");
                 break;
             case 'error':
                 toastr.error("{{ Session::get('message') }}");
                 break;
         }
         @endif
         @if(count($errors) > 0)
         @foreach($errors->all() as $error)
         toastr.error("{{ $error }}");
         @endforeach
         @endif
      </script>
   </body>
</html>
