<?php

namespace projet4\Domain;

class Comment 
{
    /**
     * Comment id.
     *
     * @var integer
     */
    private $id;

    /**
     * Comment author.
     *
     * @var \projet4\Domain\User
     */
    private $author;

    /**
     * Comment content.
     *
     * @var integer
     */
    private $content;

    /**
     * Associated episode.
     *
     * @var \projet4\Domain\Episode
     */
    private $episode;
    /**
     *
     * @var string 
     */
    private $email;
    /**
     *
     * @var string 
     */
    private $website;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function getAuthor() {
        return $this->author;
    }

    public function setAuthor(User $author) {
        $this->author = $author;
        return $this;
    }

    public function getContent() {
        return $this->content;
    }

    public function setContent($content) {
        $this->content = $content;
        return $this;
    }

    public function getEpisode() {
        return $this->episode;
    }

    public function setEpisode(Episode $episode) {
        $this->episode = $episode;
        return $this;
    }
    
    public function getEmail() {
        return $this->email;
    }

    public function getWebsite() {
        return $this->website;
    }

    public function setEmail($email) {
        $this->email = $email;
        return $this;
    }

    public function setWebsite($website) {
        $this->website = $website;
        return $this;
    }

}
