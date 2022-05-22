<?php
declare(strict_types=1);

namespace space\yurisi\SecureCoinAPI;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerLoginEvent;
use pocketmine\plugin\PluginBase;
use space\yurisi\SecureCoinAPI\command\addcoinCommand;
use space\yurisi\SecureCoinAPI\command\mycoinCommand;
use space\yurisi\SecureCoinAPI\command\seecoinCommand;
use space\yurisi\SecureCoinAPI\command\setcoinCommand;
use space\yurisi\SecureCoinAPI\command\takecoinCommand;
use space\yurisi\SecureCoinAPI\database\coinJson;
use space\yurisi\SecureCoinAPI\database\historySQLite;
use space\yurisi\SecureCoinAPI\lib\APIMethod;

class SecureCoinAPI extends PluginBase {

    use APIMethod;

    private static self $main;

    private coinJson $coinJson;

    private historySQLite $history;

    protected function onEnable(): void {
        $this->coinJson = new coinJson($this);
        $this->history = new historySQLite($this);
        $this->registerEvents();
        $this->registerCommands();
        self::$main = $this;
    }

    private function registerEvents() {
        $this->getServer()->getPluginManager()->registerEvents(new class implements Listener {
            function onJoin(PlayerLoginEvent $event) {
                if (!SecureCoinAPI::getInstance()->isRegister($event->getPlayer()->getName())) {
                    SecureCoinAPI::getInstance()->register($event->getPlayer()->getName());
                }
            }
        }, $this);
    }

    private function registerCommands() {
        $this->getServer()->getCommandMap()->registerAll($this->getName(), [
            new addcoinCommand($this),
            new mycoinCommand($this),
            new seecoinCommand($this),
            new takecoinCommand($this),
            new setcoinCommand($this)
        ]);
    }

    protected function onDisable(): void {
        $this->coinJson->save();
        $this->history->save();
    }

    public static function getInstance(): self {
        return self::$main;
    }
}