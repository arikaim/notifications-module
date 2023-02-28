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

use \Twilio\Rest\Client;

use Arikaim\Core\Driver\Traits\Driver;
use Arikaim\Core\Interfaces\Driver\DriverInterface;

use Arikaim\Modules\Notifications\NotificationChannelInterface;
use Arikaim\Modules\Notifications\Message\MessageInterface;

/**
 * Twilio Notification Driver api driver class
 */
class TwilioNotificationDriver implements DriverInterface, NotificationChannelInterface
{   
    use Driver;

    /**
     * Twilio client instance
     *
     * @var object
     */
    protected $client;

    /**
     * From param
     *
     * @var string
     */
    protected $from;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->setDriverParams('twilio','notification.channel','Twilio sms notification','Twilio SMS notification driver');      
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
        $result = $this->client->messages->create($to,[
            'from' => $message->getParam('from') ?? $params['from'] ?? $this->from,
            'body' => $message->getContent()
        ]);

        return (empty($result->sid) == false);
    }

    /**
     * Initialize driver
     *
     * @return void
     */
    public function initDriver($properties)
    {
        $this->from = $properties->getValue('from','');

        $this->client = new Client(
            $properties->getValue('account_sid'),
            $properties->getValue('auth_token')
        );
    }

    /**
     * Create driver config properties array
     *
     * @param Arikaim\Core\Collection\Properties $properties
     * @return void
     */
    public function createDriverConfig($properties)
    {
        $properties->property('account_sid',function($property) {
            $property
                ->title('Account SID')
                ->type('text')               
                ->value('')
                ->required(true);              
        }); 
        
        $properties->property('auth_token',function($property) {
            $property
                ->title('Auth Token')
                ->type('text')              
                ->value('')
                ->required(true);                           
        }); 

        $properties->property('from',function($property) {
            $property
                ->title('From')
                ->type('text')              
                ->value('')
                ->required(false);                           
        }); 
    }
}
