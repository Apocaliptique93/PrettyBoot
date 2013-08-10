@layout('main')

@section('script')
<script>
    $(function() {
        $('input.datepicker').datetimepicker({
            minDate: new Date()
        });
    });
</script>

@endsection

@section('content')

<div class="span5">
    <h3><span style="font-style: italic; ">{{ $user->email }}</span></h3>
    @if($user->isBanned())
        <span class="brand-red">Banned</span> <span style="font-size:70%;"> until {{ date('n-j-Y', strtotime($user->ban_expiry_date)) }}</span>
        <br />
        <a href="/admin/users/baninfo/{{$user->id}}">View ban info</a>
    @endif


        <table class="profile_table">

            <tbody>
            <tr>
                <th>Group:</th>
                <td>
                    @if($user->isAdmin())
                    <span class="label label-important">Admin</span>
                    @elseif($user->isMod())
                    <span class="label label-info">Moderator</span>
                    @else
                    <span class="label" style="background: #4b4b4b">Member</span>
                    @endif
                </td>
            </tr>
            <tr>
                <th>IP address:</th> <td>{{ $user->ip }}</td>
            </tr>
                <tr>
                    <th>Plan expiry date:</th> <td>{{ $user->planExpiryDate() }}</td>
                </tr>



                <tr>
                    <th>Boot time limit:</th>
                    <td>{{ $user->time }} seconds</td>
                </tr>
                <tr>
                    <th>Concurrents allowed:</th>
                    <td>{{ $user->concurrent }}</td>
                </tr>
                <tr>
                    <th>Last visit:</th>
                    <td>{{ date('Y-m-d H:i', strtotime($user->updated_at)) }}</td>
                </tr>
            </tbody>
        </table>
</div>

<div class="span12" style="margin-top:25px;">
    <h3>Actions</h3>

            <div class="profile_actions_ban" style="width:100%; float:left;">
                <h4>Ban user</h4>
                {{ Form::open('/admin/users/actions/ban/'.$user->id, 'POST', array('class' => 'navbar-form pull-left')) }}
                {{ Form::text('reason', '' , array('placeholder' => 'Reason')) }}
                {{ Form::text('date', '', array('placeholder' => 'Ban expiry date', 'class' => 'datepicker', 'readonly' => 'readonly', 'style' => 'cursor:select;')) }}
                {{ Form::button('Ban user', array('class' => 'btn btn-danger', 'style' => 'margin-top:5px;')) }}
                {{ Form::close() }}
            </div>
            <div class="profile_actions_plan" style=" width:100%; text-align: right;">
                <h4>Plan actions</h4>
                <p>Give plan or edit expiry date
                    {{ Form::open('/admin/users/actions/plan/newdate/'.$user->id) }}
                    {{ Form::text('date', '', array('placeholder' => 'Expiry date', 'class' => 'datepicker input-small', 'readonly' => 'readonly', 'style' => 'cursor:select;')) }}
                    {{ Form::text('time', '', array('placeholder' => 'Max sec boots', 'class'=>'input-small')) }}
                    {{ Form::text('concurrent', '1', array('placeholder'=>'Concurrents' , 'class'=>'input-small') ) }}
                    {{ Form::button('Set plan', array('class' => 'btn btn-danger', 'style' => 'margin-top:-10px;')) }}
                    {{ Form::close() }}

                    {{ Form::open('/admin/users/actions/plan/remove/'.$user->id) }}
                        {{-- Check if user has active plan, if not give the button a disabled look --}}
                        <button class="btn btn-danger"
                            @if($user->hasPlanExpired())
                                disabled
                            @endif
                        >Remove plan</button>
                    {{ Form::close() }}
                </p>
            </div>
            <div class="profile_actions_attacks" style="width:100%; text-align:left;">
                <h4>Attacks</h4>
                {{ HTML::link('/admin/users/actions/history/show/'.$user->id, 'View attack history') }}
                {{ Form::open('/admin/users/actions/history/delete/'.$user->id) }}
                {{ Form::button('Clear attack history', array('class' => 'btn btn-danger', 'style' => 'margin-top:25px;')) }}
                {{ Form::close() }}
            </div>
            <div class="profile_actions_admin" style="width:100%; text-align: right">
                <h4>Group</h4>
                @if(!$user->isAdmin())
                    {{ Form::open('/admin/users/actions/admin/'.$user->id) }}
                    {{ Form::button('Make admin', array('class' => 'btn btn-danger')) }}
                    {{ Form::close() }}
                @endif

                @if(!$user->isMod())
                {{ Form::open('/admin/users/actions/mod/'.$user->id) }}
                {{ Form::button('Make moderator', array('class' => 'btn btn-danger')) }}
                {{ Form::close() }}
                @endif

                @if($user->isAdmin() || $user->isMod())
                    {{ Form::open('/admin/users/actions/member/'.$user->id) }}
                    {{ Form::button('Make member', array('class' => 'btn btn-danger')) }}
                    {{ Form::close() }}
                @endif
            </div>

</div>
@endsection