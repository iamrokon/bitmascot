<x-layout>
    <div class="container">
        @if (session('status'))
            <h3 class="text-center" id="statusMessage" style="color: green">{{ session('status') }}</h3>
        @endif
        <div id="err_msg" style="display: none">
        </div>
        <h2 class="text-center">Login</h2>
        <div style="width: 50%;margin:0 auto">
            <form method="POST" id="login">
                @csrf
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
                <div class="form-group text-center">
                    <button type="submit" class="btn btn-primary">Login</button>
                </div>
                <div class="form-group">
                    <p>Don't have an account? <a href="{{ route('signup') }}">Sign Up</a></p>
                </div>
            </form>
        </div>
    </div>
</x-layout>
