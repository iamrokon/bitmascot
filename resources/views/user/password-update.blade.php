<x-layout>
    @include('layouts.navigation')
    @include('layouts.sidebar')
    <div class="container">
        <div id="err_msg" style="display: none">
        </div>
        @if (session('status'))
            <h3 class="text-center" id="statusMessage" style="color: green">{{ session('status') }}</h3>
        @endif
        <h2 class="text-center">Change Password</h2>
        <div style="width: 50%;margin:0 auto">
            <form method="POST" id="update_password" action="{{ route('verify.otp') }}">
                @csrf

                <div class="form-group row">
                    <label for="password" class="col-sm-4 col-form-label">Old Password</label>
                    <div class="col-sm-8">
                        <input type="password" class="form-control" id="old_password" name="old_password">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="password" class="col-sm-4 col-form-label">New Password</label>
                    <div class="col-sm-8">
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="password" class="col-sm-4 col-form-label">Confirm Password</label>
                    <div class="col-sm-8">
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                    </div>
                </div>

                <div class="form-group text-right">
                    <button type="submit" class="btn btn-primary" style="margin-right: 30px">Update</button>
                    <button type="button" class="btn" id="clear_btn">Clear</button>
                </div>
            </form>

        </div>
    </div>
</x-layout>
