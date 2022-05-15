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

    public function register(Player $player) {
        $this->data[$player->getName()] = 1000;
    }

    public function isRegister(Player $player): bool {
        return isset($this->data[$player->getName()]);
    }

    public function getCoin(Player $player): ?int {
        if (!isset($this->data[$player->getName()])) {
            return null;
        }
        return $this->data[$player->getName()];
    }

    public function addCoin(Player $player, int $amount) {
        $this->data[$player->getName()] += $amount;
    }

    public function takeCoin(Player $player, int $amount): bool {
        if ($this->data[$player->getName()] < $amount) {
            return false;
        }
        $this->data[$player->getName()] -= $amount;
        return true;
    }
}