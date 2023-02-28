<?php
/**
 * Arikaim
 *
 * @link        http://www.arikaim.com
 * @copyright   Copyright (c)  Konstantin Atanasov <info@arikaim.com>
 * @license     http://www.arikaim.com/license
 * 
*/
namespace Arikaim\Modules\Notifications\Drivers;

use Arikaim\Core\Driver\Traits\Driver;
use Arikaim\Core\Interfaces\Driver\DriverInterface;

use Arikaim\Modules\Notifications\NotificationChannelInterface;
use Arikaim\Modules\Notifications\Message\MessageInterface;

/**
 * Email Notification Driver api driver class
 */
class EmailNotificationDriver implements DriverInterface, NotificationChannelInterface
{   
    use Driver;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->setDriverParams('email','notification.channel','Email notification','Email notification driver');      
    }

    /**
     * Send notification message
     *
     * @param MessageInterface $message
     * @param string|array|object $to
     * @param array|null $params
     * @return boolean
    */
    public function send(MessageInterface $message, $to, ?array $params = null): bool
    {
        global $container;
 
        $result = $container->get('mailer')
            ->create($message->getContent(),$params ?? $message->toArray())           
            ->to($to)
            ->send();   

        return $result;
    }

    /**
     * Initialize driver
     *
     * @return void
     */
    public function initDriver($properties)
    {
    }

    /**
     * Create driver config properties array
     *
     * @param Arikaim\Core\Collection\Properties $properties
     * @return void
     */
    public function createDriverConfig($properties)
    {
    }
}
