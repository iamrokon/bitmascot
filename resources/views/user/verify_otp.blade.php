<x-layout>
    <div class="container">
        <h2 class="text-center">Verification code</h2>
        <p class="text-center">An unique code has been sent to your email</p>
        <div style="width: 50%;margin:0 auto">
            <form method="POST" id="otp_verify" action="{{ route('verify.otp') }}">
                @csrf
                <div class="form-group">
                    <label for="exampleInputEmail1">Verification code</label>
                    <input type="text" class="form-control" id="otp" name="otp" aria-describedby="emailHelp">
                    <input type="hidden" name="user_id" id="user_id" value="{{ session('user_id') }}">
                </div>
                <div class="form-group text-center">
                    <button type="submit" class="btn btn-primary">Verify</button>
                </div>
                <div class="form-group">
                    <p>Don't have an account? <a href="{{ route('signup') }}">Sign Up</a></p>
                </div>
            </form>
        </div>
    </div>
</x-layout>
