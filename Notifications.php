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
use Arikaim\Modules\Notifications\Channel\NotificationChannelInterface;

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
        // drivers
        $this->installDriver('Arikaim\\Modules\\Notifications\\Drivers\\WebPushNotificationDriver');   
        // service
        $this->registerService('Notifications');
    }

    /**
     * Sen notification
     *
     * @param MessageInterface $message
     * @param mixed $to
     * @param string|array $channels
     * @return mixed
     */
    public function send($message, $to, $channels)
    {
        $channels = (\is_array($channels) == false) ? [$channels] : $channels;

        foreach($channels as $channel) {
            // create channel driver
            $driver = Arikaim::get('driver')->create($channel);
            if (($driver instanceof NotificationChannelInterface) == false) {
                continue;
            }

            $result = $driver->send($message,$to);
        }
    }
}
