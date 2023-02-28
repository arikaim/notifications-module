<?php
/**
 * Arikaim
 *
 * @link        http://www.arikaim.com
 * @copyright   Copyright (c)  Konstantin Atanasov <info@arikaim.com>
 * @license     http://www.arikaim.com/license
 * 
*/
namespace Arikaim\Modules\Notifications\Service;

use Arikaim\Core\Service\Service;
use Arikaim\Core\Service\ServiceInterface;
use Arikaim\Modules\Notifications\Message\Message;

use Arikaim\Modules\Notifications\NotificationChannelInterface;
use Arikaim\Modules\Notifications\Message\MessageInterface;

/**
 * Notifications service class
*/
class Notifications extends Service implements ServiceInterface
{
    /**
     * Boot service
     *
     * @return void
     */
    public function boot()
    {
        $this->setServiceName('notifications');
    }
   
    /**
     * Send notification
     *
     * @param mixed $message
     * @param mixed $to
     * @param string $driverName Notification driver name
     * @param array|null $params
     * @return bool
     */
    public function send($message, $to, string $driverName, ?array $params = null): bool
    {
        global $container;

        // create driver
        $driver = $container->get('driver')->create($driverName);

        if ($driver instanceof NotificationChannelInterface) {
            $message = $this->createMessage($message,$params);

            return $driver->send($message,$to);
        }

        return false;
    }

    /**
     * Create message
     *
     * @param mixed $data
     * @param array|null $params
     * @return MessageInterface|null
    */
    public function createMessage($data, ?array $params = null): ?MessageInterface
    {
        if ($data instanceof MessageInterface) {
            return $data;
        }

        $data = \is_object($data) ? $data->toArray() : $data;
        $data = (\is_array($data) == false) ? ['content' => $data] : $data;

        return new Message($data,$params);
    }
}
