<html>

<head>
  <title>Login</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
  <link href='https://fonts.googleapis.com/css?family=Forum&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/user/css/login.css') }}">
  <link rel="icon" href="{{ asset('user/img/core-img/atomic.png') }}">
</head>

<body>
  <div class="card-container">
    <div class="toggle"><i class="fa fa-user fa-pencil fa-lg"></i>
      <div class="tooltip">Sign up</div>
    </div>
    <div class="card login-register login-reset">
    @if (session('status'))
      <div class="alert alert-success" role="alert">
        {{ session('status') }}
      </div>
    @endif
      <h1 class="title">Login</h1>
      <form method="POST" action="{{ route('login') }}">
          @csrf
        <div class="input-container has-feedback">
          <input type="email" id="email" name="email" required autocomplete="off" class="@error('email') is-invalid @enderror" value="{{ old('email') }}" />
          <label for="Username">Email</label>
          @error('email')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
          @enderror
          <i class="fa fa-user form-control-feedback"></i>
          <div class="check"></div>
          <div class="bar"></div>
        </div>
        <div class="input-container has-feedback">
          <input type="password" id="password" name="password" required autocomplete="off" class="@error('password') is-invalid @enderror" value="{{ old('password') }}" />
          <label for="Password">Password</label>
          @error('password')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
          @enderror
          <i class="fa fa-lock form-control-feedback"></i>
          <div class="check"></div>
          <div class="bar"></div>
        </div>
        <div class="checkbox">
          <label>
            <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
            <span class="cr"><i class="cr-icon fa fa-rocket"></i></span>
            Remember me
          </label>
        </div>
        <div class="button-container">
          <!-- <button class="rkmd-btn btn-lightBlue ripple-effect float-right"><span>Sign in</span></button> -->
          <input type="submit" class="rkmd-btn btn-lightBlue ripple-effect float-right" value="{{ __('Login') }}">
        </div>
        <!-- @if (Route::has('password.request')) -->
        <div class="footer"><a href="javascript:void(0)">Forgot your password?</a></div>
        <!-- @endif -->
      </form>
    </div>
    <div class="card login-register">
      <h1 class="title">Create an account</h1>
      <form method="POST" action="{{ route('register') }}">
      @csrf
        <div class="input-container has-feedback">
          <input type="text" id="Username" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" name="name" required autocomplete="off" />
          <label for="Username">Nama</label>
          <i class="fa fa-user form-control-feedback"></i>
          @error('name')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
          @enderror
          <div class="check"></div>
          <div class="bar"></div>
        </div>
        <div class="input-container has-feedback">
          <input type="email" id="E-mail" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" name="email" required pattern="[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+" title="Not an e-mail!" autocomplete="off" />
          <label for="E-mail">E-mail</label>
          <i class="fa fa-envelope form-control-feedback"></i>
          @error('email')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
          @enderror
          <div class="check"></div>
          <div class="bar"></div>
        </div>
        <div class="input-container has-feedback">
          <input type="password" id="password" name="password" value="{{ old('password') }}" class="form-control @error('password') is-invalid @enderror" required autocomplete="off" pattern="{8,20}" title="Password minimal 8 karakter" />
          <label for="Password">Password</label>
          <i class="fa fa-lock form-control-feedback"></i>
          @error('password')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
          @enderror
          <div class="check"></div>
          <div class="bar"></div>
        </div>
        <div class="input-container has-feedback">
          <input type="password" id="password-confirm" name="password_confirmation" required autocomplete="off" pattern="{8,20}" title="Password minimal 8 karakter" />
          <label for="Password">Ulangi Password</label>
          <i class="fa fa-lock form-control-feedback"></i>
          <div class="check"></div>
          <div class="bar"></div>
        </div>
        <div class="checkbox">
          <label>
            <input type="checkbox" id="terms" required>
            <span class="cr"><i class="cr-icon fa fa-rocket"></i></span>
            I accept something I never read
          </label>
        </div>
        <div class="button-container">
          <button><span>Register</span></button>
        </div>
      </form>
    </div>
    <div class="card login-reset">
      <h1 class="title">Reset password</h1>
      <p class="reset-info">Password reset instruction will be send to your e-mail.</p>
      <form method="POST" action="{{ route('password.email') }}">
      @csrf
        <div class="input-container has-feedback">
          <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" required pattern="[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+" title="Not an e-mail!" autocomplete="off" />
          <label for="E-mail">E-mail</label>
          @error('email')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
          @enderror
          <i class="fa fa-envelope form-control-feedback"></i>
          <div class="check"></div>
          <div class="bar"></div>
        </div>
        <div class="button-container">
          <!-- <button><span>Reset</span></button> -->
          <button type="submit" class="btn btn-primary">
              {{ __('Reset') }}
          </button>
        </div>
        <div class="footer"><a href="#">Back to Login</a></div>
      </form>
    </div>
  </div>


  <script type="text/javascript">//move input label function
$(".input-container")
  .find("input")
  .on("keyup blur focus", function (e) {
    var $this = $(this),
      label = $this.next("label");
    if (e.type == "blur") {
      if ($this.val() === "") {
        label.removeClass("active");
      }
    } else if (e.type === "focus") {
      if ($this.val() === "") {
        label.addClass("active");
      }
    }
  });

// Toggle Function
$(".toggle").click(function () {
  // Switches the Icon
  $(this).children("i").toggleClass("fa-pencil");
  $(".tooltip").text($(".tooltip").text() === "Sign up" ? "Login" : "Sign up");
  // Switches the forms
  $(".login-register").animate(
    {
      height: "toggle",
      "padding-top": "toggle",
      "padding-bottom": "toggle",
      opacity: "toggle"
    },
    "slow"
  );
});

$(".footer a").click(function () {
  // Switches the forms
  $(".card-container").children(".toggle").toggle();
  $(".login-reset").animate(
    {
      height: "toggle",
      "padding-top": "toggle",
      "padding-bottom": "toggle",
      opacity: "toggle"
    },
    "slow"
  );
});
</script>

</body>

</html>