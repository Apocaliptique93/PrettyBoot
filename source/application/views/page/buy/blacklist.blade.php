@layout('main')


@section('content')


<div class="span12">

    <div class="span4 offset1">
        <h3>Skype blacklisting</h3>
        <p>Do you want your Skype to be blocked from being resolved? <br />Now you can, just fill in your Skype username and complete the payment!</p>
        <div style="margin-top:25px">
            <form name="_xclick" action="https://www.paypal.com/cgi-bin/webscr" method="post">
                <input type="hidden" name="cmd" value="_xclick">
                <input type="hidden" name="business" value="{{ $settings['ppemail'] }}">
                <input type="hidden" name="currency_code" value="{{ $settings['ppcurrency'] }}">

                <input type="hidden" name="item_name" value="Blacklisting">
                <input type="hidden" name="amount" value="{{ $settings['skypebl'] }}">

                <input type="hidden" name="on0" value="User ID">
                <input type="hidden" name="os0" value="{{ Auth::user()->id }}">
                <input type="hidden" name="on1" value="Blacklist">
                <label for="os1">Skype username:<br/>Price: {{ $settings['skypebl'] }}&nbsp;{{$settings['ppcurrency']}}</label>
                <input type="text" name="os1">

                <input type="hidden" name="custom" value="blacklist_skype">

                <input type="hidden" name="no_note" value="1">
                <input type="hidden" name="no_shipping" value="1">


                <input type="hidden" name="notify_url" value="http://{{ $_SERVER['SERVER_NAME'] }}/plan/process/">
                <input type="hidden" name="return" value="http://{{ $_SERVER['SERVER_NAME'] }}/plan/paid/">
                <input type="hidden" name="cancel_return" value="http://{{ $_SERVER['SERVER_NAME'] }}/plan/cancel/">

                <input type="submit" name="submit" class="btn btn-danger" value="Purchase blacklisting">

            </form>
        </div>
    </div>

    <div class="span4 offset1">
        <h3>IP blacklisting</h3>
        <p>Do you want your IP to be blocked from being attacked? <br />Now you can, just fill in your IP address and complete the payment!</p>
        <div style="margin-top:25px">
            <form name="_xclick" action="https://www.paypal.com/cgi-bin/webscr" method="post">
                <input type="hidden" name="cmd" value="_xclick">
                <input type="hidden" name="business" value="{{ $settings['ppemail'] }}">
                <input type="hidden" name="currency_code" value="{{ $settings['ppcurrency'] }}">

                <input type="hidden" name="item_name" value="Blacklisting">
                <input type="hidden" name="amount" value="{{ $settings['ipbl'] }}">

                <input type="hidden" name="on0" value="User ID">
                <input type="hidden" name="os0" value="{{ Auth::user()->id }}">
                <input type="hidden" name="on1" value="Blacklist">
                <label for="os1">IP address:<br/>Price: {{ $settings['ipbl'] }}&nbsp;{{$settings['ppcurrency']}}</label>
                <input type="text" name="os1">

                <input type="hidden" name="custom" value="blacklist_ip">

                <input type="hidden" name="no_note" value="1">
                <input type="hidden" name="no_shipping" value="1">


                <input type="hidden" name="notify_url" value="http://{{ $_SERVER['SERVER_NAME'] }}/plan/process/">
                <input type="hidden" name="return" value="http://{{ $_SERVER['SERVER_NAME'] }}/plan/paid/">
                <input type="hidden" name="cancel_return" value="http://{{ $_SERVER['SERVER_NAME'] }}/plan/cancel/">

                <input type="submit" name="submit" class="btn btn-danger" value="Purchase blacklisting">

            </form>
        </div>
    </div>
</div>


@endsection
