@layout('main')


@section('content')

<div class="span11">
    @if(empty($sales->results))
    <div class='alert alert-danger'>
        There are no sales to display
    </div>
    @else

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>User</th>
                <th>Transaction ID</th>
                <th>Amount</th>
                <th>PayPal Fee</th>
                <th>Status</th>
                <th>Description</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sales->results as $s)
                <tr>
                    <td><a href="/admin/users/profile/{{$s->user_id}}">{{ (!empty(User::find($s->user_id)->email)) ? htmlspecialchars(User::find($s->user_id)->email) : 'No user found' }}</a></td>
                    <td><a href="/admin/transaction/info/{{$s->transaction_id}}">{{ htmlspecialchars($s->transaction_id) }}</a></td>
                    <td>{{ htmlspecialchars(Round($s->amount , 2)) }} {{ $currency }}</td>
                    <td>{{ htmlspecialchars(Round($s->paypal_fee , 2)) }} {{ $currency }}</td>
                    <td>{{ htmlspecialchars($s->status) }}</td>
                    <td>{{ htmlspecialchars($s->description) }}</td>
                    <td>{{ date('Y-m-d H:i', strtotime($s->date) ) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @endif

</div>

@endsection