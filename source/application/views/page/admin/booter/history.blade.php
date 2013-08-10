@layout('main')


@section('content')

        @if(empty($history->results))
            <div class="alert alert-danger">
                There's no attack history to display.
            </div>
        @else
            <table class='table table-condensed'>
                <caption><span style="width:100%; text-align: center;">{{ $history->links() }}</span></caption>
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Target</th>
                        <th>Boot time (s)</th>
                        <th>Method</th>
                        <th>Started at</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($history->results as $attack)
                        <tr>
                            <td>
                                @if(empty(User::find($attack->user_id)->email))
                                User doesn't exist anymore
                                @else
                                <a href="/admin/users/profile/{{$attack->user_id}}">{{ htmlspecialchars(User::find($attack->user_id)->email) }} </a></td>
                                @endif
                            <td>{{ htmlspecialchars($attack->ip) }}:{{ htmlspecialchars($attack->port) }}</td>
                            <td>{{ htmlspecialchars($attack->time) }}</td>
                            <td>{{ htmlspecialchars($attack->method) }}</td>
                            <td>{{ date('Y-m-d H:i', strtotime($attack->created_at)) }}</td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
                <span style="width:100%; text-align: center;">{{ $history->links() }}</span>
        @endif

@endsection