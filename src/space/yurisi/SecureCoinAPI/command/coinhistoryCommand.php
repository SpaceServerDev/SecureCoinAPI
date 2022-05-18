<?php
declare(strict_types=1);

namespace space\yurisi\SecureCoinAPI\command;

use pocketmine\command\CommandSender;

class coinhistoryCommand extends SecureCoinCommand {

    public function __construct() {
        parent::__construct("coinhistory", "履歴を表示する", "/coinhistory [pluginName]");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args) {
        // TODO: Implement execute() method.
    }
}