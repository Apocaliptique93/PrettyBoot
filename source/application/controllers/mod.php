<?php
/**
 * User: Rogier
 * Date: 28-4-13
 * Time: 15:19
 *
 */

class Mod_Controller extends Base_Controller {

    public $restful = true;

    public function __construct()
    {
        $this->filter('before', 'mod');
    }

    public function get_index()
    {
        return View::make('page.mod.index');
    }
    public function get_panel(){return Redirect::to('/mod/');}


}