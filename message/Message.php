<?php
/**
 * Arikaim
 *
 * @link        http://www.arikaim.com
 * @copyright   Copyright (c)  Konstantin Atanasov <info@arikaim.com>
 * @license     http://www.arikaim.com/license
 * 
*/
namespace Arikaim\Modules\Notifications\Message;

use Arikaim\Modules\Notifications\Message\MessageInterface;

/**
 * Notifications message class
 */
class Message implements MessageInterface
{  
    
    protected $id;

    protected $subject;
    
    protected $content;

    protected $contentType;
    
    protected $params;

    protected $options;

    public function __construct(array $data)
    {
    }
}
