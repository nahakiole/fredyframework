<?php
/**
 * Created by PhpStorm.
 * User: Robin
 * Date: 27.03.14
 * Time: 23:46
 */

namespace Fredy\View;


class RedirectResponse extends Response
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

    /**
     * @return void
     */
    public function render()
    {
        header($this->header);
    }
}