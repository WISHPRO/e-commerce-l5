<?php namespace app\Antony\DomainLogic\Contracts\Contact;

interface ContactMessageContract
{

    /**
     * Constant representing a successful sending of a contact message
     *
     * @var string
     */
    const MESSAGE_SENT = 'message.sent';

    /**
     * Constant representing an unsuccessful sending of a contact message
     *
     * @var string
     */
    const MESSAGE_NOT_SENT = 'message.unsent';

    /**
     * Sends the contact message
     *
     * @param $data
     *
     * @return mixed
     */
    public function send($data);
}