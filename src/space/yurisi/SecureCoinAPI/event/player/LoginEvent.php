<?php
declare(strict_types=1);

namespace space\yurisi\SecureCoinAPI\event\player;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerLoginEvent;
use space\yurisi\SecureCoinAPI\SecureCoinAPI;

class LoginEvent implements Listener {

    public function __construct(private SecureCoinAPI $main) {
    }

    public function onJoin(PlayerLoginEvent $event){
        if(!$this->main->isRegister($event->getPlayer())){
            $this->main->register($event->getPlayer());
        }
    }
}