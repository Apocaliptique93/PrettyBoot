<?php
/**
 * User: Rogier
 * Date: 10-4-13
 * Time: 21:51
 *
 */

class Custblacklist extends Eloquent {
    public static $timestamps = true;
    public static $table = 'blacklist_buy';

    public static function validateAdd($data)
    {
        $d = array();
        $d['user_id'] = Auth::user()->id;
        if($data['type'] == 0)
        {
            $d['blacklist'] = strtolower($data['bl']);
            $d['type'] = 'skype';
        }
        else
        {
            $d['blacklist'] = $data['bl'];
            $d['type'] = 'ip';
        }
        $d['transaction_id'] = 'Admin add';
        self::create($d);
        return Redirect::to('/admin/blacklist/sales');
    }
}