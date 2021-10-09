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

/**
 * Notification channel interface
 */
interface NotificationChannelInterface
{  
    public function send(MessageInterface $message, $recipient): bool;
}
