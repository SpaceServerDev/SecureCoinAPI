<?php
declare(strict_types=1);

namespace space\yurisi\SecureCoinAPI\command;

use pocketmine\command\CommandSender;
use space\yurisi\SecureCoinAPI\History;
use space\yurisi\SecureCoinAPI\SecureCoinAPI;

class addcoinCommand extends SecureCoinCommand {

    public function __construct(private SecureCoinAPI $main) {
        parent::__construct("addcoin", "プレイヤーにお金を渡します", "/addcoin [playerName] [amount]");
        $this->setPermission("space.yurisi.SecureCoinAPI.addcoin");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args) {
        if (!$this->testPermission($sender)) return;

        $amount = $this->getAmount($args, $sender);

        if($amount == null) return;

        $receive_player = $this->getPlayer($args[0]);

        if (!$this->main->isRegister($receive_player)) {
            $sender->sendMessage("対象が存在しません。");
            return;
        }

        $this->main->addCoin(new History(
            $receive_player,
            null,
            $amount,
            $this->main->getName(),
            $this->getDescription()
        ));

        $sender->sendMessage("§c{$receive_player}に{$amount}円を与えました");
    }
}