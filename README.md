# SecureCoinAPI

## 概要　
宇宙サーバーで使用予定です。

いつどのプラグインでどのタイミングでお金がいじられたかを履歴に残す経済プラグインです。

バグの悪用等でお金が増えていないかを確認できたり、どのプラグインが一番使われているかを分析することができます。


## コマンド

```bash
プレイヤーのお金を増やす
/addcoin [playerName] [amount]

プレイヤーのお金を減らす
/takecoin [playerName] [amount]

自分のお金を確認
/mycoin

他人のお金を確認
/seecoin [playerName]

お金をセットする
/setcoin [playerName]
```

## API

インスタンスを取得
```php
use space\yurisi\SecureCoinAPI\SecureCoinAPI;
$api = SecureCoinAPI::getInstance();
```

お金を追加

https://github.com/SpaceServerDev/SecureCoinAPI/blob/32b109c19cb7ba73f3086bfb33d5ad1bc84d30e9/src/space/yurisi/SecureCoinAPI/command/addcoinCommand.php#L30-L36
```php
use space\yurisi\SecureCoinAPI\SecureCoinAPI;
use space\yurisi\SecureCoinAPI\History

$history = new History(
    $player->getName(),
    null,
    増やすお金,
    "プラグイン名",
    "詳細(省略可)"
);
$api->addCoin($history);
```

お金を減らす

https://github.com/SpaceServerDev/SecureCoinAPI/blob/6039c0e18dedfa58431a77d80e9bbdf2758a15fb/src/space/yurisi/SecureCoinAPI/command/takecoinCommand.php#L43-L49
```php
use space\yurisi\SecureCoinAPI\SecureCoinAPI;
use space\yurisi\SecureCoinAPI\History

$history = new History(
    $player->getName(),
    null,
    減らすお金,
    "プラグイン名",
    "詳細(省略可)"
);
$api->takeCoin($history);
```

お金を取得

https://github.com/SpaceServerDev/SecureCoinAPI/blob/32b109c19cb7ba73f3086bfb33d5ad1bc84d30e9/src/space/yurisi/SecureCoinAPI/command/takecoinCommand.php#L28-L34

```php
$api->getCoin($player->getName());
```

お金をセット
https://github.com/SpaceServerDev/SecureCoinAPI/blob/32b109c19cb7ba73f3086bfb33d5ad1bc84d30e9/src/space/yurisi/SecureCoinAPI/command/setcoinCommand.php#L29-L35

```php
$this->main->setCoin(new History(
    $player->getName(),
    null,
    セットするお金,
    "プラグイン名",
    "詳細(省略可)"
));
```
