<?php

declare(strict_types = 1);

namespace Lavolab\TelegramAPI\Telegram\Types\Inline\Query\Result\Cached;

use Lavolab\TelegramAPI\Telegram\Types\Inline\Query\Result;
use Lavolab\TelegramAPI\Telegram\Types\InputMessageContent;

/**
 * Represents a link to a video file stored on the Telegram servers. By default, this video file will be sent by the
 * user with an optional caption. Alternatively, you can use input_message_content to send a message with the specified
 * content instead of the video.
 *
 * Objects defined as-is February 2018
 *
 * @see https://core.telegram.org/bots/api#inlinequeryresultcachedvideo
 */
class Video extends Result
{
    /**
     * Type of the result, must be video
     * @var string
     */
    public $type = 'video';

    /**
     * A valid file identifier for the video file
     * @var string
     */
    public $video_file_id = '';

    /**
     * Title for the result
     * @var string
     */
    public $title = '';

    /**
     * Optional. Short description of the result
     * @var string
     */
    public $description = '';

    /**
     * Optional. Caption of the video to be sent, 0-200 characters
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
