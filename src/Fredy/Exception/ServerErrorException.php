<?php


namespace Framework\Exception;

class ServerErrorException extends ControllerException
{
    protected $action = 'serverError';
}
