
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

