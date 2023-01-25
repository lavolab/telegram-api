<?php

declare(strict_types = 1);

namespace Lavolab\TelegramAPI\Telegram\Types\Custom;

use Psr\Log\LoggerInterface;
use Lavolab\TelegramAPI\Abstracts\TraversableCustomType;
use Lavolab\TelegramAPI\Telegram\Types\GameHighScore;

/**
 * Mockup class to generate a real telegram GameHighScore representation
 */
class GameHighScoreArray extends TraversableCustomType
{
    public function __construct(array $data = null, LoggerInterface $logger = null)
    {
        if (count($data) !== 0) {
            foreach ($data as $id => $gameHighScore) {
                $this->data[$id] = new GameHighScore($gameHighScore, $logger);
            }
        }
    }
}
