<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
  <a class="navbar-brand" href="#">TALK</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarCollapse">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#"><i class="ri-group-line ri-1x"></i></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#"><i class="ri-discuss-line ri-1x"></i></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#"><i class="ri-user-add-line ri-1x"></i></a>
      </li>
    </ul>
    <form class="form-inline mt-2 mt-md-0">
      <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
        <div class="btn-group dropstart">
          <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            <img  src="https://images.pexels.com/photos/6062496/pexels-photo-6062496.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940" alt="" 
            style="  width: 40px;
            height: 40px;
            border-radius: 75%;" />
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Profile</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a href="#" id="logout" class="dropdown-item" >Logout</a></li>
          </ul>
        </div> 
    </form>
  </div>
</nav>
<form action="{{ route('logout') }}" method="GET" id="formlogout">
  @csrf
</form>
<script>
  $('#logout').on('click', function(){
    $('#formlogout').submit();
  });
</script>
<div style="margin-bottom: 8%;">
</div>