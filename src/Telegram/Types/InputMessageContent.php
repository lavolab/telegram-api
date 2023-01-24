<?php

declare(strict_types = 1);

namespace lavolab\TelegramAPI\Telegram\Types;

use lavolab\TelegramAPI\Abstracts\TelegramTypes;

/**
 * This object represents the content of a message to be sent as a result of an inline query. Telegram clients currently
 * support the following 4 types:
 *
 * InputTextMessageContent
 * InputLocationMessageContent
 * InputVenueMessageContent
 * InputContactMessageContent
 *
 * Objects defined as-is july 2015
 *
 * @see https://core.telegram.org/bots/api#inputmessagecontent
 */
abstract class InputMessageContent extends TelegramTypes
{
}
