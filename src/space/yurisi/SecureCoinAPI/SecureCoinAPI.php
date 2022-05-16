<?php
declare(strict_types=1);

namespace space\yurisi\SecureCoinAPI;

use pocketmine\plugin\PluginBase;
use space\yurisi\SecureCoinAPI\command\addcoinCommand;
use space\yurisi\SecureCoinAPI\command\mymoneyCommand;
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
        $this->getServer()->getCommandMap()->register('SecureCoinAPI', new addcoinCommand($this));
        $this->getServer()->getCommandMap()->register('SecureCoinAPI', new mymoneyCommand($this));
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

    public function setCoin(string $name){
        //
    }

    public function getCoin(string $name): ?int {
        return $this->coinYaml->getCoin($name);
    }

    public function register(string $name) {
        $this->coinYaml->register($name);
    }

    public function isRegister(string $name): bool {
        return $this->coinYaml->isRegister($name);
    }
}