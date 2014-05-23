<?php
/**
 * Created by PhpStorm.
 * User: Robin
 * Date: 27.03.14
 * Time: 23:46
 */


namespace Fredy\View;

use CSSmin;
use JSMin;
use Twig_SimpleFilter;

class HTMLResponse extends TwigResponse {


    public function __construct($templatePath)
    {
        parent::__construct($templatePath);
    }

    protected function addFilter()
    {
        $jsFilter = new Twig_SimpleFilter('minifyjs', array($this, 'minifyjs'));
        $this->twig->addFilter($jsFilter);

        $cssFilter = new Twig_SimpleFilter('minifycss', array($this, 'minifycss'));
        $this->twig->addFilter($cssFilter);
    }

    function minifyjs($url)
    {
        $minifiedFileName = $this->checkIfFileWasUpdated($url);
        if ($minifiedFileName) {
            $fileContent = file_get_contents(ROOTPATH . $url);
            file_put_contents(ROOTPATH . $minifiedFileName, JSMin::minify($fileContent));

            return $minifiedFileName;
        }

        return $url;
    }

    function minifycss($url)
    {
        $minifiedFileName = $this->checkIfFileWasUpdated($url);
        if ($minifiedFileName) {
            $fileContent = file_get_contents(ROOTPATH . $url);
            $cssmin = new CSSmin();
            file_put_contents(ROOTPATH . $minifiedFileName, $cssmin->run($fileContent));
            return $minifiedFileName;
        }
        return $url;
    }

    /**
     * @param $url
     *
     * @return bool
     */
    function checkIfFileWasUpdated($url)
    {
        $file = ROOTPATH . $url;
        if (file_exists($file)) {
            $fileExtension = pathinfo($file, PATHINFO_EXTENSION);
            $fileName = pathinfo($file, PATHINFO_FILENAME);
            $fileFullName = pathinfo($file, PATHINFO_BASENAME);
            $minifiedFileName = substr($url, 0, -strlen($fileFullName)) . $fileName . '.min.' . $fileExtension;
            $changeDate = filectime($file);
            $changeDateMinified = file_exists(ROOTPATH . $minifiedFileName) ? filectime(ROOTPATH . $minifiedFileName)
                : 0;
            if ($changeDateMinified == 0 || $changeDate < $changeDateMinified) {
                return $minifiedFileName;
            }
        }

        return null;
    }

    function render()
    {
        return parent::render();
    }
}