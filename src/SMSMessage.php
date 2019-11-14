<?php


namespace GsDesign\SMS;

class SMSMessage
{
    /**
     * @var array Params payload
     */
    public $payload = [];

    /**
     * Message constructor.
     * @param string $content
     */
    public function __construct($content = '')
    {
        $this->content($content);
    }

    /**
     * @param string $content
     * @return static
     */
    public static function create($content = '')
    {
        return new static($content);
    }

    /**
     * Notification message
     *
     * @param $content
     * @return $this
     */
    public function content($content)
    {
        $this->payload['text'] = $content;

        return $this;
    }

    /**
     * @param $number
     * @return $this
     */
    public function to($number)
    {
        $this->payload['to_number'] = (array) $number;

        return $this;
    }

    /**
     * @return bool
     */
    public function toNotGiven()
    {
        return empty($this->payload['to_number']) || !(boolean) reset($this->payload['to_number']);
    }

    /**
     * Additional options to send message
     *
     * @param array $options
     * @return $this
     */
    public function options(array $options)
    {
        $this->payload = array_replace($this->payload, $options);

        return $this;
    }

    /**
     * Returns payload params
     *
     * @return array
     */
    public function toArray()
    {
        return $this->payload;
    }
}