<?php
class Admin_Settings_Controller extends Base_Controller
{
    public $restful = true;
    public function __construct()
    {
        $this->filter('before', 'admin');
    }

    public function get_index()
    {
        return View::make('page.admin.settings.index')->with('settings',IniHandle::readini());
    }

    public function post_key()
    {
        $settings = IniHandle::readini();
        $settings['idkey'] = htmlspecialchars(Input::get('key'));
        IniHandle::write_ini_file($settings);
        return Redirect::to('/admin/settings');
    }

    public function post_title()
    {
        $settings = IniHandle::readini();
        $settings['pagetitle'] = htmlspecialchars(Input::get('title'));
        IniHandle::write_ini_file($settings);
        return Redirect::to('/admin/settings');
    }

    public function post_logo()
    {
        $settings = IniHandle::readini();
        $settings['name_part1'] = htmlspecialchars(Input::get('part1'));
        $settings['name_part2'] = htmlspecialchars(Input::get('part2'));
        IniHandle::write_ini_file($settings);
        return Redirect::to('/admin/settings');
    }

    public function post_mail()
    {
        $settings = IniHandle::readini();
        $settings['admin_mail'] = htmlspecialchars(Input::get('mail'));
        IniHandle::write_ini_file($settings);
        return Redirect::to('/admin/settings');
    }

    public function post_paypal()
    {
        $settings = IniHandle::readini();
        $settings['ppemail'] = Input::get('ppemail');
        $settings['ppcurrency'] = htmlspecialchars(Input::get('currency'));
        IniHandle::write_ini_file($settings);
        return Redirect::to('/admin/settings');
    }

    public function get_dump()
    {
        $settings = IniHandle::readini();
                $methods = $settings['methods'];
                $api = $settings['skypeapi'];
                $skypebl = $settings['skypebl'];
                $ipbl = $settings['ipbl'];
        $result = array();
        foreach($settings as $key => $value)
        {
            $result[$key] = '';
        }
        $result['pagetitle'] = 'PrettyBoot';
        $result['name_part1'] = 'Pretty';
        $result['name_part2'] = 'Boot';
        $result['booterstatus'] = 1;
        $result['methods'] = $methods;
        $result['skypeapi'] = $api;
        $result['skypebl'] = $skypebl;
        $result['ipbl'] = $ipbl;
        $result['ppcurrency'] = 'USD';
        IniHandle::write_ini_file($result);
        return Redirect::to('/admin/settings');
    }
}