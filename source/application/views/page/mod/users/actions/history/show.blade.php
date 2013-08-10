@layout('main')


@section('content')
    <h4>Attacks of <span style="font-style: italic">{{ $user->email }}</span></h4>
    @if(empty($attacks->results))
        <div class="alert alert-danger">
            This user has no attacks.
        </div>
    @else
    <table class="table">
        <caption>
            {{ Form::open('/mod/users/actions/history/delete/'.$user->id) }}
            {{ Form::button('Clear attack history', array('class' => 'btn btn-danger', 'style' => 'margin-top:25px;')) }}
            {{ Form::close() }}
        </caption>
        <thead>
            <tr>
                <th>Target</th>
                <th>Method</th>
                <th>Boot time (s)</th>
                <th>Attack date</th>
            </tr>
        </thead>

        <tbody>
            @foreach($attacks->results as $attack)
                <tr>
                    <td>{{ htmlspecialchars($attack->ip) }}:{{ htmlspecialchars($attack->port) }}</td>
                    <td>{{ htmlspecialchars($attack->method) }}</td>
                    <td>{{ htmlspecialchars($attack->time) }}</td>
                    <td>{{ date('Y-n-j H:i', strtotime($attack->created_at)) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <span style="width:100%; text-align:center;">{{ $attacks->links() }}</span>
    @endif
@endsection