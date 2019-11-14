<?php


namespace GsDesign\SMS\Exceptions;


class CouldNotSendNotification extends \Exception
{
    /**
     * @param $message
     * @return static
     */
    public static function couldNotCommunicateWithSMS($message)
    {
        return new static("The communication with SMS failed. `{$message}`");
    }

    /**
     * @param $message
     * @return static
     */
    public static function couldNotConnectToSMS($message)
    {
        return new static( "The connect to SMS failed. `{$message}`" );
    }

    /**
     * @param $message
     * @return static
     */
    public static function couldNotDisconnectFromSMS($message)
    {
        return new static( "The disconnect from SMS failed. `{$message}`" );
    }

    /**
     * @param string $exception
     * @return static
     */
    public static function sendWithAnError($message)
    {
        return new static("SMS send with an error. `{$message}`");
    }

    /**
     * Thrown when there is no user id provided.
     *
     * @return static
     */
    public static function userIdNotProvided()
    {
        return new static('SMS notification user ID was not provided. Please refer susage docs.');
    }
}