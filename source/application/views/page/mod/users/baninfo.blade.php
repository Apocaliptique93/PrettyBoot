@layout('main')


@section('content')

<h3>{{ $user->email }}</h3>
    <p>Banned for: <span style="font-style: italic">{{ htmlspecialchars($user->ban_reason) }}</span></p>

    <p>
       Will be unbanned at: {{ date('Y-n-j H:i:s', strtotime($user->ban_expiry_date)) }}

    </p>
    <p>
        {{ Form::open('/mod/users/actions/unban/'.$user->id) }}
        {{ Form::button('Early unban', array('class' => 'btn btn-danger')) }}
        {{ Form::close() }}
    </p>

@endsection