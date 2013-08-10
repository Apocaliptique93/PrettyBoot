@layout('main')


@section('content')

    @if(empty($attacks->results))
        <div class="alert alert-danger">
            You have not yet launched any attacks.
        </div>
    @else
        <table class="table">
            <thead>
            <tr>
                <th>Target</th>
                <th>Method</th>
                <th>Launch IP</th>
                <th>Boot time (s)</th>
                <th>Attack date</th>
            </tr>
            </thead>

            <tbody>
            @foreach($attacks->results as $attack)
            <tr>
                <td>{{ htmlspecialchars($attack->ip) }}:{{ htmlspecialchars($attack->port) }}</td>
                <td>{{ htmlspecialchars($attack->method) }}</td>
                <td>{{ htmlspecialchars($attack->user_ip) }}</td>
                <td>{{ htmlspecialchars($attack->time) }}</td>
                <td>{{ date('Y-n-j H:i', strtotime($attack->created_at)) }}</td>
            </tr>
            @endforeach
            </tbody>
        </table>
        <span style="width:100%; text-align:center;">{{ $attacks->links() }}</span>

    @endif

@endsection