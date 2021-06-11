<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    

    <!-- Title -->
    <!-- <title>Olivia</title> -->
    @yield('title')

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('ubicon.png') }}">

    <!-- Core Stylesheet -->
    <link href="{{ asset('assets/user/style.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/user/custom.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Responsive CSS -->
    <link href="{{ asset('assets/user/css/responsive.css') }}" rel="stylesheet">

</head>

<body>

<!-- firebase -->
	<!-- The core Firebase JS SDK is always required and must be listed first -->
   <script src="https://www.gstatic.com/firebasejs/7.19.1/firebase-app.js"></script>

<!-- TODO: Add SDKs for Firebase products that you want to use
     https://firebase.google.com/docs/web/setup#available-libraries -->
<script src="https://www.gstatic.com/firebasejs/7.19.1/firebase-analytics.js"></script>

<script>
  // Your web app's Firebase configuration
  var firebaseConfig = {
    apiKey: "AIzaSyBwBRQHnE1ruI8I6U1rUJTY83HHfdWPumI",
    authDomain: "smart-city-c346a.firebaseapp.com",
    databaseURL: "https://smart-city-c346a.firebaseio.com",
    projectId: "smart-city-c346a",
    storageBucket: "smart-city-c346a.appspot.com",
    messagingSenderId: "10824827554",
    appId: "1:10824827554:web:6d556148dd2d5c627e8dfb",
    measurementId: "G-ENKBQX9FZ8"
  };
  // Initialize Firebase
  firebase.initializeApp(firebaseConfig);
  firebase.analytics();
</script>
<!-- end firebase -->

 
    <div id="preloader">
        <div class="olv-preloader"></div>
    </div>

  
    <header class="header_area clearfix">
        <div class="container-fluid h-100">
            <div class="row h-100">
                <!-- Menu Area Start -->
                <div class="col-12 h-100">
                    <div class="menu_area h-100">
                        <nav class="navbar h-100 navbar-expand-lg align-items-center">
                            <!-- Logo -->
                            <!-- <a class="navbar-brand" href="{{ url('/') }}"><h2 class="text text-color-white">VASHE</h2></a> -->
                            <a class="navbar-brand" href="{{ url('/') }}"><img src="{{asset('ubicon.png')}}" width="200" height="100"></a>

                            <!-- Menu Area -->
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#olv-navbar" aria-controls="olv-navbar" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>

                            <div class="collapse navbar-collapse justify-content-end" id="olv-navbar">
                                <ul class="navbar-nav animated" id="nav">
                                    <li class="nav-item @if(Route::is('home')) active @endif"><a class="nav-link" href="{{ url('/') }}">Home</a></li>
                                    <li class="nav-item @if(Route::is('profile')) active @endif"><a class="nav-link" href="{{ url('profile') }}">Profile</a></li>
                                    <!--- GALERY DROPDOWN-->
                                    <div class="dropdown">
                                       <li class="nav-item dropdown-toggle nav-link" id="dropdownMenuButton" data-toggle="dropdown">Gallery</li>
                                       <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                          <a class="dropdown-item" href="{{ url('galeri') }}">Foto</a>
                                          <a class="dropdown-item" href="{{ url('video') }}">Video</a>
                                       </div>
                                    </div>


                                    <!--<div class="dropdown">
                                       <li class="nav-item dropdown-toggle nav-link" id="dropdownMenuButton" data-toggle="dropdown">Info</li>
                                       <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                          <a class="dropdown-item" href="{{ url('berita') }}">Berita</a>
                                          <a class="dropdown-item" href="{{ url('pengumuman') }}">Pengumuman</a>
                                       </div>
                                    </div> -->
                                    <li class="nav-item @if(Route::is('faq')) active @endif"><a class="nav-link" href="{{ url('faq') }}">FAQ</a></li>
                                </ul>
                                <!-- Search Form Area Start -->
                                <div class="search-form-area animated">
                                    <!-- <form action="#" method="post"> -->
                                        <input type="search" name="search" id="search" placeholder="Type keywords &amp; hit enter">
                                    <!-- </form> -->
                                    <div id="display-search"></div>
                                    
                                </div>
                                <!-- Search btn -->
                                <div class="search-button">
                                    <a href="#" id="search-btn"><img src="{{ asset('assets/user/img/core-img/search-icon.png') }}" alt="Search"></a>
                                </div>
                                <div class="login-register-btn">
                                <!-- jika user tidak auth -->
                                <?php if(auth()->user() == null) {?>
                                <!-- Login/Register btn -->
                                <div class="login-register-btn">
                                <a href="{{ url('login') }}">Login/Register</a>
                                </div>
                                <?php } else if(auth()->user() != null) {?>
                                 <?php if(auth()->user()->id_role == 2) {?>
                                <!-- jika user auth -->
                                <div class="container">
                                        <div class="half">
                                            <label for="profile2" class="profile-dropdown">
                                                <input type="checkbox" id="profile2">
                                                <img src="https://cdn0.iconfinder.com/data/icons/avatars-3/512/avatar_hipster_guy-512.png">
                                                <span style="color: #000000;">{{auth()->user()->name}}</span>
                                                
                                                <ul>
                                                <form action="{{ route('logout') }}" method="POST">
                                                   @csrf
                                                    <div class="form-row">
                                                      <div class="col">
                                                         <a href="{{ url('user') }}"><input type="button" class="btn btn-success" value="Akun"></a>
                                                      </div>
                                                      <div class="col">
                                                         <input type="submit" class="btn btn-primary" value="Logout">
                                                      </div>
                                                   </div>
                                                    
                                                </form>
                                                </ul>
                                            </label>
                                        </div>
                                    </div>
                                    <?php } else {?>
                                       <div class="login-register-btn">
                                             <a href="{{ url('login') }}">Login/Register</a>
                                       </div>
                                    <?php } ?>
                                <?php } ?>
                                 </div>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </header>
   
    
    @yield('content')
    
   
