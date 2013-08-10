
<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{ Appsettings::page_title() }}</title>

    @yield('meta')
    {{ HTML::script('http://code.jquery.com/jquery-latest.min.js') }}
    {{-- HTML::script('js/jquery-1.7.2.min.js') --}}
    {{ HTML::script('http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.1/jquery-ui.min.js') }}

    {{ HTML::script('js/jquery-ui-timepicker-addon.js') }}

    {{ HTML::script('js/jquery.cookie.js') }}
    {{ HTML::script('js/bootstrap.min.js') }}
    {{ HTML::style('css/bootstrap.css') }}
    {{ HTML::style('http://code.jquery.com/ui/1.10.1/themes/base/jquery-ui.css') }}
    {{-- HTML::style('css/layout.css') --}}
    {{ HTML::style('css/layout-n.css') }}


    {{ HTML::style('/css/jquery-ui-timepicker-addon.css') }}
    <script>
        $(document).ready(function()
        {
            // @if(Auth::check())

            $('#account-info-btn').click(function()
            {
                if($('#acI').hasClass('in'))
                {
                    $.cookie('ai', 0, { expires: 365, path: '/' });
                }
                else
                {
                    $.cookie('ai', 1, { expires: 365, path: '/' });
                }
            });


            // @endif

        });
    </script>
    @yield('script')
</head>




<body>
<div>
    <div class="header">
        <span class="header_logo"><a href="/">{{ Appsettings::logo() }}</a></span>

        <div class="pull-right header_menu">
            <ul>
                @if(!Auth::check())
                    <li>
                        <a href="/user/register">Register</a>
                    </li>
                    <li class="vertical-divider"></li>

                    <li>
                        <a href="/user/login">Login</a>
                    </li>
                @else
                    <li>
                        <a href="/user/settings">Settings</a>
                    </li>
                    <li class="vertical-divider"></li>
                    <li>
                        <a href="/support">Support</a>
                    </li>
                    <li class="vertical-divider"></li>
                    <li>
                        <a href="/user/logout">Logout</a>
                    </li>
                @endif
            </ul>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="header_border"></div>
    <div class="clearfix"></div>
</div>


    <div class="menu">

        <div class="items">

            <ul>
                <li id="menu_caption" class="li_bot_border">
                    <span style="padding-left:5px;">MENU</span>
                </li>
                @if(Auth::check())
                    <li class="li_top_border li_bot_border  <?php if(URI::segment(1) == '') echo 'menu-active'; ?>">
                        <a href="/">Home</a>
                    </li>
                    <li class="li_top_border li_bot_border <?php if(URI::segment(1) == 'booter') echo 'menu-active'; ?>">
                        <a href="/booter">Booter</a>
                    </li>
                    <li class="li_top_border li_bot_border  <?php if(URI::segment(1) == 'plan') echo 'menu-active'; ?>">
                        <a href="/plan">Subscription plan</a>
                    </li>
                    <li class="li_top_border li_bot_border  <?php if(URI::segment(1) == 'buy') echo 'menu-active'; ?>">
                        <a href="/buy/blacklist">Buy blacklisting</a>
                    </li>


                    @if(Auth::user()->isAdmin())
                        <li class="li_top_border li_bot_border <?php if(URI::segment(1) == 'admin') echo 'menu-active'; ?>">
                            <a href="/admin">Admin panel</a>
                            <br/>
                            @if(Ticket::where('solved', '=', 0)->count() == 1)
                            <a href="/admin/support" style="font-size: 70%">{{ Ticket::where('solved', '=', 0)->count() }} ticket needs attention</a>
                            @elseif(Ticket::where('solved', '=', 0)->count() > 1)
                            <a href="/admin/support" style="font-size: 70%">{{ Ticket::where('solved', '=', 0)->count() }} tickets need attention</a>
                            @endif
                        </li>
                    @elseif(Auth::user()->isMod())
                    <li class="li_top_border li_bot_border <?php if(URI::segment(1) == 'mod') echo 'menu-active'; ?>">
                        <a href="/mod/">Moderator panel</a>
                        <br/>
                        @if(Ticket::where('solved', '=', 0)->count() == 1)
                        <a href="/admin/support" style="font-size: 70%">{{ Ticket::where('solved', '=', 0)->count() }} ticket needs attention</a>
                        @elseif(Ticket::where('solved', '=', 0)->count() > 1)
                        <a href="/admin/support" style="font-size: 70%">{{ Ticket::where('solved', '=', 0)->count() }} tickets need attention</a>
                        @endif
                    </li>
                    @endif
                <li class="li_top_border">
                    <div class="accordion" id="accordion2">
                        <div class="accordion-group">
                            <div class="accordion-heading">
                                <a id="account-info-btn" class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#acI">
                                    Account info
                                </a>
                            </div>
                            <div id="acI" class="accordion-body collapse
                                @if(isset($_COOKIE['ai']))
                                    @if($_COOKIE['ai'] == 1)
                                        in
                                    @endif
                                @endif
                            ">
                                <div class="accordion-inner">
                                <table>
                                    <tbody>
                                        <tr><th>Account:</th></tr>
                                        <tr><td> {{htmlspecialchars(Auth::user()->email) }}</td></tr>
                                        <tr><th>Plan expiry date:</th></tr>
                                        <tr><td>{{ Auth::user()->planExpiryDate() }} <br /> <span style="font-size:80%;">{{ Auth::user()->planDaysLeft() }} days left</span></td></tr>
                                        <tr><th>Boot time limit:</th></tr>
                                        <tr><td>{{ Auth::user()->time }} seconds</td></tr>
                                        <tr><th>Attacks:</th></tr>
                                        <tr><td>{{ Auth::user()->attacks()->count() }} <span style="font-size:75%; padding-left:2px;">{{ HTML::link('/booter/history', ' - History')}}</span></td></tr>
                                    </tbody>
                                </table>
                                </div>
                            </div>
                        </div>

                    </div>
                </li>
                @else
                    <li class="li_top_border li_bot_border <?php if(URI::segment(2) == 'login') echo 'menu-active'; ?>">
                        <a href="/user/login">Login</a>
                    </li>
                    <li class="li_top_border li_bot_border <?php if(URI::segment(2) == 'register') echo 'menu-active'; ?>">
                        <a href="/user/register">Register</a>
                    </li>
                    <li class="li_top_border"></li>
                @endif
            </ul>
        </div>
    </div>


<div class="content-wrap">
    <div>
        <div class="page_id">
            <div class="page">

                <?php $cur = URI::segment(1);
                        $cur = htmlspecialchars($cur); ?>
                @if(!empty($cur))
                <?php $url = explode('/',URI::current());
                    $str = '';
                    for($i=1; $i < count($url); $i++)
                {
                    $str .= ' / '.htmlspecialchars(ucfirst($url[$i]));
                }?>
                <a href="/{{URI::segment(1)}}">{{ htmlspecialchars(ucfirst(URI::segment(1))) }}</a>
                <span style="font-size:75%">{{ htmlspecialchars($str) }}</span>
                @else
                    <a href="/">Home</a>
                @endif
            </div>
        </div>
        <div class="page_id_border"></div>
    </div>
    <div class='content'>
        @yield('content')
        <div class="clearfix"></div>

    </div>


    <div class="clearfix"></div>
    <div class="page_id_border_bottom"></div>
    <div class="page_id_bottom">
        {{ Appsettings::page_title() }}
    </div>
    <div class="clearfix"></div>
    <div style="padding:10px;">&nbsp;</div>
</div>




</body>


</html>