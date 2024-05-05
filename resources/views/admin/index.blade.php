<x-layout>
    @include('layouts.navigation')
    @include('layouts.sidebar_admin')
    @include('admin.search')
    <div class="container" style="margin-top: 30px">
        <div id="err_msg" style="display: none">
        </div>
        @if (session('status'))
            <h3 class="text-center" id="statusMessage" style="color: green">{{ session('status') }}</h3>
        @endif
        <br>
        <br>
        <table class="table" style="margin-left: 120px;">
            <thead>
                <tr>
                <th scope="col">Name</th>
                <th scope="col">Address</th>
                <th scope="col">Phone</th>
                <th scope="col">Email</th>
                <th scope="col">Date of Birth</th>
                <th scope="col">ID Verification</th>
                </tr>
            </thead>
            <tbody id="user_list">
                @foreach ($users as $user)
                <tr>
                    <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                    <td>{{ $user->address }}</td>
                    <td>{{ $user->phone }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->birth_date }}</td>
                    <td><a href="{{ asset('storage/user/'.$user->nid) }}" target="_blank"><img class="profile-img" src="{{ asset('img/pdf.png') }}" alt=""></a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div style="float: right">
            {{ $users->links('pagination::bootstrap-4') }}
        </div>
    </div>
</x-layout>
