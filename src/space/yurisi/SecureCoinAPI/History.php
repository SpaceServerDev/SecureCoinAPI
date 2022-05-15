<?php
declare(strict_types=1);

namespace space\yurisi\SecureCoinAPI;

use pocketmine\player\Player;

class History {
    private string $received_player;

    private string $sent_player;

    public function __construct(
        private string $plugin_name,
        private string $class_name,
        private string $method_name,
        private string $history,
        Player         $received_player,
        Player         $sent_player,
        private int    $amount
    ) {
        $this->received_player = $received_player->getName();
        $this->sent_player = $sent_player->getName();
    }

    public function getPlugin(): string {
        return $this->plugin_name;
    }

    public function getClass(): string {
        return $this->class_name;
    }

    public function getHistory(): string {
        return $this->history;
    }

    public function getMethod(): string {
        return $this->method_name;
    }

    public function getReceivedPlayer(): string {
        return $this->received_player;
    }

    public function getSentPlayer(): string {
        return $this->sent_player;
    }

    public function getAmount(): int {
        return $this->amount;
    }
}