<div class="container wrapper-ft">
    <div class="row">
        <div class="col-lg-3">
            <div class="ft-img">
                <img src="{{ asset('assets/logo.png') }}" alt="">
                <p style="text-align:center">UB © Content 2021. All rights reserved</p>
            </div>
            
        </div>
        <div class="col-lg-3">
            <h6 style="font-weight: 600; color: #191919; margin-bottom:25px">Others</h6>
            <ul class="list-unstyled">
                <li><a href="">Privacy Policy</a></li>
                <li><a href="">Terms & Condition</a></li>
                <li><a href="">About Us</a></li>
                <li><a href="">FAQ</a></li>
            </ul>
        </div>
        <div class="col-lg-3 d-none d-sm-block">
            <h6 style="font-weight: 600; color: #191919; margin-bottom:25px">Contact Us</h6>
            <ul class="list-unstyled">
                <li><a href=""><i class="fa fa-envelope"></i>&nbsp; ub@gmail.com</a></li>
                <li><a href=""><i class="fa fa-phone" ></i>&nbsp; +62 812 554 876 90</a></li>
                {{-- <li><a href=""><i class="fa fa-whatsapp" ></i>&nbsp; +62 812 554 876 90</a></li> --}}
            </ul>
        </div>
        <div class="col-lg-3">
        <h6 style="font-weight: 600; color: #191919; margin-bottom:25px">Follow Us</h6>
            <ul class="list-unstyled">
                <li><a href=""><i class="fa fa-instagram"></i>&nbsp; Instagram</a></li>
                <li><a href=""><i class="fa fa-facebook" ></i>&nbsp; Facebook</a></li>
                <!-- <li><a href=""><i class="fa fa-whatsapp" ></i>&nbsp; +62 813 591 973 60</a></li> -->
            </ul>
        </div>
    </div>
