<?php


namespace Fredy\Exception;

class ServerErrorException extends ControllerException
{
    protected $action = 'serverError';
}
