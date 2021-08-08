<nav class="navbar navbar-expand-md navbar-dark bg-dark mb-3">
    <div class="container-fluid">
        <a href="{{route('dashboard.index')}}" class="navbar-brand mr-3">RMIS</a>
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav">
                <a href="{{route('dashboard.index')}}" class="nav-item nav-link active">Home</a>

            </div>
            <div class="navbar-nav ml-auto">
                <a href="{{route('auth.register')}}" class="nav-item nav-link">Register New User</a>

                @if(session()->get('bearer_token'))
                    <a href="{{route('auth.logout')}}" class="nav-item nav-link">Logout</a>
                @else
                    <a href="{{route('auth.login')}}" class="nav-item nav-link">Login</a>
                @endif

            </div>
        </div>
    </div>
</nav>