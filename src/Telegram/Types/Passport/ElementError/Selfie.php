<?php

declare(strict_types = 1);

namespace Lavolab\TelegramAPI\Telegram\Types\Passport\ElementError;

use Lavolab\TelegramAPI\Telegram\Types\Passport\PassportElementError;

/**
 * This object represents information about an order
 *
 * Objects defined as-is july 2018
 *
 * @see https://core.telegram.org/bots/api#passportelementerrorselfie
 */
class Selfie extends PassportElementError
{
    public $source = 'selfie';

    /**
     * Base64-encoded hash of the file with the front side of the document
     * @var string
     */
    public $file_hash = '';
}
