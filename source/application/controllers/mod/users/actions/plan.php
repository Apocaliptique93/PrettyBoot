<?php
/**
 * User: Rogier
 * Date: 22-2-13
 * Time: 17:12
 *
 */
class Mod_Users_Actions_Plan_Controller extends Base_Controller
{
    public $restful = true;
    public function __construct()
    {
        $this->filter('before', 'mod');
    }


    public function post_remove($id = NULL)
    {
        $user = User::find($id);
        if(empty($user))
        {
            return View::make('msg.error')->with('error', 'User doesn\'t exist.');
        }
        return $user->removePlan();
    }

}
