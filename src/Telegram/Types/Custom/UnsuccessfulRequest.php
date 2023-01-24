<?php
declare(strict_types = 1);

namespace lavolab\TelegramAPI\Telegram\Types\Custom;

use lavolab\TelegramAPI\Abstracts\TelegramTypes;
use lavolab\TelegramAPI\Telegram\Types\ResponseParameters;

/**
 * Not being used by the package itself, but useful for some bots to initialize if no response is actually expected
 */
class UnsuccessfulRequest extends TelegramTypes
{
    /**
     * Per definition, this will always be false, as this is an unsuccessful request
     * @var bool
     */
    public $ok = false;

    /**
     * An Integer ‘error_code’ field is returned, but its contents are subject to change in the future
     * @var int
     */
    public $error_code = 0;

    /**
     * In case of an unsuccessful request, ‘ok’ equals false and the error is explained in the ‘description’
     * @var string
     */
    public $description = '';

    /**
     * Some errors may also have an optional field ‘parameters’ of the type ResponseParameters, which can help to
     * automatically handle the error
     *
     * @see ResponseParameters
     * @var ResponseParameters
     */
    public $parameters = null;

    protected function mapSubObjects(string $key, array $data): TelegramTypes
    {
        switch ($key) {
            case 'parameters':
                return new ResponseParameters($data, $this->logger);
        }

        // Return always null if none of the objects above matches
        return parent::mapSubObjects($key, $data);
    }
}
