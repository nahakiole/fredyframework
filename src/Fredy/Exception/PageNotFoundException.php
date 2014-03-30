<?php


namespace Framework\Exception;


class PageNotFoundException extends ControllerException
{
    protected $action = 'notFound';
}