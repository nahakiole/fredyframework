<?php
/**
 * Created by PhpStorm.
 * User: Robin
 * Date: 26.03.14
 * Time: 10:36
 */

namespace View;


class HTMLElement
{
    public $name;

    /**
     * @var bool
     */
    private $selfClosing = false;
    private $attributes;

    /**
     * @var HTMLElement[]
     */
    private $children = [];

    /**
     * @param $name
     * @param $selfClosing Boolean
     * @param $attributes
     */
    function __construct($name, $selfClosing, $attributes = [])
    {
        $this->name = $name;
        $this->selfClosing = $selfClosing;
        $this->attributes = $attributes;
    }


    public function render()
    {
        $attributes = $this->renderAttributes($this->attributes);
        if ($this->selfClosing) {
            return "<$this->name $attributes>\n";
        }
        $children = '';
        foreach ($this->children as $child) {
            $children .= "\n\t".$child->render()."\n";
        }
        return "<$this->name $attributes>$children</$this->name>";

    }

    public function renderAttributes($attributes)
    {
        $output = '';
        foreach ($attributes as $name => $value) {
            $output .= $name . '="' . $value . '" ';
        }
        return $output;
    }

    /**
     * @param $child HTMLElement
     */
    public function addChildren($child){
        array_push($this->children, $child);
    }

    /**
     * @return HTMLElement
     */
    public function getChildren(){
        return $this->children;
    }


}