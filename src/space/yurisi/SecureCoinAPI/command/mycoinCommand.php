<?php
declare(strict_types=1);

namespace space\yurisi\SecureCoinAPI\command;

use pocketmine\command\CommandSender;
use pocketmine\command\defaults\VanillaCommand;
use pocketmine\player\Player;
use space\yurisi\SecureCoinAPI\SecureCoinAPI;

class mycoinCommand extends SecureCoinCommand {

    public function __construct(private SecureCoinAPI $main) {
        parent::__construct("mycoin", "所持金を確認します", "/mycoin");
        $this->setPermission("space.yurisi.SecureCoinAPI.mycoin");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args) {
        if (!$this->testPermission($sender)) return;
        if (!$sender instanceof Player) {
            $sender->sendMessage("プレイヤーのみ実行できるコマンドです");
            return;
        }

        $player = $sender->getName();

        if (!$this->main->isRegister($player)) {
            $sender->sendMessage("口座が存在しません。");
            return;
        }

        $amount = $this->main->getCoin($player);

        $sender->sendMessage("§cあなたの所持金 : {$amount}");
    }
}