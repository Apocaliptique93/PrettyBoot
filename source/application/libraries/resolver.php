<?php
/**
 * User: Rogier
 * Date: 3-3-13
 * Time: 17:09
 *
 */
class Resolver
{
    public static function cloudflareResolve($hostname)
    {
        if(empty($hostname)) return View::make('msg.errormn')->with('error', '<br />Empty URL to resolve');


        if($hostname != "")
        {
            $hostname = str_replace("http://", "",$hostname);
            $hostname = str_replace("https://", "",$hostname);
            $hostname = str_replace("/", "",$hostname);
            $hostname = str_replace("www.", "",$hostname);
            $hostname = str_replace("\"", "",$hostname);
            $hostname = str_replace("<a href=", "",$hostname);
            $hostname = str_replace("<", "",$hostname);

            $array = array("","www","mail","direct","connect","cpanel","ftp","forum","blog","m","dev","webmail","direct-connect");
            $count = count($array);
            $result = '<table style="margin-left:30px;"><tbody>';
            for ($i = 0; $i < $count; $i++) {

                $host = ($array[$i] != "" ? $array[$i] . "." : "") .$hostname;
                $result .= "<tr><td>".$host."</td><td style='padding-left:10px;'>".( gethostbyname($host) == $host ? "Not found"  : '' .gethostbyname($host) . '' )."</td></tr>";
            }
            $result .= '</tbody></table>';
            return $result;
        }
    }

    public static function skypeResolve($username)
    {
        if(empty($username)) return View::make('msg.errormn')->with('error', '<br />Invalid username.');
        if(Custblacklist::where('type', '=', 'skype')->where('blacklist', '=', $username)->count() > 0) return View::make('msg.errormn')->with('error', '<br />This Skype name is blocked from being resolved');

        $settings = IniHandle::readini();
        if(empty($settings['skypeapi']) || $settings['skypeapi'] == '')
        {
            $url = base64_decode('aHR0cDovL2luZmVybm9hcGkuY29tL3NreXBlLnBocD9hcGlrZXk9Y2M4NGNiOTQ3MmFkZmNhZWM2MTVmMjI4ZTgwMmY2ZWVjNWJiZDlkMSZ1c2VyPQ=='). $username;
        }
        else
        {
            $url = $settings['skypeapi'].$username;
        }

        $c = curl_init();
        curl_setopt($c, CURLOPT_URL, $url);
        curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($c);
        return '<br /><table style="margin-left:30px;"><tbody><tr><td>Username:</td><td>'. $username .'</td></tr><tr><td>IP:</td><td>'. $result .'</td></tr></tbody></table>';
    }

    public static function ipResolve($hostname)
    {
        if(empty($hostname)) return View::make('msg.errormn')->with('error', '<br />Invalid host.');
        $hostname = str_replace("http://", "",$hostname);
        $hostname = str_replace("https://", "",$hostname);
        $hostname = str_replace("/", "",$hostname);
        $hostname = str_replace("www.", "",$hostname);
        $hostname = str_replace("\"", "",$hostname);
        $hostname = str_replace("<a href=", "",$hostname);
        $hostname = str_replace("<", "",$hostname);
        $ip = gethostbyname($hostname);
        return '<br /><table style="margin-left:30px;"><tbody><tr><td>URL: </td><td>'. $hostname .'</td></tr><tr><td>IP:</td><td>'. $ip .'</td></tr></tbody></table>';
    }

    public static function geoResolve($ip)
    {
        if(Custblacklist::where('type', '=', 'ip')->where('blacklist', '=', $ip)->count() > 0) return View::make('msg.errormn')->with('error', '<br />This IP address cannot be geo resolved.');
        $url = base64_decode('aHR0cDovL2FwaS5pcGluZm9kYi5jb20vdjMvaXAtY2l0eS8/a2V5PTRiYTVkMmQ4MjI3NDk1NWRm
OTM3MTlkMDYxYjQ3YWE5NDhlYTUxMjk0MmRiZDljZjliMzYwMTNlNWQ4ZTc3ODQmaXA9').$ip.base64_decode('JmZvcm1hdD1qc29u');
        $c = curl_init();
        curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($c, CURLOPT_URL, $url);
        curl_setopt($c, CURLOPT_TIMEOUT, 10);
        $output = curl_exec($c);
        curl_close($c);
        $i =  json_decode($output, true);
        $info = array();
        foreach($i as $key => $val)
        {
            $info[$key] = ucfirst(strtolower($val));
        }
        $str = "
            <br /><table style=\"margin-left:30px;\"><tbody>
                <tr><td>IP address:</td><td>{$info['ipAddress']}</td></tr>
                <tr><td>Country:</td><td>{$info['countryName']}</td></tr>
                <tr><td>State/Province:</td><td>{$info['regionName']}</td></tr>
                <tr><td>City:</td><td>{$info['cityName']}</td></tr>
            </tbody>
            </table>
        ";
        return $str;
    }

    public static function downornot($url)
    {
        if (!preg_match("~^(?:f|ht)tps?://~i", $url)) {
            $url = "http://" . $url;
        }
        if(!filter_var($url, FILTER_VALIDATE_URL))
        {
            return 'Invalid URL';
        }
        $cl = curl_init($url);
        curl_setopt($cl,CURLOPT_CONNECTTIMEOUT,10);
        curl_setopt($cl,CURLOPT_HEADER,true);
        curl_setopt($cl,CURLOPT_NOBODY,true);
        curl_setopt($cl,CURLOPT_RETURNTRANSFER,true);
        $response = curl_exec($cl);
        curl_close($cl);
        if ($response) return 'Website is online!';
        return 'Website seems to be offline';
    }
}
