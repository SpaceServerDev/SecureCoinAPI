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

https://github.com/SpaceServerDev/SecureCoinAPI/blob/55ac74ce820969bcd1dea0ab73b24ae9501bf332/src/space/yurisi/SecureCoinAPI/command/addcoinCommand.php#L43-L51
```php
use space\yurisi\SecureCoinAPI\SecureCoinAPI;
use space\yurisi\SecureCoinAPI\History

$history = new History(
    $player->getName(),
    null,
    "増やすお金",
    "プラグイン名",
    "クラス名",
    "メソッド名",
    "詳細(省略可)"
)
$api->addMoney($history);
```

お金を取得
```php
$api->getMoney($player->getName());
```
