@layout('main')


@section('content')
    @if(empty($plans))
        <div class="alert alert-danger">
            You have no plans set up yet, <a href="/admin/plan/new">click here to create a new plan!</a>
        </div>
    @else
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
        <div class="btn-group">
        <a href="/admin/plan/edit/{{$plan->id}}" class="btn btn-danger btn-small"> Edit plan </a>
        <a href="/admin/plan/delete/{{$plan->id}}" class="btn btn-danger btn-small"> Delete </a>
        </div>


    </div>

    @endforeach
    @endif
<div style="clear:both"></div>
@endsection