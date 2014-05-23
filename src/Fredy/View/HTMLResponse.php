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

    /**
     * @param $templatePath Path to Template
     */
    public function __construct($templatePath)
    {
        parent::__construct($templatePath);
    }

    /**
     * @return void
     */
    protected function addFilter()
    {
        $jsFilter = new Twig_SimpleFilter('minifyjs', array($this, 'minifyjs'));
        $this->twig->addFilter($jsFilter);

        $cssFilter = new Twig_SimpleFilter('minifycss', array($this, 'minifycss'));
        $this->twig->addFilter($cssFilter);
    }

    /**
     * @param $file
     * Relative path to file
     * @return bool
     */
    function minifyjs($file)
    {
        $minifiedFileName = $this->checkIfFileWasUpdated($file);
        if ($minifiedFileName) {
            $fileContent = file_get_contents(ROOTPATH . $file);
            file_put_contents(ROOTPATH . $minifiedFileName, JSMin::minify($fileContent));

            return $minifiedFileName;
        }

        return $file;
    }

    /**
     * @param $file
     * Relative path to file
     *
     * @return bool
     */
    function minifycss($file)
    {
        $minifiedFileName = $this->checkIfFileWasUpdated($file);
        if ($minifiedFileName) {
            $fileContent = file_get_contents(ROOTPATH . $file);
            $cssmin = new CSSmin();
            file_put_contents(ROOTPATH . $minifiedFileName, $cssmin->run($fileContent));
            return $minifiedFileName;
        }
        return $file;
    }

    /**
     * @param $file
     * Relative path to file
     *
     * @return bool
     */
    function checkIfFileWasUpdated($file)
    {
        $file = ROOTPATH . $file;
        if (file_exists($file)) {
            $fileExtension = pathinfo($file, PATHINFO_EXTENSION);
            $fileName = pathinfo($file, PATHINFO_FILENAME);
            $fileFullName = pathinfo($file, PATHINFO_BASENAME);
            $minifiedFileName = substr($file, 0, -strlen($fileFullName)) . $fileName . '.min.' . $fileExtension;
            $changeDate = filectime($file);
            $changeDateMinified = file_exists(ROOTPATH . $minifiedFileName) ? filectime(ROOTPATH . $minifiedFileName)
                : 0;
            if ($changeDateMinified == 0 || $changeDate < $changeDateMinified) {
                return $minifiedFileName;
            }
        }

        return null;
    }

    /**
     * @return string
     */
    function render()
    {
        return parent::render();
    }
}