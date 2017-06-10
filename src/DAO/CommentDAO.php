<?php

namespace projet4\DAO;

use projet4\Domain\Comment;

class CommentDAO extends DAO 
{
    /**
     * @var \projet4\DAO\EpisodeDAO
     */
    private $episodeDAO;

    /**
     * @var \projet4\DAO\UserDAO
     */
    private $userDAO;

    public function setEpisodeDAO(EpisodeDAO $episodeDAO) {
        $this->episodeDAO = $episodeDAO;
    }

    public function setUserDAO(UserDAO $userDAO) {
        $this->userDAO = $userDAO;
    }

    /**
     * Returns a list of all comments, sorted by date (most recent first).
     *
     * @return array A list of all comments.
     */
    public function findAll() {
        $sql = "select * from t_comment order by created_at";
        $result = $this->getDb()->fetchAll($sql);

        // Convert query result to an array of domain objects
        $entities = array();
        foreach ($result as $row) {
            $id = $row['com_id'];
            $entities[$id] = $this->buildDomainObject($row);
        }
        return $entities;
    }

    /**
     * Return a list of all comments for an episode, sorted by date (most recent last).
     *
     * @param integer $episodeId The episode id.
     *
     * @return array A list of all comments for the episode.
     */
    public function findAllByEpisode($episodeId) {
        // The associated episode is retrieved only once
        $episode = $this->episodeDAO->find($episodeId);

        // art_id is not selected by the SQL query
        // The episode won't be retrieved during domain objet construction
        $sql = "select com_id, com_content, usr_id, created_at from t_comment where art_id=? order by created_at";
        $result = $this->getDb()->fetchAll($sql, array($episodeId));

        // Convert query result to an array of domain objects
        $comments = array();
        foreach ($result as $row) {
            $comId = $row['com_id'];
            $comment = $this->buildDomainObject($row);
            // The associated episode is defined for the constructed comment
            $comment->setEpisode($episode);
            $comments[$comId] = $comment;
        }
        return $comments;
    }

    /**
     * Returns a comment matching the supplied id.
     *
     * @param integer $id The comment id
     *
     * @return \projet4\Domain\Comment|throws an exception if no matching comment is found
     */
    public function find($id) {
        $sql = "select * from t_comment where com_id=?";
        $row = $this->getDb()->fetchAssoc($sql, array($id));

        if ($row) {
            return $this->buildDomainObject($row);
        } else {
            throw new \Exception("No comment matching id " . $id);
        }
    }

    /**
     * Saves a comment into the database.
     *
     * @param \projet4\Domain\Comment $comment The comment to save
     */
    public function save(Comment $comment) {
        $commentData = array(
            'art_id' => $comment->getEpisode()->getId(),
            'usr_id' => $comment->getAuthor()->getId(),
            'com_content' => $comment->getContent(),
            );

        if ($comment->getId()) {
            // The comment has already been saved : update it
            $this->getDb()->update('t_comment', $commentData, array('com_id' => $comment->getId()));
        } else {
            // The comment has never been saved : insert it
            $this->getDb()->insert('t_comment', $commentData);
            // Get the id of the newly created comment and set it on the entity.
            $id = $this->getDb()->lastInsertId();
            $comment->setId($id);
        }
    }

    /**
     * Removes all comments for an episode
     *
     * @param integer $episodeId The id of the episode
     */
    public function deleteAllByEpisode($episodeId) {
        $this->getDb()->delete('t_comment', array('art_id' => $episodeId));
    }

    /**
     * Removes all comments for a user
     *
     * @param integer $userId The id of the user
     */
    public function deleteAllByUser($userId) {
        $this->getDb()->delete('t_comment', array('usr_id' => $userId));
    }

    /**
     * Removes a comment from the database.
     *
     * @param integer $id The comment id
     */
    public function delete($id) {
        // Delete the comment
        $this->getDb()->delete('t_comment', array('com_id' => $id));
    }

    /**
     * Creates an Comment object based on a DB row.
     *
     * @param array $row The DB row containing Comment data.
     * @return \projet4\Domain\Comment
     */
    protected function buildDomainObject(array $row) {
        $comment = new Comment();
        $comment->setId($row['com_id']);
        $comment->setContent($row['com_content']);
        $comment->setCreatedAt($row['created_at']);

        if (array_key_exists('art_id', $row)) {
            // Find and set the associated episode
            $episodeId = $row['art_id'];
            $episode = $this->episodeDAO->find($episodeId);
            $comment->setEpisode($episode);
        }
        if (array_key_exists('usr_id', $row)) {
            // Find and set the associated author
            $userId = $row['usr_id'];
            $user = $this->userDAO->find($userId);
            $comment->setAuthor($user);
        }
        
        return $comment;
    }
}
