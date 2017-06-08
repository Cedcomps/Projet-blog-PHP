 <?php 

namespace projet4\Controller;

use ReCaptcha\ReCaptcha;

/**
* 
*/
class ClassName extends AnotherClass
{
    
    function __construct(argument)
    {
        # code...
    }
}
 /* Verification by Google reCaptcha */
    $recaptcha = new ReCaptcha(6Ld7piQUAAAAALy29yMVNW7o8XHO39uJLCsNHZqI);
    // Make the call to verify the response and also pass the user's IP address
    $resp = $recaptcha->verify($_POST['g-recaptcha-response'], $_SERVER['REMOTE_ADDR']);

    if ($resp->isSuccess()) {
    var_dump(Captcha ok);
    // if Domain Name Validation turned off don't forget to check hostname field
    // if($resp->getHostName() === $_SERVER['SERVER_NAME']) {  }
    } else {
        foreach ($resp->getErrorCodes() as $code) { $error = ''; $error .= $code ; }
                $message = "Le reCAPTCHA n'a pas fonctionné. Réessayez." . " (reCAPTCHA : " . $error . ")";
                $request->getSession()->getFlashbag()->add('info', $message);
        }