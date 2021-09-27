<?php
   session_start();
   if(isset($_SESSION['login_user'])) {
      header("location: main.php");
   }

   $error = "";
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form

      $hash = json_decode(file_get_contents("admin.json"), true);
      $passwd = password_hash($_POST['password'], PASSWORD_DEFAULT);

      if (isset($hash[$_POST['username']]) && password_verify($_POST['password'], $hash[$_POST['username']])) {
         $_SESSION['login_user'] = $_POST['username'];
         header("location: main.php");
      }else {
         $error = "Your Login Name or Password is invalid";
      }
   }
?>
<html>

   <head>
      <title>Login Page</title>

      <style type = "text/css">

         label {
            font-weight:bold;
            width:100px;
            font-size:14px;
         }
         .box {
            border:#666666 solid 1px;
         }

         .login_view {
            margin-top: 100px;
         }

         .btn {
            text-align: center;
            margin: 0 auto;
            display: block;

            background-color: #333333;
            border: none;
            color: white;
            padding: 3px 6px;
            text-decoration: none;
            font-size: 16px;
         }

         .header{
            background-color:#333333;
            color:#FFFFFF;
            padding:10px;
            font-weight: bold;
         }

      </style>

   </head>

   <body bgcolor = "#FFFFFF">

      <div align="center" class="login_view">
         <div style = "width:400px; border: solid 1px #333333; " align = "left">
            <div align="center" class="header" ><b>Login</b></div>

            <div style = "margin:30px">

               <form action = "" method = "post">
                  <label style="margin:10px" >USERNAME </label><input type = "text" name = "username" class = "box"/><br/>
                  <label style="margin:10px" >PASSWORD </label><input type = "password" name = "password" class = "box"/><br/><br />
                  <input class="btn" style="float:right;" type = "submit" value = " Submit "/><br/>
               </form>
            </div>

            <div style = "font-size:15px; color:#cc0000; float:left; margin:10px"><?php echo $error; ?></div>

         </div>

      </div>

   </body>
</html>
