<?php
/**
 * Arikaim
 *
 * @link        http://www.arikaim.com
 * @copyright   Copyright (c)  Konstantin Atanasov <info@arikaim.com>
 * @license     http://www.arikaim.com/license
 * 
*/
namespace Arikaim\Modules\Notifications\Message;

/**
 * Notifications message interface
 */
interface MessageInterface
{  
    /**
     * Return true if msg is valid
     *
     * @return boolean
     */
    public function isValid(): bool;

    /**
     * Get option
     *
     * @param string $name
     * @param mixed $default
     * @return mixed
     */
    public function getOption(string $name, $default = null);

    /**
     * Get param
     *
     * @param string $name
     * @param mixed $default
     * @return mixed
     */
    public function getParam(string $name, $default = null);

    /**
     * Get subject
     *
     * @return string|null
     */
    public function getSubject(): ?string;

    /**
     * Get content
     *
     * @return string|null
     */
    public function getContent(): ?string;

    /**
     * Get content type
     *
     * @return string|null
     */
    public function getContentType(): ?string;
}
