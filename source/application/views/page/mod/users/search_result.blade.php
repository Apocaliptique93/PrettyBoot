


<table class="table">
    <thead>
        <tr>
            <th>User ID</th>
            <th>Email</th>
            <th>IP</th>
            <th>Group</th>
            <th>Plan expiry date</th>
            <th>Register date</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)

        <tr>
            <td>{{ $user->id }}</td>
            <td><a href="/mod/users/profile/{{$user->id}}">{{ $user->email }}</a></td>
            <td>{{ $user->ip }}</td>
            <td>
                @if(strtolower($user->group()) == 'admin')
                <span class="label label-important">Admin</span>
                @elseif(strtolower($user->group()) == 'moderator')
                <span class="label label-info">Moderator</span>
                @elseif(strtolower($user->group()) == 'member')
                <span class="label" style="background: #4b4b4b">Member</span>
                @endif
            </td>
            <td>{{ $user->planExpiryDate() }}</td>
            <td>{{ $user->created_at }}</td>
        </tr>

        @endforeach
    </tbody>
</table>