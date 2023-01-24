<?php
declare(strict_types = 1);

namespace lavolab\TelegramAPI\Telegram\Types\Custom;

use Psr\Log\LoggerInterface;
use lavolab\TelegramAPI\Abstracts\CustomType;

/**
 * Some API calls respond with int types
 */
class ResultInt extends CustomType
{
    public $data = 0;

    public function __construct(int $result, LoggerInterface $logger = null)
    {
        $this->data = $result;
    }

    public function __toString()
    {
        return (string)$this->data;
    }
}
