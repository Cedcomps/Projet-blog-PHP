<?php

namespace projet4\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use projet4\Domain\Comment;
use projet4\Form\Type\CommentType;

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
                $app['session']->getFlashBag()->add('success', 'Your comment was successfully added.');
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
