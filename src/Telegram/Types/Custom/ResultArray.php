<?php
declare(strict_types = 1);

namespace Lavolab\TelegramAPI\Telegram\Types\Custom;

use Psr\Log\LoggerInterface;
use Lavolab\TelegramAPI\Abstracts\TraversableCustomType;

/**
 * Mainly used if we have no clue what type of (new?) object the API is returning us
 */
class ResultArray extends TraversableCustomType
{
    /**
     * @var array
     */
    public $data = '';

    public function __construct(array $result, LoggerInterface $logger = null)
    {
        $this->data = $result;
    }

    /**
     * Return the data
     * @return string
     */
    public function __toString()
    {
        return json_encode($this->data);
    }
}
