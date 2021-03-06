<?php
declare(strict_types=1);

namespace space\yurisi\SecureCoinAPI;

class History {

    private string $class_name;
    private string $method_name;

    public function __construct(
        private string  $received_player,
        private ?string $sent_player,
        private int     $amount,
        private string  $plugin_name,
        private string  $description = "",
    ) {
        $backtrace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 2);
        $this->class_name = $backtrace[1]['class'];
        $this->method_name = $backtrace[1]['function'];
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

    public function getReceivedPlayer(): string {
        return $this->received_player;
    }

    public function getSentPlayer(): ?string {
        return $this->sent_player ?? null;
    }

    public function setAmount(int $amount) {
        return $this->amount = $amount;
    }

    public function getAmount(): int {
        return $this->amount;
    }
}