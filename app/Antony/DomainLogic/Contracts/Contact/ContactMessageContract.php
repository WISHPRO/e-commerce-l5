<?php namespace app\Antony\DomainLogic\Contracts\Contact;

interface ContactMessageContract
{

    /**
     * Constant representing an successful sending of a contact message
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

}