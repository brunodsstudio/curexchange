<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarColor01">
      <ul class="navbar-nav me-auto">
        <li class="nav-item active">
          <a class="nav-link" href="/home">Home
            <span class="visually-hidden">(current)</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#"class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Taxas</a>
        </li>
        
      </ul>

  
      <form class="d-flex" method="POST" id="formLogout" action="{{ route('logout') }}">
                            @csrf </form>
                            <a type="button" style="color:white"class="nav-link"  href="route('logout')"
                                    onclick="event.preventDefault();
                                                $('#formLogout').submit();">
                                {{ __('Log Out') }}
                        </a>
   
       
      
     
    </div>
  </div>
</nav>