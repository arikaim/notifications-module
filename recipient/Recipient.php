<?php
/**
 * Arikaim
 *
 * @link        http://www.arikaim.com
 * @copyright   Copyright (c)  Konstantin Atanasov <info@arikaim.com>
 * @license     http://www.arikaim.com/license
 * 
*/
namespace Arikaim\Modules\Notifications\Recipient;

use Arikaim\Modules\Notifications\Recipient\RecipientInterface;

/**
 * Notifications recipient class
 */
class Recipient implements RecipientInterface
{  
    /**
     * Id
     *
     * @var string|null
     */
    protected $id;

    /**
     * recipient
     *
     * @var string|null
    */
    protected $recipient;
    
    /**
     * Options
     *
     * @var array
     */
    protected $options = [];

    /**
     * Constructor
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->id = $data['id'] ?? $data['uuid'] ?? null;
        $this->recipient = $data['recipient'] ?? null;
        $this->options = $data;             
    }

    /**
     * To array
     *
     * @return array
     */
    public function toArray(): array
    {
        $this->options['id'] = $this->getId(); 
        $this->options['recipient'] = $this->getRecipient(); 

        return $this->options;
    }

    /**
     * Create
     *
     * @param array $data
     * @return RecipientInterface
     */
    public static function create(array $data): RecipientInterface
    {
        return new Recipient($data);
    }

    /**
     * Get recipient
     *
     * @return string|null
     */
    public function getRecipient(): ?string
    {
        return $this->recipient;
    }

    /**
     * Get id
     *
     * @return string|null
    */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * Get option
     *
     * @param string $name
     * @param mixed $default
     * @return mixed
    */
    public function getOption(string $name, $default = null)
    {
        return $this->options[$name] ?? $default;
    }

    /**
     * Set option
     *
     * @param string $name
     * @param mxied $value
     * @return Self
     */
    public function option(string $name, $value)
    {
        $this->options[$name] = $value;

        return $this;
    } 

    /**
     * Set recipient
     *
     * @param string $value
     * @return Self
     */
    public function recipient(string $value)
    {
        $this->recipient = $value;

        return $this;
    } 
}
