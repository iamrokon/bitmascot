<nav class="navbar navbar-inverse">
<div class="container-fluid">
    <div class="navbar-header col-sm-10">
    @if (Auth::check() && Auth::user()->role == 1)
        <a class="navbar-brand" href="#">Admin Portal</a>
    @else
        <a class="navbar-brand" href="#">User Portal</a>
    @endif
    </div>
    <ul class="nav navbar-nav col-sm-2">
    <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">
        @if (Auth::check())
        {{ Auth::user()->first_name }}
        @else
            Guest User
        @endif
    <span class="caret"></span></a>
        <ul class="dropdown-menu">
        <li><a href="{{ route('password-update') }}" class="change_password">Change Password</a></li>
        <li><a href="#" id="logoutBtn">Logout</a></li>
        </ul>
    </li>
    </ul>
</div>
</nav>


