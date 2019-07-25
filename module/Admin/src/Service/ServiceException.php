<?php
/**
 * Created by PhpStorm.
 * User: Alyson
 * Date: 24/07/2019
 * Time: 21:31
 */

namespace Admin\Service;


use Throwable;

class ServiceException extends \RuntimeException
{

    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

}