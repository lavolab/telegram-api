<?php

declare(strict_types=1);

namespace Lavolab\TelegramAPI\Telegram\Types;

use Lavolab\TelegramAPI\Abstracts\TelegramTypes;

/**
 * This object contains information about a poll
 *
 * Objects defined as-is june 2019
 *
 * @see https://core.telegram.org/bots/api#polloption
 */
class PollOption extends TelegramTypes
{
    /**
     * Option text, 1-100 characters
     * @var string
     */
    public $text;

    /**
     * Number of users that voted for this option
     * @var int
     */
    public $voter_count;
}
