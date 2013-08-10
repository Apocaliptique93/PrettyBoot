@layout('main')


@section('content')

<div class="span12">
    <h4>Overview of all tickets</h4>
    @if(empty($tickets))
    <div class="alert alert-error">
        You have no tickets to list
    </div>
    @else
    <table class="table table-bordered">
        <thead>
        <tr>
            <th></th>
            <th>Title</th>
            <th>Status</th>
            <th>Creator</th>
            <th>Replies</th>
            <th>Creation date</th>
            <th>Last update at</th>
        </tr>
        </thead>
        <tbody>
    @if(empty($tickets->results))
        <div class="alert alert-danger">
            There are no tickets to show.
        </div>
    @else
        @foreach($tickets->results as $t)
        <tr>
            <td>
                <a href="/support/ticket/{{$t->id}}">View ticket</a>
            </td>
            <td>
                {{ htmlspecialchars($t->title) }}
            </td>
            <td>
                {{ $t->getStatus() }}
            </td>
            <td>
                @if(empty(User::find($t->user_id)->email))
                    User doesn't exist anymore
                @else
                    <a href="/admin/users/profile/{{$t->user_id}}">{{ htmlspecialchars(User::find($t->user_id)->email) }}</a>
                @endif
            </td>
            <td>
                {{ $t->replies()->count(); }}
            </td>
            <td>
                {{ date('Y-m-d H:i', strtotime($t->created_at) ) }}
            </td>
            <td>
                {{ date('Y-m-d H:i', strtotime($t->updated_at) ) }}
            </td>
        </tr>
        @endforeach
    @endif
        </tbody>
    </table>
        {{ $tickets->links() }}
    @endif
</div>

@endsection