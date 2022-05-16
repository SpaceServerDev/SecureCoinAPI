<?php
declare(strict_types=1);

namespace space\yurisi\SecureCoinAPI;

use pocketmine\player\Player;

class History {
    private string $received_player_name;

    private string $sent_player_name;

    public function __construct(
        private Player  $received_player,
        private ?Player $sent_player,
        private int     $amount,
        private string  $plugin_name,
        private string  $class_name,
        private string  $method_name,
        private string  $description = "",
    ) {
        $this->received_player_name = $received_player->getName();
        $this->sent_player_name = isset($sent_player) ? $sent_player->getName() : 'null';
    }

    public function getPlugin(): string {
        return $this->plugin_name;
    }

    public function getClass(): string {
        return $this->class_name;
    }

    public function getDescription(): string {
        return $this->description;
    }

    public function getMethod(): string {
        return $this->method_name;
    }

    public function getReceivedPlayer(): Player {
        return $this->received_player;
    }

    public function getSentPlayer(): ?Player {
        return $this->sent_player;
    }

    public function getReceivedPlayerName(): string {
        return $this->received_player_name;
    }

    public function getSentPlayerName(): string {
        return $this->sent_player_name;
    }

    public function setAmount(int $amount){
        $this->amount = $amount;
    }

    public function getAmount(): int {
        return $this->amount;
    }
}