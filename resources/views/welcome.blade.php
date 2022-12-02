<!DOCTYPE html>
<html>
    <style>

        body, html{
            margin: 0;
            padding: 0;
            background-repeat: no-repeat;
            background-size: cover;
            background-image: url('images/background-test2.jpg');
            height: 100%;

        }
        .center{
            text-align: center;
        }

        .footer {
  text-align: center;
  padding: 15px 10px;
  background-color: black;
  width: 100%;
  position: fixed;
  bottom: 0;
  right: 0;
}

    </style>

    <body style="background-color: #b3ffff">
        @include('layouts.master')
        <div class="center">
        <h2><i class="fa fa-paw" aria-hidden="true"></i><strong>Welcome to Acme Pet Clinic</strong></h2>
        <h4><strong>We Care About Your Pet's Well Being</strong></h4>
        </div>
        <!-- <p class="center">
            <img src="/images/logo2.jpg" width = "300px" height="300px" alt="logo.jpeg">
        </p> -->


        <footer class="footer">
        <h4 style="color:white">Acme Pet Clinic All Rights Reserved @2022</h4>
        </footer>
    </body>
    
</html>