<?php
declare(strict_types=1);

namespace space\yurisi\SecureCoinAPI\database;

use space\yurisi\SecureCoinAPI\History;
use space\yurisi\SecureCoinAPI\SecureCoinAPI;

class historySQLite extends \SQLite3 {

    private array $history = [];

    public function __construct(SecureCoinAPI $main) {
        parent::__construct($main->getDataFolder() . 'history.db', SQLITE3_OPEN_READWRITE | SQLITE3_OPEN_CREATE);
        $sql = /** @lang SQLite */
            "CREATE TABLE IF NOT EXISTS history (id INTEGER PRIMARY KEY AUTOINCREMENT,
                                                            received_player TEXT,
                                                            sent_player TEXT,
                                                            plugin TEXT,
                                                            class TEXT,
                                                            method TEXT,
                                                            amount INTEGER)";
        $this->query($sql);
    }

    public function registerHistory(History $history) {
        $this->$history[] = [
            'received_player' => $history->getReceivedPlayer(),
            'sent_player' => $history->getSentPlayer(),
            'plugin' => $history->getPlugin(),
            'class' => $history->getClass(),
            'method' => $history->getMethod(),
            'amount' => $history->getAmount()
        ];
    }

    public function save(){
        $value = [];
        foreach ($this->history as $data) {
            $received_player   = $data['received_player'];
            $sent_player = $data['sent_player'];
            $plugin   = $data['plugin'];
            $class = $data['class'];
            $method   = $data['method'];
            $amount = $data['amount'];
            $value[] = "('{$received_player}', '{$sent_player}', '{$plugin}', '{$class}', '{$method}', '{$amount}')";
        }
        $sql = /** @lang SQLite */
            "INSERT INTO history (received_player, sent_player, plugin, class, method, amount) VALUES ".join(",", $value);
        $this->query($sql);
    }


}