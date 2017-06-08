<?php

namespace projet4\DAO;

use projet4\Domain\Episode;

class EpisodeDAO extends DAO
{
    /**
     * Return a list of all episodes, sorted by date (most recent first).
     *
     * @return array A list of all episodes.
     */
    public function findAll() {
        $sql = "select * from t_episode order by art_id desc";
        $result = $this->getDb()->fetchAll($sql);

        // Convert query result to an array of domain objects
        $episodes = array();
        foreach ($result as $row) {
            $episodeId = $row['art_id'];
            $episodes[$episodeId] = $this->buildDomainObject($row);
        }
        return $episodes;
    }

    /**
     * Returns an episode matching the supplied id.
     *
     * @param integer $id The episode id.
     *
     * @return \projet4\Domain\Episode|throws an exception if no matching episode is found
     */
    public function find($id) {
        $sql = "select * from t_episode where art_id=?";
        $row = $this->getDb()->fetchAssoc($sql, array($id));

        if ($row) {
            return $this->buildDomainObject($row);
        } else {
            throw new \Exception("No episode matching id " . $id);
        }
    }

    /**
     * Saves an episode into the database.
     *
     * @param \projet4\Domain\Episode $episode The episode to save
     */
    public function save(episode $episode) {
        $episodeData = array(
            'art_title' => $episode->getTitle(),
            'art_content' => $episode->getContent(),
            );

        if ($episode->getId()) {
            // The episode has already been saved : update it
            $this->getDb()->update('t_episode', $episodeData, array('art_id' => $episode->getId()));
        } else {
            // The episode has never been saved : insert it
            $this->getDb()->insert('t_episode', $episodeData);
            // Get the id of the newly created episode and set it on the entity.
            $id = $this->getDb()->lastInsertId();
            $episode->setId($id);
        }
    }

    /**
     * Removes an episode from the database.
     *
     * @param integer $id The episode id.
     */
    public function delete($id) {
        // Delete the episode
        $this->getDb()->delete('t_episode', array('art_id' => $id));
    }

    /**
     * Creates an episode object based on a DB row.
     *
     * @param array $row The DB row containing episode data.
     * @return \projet4\Domain\Episode
     */

    protected function buildDomainObject(array $row) {
        $episode = new Episode();
        $episode->setId($row['art_id']);
        $episode->setTitle($row['art_title']);
        $episode->setContent($row['art_content']);
        return $episode;
    }
}
