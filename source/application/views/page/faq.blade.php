@layout('main')


@section('content')
<h2>Frequent Asked Questions</h2>
<p>These are the frequently asked questions, listed for your convenience.</p>

<ul class="faq">

    <li>
        <h4>
            What is a stresser?
        </h4>
        <p>
            A stresser is a tool that allows you to "stress test a network" the attempt is to feed the network with an enormous amount of dedicated packets attempting to crash the network.
        </p>
    </li>

    <li>
        <h4>Can I attack other people's network?</h4>
        <p>
            Short answer, yes. You can attack other people's network, but this should never be done without the network's administrator's permission.
        </p>
    </li>

    <li>
        <h4>How do I purchase {{ Appsettings::logo() }} stresser?</h4>
        <p>
            First you'll need to register an account, then log on to it and then select a subscription plan. Click on "purchase plan" and you'll be redirect to PayPal where you finish the payment.
            When done, you'll be redirected to here again and the plan will be added to your account.
        </p>
    </li>

    <li>
        <h4>Do you accept any other payment processors?</h4>
        <p>We're sorry to inform you we currently don't.</p>
    </li>

    <li>
        <h4>What would happen if I stress tested someone for example on xBox Live?</h4>
        <p>Due to our servers being optimalised for stress testing servers that can handle high loads of concurrent requests, the targeted address will simply crash. We advise you never to target someone without their permission.</p>
    </li>

    <li>
        <h4>If I run into any problems, how can I contact you?</h4>
        <p>If you manage to run into problems you can simply contact us via the support ticket system, we'll get to you as soon as possible.</p>
    </li>

    <li>
        <h4>What are your plans like?</h4>
        <p>You can preview our plans over <a href="/products">here</a></p>
    </li>

</ul>


@endsection