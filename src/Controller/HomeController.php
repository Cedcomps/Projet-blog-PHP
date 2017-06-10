<?php

namespace projet4\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use projet4\Domain\Comment;
use projet4\Form\Type\CommentType;
use ReCaptcha\ReCaptcha;

class HomeController {

    /**
     * Home page controller.
     *
     * @param Application $app Silex application
     */
    public function indexAction(Application $app) {
        $episodes = $app['dao.episode']->findAll();
        return $app['twig']->render('index.html.twig', array('episodes' => $episodes));
    }
    
    /**
     * episode details controller.
     *
     * @param integer $id Episode id
     * @param Request $request Incoming request
     * @param Application $app Silex application
     */
   public function episodeAction($id, Request $request, Application $app) {
        $episode = $app['dao.episode']->find($id);
        $commentFormView = null;
        if ($app['security.authorization_checker']->isGranted('IS_AUTHENTICATED_FULLY')) {
            // A user is fully authenticated : he can add comments
            $comment = new Comment();
            $comment->setEpisode($episode);
            $user = $app['user'];
            $comment->setAuthor($user);
            $commentForm = $app['form.factory']->create(CommentType::class, $comment);
            $commentForm->handleRequest($request);
            if ($commentForm->isSubmitted() && $commentForm->isValid()) {
                $app['dao.comment']->save($comment);
                $app['session']->getFlashBag()->add('success', 'Votre commentaire a été enregistré avec succès.');
            }
            $commentFormView = $commentForm->createView();
        }
        $comments = $app['dao.comment']->findAllByEpisode($id);
        
        return $app['twig']->render('episode.html.twig', array(
            'episode' => $episode,
            'comments' => $comments,
            'commentForm' => $commentFormView));
    }
    
}

//6Ld7piQUAAAAALy29yMVNW7o8XHO39uJLCsNHZqI key secret google

/* Verification by Google reCaptcha */
                // $recaptcha = new ReCaptcha('6Ld7piQUAAAAALy29yMVNW7o8XHO39uJLCsNHZqI');
                // // Make the call to verify the response and also pass the user's IP address
                // $resp = $recaptcha->verify($_POST['g-recaptcha-response'], $_SERVER['REMOTE_ADDR']);
                // if (!$resp->isSuccess()) {
                //     foreach ($resp->getErrorCodes() as $code) { $error = ''; $error .= $code ; }
                //             $message = "Le reCAPTCHA n'a pas fonctionné. Réessayez." . " (reCAPTCHA : " . $error . ")";
                //             $request->getSession()->getFlashbag()->add('info', $message); 
                // } else {      
                //    //
                // }