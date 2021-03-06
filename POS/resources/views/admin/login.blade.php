<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Admin Login </title>

    <!-- Bootstrap -->
    <link href="{{asset('assets/admin/vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{asset('assets/admin/vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
   
    <!-- Custom Theme Style -->
    <link href="{{asset('assets/admin/build/css/custom.min.css')}}" rel="stylesheet">
  </head>

  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form action="{{url('adminLogin')}}" method="POST">
              @csrf
              <h1>Login Form</h1>
              <div>
                <input type="email" class="form-control" placeholder="Email address" required="required" name="email" />
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Password" required="required" name="password" />
              </div>
              @if(session()->has('error'))
                <div class="alert alert-danger alert-dismissible " role="alert">
                    {{session('error')}}
                  </div>
              @endif
              <div>
                <button type="submit" class="btn btn-primary">Log in</button>
                <a class="reset_pass" href="javascript:void(0)">Lost your password?</a>
              </div>
              <div class="clearfix"></div>

            </form>
          </section>
        </div>

        
      </div>
    </div>
  </body>
</html>
