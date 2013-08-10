<?php
/**
 * User: Rogier
 * Date: 15-3-13
 * Time: 16:23
 *
 */

class Server extends Eloquent
{
    public static $timestamps = true;

    public static function validateAdd($data)
    {
        $data = array_map('trim', $data);
        if(strpos($data['url'], '?') !== false) $data['url'] = substr($data['url'], 0, strpos($data['url'], '?'));
        if(Server::where('url', '=', $data['url'])->count() > 0) return 'That server/API already exists';
        $d = array(
            'url' => $data['url'],
            'host' => $data['host'],
            'time' => $data['time'],
            'port' => $data['port'],
            'method' => $data['method'],
            'custom' => $data['custom']
        );
        self::create($d);
        return true;
    }

    public function getStatus()
    {
        $result = @get_headers($this->url);
        if($result[0] == 'HTTP/1.1 200 OK') return true;
        return false;
    }

    public function getStatusMarkup()
    {
        $result = @get_headers($this->url);
        if($result[0] == 'HTTP/1.1 200 OK')
        {
            return '<span style="color:#00ab00; text-shadow:0px 0px 1px #111;">Online</span>';
        }
        return '<span style="color:red;">Offline</span>';
    }

    public static function getOnline()
    {
        $cnt = 0;
        foreach(Server::all() as $s)
        {
            $url = $s->url;
            $result = @get_headers($url);
            if($result[0] == 'HTTP/1.1 200 OK') $cnt++;
        }
        return $cnt;
    }

}