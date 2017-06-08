<?php

namespace projet4\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use projet4\Domain\Episode;
use projet4\Domain\User;
use projet4\Form\Type\EpisodeType;
use projet4\Form\Type\CommentType;
use projet4\Form\Type\UserType;

class AdminController {

    /**
     * Admin home page controller.
     *
     * @param Application $app Silex application
     */
    public function indexAction(Application $app) {
        $episodes = $app['dao.episode']->findAll();
        $comments = $app['dao.comment']->findAll();
        $users = $app['dao.user']->findAll();
        return $app['twig']->render('admin.html.twig', array(
            'episodes' => $episodes,
            'comments' => $comments,
            'users' => $users));
    }

    /**
     * Add episode controller.
     *
     * @param Request $request Incoming request
     * @param Application $app Silex application
     */
    public function addEpisodeAction(Request $request, Application $app) {
        $episode = new Episode();
        $episodeForm = $app['form.factory']->create(EpisodeType::class, $episode);
        $episodeForm->handleRequest($request);
        if ($episodeForm->isSubmitted() && $episodeForm->isValid()) {
            $app['dao.episode']->save($episode);
            $app['session']->getFlashBag()->add('success', 'The episode was successfully created.');
        }
        return $app['twig']->render('episode_form.html.twig', array(
            'title' => 'New episode',
            'episodeForm' => $episodeForm->createView()));
    }

    /**
     * Edit episode controller.
     *
     * @param integer $id Episode id
     * @param Request $request Incoming request
     * @param Application $app Silex application
     */
    public function editEpisodeAction($id, Request $request, Application $app) {
        $episode = $app['dao.episode']->find($id);
        $episodeForm = $app['form.factory']->create(EpisodeType::class, $episode);
        $episodeForm->handleRequest($request);
        if ($episodeForm->isSubmitted() && $episodeForm->isValid()) {
            $app['dao.episode']->save($episode);
            $app['session']->getFlashBag()->add('success', 'The episode was successfully updated.');
        }
        return $app['twig']->render('episode_form.html.twig', array(
            'title' => 'Edit episode',
            'episodeForm' => $episodeForm->createView()));
    }

    /**
     * Delete episode controller.
     *
     * @param integer $id Episode id
     * @param Application $app Silex application
     */
    public function deleteEpisodeAction($id, Application $app) {
        // Delete all associated comments
        $app['dao.comment']->deleteAllByEpisode($id);
        // Delete the episode
        $app['dao.episode']->delete($id);
        $app['session']->getFlashBag()->add('success', 'The episode was successfully removed.');
        // Redirect to admin home page
        return $app->redirect($app['url_generator']->generate('admin'));
    }

    /**
     * Edit comment controller.
     *
     * @param integer $id Comment id
     * @param Request $request Incoming request
     * @param Application $app Silex application
     */
    public function editCommentAction($id, Request $request, Application $app) {
        $comment = $app['dao.comment']->find($id);
        $commentForm = $app['form.factory']->create(CommentType::class, $comment);
        $commentForm->handleRequest($request);
        if ($commentForm->isSubmitted() && $commentForm->isValid()) {
            $app['dao.comment']->save($comment);
            $app['session']->getFlashBag()->add('success', 'The comment was successfully updated.');
        }
        return $app['twig']->render('comment_form.html.twig', array(
            'title' => 'Edit comment',
            'commentForm' => $commentForm->createView()));
    }

    /**
     * Delete comment controller.
     *
     * @param integer $id Comment id
     * @param Application $app Silex application
     */
    public function deleteCommentAction($id, Application $app) {
        $app['dao.comment']->delete($id);
        $app['session']->getFlashBag()->add('success', 'The comment was successfully removed.');
        // Redirect to admin home page
        return $app->redirect($app['url_generator']->generate('admin'));
    }

    /**
     * Add user controller.
     *
     * @param Request $request Incoming request
     * @param Application $app Silex application
     */
    public function addUserAction(Request $request, Application $app) {
        $user = new User();
        $userForm = $app['form.factory']->create(UserType::class, $user);
        $userForm->handleRequest($request);
        if ($userForm->isSubmitted() && $userForm->isValid()) {
            // generate a random salt value
            $salt = substr(md5(time()), 0, 23);
            $user->setSalt($salt);
            $plainPassword = $user->getPassword();
            // find the default encoder
            $encoder = $app['security.encoder.bcrypt'];
            // compute the encoded password
            $password = $encoder->encodePassword($plainPassword, $user->getSalt());
            $user->setPassword($password); 
            $app['dao.user']->save($user);
            $app['session']->getFlashBag()->add('success', 'The user was successfully created.');
        }
        return $app['twig']->render('user_form.html.twig', array(
            'title' => 'New user',
            'userForm' => $userForm->createView()));
    }

    /**
     * Edit user controller.
     *
     * @param integer $id User id
     * @param Request $request Incoming request
     * @param Application $app Silex application
     */
    public function editUserAction($id, Request $request, Application $app) {
        $user = $app['dao.user']->find($id);
        $userForm = $app['form.factory']->create(UserType::class, $user);
        $userForm->handleRequest($request);
        if ($userForm->isSubmitted() && $userForm->isValid()) {
            $plainPassword = $user->getPassword();
            // find the encoder for the user
            $encoder = $app['security.encoder_factory']->getEncoder($user);
            // compute the encoded password
            $password = $encoder->encodePassword($plainPassword, $user->getSalt());
            $user->setPassword($password); 
            $app['dao.user']->save($user);
            $app['session']->getFlashBag()->add('success', 'The user was successfully updated.');
        }
        return $app['twig']->render('user_form.html.twig', array(
            'title' => 'Edit user',
            'userForm' => $userForm->createView()));
    }

    /**
     * Delete user controller.
     *
     * @param integer $id User id
     * @param Application $app Silex application
     */
    public function deleteUserAction($id, Application $app) {
        // Delete all associated comments
        $app['dao.comment']->deleteAllByUser($id);
        // Delete the user
        $app['dao.user']->delete($id);
        $app['session']->getFlashBag()->add('success', 'The user was successfully removed.');
        // Redirect to admin home page
        return $app->redirect($app['url_generator']->generate('admin'));
    }
}
