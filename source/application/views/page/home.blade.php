@layout('main')


@section('content')

<div class="span5">
    {{ Appsettings::logo() }}
    <div class="clearfix"></div>
    <p>
        The new booter on the web. Custom built to create a better and stunning performance.
    </p>
    <h5>Why choose for us?</h5>


         <ul>
            <li>Speed</li>
            <li>99.9% uptime</li>
            <li>Always optimal Gbps</li>
            <li>Easy to use</li>
            <li>Supports PayPal Autobuy!</li>
            <li><span style="font-weight: bold">Always cheap</span></li>
        </ul>

</div>

<div class="span4 offset2">
    <h3>Get started right now!</h3>


        <ol>
            <li>
                Create an account
            </li>
            <li>
                Select your plan
            </li>
            <li>
                Finish payment on PayPal
            </li>
            <li>Start booting, no waiting times guaranteed!</li>
        </ol>

        <a href="/user/register" class="btn btn-danger btn-block">Create an account </a>
        <h5 style="width:100%; text-align:center;">Or</h5>
        <a href="/user/login" class="btn btn-danger btn-block">Login</a>

</div>
@endsection

