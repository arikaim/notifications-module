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
use Arikaim\Modules\Notifications\Channel\NotificationChannelInterface;
use Arikaim\Modules\Notifications\Recipient\RecipientInterface;
use Arikaim\Modules\Notifications\Recipient\Recipient;
use Arikaim\Modules\Notifications\Message\Message;

/**
 * Notification channel base abstract class
 */
abstract class AbstractNotificationChannel implements NotificationChannelInterface
{  
    /**
     * Send notification message
     *
     * @param string|array|object|MessageInterface $message
     * @param string|array|object $to
     * @return boolean
    */
    abstract public function send($message, $to): bool;

    /**
     * Create recepient object
     *
     * @param mixed $data
     * @return RecipientInterface|null
    */
    public function createRecipient($data): ?RecipientInterface
    {
        if (empty($data) == true) {
            // not valid recepient
            return null;
        }

        if ($data instanceof RecipientInterface) {
            return $data;
        }

        $data = \is_object($data) ? $data->toArray() : $data;
        $data = (\is_array($data) == false) ? ['recepient' => $data] : $data;

        return new Recipient($data);
    }

    /**
     * Create message
     *
     * @param mixed $data
     * @return MessageInterface|null
    */
    public function createMessage($data): ?MessageInterface
    {
        if (empty($data) == true) {
            // not valid message
            return null;
        }

        if ($data instanceof MessageInterface) {
            return $data;
        }

        $data = \is_object($data) ? $data->toArray() : $data;
        $data = (\is_array($data) == false) ? ['content' => $data] : $data;

        return new Message($data);
    }
}
