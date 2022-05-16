<?php
declare(strict_types=1);

namespace space\yurisi\SecureCoinAPI\database;

use pocketmine\player\Player;
use pocketmine\utils\Config;
use space\yurisi\SecureCoinAPI\SecureCoinAPI;

class coinYaml extends Config {

    private array $data = [];

    public function __construct(SecureCoinAPI $main) {
        parent::__construct($main->getDataFolder() . 'coin.json', Config::JSON);
        $this->data = $this->getAll();
    }

    public function register(string $name) {
        $name = strtolower($name);
        $this->data[$name] = 1000;
    }

    public function isRegister(string $name): bool {
        $name = strtolower($name);
        return isset($this->data[$name]);
    }

    public function getCoin(string $name): ?int {
        $name = strtolower($name);
        if (!isset($this->data[$name])) {
            return null;
        }
        return $this->data[$name];
    }

    public function addCoin(string $name, int $amount) {
        $name = strtolower($name);
        $this->data[$name] += $amount;
    }

    public function takeCoin(string $name, int $amount): bool {
        $name = strtolower($name);
        if ($this->data[$name] < $amount) {
            return false;
        }
        $this->data[$name] -= $amount;
        return true;
    }

    public function save(): void {
        $this->setAll($this->data);
        try {
            parent::save();
        } catch (\JsonException $e) {
        }
    }
}