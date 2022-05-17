<?php

namespace space\yurisi\SecureCoinAPI\command;

use pocketmine\command\CommandSender;
use pocketmine\command\defaults\VanillaCommand;
use pocketmine\player\Player;
use space\yurisi\SecureCoinAPI\History;
use space\yurisi\SecureCoinAPI\SecureCoinAPI;

class takecoinCommand extends VanillaCommand {

    public function __construct(private SecureCoinAPI $main) {
        parent::__construct("takecoin", "プレイヤーからお金を奪います", "/takecoin [playerName] [amount]");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args) {
        if (!isset($args[0]) || !isset($args[1])) {
            $sender->sendMessage($this->getUsage());
            return;
        }

        if (!is_numeric($args[1])) {
            $sender->sendMessage($this->getUsage());
            return;
        }

        $amount = (int)floor((int)$args[1]);

        $receive_player = $this->main->getServer()->getPlayerByPrefix($args[0]);

        if ($receive_player instanceof Player) {
            $receive_player = $receive_player->getName();
        } else {
            $receive_player = $args[0];
        }

        if (!$this->main->isRegister($receive_player)) {
            $sender->sendMessage("対象が存在しません。");
            return;
        }

        $this->main->takeCoin(new History(
            $receive_player,
            null,
            $amount,
            $this->main->getName(),
            $this->getDescription()
        ));

        $sender->sendMessage("§c{$receive_player}から{$amount}円を奪いました");
    }
}