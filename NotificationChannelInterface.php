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
    /**
     * Send notification message
     *
     * @param MessageInterface $message
     * @param mixed $to
     * @param array|null $params
     * @return boolean
    */
    public function send(MessageInterface $message, $to, ?array $params = null): bool;
}
