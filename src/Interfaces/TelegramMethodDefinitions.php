<?php

declare(strict_types = 1);

namespace Lavolab\TelegramAPI\Interfaces;

use Psr\Log\LoggerInterface;
use Lavolab\TelegramAPI\Abstracts\TelegramMethods;
use Lavolab\TelegramAPI\Abstracts\TelegramTypes;
use Lavolab\TelegramAPI\InternalFunctionality\TelegramResponse;

/**
 * Mandatory functions for Methods
 *
 * @package Lavolab\TelegramAPI\Interfaces
 */
interface TelegramMethodDefinitions
{
    /**
     * Most of the methods will instantiate a Message object, this method can override the default behaviour
     *
     * @param TelegramResponse $data
     * @param LoggerInterface $logger
     * @return TelegramTypes
     */
    public static function bindToObject(TelegramResponse $data, LoggerInterface $logger): TelegramTypes;

    /**
     * Performs special work that needs to be done on the fields before sending it to Telegram
     *
     * @return TelegramMethods
     */
    public function performSpecialConditions(): TelegramMethods;

    /**
     * Will check and export all mandatory fields, will also add non-mandatory fields if they have any values
     *
     * @return array
     */
    public function export(): array;

    /**
     * Gets the name of all mandatory fields
     * @return array
     */
    public function getMandatoryFields(): array;
}
