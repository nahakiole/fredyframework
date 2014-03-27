<?php


namespace View;


class Redirect implements Viewable
{

    private $header;

    public function __construct($url)
    {
        $this->setHeader($url);
    }

    public function setHeader($url)
    {
        $this->header = 'Location: ' . $url;
    }

    public function render()
    {
        header($this->header);
    }
}