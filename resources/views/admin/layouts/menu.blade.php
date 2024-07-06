<header class="navbar navbar-expand-md navbar-light d-none d-lg-flex d-print-none">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu">
            <span class="navbar-toggler-icon"></span>
        </button>

        {{-- <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
            <a href="#">
                <img src="#" height="40" alt="tanni" class="navbar-brand-image" />
            </a>
        </h1> --}}
      
        <div class="navbar-nav flex-row order-md-last">
            <div class="nav-item dropdown">
                <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open user menu">
                   
                    </span>
                    
                    <div class="d-none d-xl-block ps-2">
                        <div class="mt-1 small text-secondary">Administrador</div>
                    </div>
                </a>

                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <form action="login" method="POST">
                    @method('put')    
                    @csrf
                    <button class="dropdown-item">
                        Cerrar sesión
                    </button>
                    </form>
                </div>
                
            </div>
        </div>
        <div class="collapse navbar-collapse" id="navbar-menu">
            <div>
            </div>
        </div>
    </div>
</header>

{{-- <header class="navbar-expand-md">
    <div class="collapse navbar-collapse" id="navbar-menu">
        <div class="navbar">
            <div class="container-xl">
                <div class="my-2 my-md-0 w-100">
                    <form action="./" method="get" autocomplete="off" novalidate>
                        <div class="input-icon">
                            <span class="input-icon-addon">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-search" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0"></path>
                                    <path d="M21 21l-6 -6"></path>
                                </svg>
                            </span>
                            <input type="text" class="form-control" placeholder="Hola, ¿qué necesitas?">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header> --}}