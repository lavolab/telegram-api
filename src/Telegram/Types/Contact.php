<?php

declare(strict_types = 1);

namespace Lavolab\TelegramAPI\Telegram\Types;

use Lavolab\TelegramAPI\Abstracts\TelegramTypes;

/**
 * This object represents a phone contact
 *
 * Objects defined as-is july 2016
 *
 * @see https://core.telegram.org/bots/api#contact
 */
class Contact extends TelegramTypes
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
     * Optional. Contact's user identifier in Telegram
     * @var int
     */
    public $user_id = 0;

    /**
     * Optional. Additional data about the contact in the form of a vCard
     * @see https://en.wikipedia.org/wiki/VCard
     * @var string
     */
    public $vcard = '';
}
