<?php
declare(strict_types=1);
namespace space\yurisi\SecureCoinAPI\command;

use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use space\yurisi\SecureCoinAPI\SecureCoinAPI;

class seecoinCommand extends SecureCoinCommand {

    public function __construct(private SecureCoinAPI $main) {
        parent::__construct("seecoin", "プレイヤーのお金を確認します", "/seecoin [playerName]");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args) {
        if (!isset($args[0])) {
            $sender->sendMessage($this->getUsage());
            return;
        }

        $receive_player = $this->getPlayer($args[0]);

        if (!$this->main->isRegister($receive_player)) {
            $sender->sendMessage("対象が存在しません。");
            return;
        }

        $amount = $this->main->getCoin($receive_player);

        $sender->sendMessage("§c{$receive_player}の所持金: {$amount}円");
    }
}