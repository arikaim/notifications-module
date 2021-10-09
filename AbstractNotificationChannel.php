<?php
/**
 * Arikaim
 *
 * @link        http://www.arikaim.com
 * @copyright   Copyright (c)  Konstantin Atanasov <info@arikaim.com>
 * @license     http://www.arikaim.com/license
 * 
*/
namespace Arikaim\Modules\Notifications;

use Arikaim\Modules\Notifications\Message\MessageInterface;
use Arikaim\Modules\Notifications\NotificationChannelInterface;

/**
 * Notification channel base abstract class
 */
abstract class AbstractNotificationChannel implements NotificationChannelInterface
{  
   
    abstract public function send(MessageInterface $message, $recipient): bool;

    public function __construct()
    {
    }    
}
