<x-layout>
    @include('layouts.navigation')
    @include('layouts.sidebar')
    <div class="container" style="margin-top: 30px">
        <div id="err_msg" style="display: none">
        </div>
        @if (session('status'))
            <h3 class="text-center" id="statusMessage" style="color: green">{{ session('status') }}</h3>
        @endif
        <h2 class="text-center">User Profile</h2>
        <br>
        <br>
        <div style="margin-left:420px">
            <div class="row">
                <div class="col-sm-3">
                    <label>First Name</label>
                </div>
                <div class="col-sm-7">
                    <span>{{ $user->first_name }}</span>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <label>Last Name</label>
                </div>
                <div class="col-sm-7">
                    <span>{{ $user->last_name }}</span>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <label>Address</label>
                </div>
                <div class="col-sm-7">
                    <span>{{ $user->address }}</span>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <label>Phone</label>
                </div>
                <div class="col-sm-7">
                    <span>{{ $user->phone }}</span>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <label>Email</label>
                </div>
                <div class="col-sm-7">
                    <span>{{ $user->email }}</span>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <label>Birthdate</label>
                </div>
                <div class="col-sm-7">
                    <span>{{ $user->birth_date }}</span>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <label>ID Verification</label>
                </div>
                <div class="col-sm-7">
                    <a href="{{ asset('storage/user/'.$user->nid) }}" target="_blank"><img class="profile-img" src="{{ asset('img/pdf.png') }}" alt=""></a>
                </div>
            </div>
        </div>
    </div>
</x-layout>
