<?php
declare(strict_types=1);

namespace space\yurisi\SecureCoinAPI;

use pocketmine\player\Player;
use pocketmine\plugin\PluginBase;
use space\yurisi\SecureCoinAPI\database\coinYaml;
use space\yurisi\SecureCoinAPI\database\historySQLite;
use space\yurisi\SecureCoinAPI\event\player\LoginEvent;

class SecureCoinAPI extends PluginBase {

    private static self $main;

    private coinYaml $coinYaml;

    private historySQLite $history;

    protected function onEnable(): void {
        $this->coinYaml = new coinYaml($this);
        $this->history = new historySQLite($this);
        $this->getServer()->getPluginManager()->registerEvents(new LoginEvent($this), $this);
        self::$main = $this;
    }

    protected function onDisable(): void {
        $this->coinYaml->save();
        $this->history->save();
    }

    public function getInstance(): self {
        return self::$main;
    }

    public function addCoin(History $history) {
        $this->coinYaml->addCoin($history->getReceivedPlayer(), $history->getAmount());
        $this->history->registerHistory($history);
    }

    public function takeCoin(History $history) {
        $this->coinYaml->takeCoin($history->getReceivedPlayer(), $history->getAmount());
        $history->setAmount(-$history->getAmount());
        $this->history->registerHistory($history);
    }

    public function getCoin(Player $player): ?int {
        return $this->coinYaml->getCoin($player);
    }

    public function register(Player $player) {
        $this->coinYaml->register($player);
    }

    public function isRegister(Player $player): bool {
        return $this->coinYaml->isRegister($player);
    }
}