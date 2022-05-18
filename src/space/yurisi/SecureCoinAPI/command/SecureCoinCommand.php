<?php

namespace space\yurisi\SecureCoinAPI\command;

use pocketmine\command\defaults\VanillaCommand;
use pocketmine\player\Player;
use pocketmine\Server;

abstract class SecureCoinCommand extends VanillaCommand {

    public function getPlayer(string $name): string {
        $receive_player = Server::getInstance()->getPlayerByPrefix($name);

        if ($receive_player instanceof Player) {
            $receive_player = $receive_player->getName();
        } else {
            $receive_player = $name;
        }
        return $receive_player;
    }

}