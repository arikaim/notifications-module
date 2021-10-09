<?php
/**
 * Arikaim
 *
 * @link        http://www.arikaim.com
 * @copyright   Copyright (c)  Konstantin Atanasov <info@arikaim.com>
 * @license     http://www.arikaim.com/license
 * 
*/
namespace Arikaim\Modules\Notifications\Channel;

use Arikaim\Modules\Notifications\Message\MessageInterface;
use  Arikaim\Modules\Notifications\Recipient\RecipientInterface;

/**
 * Notification channel interface
 */
interface NotificationChannelInterface
{  
    /**
     * Send notification message
     *
     * @param string|array|object|MessageInterface $message
     * @param string|array|object $to
     * @return boolean
    */
    public function send($message, $to): bool;

    /**
     * Create recepient object
     *
     * @param mixed $data
     * @return RecipientInterface|null
     */
    public function createRecipient($data): ?RecipientInterface;

    /**
     * Create message
     *
     * @param mixed $data
     * @return MessageInterface|null
     */
    public function createMessage($data): ?MessageInterface;
}
