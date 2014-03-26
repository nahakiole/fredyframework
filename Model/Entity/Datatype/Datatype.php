<?php
/**
 * Created by PhpStorm.
 * User: Robin
 * Date: 25.03.14
 * Time: 16:29
 */

namespace Model\Entity\Datatype;


abstract class Datatype {

    abstract function isValid(&$value);


} 