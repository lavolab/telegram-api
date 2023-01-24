<?php

declare(strict_types = 1);

namespace lavolab\TelegramAPI\Telegram\Methods;

use Psr\Log\LoggerInterface;
use lavolab\TelegramAPI\Abstracts\TelegramMethods;
use lavolab\TelegramAPI\Abstracts\TelegramTypes;
use lavolab\TelegramAPI\Exceptions\InvalidResultType;
use lavolab\TelegramAPI\InternalFunctionality\TelegramResponse;
use lavolab\TelegramAPI\Telegram\Types\Custom\ResultBoolean;
use lavolab\TelegramAPI\Telegram\Types\Inline\Keyboard\Markup;
use lavolab\TelegramAPI\Telegram\Types\InputMedia;
use lavolab\TelegramAPI\Telegram\Types\Message;

/**
 * Use this method to edit audio, document, photo, or video messages. If a message is a part of a message album, then it
 * can be edited only to a photo or a video. Otherwise, message type can be changed arbitrarily. When inline message is
 * edited, new file can't be uploaded. Use previously uploaded file via its file_id or specify a URL. On success, if the
 * edited message was sent by the bot, the edited Message is returned, otherwise True is returned.
 *
 * Objects defined as-is july 2018
 *
 * @see https://core.telegram.org/bots/api#editmessagemedia
 */
class EditMessageMedia extends TelegramMethods
{
    /**
     * Required if inline_message_id is not specified. Unique identifier for the target chat or username of the target
     * channel (in the format @channelusername)
     * @var string
     */
    public $chat_id = '';

    /**
     * Required if inline_message_id is not specified. Unique identifier of the sent message
     * @var int
     */
    public $message_id = 0;

    /**
     * Required if chat_id and message_id are not specified. Identifier of the inline message
     * @var string
     */
    public $inline_message_id = '';

    /**
     * A JSON-serialized object for a new media content of the message
     * @var InputMedia
     */
    public $media;

    /**
     * Optional. A JSON-serialized object for an inline keyboard.
     * @var Markup
     */
    public $reply_markup;

    public function getMandatoryFields(): array
    {
        $returnValue[] = 'media';
        $this->mandatoryUserOrInlineMessageId($returnValue);
        return $returnValue;
    }

    /**
     * @param TelegramRawData $data
     * @param LoggerInterface $logger
     * @return TelegramTypes
     * @throws InvalidResultType
     */
    public static function bindToObject(TelegramResponse $data, LoggerInterface $logger): TelegramTypes
    {
        $typeOfResult = $data->getTypeOfResult();
        switch ($typeOfResult) {
            case 'array':
                return new Message($data->getResult(), $logger);
            case 'boolean':
                return new ResultBoolean($data->getResultBoolean(), $logger);
            default:
                throw new InvalidResultType(sprintf(
                    'Result is of type: %s. Expecting one of array or boolean',
                    $typeOfResult
                ));
        }
    }
}
