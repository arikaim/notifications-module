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

use Arikaim\Modules\Notifications\Message\MessageInterface;

/**
 * Notifications message class
 */
class Message implements MessageInterface
{  
    /**
     * Get id
     *
     * @var string|null
    */
    protected $id;

    /**
     * Subject
     *
     * @var string|null
     */
    protected $subject = null;
    
    /**
     * Content
     *
     * @var string|null
     */
    protected $content;

    /**
     * Content type
     *
     * @var string|null
     */
    protected $contentType = null;
    
    /**
     * Params
     *
     * @var array|null
     */
    protected $params = [];

    /**
     * Constructor
     *
     * @param array $data
     * @param array|null $params
     */
    public function __construct(array $data, ?array $params = null)
    {
        $this->id = $data['id'] ?? $data['uuid'] ?? null;
        $this->content = $data['content'] ?? null;
        $this->subject = $data['subject'] ?? null;
        $this->contentType = $data['content_type'] ?? $data['contentType'] ?? $data['Content-Type'] ?? null;
        $this->params = $params ?? $data['params'] ?? [];
    }

    /**
     * To array
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'id'           => $this->id,
            'subject'      => $this->subject,
            'content'      => $this->content,
            'content_type' => $this->contentType,
            'params'       => $this->params
        ];       
    }

    /**
     * Return true if msg is valid
     *
     * @return boolean
     */
    public function isValid(): bool
    {
        return (empty($this->content) == false);
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
     * Get param
     *
     * @param string $name
     * @param mixed $default
     * @return mixed
     */
    public function getParam(string $name, $default = null)
    {
        return $this->params[$name] ?? $default;
    }

    /**
     * Get subject
     *
     * @return string|null
     */
    public function getSubject(): ?string
    {
        return $this->subject;
    }

    /**
     * Get content
     *
     * @return string|null
     */
    public function getContent(): ?string
    {
        return $this->content;
    }

    /**
     * Get content type
     *
     * @return string|null
     */
    public function getContentType(): ?string
    {
        return $this->contentType;
    }
}
