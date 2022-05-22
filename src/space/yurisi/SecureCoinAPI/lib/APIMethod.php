<?php
declare(strict_types=1);

namespace space\yurisi\SecureCoinAPI\lib;

use space\yurisi\SecureCoinAPI\History;

trait APIMethod {

    /**
     * プレイヤーにお金を付与します
     *
     * @param History $history
     * @return void
     */
    public function addCoin(History $history) {
        $this->coinJson->addCoin($history->getReceivedPlayer(), $history->getAmount());
        $this->history->registerHistory($history);
    }

    /**
     * プレイヤーからお金を奪います
     *
     * @param History $history
     * @return void
     */
    public function takeCoin(History $history) {
        $take = $this->coinJson->takeCoin($history->getReceivedPlayer(), $history->getAmount());
        $history->setAmount(-$take);
        $this->history->registerHistory($history);
    }

    /**
     * プレイヤーのお金をセットします
     *
     * @param History $history
     * @return void
     */
    public function setCoin(History $history) {
        $history = $this->coinJson->setCoin($history);
        if($history == null) return;
        $this->history->registerHistory($history);
    }

    /**
     * プレイヤーのお金を取得します
     *
     * @param string $name
     * @return int|null
     */
    public function getCoin(string $name): ?int {
        return $this->coinJson->getCoin($name);
    }

    /**
     * 指定された名前の口座を追加します
     *
     * @param string $name
     * @return void
     */
    public function register(string $name) {
        $this->coinJson->register($name);
    }

    /**
     * 口座が存在するか確認します
     *
     * @param string $name
     * @return bool
     */
    public function isRegister(string $name): bool {
        return $this->coinJson->isRegister($name);
    }
}