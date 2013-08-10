@layout('main')

@section('script')

<script>
    $(document).ready( function()
    {
        $.get('/booter/onlineservers', function(data)
        {
            $('#servers_online').html(data);
        });
    });
</script>

@endsection


@section('content')


<div class="span12">
    <div class="accordion" id="collapse-adminpanel">
        <div class="accordion-group">
            <div class="accordion-heading admin-collapse">
                <a class="accordion-toggle" data-toggle="collapse" data-parent="#collapse-adminpanel" href="#collapseNews">
                    News
                </a>
            </div>
            <div id="collapseNews" class="accordion-body acc-body collapse">
                <div class="accordion-inner admin-inner">

                    <div class="span4 offset1">
                        <h4>Statistics:</h4>
                        <table>
                            <tbody>
                            <tr><td>Items:</td> <td><strong>{{ News::count() }}</strong></td></tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="span4 offset1">
                    <h4>Actions</h4>
                    <ul class="admin-list">
                        <li>
                            {{ HTML::link('/admin/news/overview','Overview') }}
                        </li>
                        <li>
                            {{ HTML::link('/admin/news/new','New item') }}
                        </li>
                    </ul>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>

            <div class="accordion-heading admin-collapse">
                <a class="accordion-toggle" data-toggle="collapse" data-parent="#collapse-adminpanel" href="#collapseUsers">
                    Users
                </a>
            </div>
            <div id="collapseUsers" class="accordion-body acc-body collapse">
                <div class="accordion-inner admin-inner">
                    <div class="span4 offset1">
                        <h4>Statistics:</h4>
                        <table>
                            <tbody>
                            <tr><td>Users:</td> <td><strong>{{ User::count() }}</strong></td></tr>
                            <tr><td>Admins:</td> <td><strong>{{ User::where('group', '=', 3)->count() }}</strong></td></tr>
                            <tr><td>Moderators:</td> <td><strong>{{ User::where('group', '=', 2)->count() }}</strong></td></tr>
                            <tr><td>Banned:</td> <td><strong>{{ User::where('ban_expiry_date', '>', date('Y-m-d H:i:s', time()))->count() }}</strong></td></tr>
                            <tr><td>Active plans:</td> <td><strong>{{ User::where(DB::raw('DATE(plan_expiry_date)'), '>', DB::raw('CURDATE()'))->count() }}</strong></td></tr>
                            <?php $time = date('Y-m-d H:i:s', (time() - 600) ); ?>
                            <tr><td>Online users:</td><td><strong>{{ User::where('updated_at', '>', $time)->count() }}</strong></td></tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="span4 offset1">
                        <h4>Actions</h4>
                        <ul class="admin-list">
                            <li>
                                {{ HTML::link('/admin/users/list','User list') }}
                            </li>
                            <li>
                                {{ HTML::link('/admin/users/search','Search for user') }}
                            </li>
                        </ul>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>


            <div class="accordion-heading admin-collapse">
                <a class="accordion-toggle" data-toggle="collapse" data-parent="#collapse-adminpanel" href="#collapseBooter">
                    Booter
                </a>
            </div>
            <div id="collapseBooter" class="accordion-body acc-body collapse">
                <div class="accordion-inner admin-inner">

                    <div class="span4 offset1">
                        <h4>Statistics:</h4>
                        <table>
                            <tbody>
                            <tr><td>Servers:</td> <td><strong>{{ Server::count() }}</strong></td></tr>
                            <tr><td>Online servers:</td> <td><strong><span id="servers_online">x</span></strong></td></tr>
                            <tr><td>Attacks:</td> <td><strong>{{ Attack::count() }} </strong></td></tr>
                            <tr><td>Running attacks:</td> <td><strong>{{ Attack::where( DB::raw('(created_at + INTERVAL time SECOND)'), '>', DB::raw( 'NOW()' ) )->count()  }}</strong></td></tr>
                            <tr><td>Blocked hosts:</td> <td><strong>{{Blacklist::count() }}</strong></td></tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="span4 offset1">
                        <h4>Actions</h4>
                        <ul class="admin-list">
                            <li>
                                {{ HTML::link('/admin/server/overview', 'Server/API overview') }}
                            </li>
                            <li>
                                {{ HTML::link('/admin/server/add', 'Add server/API') }}
                            </li>
                            <li>
                                {{ HTML::link('/admin/booter/methods', 'Manage booter methods') }}
                            </li>
                            <li>
                                {{ HTML::link('/admin/booter/skype', 'Skype API') }}
                            </li>
                            <li>
                                {{ HTML::link('/admin/blacklist/overview', 'Blocked hosts overview') }}
                            </li>
                            <li>
                                {{ HTML::link('/admin/blacklist/add', 'Add blocked hosts') }}
                            </li>
                            <li>
                                {{ HTML::link('/admin/blacklist/sales', 'Buyable blacklist overview') }}
                            </li>
                            <li>
                                {{ HTML::link('/admin/booter/history', 'Attack history') }}
                            </li>
                        </ul>
                        <div class="btn-group">
                            <a href="/admin/booter/on" class="btn btn-danger btn-mini">On&nbsp;</a>
                            <a href="/admin/booter/off" class="btn btn-danger btn-mini">Off</a>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>


            <div class="accordion-heading admin-collapse">
                <a class="accordion-toggle" data-toggle="collapse" data-parent="#collapse-adminpanel" href="#collapsePlan">
                    Sales
                </a>
            </div>
            <div id="collapsePlan" class="accordion-body acc-body collapse">
                <div class="accordion-inner admin-inner">

                    <div class="span4 offset1">
                        <h4>Statistics:</h4>
                        <table>
                            <tbody>
                            <tr><td>Plans:</td> <td><strong>{{ Plan::count() }}</strong></td></tr>
                            <tr><td>Sales:</td> <td><strong>{{ Payment::where('description', '=', 'Booter plan')->count() }}</strong></td></tr>

                            <tr><td>Skype blacklist sales:</td><td><strong>{{ Payment::where('description', '=', 'blacklist_skype')->count() }}</strong></td></tr>
                            <tr><td>IP blacklist sales:</td><td><strong>{{ Payment::where('description', '=', 'blacklist_ip')->count() }}</strong></td></tr>

                            <?php
                            $settings = parse_ini_file('application/config/config.ini');
                            ?>
                            <tr><td>Total PayPal earnings:</td> <td><strong>{{ Round(Payment::sum('amount'), 2) }} {{ $settings['ppcurrency'] }}</strong></td></tr>
                            <tr><td>Total PayPal fees:</td> <td><strong>{{ Round(Payment::sum('paypal_fee'), 2) }} {{ $settings['ppcurrency'] }}</strong></td></tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="span4 offset1">
                        <h4>Actions</h4>
                        <ul class="admin-list">
                            <li>
                                {{ HTML::link('/admin/plan/overview','Plan overview') }}
                            </li>
                            <li>
                                {{ HTML::link('/admin/plan/new','Add new plan') }}
                            </li>
                            <li>
                                {{ HTML::link('/admin/plan/blacklist', 'Blacklisting prices') }}
                            </li>
                            <li>
                                {{ HTML::link('/admin/transaction/overview', 'Transaction overview') }}
                            </li>
                        </ul>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>



            <div class="accordion-heading admin-collapse">
                <a class="accordion-toggle" data-toggle="collapse" data-parent="#collapse-adminpanel" href="#collapseSupport">
                    Support
                    @if(Ticket::where('solved', '=', 0)->count() > 0)
                        <span style="font-size: 40%; margin-right:-140px;">{{ Ticket::where('solved', '=', 0)->count() }} ticket(s) need attention</span>
                    @endif
                </a>
            </div>
            <div id="collapseSupport" class="accordion-body acc-body collapse">
                <div class="accordion-inner admin-inner">

                    <div class="span4 offset1">
                        <h4>Statistics:</h4>
                        <table>
                            <tbody>
                            <tr><td>Total created tickets:</td> <td><strong>{{ Ticket::count() }}</strong></td></tr>
                            <tr><td>Open tickets:</td> <td>{{ Ticket::where('solved', '=', 0)->count() }}</td></tr>
                            <tr><td>Solved tickets:</td> <td> {{ Ticket::where('solved', '=', 1)->count() }}</td> </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="span4 offset1">
                        <h4>Actions</h4>
                        <ul class="admin-list">
                            <li>
                                {{ HTML::link('/admin/support/overview','All tickets') }}
                            </li>
                            <li>
                                {{ HTML::link('/admin/support/open','Open tickets') }}
                            </li>
                            <li>
                                {{ HTML::link('/admin/support/solved','Solved tickets') }}
                            </li>
                        </ul>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>






            <div class="accordion-heading admin-collapse">
                <a class="accordion-toggle" data-parent="#collapse-adminpanel" href="/admin/settings">
                    Core application settings
                </a>
            </div>



        </div>

    </div>
</div>

@endsection