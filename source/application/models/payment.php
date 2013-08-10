<?php

class Payment extends Eloquent
{
	public static $timestamps = false;
	public static $table = 'payments';
	




    public static function verifyPlan($data)
    {
        Log::write('PayPal', 'Verifying plan');
        $plan = Plan::find($data['option_selection2']);
        if(empty($plan))
        {
            Log::write('PayPal', 'Plan verify: Plan does not exist');
            return View::make('msg.error')->with('error', 'Plan does not exist.');
        }
        if($plan->price != $data['mc_gross'])
        {
            Log::write('PayPal', 'Plan price does not match PayPal\'s return price');
            return View::make('msg.error')->with('error', 'Prices do not match');
        }
        $user = User::find($data['option_selection1']);
        if(empty($user))
        {
            Log::write('PayPal', 'Plan verify: User does not exist');
            return View::make('msg.error')->with('error', 'User does not exist.');
        }
        $user->planMake($plan->days, $plan->time, $plan->concurrent);
        Log::write('PayPal', 'Plan verifying: checks done, plan given');
        return true;
    }

    public static function verifyBlacklist($data)
    {
        $settings = IniHandle::readini();
        if($data['custom'] == 'blacklist_skype')
        {
            $price = $settings['skypebl'];
        }
        elseif($data['custom'] == 'blacklist_ip')
        {
            $price = $settings['ipbl'];
        }
        else
        {
            Log::write('PayPal', 'No custom parameter, could not get product(Blacklist:skype/IP)');
            return;
        }

        Log::write('PayPal', 'Verifying Blacklist');
        $user = User::find($data['option_selection1']);
        if(empty($user))
        {
            Log::write('PayPal', 'Blacklist verify: User does not exist');
            return View::make('msg.error')->with('error', 'User does not exist.');
        }
        if($data['mc_gross'] != $price)
        {
            Log::write('PayPal', 'Blacklist verify: prices do not match');
            return View::make('msg.error')->with('error', 'Prices do not match');
        }
        if(Custblacklist::where('blacklist', '=', $data['option_selection2'])->count() != 0)
        {
            Log::write('PayPal', 'Blacklist verify: Blacklist variable already exists: '.$data['option_selection2']).' -> continue process though';
            return true;
        }

        Custblacklist::create(
            array(
                'user_id' => $data['option_selection1'],
                'blacklist' => strtolower($data['option_selection2']),
                'type' => ($data['custom'] == 'blacklist_skype') ? 'skype' : 'ip',
                'transaction_id' => $data['txn_id']
            )
        );

        Log::write('PayPal', 'Blacklist verify: succeeded added blacklist: '.$data['option_selection2']);
        return true;

    }

}





