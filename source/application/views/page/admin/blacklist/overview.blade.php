@layout('main')


@section('content')


@if(empty($hosts->results))
    <div class="alert alert-danger">
        There are no blocked hosts yet, <a href="/admin/blacklist/add">click here to add some!</a>
    </div>
@else
    <table class="table table-condensed">
        <thead>
            <tr>
                <th>Host</th>
                <th>Description</th>
                <th>Added by</th>
                <th>Added at</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
    @foreach($hosts->results as $host)
            <tr>
                <td>{{ htmlspecialchars($host->ip) }}</td>
                <td>{{ htmlspecialchars($host->desc) }}</td>
                <td>{{ htmlspecialchars(User::find($host->user_id)->email) }}</td>
                <td>{{ date('Y-m-d H:i', strtotime($host->created_at)) }}</td>
                <td><a href="/admin/blacklist/delete/{{$host->id}}">Delete</a></td>
            </tr>
    @endforeach
        </tbody>
    </table>
@endif


@endsection