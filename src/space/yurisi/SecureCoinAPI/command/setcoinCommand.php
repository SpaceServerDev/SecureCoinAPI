<?php
declare(strict_types=1);

namespace space\yurisi\SecureCoinAPI\command;

use pocketmine\command\CommandSender;


class setcoinCommand extends SecureCoinCommand {

    public function __construct() {
        parent::__construct("/setcoin", 'プレイヤーのお金を変更します。', '/setcoin [playerName] [amount]');
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args) {
        // TODO: Implement execute() method.
    }
}