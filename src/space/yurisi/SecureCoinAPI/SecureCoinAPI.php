<?php
declare(strict_types=1);

namespace space\yurisi\SecureCoinAPI;

use pocketmine\plugin\PluginBase;
use space\yurisi\SecureCoinAPI\command\addcoinCommand;
use space\yurisi\SecureCoinAPI\command\mymoneyCommand;
use space\yurisi\SecureCoinAPI\database\coinJson;
use space\yurisi\SecureCoinAPI\database\historySQLite;
use space\yurisi\SecureCoinAPI\event\player\LoginEvent;

class SecureCoinAPI extends PluginBase {

    private static self $main;

    private coinJson $coinJson;

    private historySQLite $history;

    protected function onEnable(): void {
        $this->coinJson = new coinJson($this);
        $this->history = new historySQLite($this);
        $this->getServer()->getPluginManager()->registerEvents(new LoginEvent($this), $this);
        $this->getServer()->getCommandMap()->register('SecureCoinAPI', new addcoinCommand($this));
        $this->getServer()->getCommandMap()->register('SecureCoinAPI', new mymoneyCommand($this));
        self::$main = $this;
    }

    protected function onDisable(): void {
        $this->coinJson->save();
        $this->history->save();
    }

    public function getInstance(): self {
        return self::$main;
    }

    /**
     * プレイヤーにお金を付与します
     *
     * @param History $history
     * @return void
     */
    public function addCoin(History $history) {
        $this->coinJson->addCoin($history->getReceivedPlayer(), $history->getAmount());
        $this->history->registerHistory($history);
    }

    /**
     * プレイヤーからお金を奪います
     *
     * @param History $history
     * @return void
     */
    public function takeCoin(History $history) {
        $this->coinJson->takeCoin($history->getReceivedPlayer(), $history->getAmount());
        $history->setAmount(-$history->getAmount());
        $this->history->registerHistory($history);
    }

    /**
     * プレイヤーのお金をセットします
     *
     * @param string $name
     * @return void
     */
    public function setCoin(string $name) {
        //
    }

    /**
     * プレイヤーのお金を取得します
     *
     * @param string $name
     * @return int|null
     */
    public function getCoin(string $name): ?int {
        return $this->coinJson->getCoin($name);
    }

    /**
     * 指定された名前の口座を追加します
     *
     * @param string $name
     * @return void
     */
    public function register(string $name) {
        $this->coinJson->register($name);
    }

    /**
     * 口座が存在するか確認します
     *
     * @param string $name
     * @return bool
     */
    public function isRegister(string $name): bool {
        return $this->coinJson->isRegister($name);
    }
}