<?php
declare(strict_types=1);

namespace space\yurisi\SecureCoinAPI;

use pocketmine\player\Player;
use pocketmine\plugin\PluginBase;
use space\yurisi\SecureCoinAPI\database\coinYaml;
use space\yurisi\SecureCoinAPI\database\historySQLite;

class SecureCoinAPI extends PluginBase {

    private static self $main;

    private coinYaml $coinYaml;

    private historySQLite $history;

    protected function onEnable(): void {
        $this->coinYaml = new coinYaml($this);
        $this->history = new historySQLite($this);
        self::$main = $this;
    }

    protected function onDisable(): void {
        $this->coinYaml->save();
        $this->history->save();
    }

    public function getInstance(): self {
        return self::$main;
    }

    public function addCoin(Player $player, int $amount){
        $this->coinYaml->addCoin($player, $amount);
        $this->history->registerHistory();
    }

}