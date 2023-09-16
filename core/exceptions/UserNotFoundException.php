<?php

namespace app\core\exceptions;
class UserNotFoundException extends \Exception{

   protected $code=404;
    protected $message='User Not Found';

   
}

?>