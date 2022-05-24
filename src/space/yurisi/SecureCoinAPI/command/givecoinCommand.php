<?php
declare(strict_types=1);

namespace space\yurisi\SecureCoinAPI\command;

use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use space\yurisi\SecureCoinAPI\History;
use space\yurisi\SecureCoinAPI\SecureCoinAPI;

class givecoinCommand extends SecureCoinCommand{

    public function __construct(private SecureCoinAPI $main) {
        parent::__construct('givecoin', '自分のお金を他人に譲渡します。', '/givecoin [playerName] [amount]');
        $this->setPermission("space.yurisi.SecureCoinAPI.givecoin");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args) {
        if (!$this->testPermission($sender)) return;

        $amount = $this->getAmount($args, $sender);

        if($amount === null) return;

        if ($amount === 0){
            $sender->sendMessage('0は指定できません。');
            return;
        }

        if (!$sender instanceof Player){
            $sender->sendMessage('ゲーム内で実行してください。');
            return;
        }

        $receive_player = $this->getPlayer($args[0]);
        $sent_player = $sender->getName();

        if (!$this->main->isRegister($receive_player) || !$this->main->isRegister($sent_player)) {
            $sender->sendMessage("対象が存在しません。");
            return;
        }

        if ($receive_player == $sent_player) {
            $sender->sendMessage("自分自身には渡せません。");
            return;
        }

        if(!$this->main->isEnoughCoin($sent_player, $amount)){
            $sender->sendMessage("お金が足りません。");
            return;
        }

        $this->main->addCoin(new History(
            $receive_player,
            $sent_player,
            $amount,
            $this->main->getName(),
            $this->getDescription()
        ));

        $this->main->takeCoin(new History(
            $sent_player,
            $receive_player,
            $amount,
            $this->main->getName(),
            $this->getDescription()
        ));

        $sender->sendMessage("§c{$receive_player}に{$amount}円を渡しました");
    }
}