</div>
    
    <!-- jQuery-2.2.4 js -->
    <script src="{{ asset('assets/user/js/jquery-2.2.4.min.js') }}"></script>
    <!-- Popper js -->
    <script src="{{ asset('assets/user/js/popper.min.js') }}"></script>
    <!-- Bootstrap js -->
    <script src="{{ asset('assets/user/js/bootstrap.min.js') }}"></script>
    <!-- All Plugins js -->
    <script src="{{ asset('assets/user/js/plugins.js') }}"></script>
    <!-- Active js -->
    <script src="{{ asset('assets/user/js/active.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    @yield('js-user')
    <!-- custom file -->
    <script type="text/javascript">
      //Reference:
//https://www.onextrapixel.com/2012/12/10/how-to-create-a-custom-file-input-with-jquery-css3-and-php/
(function ($) {
  // Browser supports HTML5 multiple file?
  var multipleSupport = typeof $("<input/>")[0].multiple !== "undefined",
    isIE = /msie/i.test(navigator.userAgent);

  $.fn.customFile = function () {
    return this.each(function () {
      var $file = $(this).addClass("custom-file-upload-hidden"), // the original file input
        $wrap = $('<div class="file-upload-wrapper">'),
        $input = $('<input type="text" class="file-upload-input" />'),
        // Button that will be used in non-IE browsers
        $button = $(
          '<button type="button" class="file-upload-button">Select a File</button>'
        ),
        // Hack for IE
        $label = $(
          '<label class="file-upload-button" for="' +
            $file[0].id +
            '">Select a File</label>'
        );

      // Hide by shifting to the left so we
      // can still trigger events
      $file.css({
        position: "absolute",
        left: "-9999px"
      });

      $wrap.insertAfter($file).append($file, $input, isIE ? $label : $button);

      // Prevent focus
      $file.attr("tabIndex", -1);
      $button.attr("tabIndex", -1);

      $button.click(function () {
        $file.focus().click(); // Open dialog
      });

      $file.change(function () {
        var files = [],
          fileArr,
          filename;

        // If multiple is supported then extract
        // all filenames from the file array
        if (multipleSupport) {
          fileArr = $file[0].files;
          for (var i = 0, len = fileArr.length; i < len; i++) {
            files.push(fileArr[i].name);
          }
          filename = files.join(", ");

          // If not supported then just take the value
          // and remove the path to just show the filename
        } else {
          filename = $file.val().split("\\").pop();
        }

        $input
          .val(filename) // Set the value
          .attr("title", filename) // Show filename in title tootlip
          .focus(); // Regain focus
      });

      $input.on({
        blur: function () {
          $file.trigger("blur");
        },
        keydown: function (e) {
          if (e.which === 13) {
            // Enter
            if (!isIE) {
              $file.trigger("click");
            }
          } else if (e.which === 8 || e.which === 46) {
            // Backspace & Del
            // On some browsers the value is read-only
            // with this trick we remove the old input and add
            // a clean clone with all the original events attached
            $file.replaceWith(($file = $file.clone(true)));
            $file.trigger("change");
            $input.val("");
          } else if (e.which === 9) {
            // TAB
            return;
          } else {
            // All other keys
            return false;
          }
        }
      });
    });
  };

  // Old browser fallback
  if (!multipleSupport) {
    $(document).on("change", "input.customfile", function () {
      var $this = $(this),
        // Create a unique ID so we
        // can attach the label to the input
        uniqId = "customfile_" + new Date().getTime(),
        $wrap = $this.parent(),
        // Filter empty input
        $inputs = $wrap
          .siblings()
          .find(".file-upload-input")
          .filter(function () {
            return !this.value;
          }),
        $file = $(
          '<input type="file" id="' +
            uniqId +
            '" name="' +
            $this.attr("name") +
            '"/>'
        );

      // 1ms timeout so it runs after all other events
      // that modify the value have triggered
      setTimeout(function () {
        // Add a new input
        if ($this.val()) {
          // Check for empty fields to prevent
          // creating new inputs when changing files
          if (!$inputs.length) {
            $wrap.after($file);
            $file.customFile();
          }
          // Remove and reorganize inputs
        } else {
          $inputs.parent().remove();
          // Move the input so it's always last on the list
          $wrap.appendTo($wrap.parent());
          $wrap.find("input").focus();
        }
      }, 1);
    });
  }
})(jQuery);

