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
                                                            received_player TEXT NOT NULL,
                                                            sent_player TEXT,
                                                            plugin TEXT,
                                                            class TEXT,
                                                            method TEXT,
                                                            description TEXT,
                                                            amount INTEGER NOT NULL)";
        $this->query($sql);
    }

    public function registerHistory(History $history) {
        $this->history[] = $history;
    }

    public function save(){
        if(count($this->history) <= 0) return;
        $value = [];
        foreach ($this->history as $data) {
            /** @var History $data */
            $received_player   = $data->getReceivedPlayer();
            $sent_player = $data->getSentPlayer() ?? "null";
            $plugin   = $data->getPlugin();
            $class = $data->getClass();
            $method   = $data->getMethod();
            $description = $data->getDescription();
            $amount = $data->getAmount();
            $value[] = "('{$received_player}', '{$sent_player}', '{$plugin}', '{$class}', '{$method}', '{$description}', '{$amount}')";
        }
        $sql = /** @lang SQLite */
            "INSERT INTO history (received_player, sent_player, plugin, class, description, method, amount) VALUES ".join(",", $value);
        $this->query($sql);
    }


}