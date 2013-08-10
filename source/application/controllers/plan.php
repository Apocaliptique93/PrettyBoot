<?php
/**
 * User: Rogier
 * Date: 23-2-13
 * Time: 13:32
 *
 */
class Plan_Controller extends Base_Controller
{
    public $restful = true;
    public function __construct()
    {
        $this->filter('before', 'auth')->except(array('process'));
    }

    public function get_index()
    {
        return View::make('page.plan')->with('plans', Plan::all())->with('settings', IniHandle::readini());
    }


    public function post_process()
    {
        Log::write('PayPal', 'Trying to process IPN');
        Bundle::start('paypal-ipn');
        $listener = new IpnListener();
//        $listener->use_sandbox = true;

        try {
            $listener->requirePostMethod();
            $verified = $listener->processIpn();


        } catch (Exception $e) {
            Log::info($e->getMessage());
        }

        if ($verified) {
            Log::write('PayPal', 'IPN payment looks verified');
            $data = Input::get();
            $settings = IniHandle::readini();
            if(!in_array($data['payment_status'], array('Completed', 'COMPLETED', 'completed')))
            {
                Log::write('PayPal', 'payment not completed');
                return View::make('msg.error')->with('error', 'PayPal: payment not completed');
            }
            if(strtolower($data['receiver_email']) != strtolower($settings['ppemail']))
            {
                Log::write('PayPal', 'receive email not same as set in settings. Settings: '.$settings['ppemail'].' ||| PayPal email: '.$data['receiver_email']);
                return View::make('msg.error')->with('error', 'PayPal: receive email not same as set in settings');
            }
            if(Payment::where('transaction_id', '=', $data['txn_id'])->count() != 0)
            {
                Log::write('PayPal', 'transaction ID already exists');
                return View::make('msg.error')->with('error', 'PayPal: transaction ID already exists');
            }
            if(strtolower($data['mc_currency']) != strtolower($settings['ppcurrency']))
            {
                Log::write('PayPal', 'Currencies do not match');
                return View::make('msg.error')->with('error', 'PayPal: currencies do not match');
            }
            Log::write('PayPal', 'Got past all PLAN controller checks now going into CUSTOM');
            if(strtolower($data['custom']) == 'plan')
            {
                $result = Payment::verifyPlan($data);
                if(!$result)
                {
                    return $result;
                }
            }
            elseif(strtolower($data['custom']) == 'blacklist_skype' || strtolower($data['custom']) == 'blacklist_ip')
            {
                $result = Payment::verifyBlacklist($data);
                if(!$result)
                {
                    return $result;
                }
            }
            else
            {
                Log::write('PayPal', 'Custom not found, can\'t verify anything');
                return View::make('msg.error')->with('error', 'Fraudulent payment?');
            }

            Log::write('PayPal', 'Now trying to add Payment info to DB');
            $payment = Payment::create(array(
                'user_id' => $data['option_selection1'],
                'token' => $data['ipn_track_id'],
                'date' => date('Y-m-d H:i:s', time()),
                'ack' => $data['payment_status'],
                'transaction_id' => $data['txn_id'],
                'amount' => $data['mc_gross'],
                'paypal_fee' => $data['mc_fee'],
                'status' => $data['payment_status'],
                'description' => $data['custom']
            ));
            Log::write('PayPal', 'Successful payment, DB id: '.$payment->id);
        } else {
            Log::write('PayPal', 'IPN listener returns false on check');
        }
        return 'handled';
    }




    public function post_paid()
    {
        return View::make('msg.plan.success');
    }


    public function get_cancel()
    {
        return View::make('msg.plan.cancel');
    }

}
