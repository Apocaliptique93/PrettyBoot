@layout('main')



@section('content')
<div class="span11 offset1">
    <table class="table">
        <tr><th>By user:</th> <td>
                @if(empty(User::find($trans->user_id)->email))
                    User doesn't exist anymore
                @else
                    <a href="/admin/users/profile/{{$trans->user_id}}">{{ htmlspecialchars(User::find($trans->user_id)->email) }} </a></td>
                @endif
        </tr>
        <tr><th>Transaction date:</th> <td>{{ date('Y-m-d H:i', strtotime($trans->date) ) }}</td></tr>
        <tr><th>Amount:</th> <td>{{ htmlspecialchars(Round( $trans->amount , 2)) }} {{ $currency }}</td></tr>
        <tr><th>PayPal fee:</th> <td>{{ htmlspecialchars(Round($trans->paypal_fee, 2)) }} {{ $currency }}</td></tr>
        <tr><th>Description:</th><td>{{ htmlspecialchars($trans->description) }}</td></tr>
    </table>

    <h4>More transactions of this user</h4>
    @foreach($transactions as $t)
    <a href="/admin/transaction/info/{{$t->transaction_id}}">- {{ htmlspecialchars($t->transaction_id) }}</a>
    <br />
    @endforeach
</div>
@endsection