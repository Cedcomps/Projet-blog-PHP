<?php

namespace projet4\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use projet4\Domain\User;
use projet4\Form\Type\UserType;
use ReCaptcha\ReCaptcha;

class AuthController 
{
   /**
     * User login controller.
     *
     * @param Request $request Incoming request
     * @param Application $app Silex application
     */
    public function loginAction(Request $request, Application $app) {
        return $app['twig']->render('login.html.twig', array(
            'error'         => $app['security.last_error']($request),
            'last_username' => $app['session']->get('_security.last_username'),
        ));
    }
    /**
     * User register controller.
     *
     * @param Request $request Incoming request
     * @param Application $app Silex application
     */
    public function registerAction(Request $request, Application $app) {
        $user = new User();
        $userForm = $app['form.factory']->create(UserType::class, $user);
        $userForm->handleRequest($request);
        if ($userForm->isSubmitted() && $userForm->isValid()) {
            $recaptcha = new ReCaptcha('6Ld7piQUAAAAALy29yMVNW7o8XHO39uJLCsNHZqI');
            $resp = $recaptcha->verify($request->request->get('g-recaptcha-response'), $request->getClientIp());

            if (!$resp->isSuccess()) {
                foreach ($resp->getErrorCodes() as $code) {
                    $app['session']->getFlashBag()->add('info', 'Le reCAPTCHA n\'a pas fonctionné, veuillez réessayer (reCAPTCHA : ' . $code . ')');
                }
            } else {
                // Successfull Google reCaptcha validation 
                // generate a random salt value
                $salt = substr(md5(time()), 0, 23);
                $user->setSalt($salt);
                $plainPassword = $user->getPassword();
                // find the default encoder
                $encoder = $app['security.encoder.bcrypt'];
                // compute the encoded password
                $password = $encoder->encodePassword($plainPassword, $user->getSalt());
                $user->setPassword($password);
                $user->setRole('ROLE_USER');
                $app['dao.user']->save($user);
                $app['session']->getFlashBag()->add('success', 'Le compte utilisateur a été créé avec succès. Veuillez vous connecter.');
            }
        }
        return $app['twig']->render('register.html.twig', [
            'title'    => 'Enregistrement d\'un nouveau compte',
            'userForm' => $userForm->createView(),
        ]);
    }
}