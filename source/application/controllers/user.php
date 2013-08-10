<?php
/**
 * User: Rogier
 * Date: 15-2-13
 * Time: 15:15
 *
 */

Class User_Controller extends Base_Controller
{
    public $restful = true;

    public function __construct()
    {
        $this->filter('before', 'guest')->only(array('register', 'login'));
        $this->filter('before', 'auth')->only(array('logout'));
    }

    public function get_index() { return \Laravel\Redirect::to('/'); }

    public function get_register()
    {
        return View::make('page.user.register');
    }

    public function post_register()
    {
        $data = Input::get();
        $data['ip'] = $_SERVER['REMOTE_ADDR'];
        $rules = array(
            'username' => 'required|min:5|max:40|unique:users,email',
            'password' => 'required|min:7|max:25|same:confirm_password',
            'confirm_password' => 'required',
            'ip' => 'unique:users,ip',
            'emailaddress' => 'required|email|unique:users,emailaddress'
        );
        $messages = array(
            'ip_unique' => 'There\'s already an account on this IP address.',
        );
        $validate = Validator::make($data, $rules, $messages);
        if($validate->fails())
        {
            $errors ='';
            foreach($validate->errors->all() as $e)
            {
                $errors .= $e . '<br />';
            }
            return View::make('msg.usererror')
                ->with('error', $errors)
                ->with('refresh', 'javascript:history.go(-1)');
        }

        $user_info = array(
                'email' => htmlentities($data['username']),
                'password' => Hash::make($data['password']),
                'ip' => $_SERVER['REMOTE_ADDR'],
                'emailaddress' => $data['emailaddress']
        );

        $user = new User($user_info);
        $user->save();

        $name = $data['username'];


        return View::make('msg.registered')
            ->with('email', $name[0]);
    }



    public function get_login()
    {
        return View::make('page.user.login');
    }

    public function post_login()
    {
        $data = Input::get();
        $credentials = array('username' => $data['username'], 'password' => $data['password'], 'remember' => true);

        if(!Auth::attempt($credentials))
        {
            return View::make('msg.usererror')
                ->with('error', 'Wrong username or password');
        }

        return View::make('msg.loggedin');
    }

    public function get_logout()
    {
        Auth::logout();
        return Redirect::to('/user/login');
    }


    public function get_forgot()
    {
        return View::make('page.user.forgot');
    }

    public function post_forgot()
    {
        $email = Input::get('emailaddress');
        if(empty($email)) return View::make('msg.usererror')->with('error', 'Email is empty.');
        $user = User::where('emailaddress', '=', Input::get('emailaddress'))->first();
        if(empty($user)) return View::make('msg.usererror')->with('error', 'That email isn\'t bound to an account.');
        return $user->resetPassword();
    }

    public function get_settings()
    {
        return View::make('page.user.settings.overview');
    }

    public function post_changepw()
    {
        $data = Input::get();
        return Auth::user()->changePassword($data);
    }

    public function post_changeea()
    {
        $data = Input::get('emailaddress');
        return Auth::user()->changeEmail($data);
    }

}