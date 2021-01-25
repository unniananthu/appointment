<?php
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: patient-dashboard.php");
    exit;
}
 ?><html>
<head>
<link href="login_style.css" type="text/css" rel="stylesheet"/>
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script type="text/javascript">
function do_login()
{
 var username = $("#username").val();
 var password = $("#password").val();
 if(username != "" && password != ""){
  $.ajax({
    type: 'POST',
    url: 'userLogin.php',
    data: {
     username: username,
     password: password
    },success: function(data) {
      var data = JSON.parse(data);
      if(data.successFlag == 1){
        location.reload();
      }else{
         alert(data.message);
      }
  	}
  });

 }else{
  alert("Please Fill All The Details");
 }
 return false;
}
</script>
</head>
<body>
<div id="wrapper">

<div id="login_form">
 <h1>LOGIN FORM</h1>
 <p id="login_label">Email : jinju@safecaretec.com | Password : demo</p>
 <form method="post" action="userLogin.php" onsubmit="return do_login();">
  <input type="text" name="emailid" id="emailid" placeholder="Enter Email">
  <br>
  <input type="password" name="password" id="password" placeholder="***********">
  <br>
  <input type="submit" name="login" value="DO LOGIN" id="login_button">
 </form>
 <p id="loading_spinner"><img src="images/loader.gif"></p>
</div>

</div>
</body>
</html>