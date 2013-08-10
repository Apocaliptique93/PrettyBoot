Laravel-PayPal-IPN
==============

A Laravel bundle to work with the PayPal Instant Payment Notification (IPN) System. 
This bundle is based on the IPNListener Class from Micah Carrick. 
https://github.com/Quixotix/PHP-PayPal-IPN
 


Setup
--------

Install the bundle  

	$ php artisan bundle:install paypal-ipn

Include it in application/bundles.php  

	return array('paypal-ipn');


Example Usage
--------

For example add a route, which will act as your PayPal IPN Url.

	Route::post('paypal', function()
	{
		Bundle::start('paypal-ipn'); // Start Bundle
    $listener = new IpnListener(); // Instanciate IpnListener 
    $listener->use_sandbox = true; // PayPal Sandbox Acccount for testing
    
    try {
      $listener->requirePostMethod();
      $verified = $listener->processIpn();
    } catch (Exception $e) {
    	Log::info($e->getMessage());
    }
    
    if ($verified) {
        // IPN response was "VERIFIED"
    } else {
        // IPN response was "INVALID"
    }
    
	});
