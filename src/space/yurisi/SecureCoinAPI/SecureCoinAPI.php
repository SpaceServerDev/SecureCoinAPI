<?php
declare(strict_types=1);

namespace space\yurisi\SecureCoinAPI;

use pocketmine\plugin\PluginBase;

class SecureCoinAPI extends PluginBase {

    private static self $main;

    protected function onEnable(): void {

        self::$main = $this;
    }

    protected function onDisable(): void {

    }

    public function getInstance(): self {
        return self::$main;
    }

}