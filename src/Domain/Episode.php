<?php

namespace projet4\Domain;

class Episode 
{
    /**
     * episode id.
     *
     * @var integer
     */
    private $id;

    /**
     * episode title.
     *
     * @var string
     */
    private $title;

    /**
     * episode content.
     *
     * @var string
     */
    private $content;
    /**
     * episode draft.
     * Values : Brouillon or Publié.
     * @var boolean
     */
    private $draft;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function getTitle() {
        return $this->title;
    }

    public function setTitle($title) {
        $this->title = $title;
        return $this;
    }

    public function getContent() {
        return $this->content;
    }

    public function setContent($content) {
        $this->content = $content;
        return $this;
    }
    public function getDraft() {
        return $this->draft;
    }

    public function setDraft($draft) {
        $this->draft = $draft;
        return $this;
    }
}
