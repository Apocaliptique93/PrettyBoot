<?php
/**
 * User: Rogier
 * Date: 18-2-13
 * Time: 16:35
 *
 */
class Appsettings
{


    public static function getSetting()
    {
        $data = IniHandle::readini();
        return $data;
    }

    public static function page_title()
    {
        $d = self::getSetting();
        return $d['pagetitle'];
    }
    public static function logo()
    {
        $data = self::getSetting();
        $part_1 = $data['name_part1'];
        $part_2 = $data['name_part2'];
        return '<div id="logo_txt"><span class="brand-one">'. $part_1 .'</span><span class="brand-two">'. $part_2 .'</span></div>';
    }

    public static function admin_mail()
    {
        $d = self::getSetting();
        return $d['admin_mail'];
    }

    public static function idkey()
    {
        $d = self::getSetting();
        return $d['idkey'];
    }

    public static function isCloudFlare($range)
    {
        list($subnet, $mask) = explode('/', $range);

        if ((ip2long($_SERVER["REMOTE_ADDR"]) & ~((1 << (32 - $mask)) - 1) ) == ip2long($subnet))
        {
            return true;
        }
        return false;
    }


}
