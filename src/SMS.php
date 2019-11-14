<?php


namespace GsDesign\SMS;

use GsDesign\SMS\Exceptions\CouldNotSendNotification;

class SMS
{
    protected $sms;
    protected $from;

    /**
     * SMS constructor.
     * @param $url
     * @param $key
     * @param $from
     * @param string $login
     * @param string $pass
     * @param string $mode
     * @throws CouldNotSendNotification
     */
    public function __construct($url, $key, $from, $login = '', $pass = '', $mode = 'http')
    {
        try {
            $this->sms = new SMSTranstort($url, $key, $login, $pass, $mode);
            $this->from = $from;
        } catch (\Exception $exception) {
            throw CouldNotSendNotification::couldNotCommunicateWithSMS($exception);
        }
    }

    /**
     * @param $message
     */
    public function sendMessage($message)
    {
        try {
            foreach ($message['to_number'] as $key => $item) {
                $this->sms->send($this->from, $item, $message['text']);
            }
        } catch (\Exception $exception) {
            throw CouldNotSendNotification::couldNotCommunicateWithSMS($exception);
        }
    }
}