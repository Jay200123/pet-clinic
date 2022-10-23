<!DOCTYPE html>
<html>
    <style>
        .center{
            text-align: center;
        }

        footer {
  text-align: center;
  padding: 3px;
  background-color: "ffffff;";
  color: white;
  position: fixed;
  bottom: 0;
  right: 0;
}
    </style>

    <body style="background-color: #b3ffff">
        @include('layouts.master')
        <h2><i class="fa fa-paw" aria-hidden="true"></i>Welcome to Acme Pet Clinic</h2>
        <h4>We Care About Your Pet's Well Being</h4>
        <p class="center">
            <img src="/images/logo2.jpg" width = "300px" height="300px" alt="logo.jpeg">
        </p>


        <footer>
        <h4 class ="text-center text-primary">Acme Pet Clinic All Rights Reserved @2022</h4>
        </footer>
    </body>
    
</html>