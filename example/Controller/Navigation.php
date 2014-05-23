<?php
/**
 * Created by PhpStorm.
 * User: Robin
 * Date: 28.03.14
 * Time: 12:58
 */

namespace Controller;


class Navigation {

    /**
     * @var \Fredy\Model\Entity\Request
     */
    private $request;

    private $cachedNavigation = [];

    /**
     * @param $request \Fredy\Model\Entity\Request
     */
    function __construct($request)
    {
        $this->request = $request;
    }

    public function getNavigation($file){

        $navigation = json_decode( file_get_contents(ROOTPATH.$file), true);
        $this->cachedNavigation[$file] = $navigation;

        foreach ($navigation['navigation'] as &$link) {
            if (preg_match(':^'.$link['url'].':', $this->request->matches[0]) && $link['url'] != '/' || ($this->request->matches[0] == '/' &&  $link['url'] == '/') ){

                $link['active'] = 'active';
            }
        }
        return $navigation['navigation'];
    }
} 