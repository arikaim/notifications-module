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

/**
 * Recipient interface
 */
interface RecipientInterface
{  

    /**
     * To array
     *
     * @return array
     */
    public function toArray(): array;

    /**
     * Get recipient
     *
     * @return string|null
     */
    public function getRecipient(): ?string;

    /**
     * Get id
     *
     * @return string|null
     */
    public function getId(): ?string;

    /**
     * Get option
     *
     * @param string $name
     * @param mixed $default
     * @return mixed
     */
    public function getOption(string $name, $default = null);
}
