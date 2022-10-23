<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    <a class="navbar-brand" href="{{ route('shops.index') }}">Acme Pet Clinic Services</a>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    <ul class="nav navbar-nav navbar-right">

            <li>
            <a href="{{route('getCustomer')}}">
            <i class="fa fa-user" aria-hidden="true"></i>Customer
            </a>
            </li>

            <li> 
                <a href="{{ route('getEmployee') }}">
                    <i class="fa-solid fa-users" aria-hidden="true"></i> Employee
                </a>
            </li>

            <li>
              <a href="{{ route('getService') }}">
              <i class="fa fa-cog" aria-hidden="true"></i> Services
              </a>
              </li>

              <li>
                  <a href="{{ route('getPet') }}">
                  <i class="fa-solid fa-paw" aria-hidden="true"></i> Pet
                  </a>
              </li>

          <li>
          <a href="{{ route('shop.shoppingCart') }}">
          <i class="fa fa-shopping-cart" aria-hidden="true"></i> Shopping Cart<span class="badge">{{ Session::has('cart') ? Session::get('cart')->totalQty : '' }}</span>
          </a>
          </li>

          <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
          aria-expanded="false"><i class="fa fa-heartbeat" aria-hidden="true"></i> Pet Health <span class="caret"></span></a>
          <ul class="dropdown-menu">
              <li><i class="fa fa-paw" aria-hidden="true"><a href="{{route('consults.index')}}">Consultations</a></i></li>
              <li role="separator" class="divider"></li>
              <li><i class="fa fa-exclamation-circle" aria-hidden="true"><a href="{{ route('diseases.index') }}">Diseases</a></i></li>
          </ul>
        </li>

          <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
          aria-expanded="false"><i class="fa fa-user" aria-hidden="true"></i> User Management <span class="caret"></span></a>
          <ul class="dropdown-menu">
            @if (Auth::check())
              <li><i class="fa fa-user" aria-hidden="true"><a href="{{ route('user.profile') }}">User Profile</a></i></li>
              <li role="separator" class="divider"></li>
              <li><i class="fa fa-sign-out" aria-hidden="true"><a href="{{ route('user.logout') }}">Logout</a></i></li>
              @else
              <li><i class="fa fa-user-plus" aria-hidden="true"><a href="{{ route('user.signup') }}"></i>Customer Signup</a></li>
              <li><i class="fa fa-user-plus" aria-hidden="true"><a href="{{ route('user.esignup') }}"></i>Employee Signup</a></li>
              <li><i class="fa fa-sign-in" aria-hidden="true"><a href="{{ route('user.signins') }}"></i>Signin</a></li>
            @endif
          </ul>
        </li>
    </ul>
</div>
</div> 
</nav>      


