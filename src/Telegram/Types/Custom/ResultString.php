<?php
declare(strict_types = 1);

namespace Lavolab\TelegramAPI\Telegram\Types\Custom;

use Psr\Log\LoggerInterface;
use Lavolab\TelegramAPI\Abstracts\CustomType;

/**
 * Some API calls respond with int types
 */
class ResultString extends CustomType
{
    public $data = '';

    public function __construct(string $result, LoggerInterface $logger = null)
    {
        $this->data = $result;
    }

    public function __toString()
    {
        return (string)$this->data;
    }
}
