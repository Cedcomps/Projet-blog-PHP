<?php

namespace projet4\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use projet4\Domain\User;
use projet4\Form\Type\UserType;

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
}