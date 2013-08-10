<?php
/**
 * User: Rogier
 * Date: 3-3-13
 * Time: 18:09
 *
 */
class Blacklist extends Eloquent
{
    public static $timestamps = true;
    public static $table = 'blacklist';

    public function __constuct()
    {
        if($this->check() === false) return $this->error();
    }

    public function creator()
    {
        return $this->belongs_to('User', 'user_id');
    }
    public static function add($friend)
    {
        $hosts = preg_split('/\r\n|\r|\n/', $friend);
        foreach($hosts as $entry)
        {
            $entry = explode('=', $entry);

            Blacklist::create(array(
                'user_id' => Auth::user()->id,
                'ip' => $entry[0],
                'desc' => (!empty($entry[1]) ? $entry[1] : 'none')
            ));

        }
        return Redirect::to('/admin/blacklist/overview');
    }



    public static function error()
    {
        return View::make('msg.error')->with('error', 'Seems like this PrettyBoot copy is not legitimate.');
    }

}
