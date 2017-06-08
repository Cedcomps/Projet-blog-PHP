<?php

namespace projet4\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use projet4\Domain\Episode;

class ApiController {

    /**
     * API episodes controller.
     *
     * @param Application $app Silex application
     *
     * @return All Episodes in JSON format
     */
    public function getEpisodesAction(Application $app) {
        $episodes = $app['dao.episode']->findAll();
        // Convert an array of objects ($episodes) into an array of associative arrays ($responseData)
        $responseData = array();
        foreach ($episodes as $episode) {
            $responseData[] = $this->buildEpisodeArray($episode);
        }
        // Create and return a JSON response
        return $app->json($responseData);
    }

    /**
     * API episode details controller.
     *
     * @param integer $id Episode id
     * @param Application $app Silex application
     *
     * @return Episode details in JSON format
     */
    public function getEpisodeAction($id, Application $app) {
        $episode = $app['dao.episode']->find($id);
        $responseData = $this->buildEpisodeArray($episode);
        // Create and return a JSON response
        return $app->json($responseData);
    }

    /**
     * API create episode controller.
     *
     * @param Request $request Incoming request
     * @param Application $app Silex application
     *
     * @return Episode details in JSON format
     */
    public function addEpisodeAction(Request $request, Application $app) {
        // Check request parameters
        if (!$request->request->has('title')) {
            return $app->json('Missing required parameter: title', 400);
        }
        if (!$request->request->has('content')) {
            return $app->json('Missing required parameter: content', 400);
        }
        // Build and save the new episode
        $episode = new Episode();
        $episode->setTitle($request->request->get('title'));
        $episode->setContent($request->request->get('content'));
        $app['dao.episode']->save($episode);
        $responseData = $this->buildEpisodeArray($episode);
        return $app->json($responseData, 201);  // 201 = Created
    }

    /**
     * API delete episode controller.
     *
     * @param integer $id Episode id
     * @param Application $app Silex application
     */
    public function deleteepisodeAction($id, Application $app) {
        // Delete all associated comments
        $app['dao.comment']->deleteAllByEpisode($id);
        // Delete the episode
        $app['dao.episode']->delete($id);
        return $app->json('No Content', 204);  // 204 = No content
    }

    /**
     * Converts an episode object into an associative array for JSON encoding
     *
     * @param Episode $episode episode object
     *
     * @return array Associative array whose fields are the episode properties.
     */
    private function buildEpisodeArray(Episode $episode) {
        $data  = array(
            'id' => $episode->getId(),
            'title' => $episode->getTitle(),
            'content' => $episode->getContent()
            );
        return $data;
    }
}
