@layout('main')


@section('content')

    @foreach($plans as $plan)
        <div class="plan_buy">
            <h3>{{ htmlspecialchars($plan->name) }}</h3>
            <p style="font-style: italic">
                {{ nl2br(htmlspecialchars($plan->desc)) }}
            </p>
            <?php
            $settings = parse_ini_file('application/config/config.ini');
            ?>
            Price:  <strong>{{ htmlspecialchars($plan->price) }}</strong> - {{ $settings['ppcurrency'] }}
            <br />
            Length in days: <strong>{{ htmlspecialchars($plan->days) }}</strong>
            <br />
            Boot time: <strong> {{ htmlspecialchars($plan->time) }}</strong> seconds
            <br />
            Concurrents attacks: <strong> {{ htmlspecialchars($plan->concurrent) }} </strong>
            <br />
            <br />


            <form name="_xclick" action="https://www.paypal.com/cgi-bin/webscr" method="post">
                <input type="hidden" name="cmd" value="_xclick">
                <input type="hidden" name="business" value="{{ $settings['ppemail'] }}">
                <input type="hidden" name="currency_code" value="{{ $settings['ppcurrency'] }}">

                <input type="hidden" name="item_name" value="{{ $plan->name }}">
                <input type="hidden" name="amount" value="{{ $plan->price }}">

                <input type="hidden" name="on0" value="User ID">
                <input type="hidden" name="os0" value="{{ Auth::user()->id }}">
                <input type="hidden" name="on1" value="Plan ID">
                <input type="hidden" name="os1" value="{{ $plan->id }}">

                <input type="hidden" name="custom" value="plan">

                <input type="hidden" name="no_note" value="1">
                <input type="hidden" name="no_shipping" value="1">


                <input type="hidden" name="notify_url" value="http://{{ $_SERVER['SERVER_NAME'] }}/plan/process/">
                <input type="hidden" name="return" value="http://{{ $_SERVER['SERVER_NAME'] }}/plan/paid/">
                <input type="hidden" name="cancel_return" value="http://{{ $_SERVER['SERVER_NAME'] }}/plan/cancel/">

                <input type="submit" name="submit" class="btn btn-danger" value="Purchase plan">

            </form>


        </div>
    @endforeach
<div style="clear:both"></div>
@endsection