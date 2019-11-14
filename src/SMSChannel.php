<?php


namespace GsDesign\SMS;

use Illuminate\Notifications\Notification;
use GsDesign\SMS\Exceptions\CouldNotSendNotification;

class SMSChannel
{
    protected $sms;

    /**
     * Channel constructor.
     * @param SMS $sms
     */
    public function __construct(SMS $sms)
    {
        $this->sms = $sms;
    }

    public function send($notifiable, Notification $notification)
    {
        $message = $notification->toSMS($notifiable);

        if (is_string($message)) {
            $message = SMSMessage::create($message);
        }

        if ($message->toNotGiven()) {
            if (!$to = $notifiable->routeNotificationFor('sms')) {
                throw CouldNotSendNotification::userIdNotProvided();
            }

            $message->to($to);
        }

        if(!empty($message->payload['text'])) {
            $params = $message->toArray();
            $this->sms->sendMessage($params);
        }
    }
}