@layout('main')


@section('content')
<p>An overview of our current plans along with their prices and other information</p>

@foreach($products as $plan)
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





</div>
@endforeach

@endsection