<?php
declare(strict_types=1);

namespace space\yurisi\SecureCoinAPI\command;

use pocketmine\command\CommandSender;
use pocketmine\command\defaults\VanillaCommand;
use pocketmine\player\Player;
use pocketmine\Server;

abstract class SecureCoinCommand extends VanillaCommand {

    protected function getPlayer(string $name): string {
        $receive_player = Server::getInstance()->getPlayerByPrefix($name);

        if ($receive_player instanceof Player) {
            $receive_player = $receive_player->getName();
        } else {
            $receive_player = $name;
        }
        return $receive_player;
    }

    protected function getAmount(array $args, CommandSender $sender): ?int {
        if (!isset($args[0]) || !isset($args[1])) {
            $sender->sendMessage($this->getUsage());
            return null;
        }

        if (!is_numeric($args[1])) {
            $sender->sendMessage($this->getUsage());
            return null;
        }

        if ((int)$args[1] < 0) {
            $sender->sendMessage("数値は正の値を指定してください。");
            return null;
        }

        return (int)floor((int)$args[1]);
    }

}