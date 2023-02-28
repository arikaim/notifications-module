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
        $this->installDriver('Arikaim\\Modules\\Notifications\\Drivers\\EmailNotificationDriver');   
        $this->installDriver('Arikaim\\Modules\\Notifications\\Drivers\\TwilioNotificationDriver');   
        // service
        $this->registerService('Notifications');
    }
}
