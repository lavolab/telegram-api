<?php

declare(strict_types = 1);

namespace Lavolab\TelegramAPI\Telegram\Types\InputMessageContent;

use Lavolab\TelegramAPI\Telegram\Types\InputMessageContent;

/**
 * Represents the content of a contact message to be sent as the result of an inline query.
 *
 * Objects defined as-is july 2015
 * Note: This will only work in Telegram versions released after 9 April, 2016. Older clients will ignore them.
 *
 * @see https://core.telegram.org/bots/api#inputcontactmessagecontent
 */
class Contact extends InputMessageContent
{
    /**
     * Contact's phone number
     * @var string
     */
    public $phone_number = '';

    /**
     * Contact's first name
     * @var string
     */
    public $first_name = '';

    /**
     * Optional. Contact's last name
     * @var string
     */
    public $last_name = '';

    /**
     * Optional. Additional data about the contact in the form of a vCard, 0-2048 bytes
     * @see https://en.wikipedia.org/wiki/VCard
     * @var string
     */
    public $vcard = '';
}
