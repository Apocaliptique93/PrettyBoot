<?php
/**
 * User: Rogier
 * Date: 4-3-13
 * Time: 20:24
 *
 */
class Admin_Booter_Controller extends Base_Controller
{
    public $restful = true;

    public function __construct()
    {
        $this->filter('before', 'admin');
    }

    public function get_on()
    {
        $settings = IniHandle::readini();
        $settings['booterstatus'] = 1;
        IniHandle::write_ini_file($settings);
        return Redirect::to('/admin');
    }
    public function get_off()
    {
        $settings = IniHandle::readini();
        $settings['booterstatus'] = 0;
        IniHandle::write_ini_file($settings);
        return Redirect::to('/admin');
    }

    public function get_history()
    {
        return View::make('page.admin.booter.history')->with('history', Attack::order_by('created_at', 'DESC')->paginate(250));
    }

    public function get_methods()
    {
        $settings = IniHandle::readini();
        $methods = explode(',', $settings['methods']);
        $str = '';
        foreach($methods as $m)
        {
            $str.= $m."\n";
        }

        return View::make('page.admin.booter.methods')->with('methods', $str);
    }

    public function post_methods()
    {
        $methods = Input::get('methods');
        if(empty($methods)) return View::make('msg.error')->with('error', 'No methods given');
        $methods = preg_split( '/\r\n|\r|\n/', $methods);
        $m = '';
        foreach($methods as $met)
        {
            $m.=$met.',';
        }
        $m = substr_replace($m, '', -1);
        $settings = IniHandle::readini();
        $settings['methods'] = $m;
        IniHandle::write_ini_file($settings);
        return \Laravel\Redirect::to('/admin/booter/methods');
    }

    public function get_skype()
    {
        $settings = IniHandle::readini();
        return View::make('page.admin.booter.skype')->with('settings', $settings);
    }

    public function post_skype()
    {
        $skype = Input::get('api');
        $skype = trim($skype);
        $settings = IniHandle::readini();
        $settings['skypeapi'] = $skype;
        IniHandle::write_ini_file($settings);
        return \Laravel\Redirect::to('/admin/booter/skype');
    }
}
