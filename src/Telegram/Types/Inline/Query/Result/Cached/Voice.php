<?php

declare(strict_types = 1);

namespace Lavolab\TelegramAPI\Telegram\Types\Inline\Query\Result\Cached;

use Lavolab\TelegramAPI\Telegram\Types\Inline\Query\Result;
use Lavolab\TelegramAPI\Telegram\Types\InputMessageContent;

/**
 * Represents a link to a voice message stored on the Telegram servers. By default, this voice message will be sent by
 * the user. Alternatively, you can use input_message_content to send a message with the specified content instead of
 * the voice message.
 *
 * Objects defined as-is February 2018
 *
 * @see https://core.telegram.org/bots/api#inlinequeryresultcachedvoice
 */
class Voice extends Result
{
    /**
     * Type of the result, must be voice
     * @var string
     */
    public $type = 'voice';

    /**
     * A valid file identifier for the voice message
     * @var string
     */
    public $voice_file_id = '';

    /**
     * Voice message title
     * @var string
     */
    public $title = '';

    /**
     * Optional. Audio caption, 0-200 characters
     * @var string
     */
    public $caption = '';

    /**
     * Optional. Send Markdown or HTML, if you want Telegram apps to show bold, italic, fixed-width text or inline URLs
     * in the media caption
     * @var string
     */
    public $parse_mode = '';

    /**
     * Optional. Content of the message to be sent instead of the audio/document/voice message/video/sticker/etc.
     * @var InputMessageContent
     */
    public $input_message_content;
}
