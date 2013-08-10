@layout('main')



@section('content')

<div class="span3">
{{ Form::open() }}
    <h3>Blacklist</h3>
{{ Form::select('type', array('0'=>'Skype', '1'=>'IP address'), 'Skype') }}

{{ Form::label('bl', 'IP/Skype to blacklist') }}
{{ Form::text('bl') }}

{{ Form::button('Add to blacklist', array('class' => 'btn btn-danger btn-block btn-small') ) }}
{{ Form::close() }}
</div>
<div class="span7 offset1">
    <h3>Overview</h3>
    @if(empty($sales->results))
        <div class="alert-danger">
            There are no custom blacklists yet.
        </div>
    @else
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>User</th>
                <th>Type</th>
                <th>Skype/IP</th>
                <th>Transaction ID</th>
            </tr>
        </thead>

        <tbody>
            @foreach($sales->results as $s)

            <tr>
                <td><a href="/admin/users/profile/{{$s->id}}">{{ htmlspecialchars(User::find($s->user_id)->email) }}</a></td>
                <td>{{ (htmlspecialchars($s->type) == 'skype') ? 'Skype' : 'IP address' }}</td>
                <td>{{ htmlspecialchars($s->blacklist) }}</td>
                <td>
                    @if($s->transaction_id == 'Admin add')
                    {{ htmlspecialchars($s->transaction_id) }}
                    @else
                    <a href="/admin/transaction/info/{{$s->transaction_id}}">{{ htmlspecialchars($s->transaction_id) }}</a>
                    @endif
                </td>
            </tr>

            @endforeach
        </tbody>
    </table>
    {{ $sales->links() }}
    @endif
</div>
@endsection