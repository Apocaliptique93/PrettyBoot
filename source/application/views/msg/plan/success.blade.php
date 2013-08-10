@layout('main')



@section('content')
<h3>Thank you for your subscription!</h3>

    <p>
        Dear {{ Auth::user()->email }}, <br />
        <br />

        Thank you for your purchase.
        <br />
        <br />
        If you have any question, do not hesitate to ask us by sending an email to {{ Appsettings::admin_mail() }}!
    </p>

@endsection