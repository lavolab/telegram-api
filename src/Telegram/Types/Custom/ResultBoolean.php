<?php
declare(strict_types = 1);

namespace lavolab\TelegramAPI\Telegram\Types\Custom;

use Psr\Log\LoggerInterface;
use lavolab\TelegramAPI\Abstracts\CustomType;

/**
 * Some APIs (mainly inline bots) respond with boolean types
 */
class ResultBoolean extends CustomType
{
    public $data = false;

    public function __construct(bool $result, LoggerInterface $logger = null)
    {
        $this->data = $result;
    }

    /**
     * I don't really use this function, but I can imagine it can come in handy when PHP handles the casting internally
     * @return string
     */
    public function __toString()
    {
        if ($this->data === true) {
            return '1';
        }
        return '0';
    }
}
