@layout('main')



@section('content')

<div class="alert alert-danger">
    <h3>So yeah.. uh...</h3>
        <p>{{ ucfirst($user->email) }}, unfortunately you have been banned. <br />
            This most likely happened due to breaking the rules.

            <br /><br />
            The reason for your ban:
            <br />
            <span style="font-style: italic">
                {{ htmlspecialchars($user->ban_reason) }}
            </span>
            <br /><br />
            Your ban will be lifted on {{ date('Y-m-d H:i', strtotime($user->ban_expiry_date)) }}
            <br />
            The current server time is {{ date('Y-m-d H:i:s', time()) }} with timezone being {{ Config::get('application.timezone') }}.

        </p>
        <p>
            If you feel like discussing your ban with the administrator, mail them at this address:
            <br /> <a href="mailto:{{ Appsettings::admin_mail()}}">{{ Appsettings::admin_mail() }}</a>
        </p>
</div>
@endsection