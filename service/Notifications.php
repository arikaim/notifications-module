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


use Arikaim\Core\System\Error\Traits\TaskErrors;

use Arikaim\Core\Service\Service;
use Arikaim\Core\Service\ServiceInterface;
use Arikaim\Modules\Notifications\Notifications as NotificaitonsManager;

/**
 * Notifications service class
*/
class Notifications extends Service implements ServiceInterface
{
    use TaskErrors;

    /**
     * Notifications module class
     *
     * @var NotificaitonsManager
     */
    private $manager;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->setServiceName('notifications');
        $this->manager = new NotificaitonsManager();
    }

    /**
     * Get notifications manager
     *
     * @return NotificaitonsManager
     */
    public function getManager()
    {
        return $this->manager;
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
        return $this->manager->send($message,$to,$channels);
    }
}
