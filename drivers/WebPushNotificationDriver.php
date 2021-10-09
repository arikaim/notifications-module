<?php
/**
 * Arikaim
 *
 * @link        http://www.arikaim.com
 * @copyright   Copyright (c)  Konstantin Atanasov <info@arikaim.com>
 * @license     http://www.arikaim.com/license
 * 
*/
namespace Arikaim\Modules\GithubApi\Drivers;

use Minishlink\WebPush\WebPush;
use Minishlink\WebPush\Subscription;

use Arikaim\Core\Arikaim;
use Arikaim\Core\Driver\Traits\Driver;
use Arikaim\Core\Interfaces\Driver\DriverInterface;
use Arikaim\Modules\Notifications\Channel\AbstractNotificationChannel;
use Arikaim\Modules\Notifications\Message\MessageInterface;
use Arikaim\Modules\Notifications\Channel\NotificationChannelInterface;

/**
 * WebPushNotificationDriver api driver class
 */
class WebPushNotificationDriver extends AbstractNotificationChannel implements DriverInterface, NotificationChannelInterface
{   
    use Driver;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->setDriverParams('webpush','notification.channel','WebPush notification','WebPush notification driver');      
    }

    /**
     * Send notification message
     *
     * @param string|array|object|MessageInterface $message
     * @param string|array|object $to
     * @return boolean
    */
    public function send($message, $to): bool
    {
        $message = $this->createMessage($message);
        if ($message == null) {
            // not valid message
            return false;
        }

        $recepient = $this->createRecipient($to);
        if ($recepient == null) {
            // not valid recepient
            return false;
        }
        
        $subscriptin = Subscription::create([

        ]);

        $payload = 'content';
        $webPush = new WebPush();

        $report = $webPush->sendOneNotification($subscriptin,$payload);
          
        var_dump($report);

        return false;
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
     * @return array
     */
    public function createDriverConfig($properties)
    {
        $properties->property('baseUrl',function($property) {
            $property
                ->title('Base Url')
                ->type('text')
                ->default('https://api.github.com/')
                ->value('https://api.github.com/')
                ->readonly(true);              
        }); 
        
        $properties->property('token',function($property) {
            $property
                ->title('OAuth2 Access Token')
                ->type('text')              
                ->value('');                         
        }); 
    }
}
