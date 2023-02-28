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

use Minishlink\WebPush\WebPush;
use Minishlink\WebPush\Subscription;

use Arikaim\Core\Driver\Traits\Driver;
use Arikaim\Core\Interfaces\Driver\DriverInterface;
use Arikaim\Modules\Notifications\NotificationChannelInterface;
use Arikaim\Modules\Notifications\Message\MessageInterface;

/**
 * WebPushNotificationDriver api driver class
 */
class WebPushNotificationDriver implements DriverInterface, NotificationChannelInterface
{   
    use Driver;

    /**
     * Private key
     *
     * @var string
     */
    protected $publicKey;

    /**
     * Private key
     *
     * @var string
     */
    protected $privateKey;

    /**
     * Web push service
     *
     * @var object|null
     */
    protected $webPush;

    /**
     * Error message
     *
     * @var string|null
     */
    protected $error;
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
     * @param MessageInterface $message
     * @param mixed $to
     * @param array|null $params
     * @return boolean
    */
    public function send(MessageInterface $message, $to, ?array $params = null): bool
    {
        $this->error = null;
       
        $subscription = Subscription::create([
            'endpoint'  => $to,
            'publicKey' => $this->publicKey, 
            'authToken' => $this->privateKey
        ]);

        $report = $this->webPush->sendOneNotification($subscription,$message->getContent());
          
        if ($report->isSuccess()) {
            return true;
        } 
 
        // error
        $this->error = $report->getReason();

        return false;
    }

    /**
     * Initialize driver
     *
     * @return void
     */
    public function initDriver($properties)
    {
        $this->publicKey = $properties->getValue('public_key');
        $this->privateKey = $properties->getValue('private_key');

        $this->webPush = new WebPush([
            'VAPID' => [
                'subject'    => 'Push notificaiton',
                'publicKey'  => $this->publicKey,
                'privateKey' => $this->privateKey
            ]
        ]);
    }

    /**
     * Create driver config properties array
     *
     * @param Arikaim\Core\Collection\Properties $properties
     * @return void
     */
    public function createDriverConfig($properties)
    {
        $properties->property('private_key',function($property) {
            $property
                ->title('Private Key')
                ->type('text-area')               
                ->value('')
                ->required(true);              
        }); 
        
        $properties->property('public_key',function($property) {
            $property
                ->title('Public Key')
                ->type('text')              
                ->value('')
                ->required(true);                           
        }); 
    }
}
