<?php
// Home page
$app->get('/', "projet4\Controller\HomeController::indexAction")->bind('home');

// Admin zone
$app->get('/admin', "projet4\Controller\AdminController::indexAction")->bind('admin');
// Login form
$app->get('/login', "projet4\Controller\AuthController::loginAction")->bind('login');
// Register form
$app->match('/register', 'projet4\Controller\AuthController::registerAction')->bind('register');

/****EPISODE****/
// Add a new episode
$app->match('/admin/episode/add', "projet4\Controller\AdminController::addEpisodeAction")->bind('admin_episode_add');
// Edit an existing episode
$app->match('/admin/episode/{id}/edit', "projet4\Controller\AdminController::editEpisodeAction")->bind('admin_episode_edit');
// Remove an episode
$app->get('/admin/episode/{id}/delete', "projet4\Controller\AdminController::deleteEpisodeAction")->bind('admin_episode_delete');
// Detailed info about an episode
$app->match('/episode/{id}', "projet4\Controller\HomeController::episodeAction")->bind('episode');

/****COMMENT****/
// Edit an existing comment
$app->match('/admin/comment/{id}/edit', "projet4\Controller\AdminController::editCommentAction")->bind('admin_comment_edit');
// Remove a comment
$app->get('/admin/comment/{id}/delete', "projet4\Controller\AdminController::deleteCommentAction")->bind('admin_comment_delete');

/****USER****/
// Add a user
$app->match('/admin/user/add', "projet4\Controller\AdminController::addUserAction")->bind('admin_user_add');
// Edit an existing user
$app->match('/admin/user/{id}/edit', "projet4\Controller\AdminController::editUserAction")->bind('admin_user_edit');
// Remove a user
$app->get('/admin/user/{id}/delete', "projet4\Controller\AdminController::deleteUserAction")->bind('admin_user_delete');

/****API****/
// API : get all episodes
$app->get('/api/episodes', "projet4\Controller\ApiController::getEpisodesAction")->bind('api_episodes');
// API : get an episode
$app->get('/api/episode/{id}', "projet4\Controller\ApiController::getEpisodeAction")->bind('api_episode');
// API : create an episode
$app->post('/api/episode', "projet4\Controller\ApiController::addEpisodeAction")->bind('api_episode_add');
// API : remove an episode
$app->delete('/api/episode/{id}', "projet4\Controller\ApiController::deleteEpisodeAction")->bind('api_episode_delete');
