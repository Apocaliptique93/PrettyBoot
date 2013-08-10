@layout('main')



@section('content')

        @if( empty( $users->results ) )
            <div class="alert alert-danger">
                You have no members :(
            </div>

        @else
            <table class="table">
                <caption>

                    <span style="font-size:70%">Members: {{ User::count() }}</span>
                    <br /> From <strong>{{ $users->results[0]->email }}</strong> to <strong>{{ $users->results[count($users->results)-1]->email }}</strong>
                    {{ $users->links() }}
                </caption>
                <thead>
                    <tr>
                        <th>User ID</th>
                        <th>Username</th>
                        <th>IP</th>
                        <th>Group</th>
                        <th>Plan expiry date</th>
                        <th>Register date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users->results as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td><a href="/admin/users/profile/{{$user->id}}">{{ $user->email }}</a></td>
                            <td>{{ $user->ip }}</td>
                            <td>
                                @if($user->isAdmin())
                                    <span class="label label-important">Admin</span>
                                @elseif($user->isMod())
                                    <span class="label label-info">Moderator</span>
                                @else
                                    <span class="label" style="background: #4b4b4b">Member</span>
                                @endif
                            </td>
                            <td>{{ $user->planExpiryDate() }}</td>
                            <td>{{ $user->created_at }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <span style="width:100%; text-align:center;">{{ $users->links() }}</span>
        @endif

@endsection