<?php
declare(strict_types=1);

namespace space\yurisi\SecureCoinAPI\command;

use pocketmine\command\CommandSender;
use space\yurisi\SecureCoinAPI\SecureCoinAPI;

class coinhistoryCommand extends SecureCoinCommand {

    public function __construct(private SecureCoinAPI $main) {
        parent::__construct("coinhistory", "履歴を表示する", "/coinhistory [pluginName] [page = 1]");
        $this->setPermission("space.yurisi.SecureCoinAPI.coinhistory");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args) {
        if (!$this->testPermission($sender)) return;
        $this->main->save();

        if(!isset($args[0])){
            $sender->sendMessage($this->getUsage());
            return;
        }

        $player = $this->getPlayer($args[0]);

        if(!isset($args[1])) $args[1] = 1;

        if(!is_numeric($args[1])){
            $sender->sendMessage($this->getUsage());
            return;
        }
        if($args[1] <= 0){
            $sender->sendMessage($this->getUsage());
            return;
        }

        $history = $this->main->getHistory($player, (int)$args[1]);

        if($history == null){
            $sender->sendMessage("履歴が存在しませんでした。");
            return;
        }

        $sender->sendMessage('現在の経済状況を保存しました！');
        $sender->sendMessage($player.'の履歴');
        $sender->sendMessage("id | 送信プレイヤー | 数量 | プラグイン | クラス | メソッド | 詳細");

        foreach ($history as $data){
            $sender->sendMessage($data);
        }
    }
}