$("input[type=file]").customFile();

    </script>
    <!-- end custom file -->
    <script type="text/javascript">
    $(document).ready(function() {

      $(document).on('keyup', '#search', function() {
         var key = $('#search').val();
         if(key != "") {
            showSearch(key)
         } else {
            $('#display-search').empty();
         }
      });

      function showSearch(key)
      {  
         $.ajax({
               type: 'GET',
               url: '{{url('search')}}',
               data: {key:key},
               success: function(data) {
                  if(data.success == true) {
                  $('#display-search').html(data.html);
                  } else {
                     $('#display-search').html(data.html);
                     console.log(data.html)
                  }
               }
         });
      }

      $(function () {
           $(".input input")
              .focus(function () {
                 $(this)
                    .parent(".input")
                    .each(function () {
                       $("label", this).css({
                          "line-height": "18px",
                          "font-size": "18px",
                          "font-weight": "100",
                          top: "0px"
                       });
                       $(".spin", this).css({
                          width: "100%"
                       });
                    });
              })
              .blur(function () {
                 $(".spin").css({
                    width: "0px"
                 });
                 if ($(this).val() == "") {
                    $(this)
                       .parent(".input")
                       .each(function () {
                          $("label", this).css({
                             "line-height": "60px",
                             "font-size": "24px",
                             "font-weight": "300",
                             top: "10px"
                          });
                       });
                 }
              });

           $(".button").click(function (e) {
              var pX = e.pageX,
                 pY = e.pageY,
                 oX = parseInt($(this).offset().left),
                 oY = parseInt($(this).offset().top);

              $(this).append(
                 '<span class="click-efect x-' +
                    oX +
                    " y-" +
                    oY +
                    '" style="margin-left:' +
                    (pX - oX) +
                    "px;margin-top:" +
                    (pY - oY) +
                    'px;"></span>'
              );
              $(".x-" + oX + ".y-" + oY + "").animate(
                 {
                    width: "500px",
                    height: "500px",
                    top: "-250px",
                    left: "-250px"
                 },
                 600
              );
              $("button", this).addClass("active");
           });

           $(".alt-2").click(function () {
              if (!$(this).hasClass("material-button")) {
                 $(".shape").css({
                    width: "100%",
                    height: "100%",
                    transform: "rotate(0deg)"
                 });

                 setTimeout(function () {
                    $(".overbox").css({
                       overflow: "initial"
                    });
                 }, 600);

                 $(this).animate(
                    {
                       width: "140px",
                       height: "140px"
                    },
                    500,
                    function () {
                       $(".box").removeClass("back");

                       $(this).removeClass("active");
                    }
                 );

                 $(".overbox .title").fadeOut(300);
                 $(".overbox .input").fadeOut(300);
                 $(".overbox .button").fadeOut(300);

                 $(".alt-2").addClass("material-buton");
              }
           });

           $(".material-button").click(function () {
              if ($(this).hasClass("material-button")) {
                 setTimeout(function () {
                    $(".overbox").css({
                       overflow: "hidden"
                    });
                    $(".box").addClass("back");
                 }, 200);
                 $(this).addClass("active").animate({
                    width: "700px",
                    height: "700px"
                 });

                 setTimeout(function () {
                    $(".shape").css({
                       width: "50%",
                       height: "50%",
                       transform: "rotate(45deg)"
                    });

                    $(".overbox .title").fadeIn(300);
                    $(".overbox .input").fadeIn(300);
                    $(".overbox .button").fadeIn(300);
                 }, 700);

                 $(this).removeClass("material-button");
              }

              if ($(".alt-2").hasClass("material-buton")) {
                 $(".alt-2").removeClass("material-buton");
                 $(".alt-2").addClass("material-button");
              }
           });
        });
      });
        </script>
</body>

</html>