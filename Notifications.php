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

use Arikaim\Core\Extension\Module;
use Arikaim\Core\Arikaim;
use Arikaim\Modules\Notifications\Message\MessageInterface;
use Arikaim\Modules\Notifications\NotificationChannelInterface;

/**
 * Notifications module class
 */
class Notifications extends Module
{  
    /**
     * Install module
     *
     * @return void
     */
    public function install()
    {
        $this->installDriver('Arikaim\\Modules\\Notifications\\Drivers\\WebPushNotificationDriver');      
    }

    /**
     * Sen notification
     *
     * @param MessageInterface $message
     * @param mixed $recipient
     * @param string|array $channels
     * @return void
     */
    public function send(MessageInterface $message, $recipient, $channels)
    {
        $channels = (\is_array($channels) == false) ? [$channels] : $channels;
        
        foreach($channels as $channel) {
            // create channel driver
            $driver = Arikaim::get('driver')->create($channel);
            if (($driver instanceof NotificationChannelInterface) == false) {
                continue;
            }

            $result = $driver->send($message,$recipient);
        }
    }
}
