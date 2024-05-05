@include('layouts.style')

<div class="sidebar col-sm-3">
    <a class="profile_page active" href="{{ route('profile-view') }}">Profile Page</a>
    <a class="change_password" href="{{ route('password-update') }}">Change Password</a>
  </div>
