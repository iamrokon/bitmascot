<x-layout>
    <div class="container" style="margin-top: 30px">
        <div id="err_msg" style="display: none">
        </div>
        <h2 class="text-center">Register</h2>
        <div style="width: 50%;margin:0 auto">
        <form method="POST" enctype="multipart/form-data" id="register">
            @csrf
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="first_name">First Name</label>
                    <input type="text" class="form-control" id="first_name" name="first_name">
                </div>
                <div class="form-group col-md-6">
                    <label for="last_name">Last Name</label>
                    <input type="text" class="form-control" id="last_name" name="last_name">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" id="address" name="address">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="phone">Phone</label>
                    <input type="text" class="form-control" id="phone" name="phone">
                </div>
                <div class="form-group col-md-6">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email">
                    <span id="availabilityMsg"></span>
                </div>
            </div>
            <div class="form-row">
                <label class="col-md-3 col-form-label" for="birth_date">Date of Birth</label>
                <div class="form-group col-md-9">
                    <input type="date" class="form-control" id="birth_date" name="birth_date">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="nid" class="form-label">Id Verification</label>
                    <input class="form-control" type="file" id="nid" name="nid">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="confirm_password">Confirm Password</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                </div>
            </div>

            <div class="form-group text-center">
                <button type="submit" class="btn btn-primary">Sign Up</button>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <p>Already have an account? <a href="{{ route('loginView') }}">Login</a></p>
                </div>
            </div>
        </form>
        </div>
    </div>
</x-layout>
