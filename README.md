# SecureCoinAPI

## 概要　
宇宙サーバーで使用予定です。

いつどのプラグインでどのタイミングでお金がいじられたかを履歴に残す経済プラグインです。

バグの悪用等でお金が増えていないかを確認できたり、どのプラグインが一番使われているかを分析することができます。


## コマンド
### example

```bash
/example [x] [y] [z]
```

## API

インスタンスを取得
```php
$api = Example::getInstance();
```

お金を取得
```php
$api->getMoney($player);
```


## コンフィグ
```yaml
1:
  ID: 1
  Meta: 1
```

## その他


