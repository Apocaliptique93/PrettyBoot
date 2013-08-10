<!DOCTYPE html>
<html>
<head>
    @yield('meta')
    {{ HTML::script('http://code.jquery.com/jquery-latest.min.js') }}
    {{-- HTML::script('/js/jquery-1.7.2.min.js') --}}
    {{ HTML::script('//ajax.googleapis.com/ajax/libs/jqueryui/1.10.1/jquery-ui.min.js') }}

    {{ HTML::script('/js/jquery-ui-timepicker-addon.js') }}

    {{ HTML::script('/js/jquery.cookie.js') }}
    {{ HTML::script('/js/bootstrap.min.js') }}
    {{ HTML::style('/css/bootstrap.css') }}
    {{ HTML::style('http://code.jquery.com/ui/1.10.1/themes/base/jquery-ui.css') }}
    {{ HTML::style('/css/layout.css') }}

    {{ HTML::style('/css/jquery-ui-timepicker-addon.css') }}


    <script>
        $(document).ready(function()
        {
            $('#ptop').click(function()
            {
                $('html, body').animate({scrollTop:0}, 'slow');
            });
            $('#pbot').click(function()
            {
                $('html, body').animate({
                            scrollTop: $(document).height()-$(window).height()},
                        'slow',
                        'swing'
                );
            });


            // @if(Auth::check())

                $('#account-info-btn').click(function()
                {
                    $.cookie('ai', 1, { expires: 365, path: '/' });
                });
                $('#account-info-hdn-btn').click(function()
                {
                    $.cookie('ai', 0, { expires: 365, path: '/' });
                });

            // @endif

        });
    </script>

    @yield('script')
    <title>{{ Appsettings::page_title() }}</title>
</head>

<body>

<div class="nav-wrap">
    <div class="navbar navbar-fixed-top navbar-inverse">
        <div class="navbar-inner">
            <a href="/" class="brand" style="padding-left:50px;">{{ Appsettings::logo() }}</a>
            <div class="nav-collapse pull-right" style="padding-right:200px;">
                <ul class="nav">
                    <li>
                        <a href="/">Home</a>
                    </li>
                    <li class="divider-vertical"></li>


                    @if(Auth::check())
                    <li>
                        <a href="/booter">Booter</a>
                    </li>
                    <li>
                        <a href="/plan">Purchase plan</a>
                    </li>
                    <li class="divider-vertical"></li>
                    @if(Auth::user()->isAdmin())
                    <li>
                        <a href="/admin">Admin</a>
                    </li>
                    <li class="divider-vertical"></li>
                    @endif
                    <li>
                        <a href="/user/logout">Logout</a>
                    </li>

                    @else
                        <li>
                            <a href="/user/register">Register</a>
                        </li>
                        <li>
                            <a href="/user/login">Login</a>
                        </li>

                    @endif
                        <li class="divider-vertical"></li>
                        <li>
                            <a style="cursor:pointer;" id="ptop"><i class="icon-arrow-up"> </i></a>
                        </li>
                        <li>
                            <a style="cursor:pointer;" id="pbot"><i class="icon-arrow-down"> </i></a>
                        </li>

                </ul>
            </div>
        </div>
    </div>
</div>

@if(Auth::check())
<div class="hdn-btn-container">
    <h4 id="account-info-hdn-btn">Show Account Info</h4>
</div>
    <div class="account-info">
        @if(Auth::user()->hasPlanExpired())
            <a href="/plan" class="btn btn-danger btn-block btn-small" style="margin-bottom:10px;border-radius:0px;">You don't have a plan set up! Click here to get a plan</a>
        @endif
        <h4 title="Click to hide" id="account-info-btn">Account info</h4>
        <div style="width:900px; margin:0 auto; margin-top: -10px;">
            <div style="min-width:20%; float:left; text-align:center;">
                <strong>Email:</strong><br />
                <span style="color: #999999">{{ Auth::user()->email }}</span>
            </div>
            <div style="min-width:20%; float:left; text-align:center;">
                <strong>Plan expiry date:</strong><br />
                <span style="color: #999999">{{ Auth::user()->planExpiryDate() }}</span>
            </div>
            <div style="min-width:20%; float:left; text-align:center;">
                <strong>Booter status: </strong><br />
                <strong>
                @if(Booter::status() == true)
                    <span style="color: #008300">
                        Online
                    @else
                    <span style="color: #870500">
                        Offline
                    @endif

                </span>
                </strong>
            </div>
            <div style="min-width:20%; float:left; text-align:center;">
                <strong>Boot time limit:</strong><br />
                <span style="color: #999999">{{ Auth::user()->time }} seconds</span>
            </div>
            <div style="min-width:20%; float:left; text-align:center;">
                <strong>Attacks: </strong><br />
                <span style="color: #999999">{{ Auth::user()->attacks()->count() }} <span style="font-size:75%; padding-left:10px;">{{ HTML::link('/booter/history', 'History')}}</span></span>
            </div>


        </div>
        <div style="clear:both;"></div>



    </div>
@endif


<div class="content">

    @yield('content')
<div class="clearfix"></div>
</div>

</body>


</html>