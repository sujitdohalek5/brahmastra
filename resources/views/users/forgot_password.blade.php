@extends('layouts.frontLayout.front_design')
@section('content')


<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.js"></script>
       <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script>
	$(document).ready(function() {
$("#txtotp").hide();
setTimeout(function(){
	
    var ot =0;
    ot=$("#otpve").val();
   
    if(ot==0)
    {
            
    $('#btnotp').prop('type', 'button');
    $('#btnotp').val('Get OTP');
  $('#btnotp').attr('onclick', 'fun()');
    $('#getotp').attr('onclick', 'fun()');

    }
    else if(ot==2)
    {

        $("#txtotp").show();
  $('#btnotp').val('Verify OTP');
  $('#btnotp').attr('onclick', 'funs()');
 $('#getotp').val('Verify OTP');

    $('#getotp').attr('onclick', 'funs()');
    document.getElementById("phone").readOnly = true;

    }
    else if(ot==1)
    {
        $("#txtotp").show();
        $('#btnotp').prop('type', 'submit');
        $('#btnotp').val('Register');
  $('#btnotp').attr('onclick', '');
    $('#getotp').attr('onclick', '');

    }
  
  }, 1000);
 });

console.log("t");

 function fun()
 {
$("#txtotp").show();
document.getElementById("txtotp").focus();
str=$("#phone").val();
if (str == "") {
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                if(this.responseText=='yes')
                {
             document.getElementById("phone").readOnly = true;

                    ot=$("#otpve").val('2');

            $('#btnotp').val('Verify OTP');
  $('#btnotp').attr('onclick', 'funs()');

  $('#getotp').val('Verify OTP');
  $('#getotp').attr('onclick', 'funs()');
                
                alert("SMS sent to your mobile please verify");
                }
                else
                {
                    alert("Sorry some thing went wrong please try again later");

                }
            }
        };
        xmlhttp.open("GET"," http://localhost:8080/Brahmastra/trunk/otp-verify.php?phone="+str,true);
        xmlhttp.send();
    }
}


function funs()
 {
str=$("#phone").val();
otp=$("#txtotp").val();

if (str == "") {
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                strs=this.responseText;
            var a=strs.replace(/\s/g,'')
                if(a=='yes')
                {
                        ot=$("#otpve").val('1');
                       $('#btnotp').prop('type', 'submit');

            $('#btnotp').val('Register');
  $('#btnotp').attr('onclick', 'funs()');
                
                alert("Phone verify success");
                    document.getElementById("phone").readOnly = true;

                }
                else
                {
            
                    
                    alert("Sorry some thing went wrong please try again later");

                }
            }
        };
        xmlhttp.open("GET","http://localhost:8080/Brahmastra/trunk/verify-otp.php?phone="+str+"&otp="+otp,true);
        xmlhttp.send();
    }
}
</script>
    

<section id="form" style="margin-top:20px;"><!--form-->
	<div class="container">
		<div class="row">
			 <script>
             @if (session('success'))
           swal("{{ session('success') }}");
         @endif
     </script>
         <script>
           @if (session('error'))
           swal("{{ session('error') }}");
         @endif

     </script>
			<div class="col-sm-4 col-sm-offset-1">
				<div class="login-form"><!--login form-->
					<h2>Forgot Password?</h2>
					<form id="forgotPasswordForm" name="forgotPasswordForm" action="{{ url('/forgot-password') }}" method="POST">{{ csrf_field() }}
						<input name="email" type="email" placeholder="Email Address" required="" />
						<button type="submit" class="btn btn-default">Submit</button><br>
					</form>
				</div><!--/login form-->
			</div>
			<div class="col-sm-1">
				<h2 class="or">OR</h2>
			</div>
			<div class="col-sm-4">
				<div class="signup-form"><!--sign up form-->
					<h2>New User Signup!</h2>
					<form id="registerForm" name="registerForm" action="{{ url('/user-register') }}" method="POST">{{csrf_field()}}
						<input id="name" name="name" type="text" placeholder="Name"/>
						<input id="email1" name="email1" type="email" placeholder="Email Address"/>
						<input id="phone" name="mobile" type="tel" placeholder="Phone Number"/>
						<input id="myPassword" name="password" type="password" placeholder="Password"/>
						<input id="confirmPassword" name="confirmPassword" type="password" placeholder="confirmPassword"/>
					    <input type="text" id="txtotp"  name="otp"  placeholder="Enter  Otp"/>
						<!-- <button id="btnotp" class="btn btn-default"></button><br>-->
                          
						
						<input type="button" name="btnotp" id="btnotp"  onclick="fun()" class="btn btn-default" style="background: #1c0e5f;border: medium none;border-radius: 0;color: #FFFFFF;display: block;font-family: 'Roboto', sans-serif;padding: 6px 25px;width: 100px;">
					<input id="otpve" type="hidden" value="0">
					</form>
				</div><!--/sign up form-->
			</div>
		</div>
	</div>
</section><!--/form-->

@endsection