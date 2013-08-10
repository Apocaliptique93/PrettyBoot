<?php
/**
 * User: Rogier
 * Date: 10-4-13
 * Time: 20:15
 *
 */

class Buy_Blacklist_Controller extends Base_Controller {

    public $restful = true;
    public function __construct()
    {
        $this->filter('before', 'auth');
    }

    public function get_index()
    {
        $settings = IniHandle::readini();
        return View::make('page.buy.blacklist')->with('settings', $settings);
    }
}