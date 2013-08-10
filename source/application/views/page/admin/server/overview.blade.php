@layout('main')


@section('content')


    @if(empty($servers))
        <div class="alert alert-danger">
            You haven't added any servers yet, <a href="/admin/server/add">Click here to add one.</a>
        </div>
    @else
    <div style="text-align: center; width:100%;">Servers: {{ Server::count() }} - Online: {{ Server::getOnline() }}</div>
        @foreach($servers as $server)
            <div class="server_info">
                <h5>{{ htmlspecialchars($server->url) }}</h5>
                Current status: {{ $server->getStatusMarkup() }}
                <br />
                Added at: {{ date('Y-m-d H:i', strtotime($server->created_at)) }}
                <br />
                <br />
                <span style="font-size:75%; text-align: right">
                    <a href="/admin/server/delete/{{$server->id}}">Delete</a>
                    <a href="/admin/server/edit/{{$server->id}}">Edit</a>
                </span>
            </div>
        @endforeach
    @endif



@endsection