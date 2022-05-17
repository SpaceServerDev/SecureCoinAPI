# SecureCoinAPI

## 概要　
宇宙サーバーで使用予定です。

いつどのプラグインでどのタイミングでお金がいじられたかを履歴に残す経済プラグインです。

バグの悪用等でお金が増えていないかを確認できたり、どのプラグインが一番使われているかを分析することができます。


## コマンド

```bash
プレイヤーのお金を増やす
/addmoney [playerName] [amount]

自分のお金を確認
/mymoney
```

## API

インスタンスを取得
```php
use space\yurisi\SecureCoinAPI\SecureCoinAPI;
$api = SecureCoinAPI::getInstance();
```

お金を追加

https://github.com/SpaceServerDev/SecureCoinAPI/blob/6039c0e18dedfa58431a77d80e9bbdf2758a15fb/src/space/yurisi/SecureCoinAPI/command/addcoinCommand.php#L44-L50
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

https://github.com/SpaceServerDev/SecureCoinAPI/blob/87252872ac9dd25a450102f807d8b0c231ee6324/src/space/yurisi/SecureCoinAPI/command/seecoinCommand.php#L35
```php
$api->getCoin($player->getName());
```
