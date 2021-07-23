# 概要 
LaravelでECのデモサイトで構築しました。設計思想はドメイン駆動設計(以下ddd)、アーキテクチャはクリーンアーキテクチャを採用しました。LaravelのWebアプリケーションをdddやクリーンアーキテクチャで構築すると、MVCで構築するのと比べて実装量やファイル数が増えるのでは？また、処理速度も遅くなるのでは？という懸念を抱いておりました。ただ、それは実際に試してみないとわからないと思い、同じ機能をddd、MVCで実相し、比較する事にしました。やるなら実践的なプロジェクトが望ましいし、イメージし易いと考えて、題材はECのデモサイトにしました。構築パターンは、ddd、軽量ddd、MVCの3パターンです。ddd、軽量dddの違いは、dddはクリーンアーキテクチャに忠実に実装したのに比べて、軽量dddはプレゼンター、ViewModel、UseCaseDataを共通クラスに実装して実装量の削減をしています。   
  
なお、Viewはbladeを使っているものの、殆どReactで実装しました。SPAにも出来たのですが、本プロジェクトの趣旨ではないのでSPAにはあえてしていません。Reactより使い慣れてるVue.jsの方が実装しやすかったのですが、いい機会だったのでついでにReactもかじってみました。   
  
# ミドルウェア 
Apache 2.4.34  
PHP 8.0.7  
PostgreSQL 13.3  
  
# フレームワーク・ライブラリ 
Laravel 8.48.1  
React 17.0.2  
material-ui 4.11.4  
typescript 4.3.4  
sass 1.35.1  
npm 6.14.12  
  
# ディレクトリ構成 
### packages/Common
共通モジュール
### packages/DDDEcSample
dddのモジュール
### packages/LightDDDEcSample
軽量dddのモジュール
### packages/MvcSample
MVCのモジュール
### tests/Unit/DDDEcSample
dddのUnitTest
### tests/Unit/LightDDDEcSample
軽量dddのUnitTest
### tests/Unit/MvcSample
MVCのUnitTest
### DDDModel
UmbrelloというUMLツールで設計したクラス図、シーケンス図を保存した「Umbrelloモデルファイル.xmi」、それらの画像出力した画像ファイル
  
# プロジェクトの環境構築について
マイグレーションファイル、シーダーファイルを作っているので、それを用いれば環境構築してデバッグ可能です。  
以下コマンドで環境構築出来ます。  
```
composer install
npm insall
php artisan migrate:fresh
php artisan db:seed
```
  
# 機能概要
- 商品一覧
- 商品詳細
- カート
- 注文
  
# 設計 
Umbrelloというソフトでクリーンアーキテクチャのベースとなるクラス図、シーケンス図を作成し、PHPでエクスポートしたソースコードをベースに実装を進めました。本当にIF部分だけのスケルトン生成なので、わざわざクラス図から生成する必要も無いのですが、検証の意味でトライしてみました。クリーンアーキテクチャのクラス図と見比べつつクラスを作成出来たので、やって良かったと考えています。「DDDModel」というフォルダにその結果を収めております。
  
### クラス図
![クラス図](https://github.com/take-t14/laravel-ddd-sample/blob/master/DDDModel/%E3%82%AF%E3%83%A9%E3%82%B9%E5%9B%B3.png)

### シーケンス図
![シーケンス図](https://github.com/take-t14/laravel-ddd-sample/blob/master/DDDModel/%E3%82%B7%E3%83%BC%E3%82%B1%E3%83%B3%E3%82%B9%E5%9B%B3.png)
  
# 自動テスト 
全機能に対するUnitTestを実装しました。TDDも勉強していた為、実装の過程で実践しました。何度かリファクタリングをしたのですが、その度にグリーン(自動テストオールOK)だったのが、レッド(自動テストオールNG)になりました。そこからグリーンにするまで修正したら、画面テストがキチンと動作する事を確認出来ました。UnitTestで非常に信頼性の高い検証を行える事が、この事から立証出来たと思います。キチンとUnitTestを実装したら、機能追加やリファクタリングを自信を持って行えると思います。 
  
# ステップ数
| 種別 | ファイル数 | ステップ数 |
| ---- | ---- | ---- |
| ddd | 152 | 3,444 |
| 軽量ddd | 102 | 2,298 |
| MVC | 23 | 725 |
  
上記の通り、懸念していたとおりdddはファイル数、ステップ数共に圧倒的にMVCと比較して多くなる結果となりました。一方でdddは1クラスの凝集度は高く、ほとんど50ステップ未満なので、実装工数は数ほどのインパクトがあるわけではありません。クラスの凝集度が高い分、どこに何が記載されているか、このクラスの役割は何かがひと目で把握しやすいメリットもあります。実装量、ファイル数が多い＝悪ではないという事を言いたいのですが、それぞれメリット、デメリットがあります。詳細を以下にまとめたいと思います。  
  
# パフォーマンス 
app/Http/Middleware/PerformanceLog.php  
上記ファイルにコントローラー実行前後にログを出力し、処理時間、処理に使用したメモリを計測できるようにしました。その計測結果を以下にまとめます。  
MVC > 軽量ddd > dddという結果でした。  
  
## 結果一覧
| 機能 | ddd時間 | dddメモリ | 軽量ddd時間 | 軽量dddメモリ | MVC時間 | MVCメモリ |
| ---- | ---- | ---- | ---- | ---- | ---- | ---- |
| 商品一覧画面表示 | 289ms | 6299KB | 178ms | 5049KB | 85ms | 2735KB |
| 商品詳細画面表示 | 63ms | 650KB | 18ms | 600KB | 23ms | 627KB |
| カート追加API | 153ms | 419KB | 19ms | 418KB | 51ms | 839KB |
| カート画面表示 | 36ms | 468KB | 10ms | 382KB | 21ms | 640KB |
| 注文画面表示 | 20ms | 468KB | 9ms | 382KB | 20ms | 640KB |
| 注文バリデーションAPI | 34ms | 422KB | 31ms | 506KB | 58ms | 814KB |
| 注文確定処理 | 2552ms | 1334KB | 2517ms | 1061KB | 1949ms | 1376KB |
  
## エビデンス
### ddd
```
[2021-07-23 23:00:19] local.DEBUG: Packages\DDDEcSample\InterfaceAdapters\Controllers\ProductController@list 繝｡繝｢繝ｪ 6298.953125KB  
[2021-07-23 23:00:19] local.DEBUG: Packages\DDDEcSample\InterfaceAdapters\Controllers\ProductController@list 288.98096084595繝溘Μ遘・ 
[2021-07-23 23:07:51] local.DEBUG: Packages\DDDEcSample\InterfaceAdapters\Controllers\ProductController@detail 繝｡繝｢繝ｪ 649.6484375KB  
[2021-07-23 23:07:51] local.DEBUG: Packages\DDDEcSample\InterfaceAdapters\Controllers\ProductController@detail 62.504053115845繝溘Μ遘・ 
[2021-07-23 23:08:28] local.DEBUG: Packages\DDDEcSample\InterfaceAdapters\Controllers\Api\CartController@add 繝｡繝｢繝ｪ 418.6953125KB  
[2021-07-23 23:08:28] local.DEBUG: Packages\DDDEcSample\InterfaceAdapters\Controllers\Api\CartController@add 153.38611602783繝溘Μ遘・ 
[2021-07-23 23:08:28] local.DEBUG: Packages\DDDEcSample\InterfaceAdapters\Controllers\CartController@list 繝｡繝｢繝ｪ 468.3046875KB  
[2021-07-23 23:08:28] local.DEBUG: Packages\DDDEcSample\InterfaceAdapters\Controllers\CartController@list 36.375999450684繝溘Μ遘・ 
[2021-07-23 23:09:27] local.DEBUG: Packages\DDDEcSample\InterfaceAdapters\Controllers\OrderController@form 繝｡繝｢繝ｪ 468.3046875KB  
[2021-07-23 23:09:27] local.DEBUG: Packages\DDDEcSample\InterfaceAdapters\Controllers\OrderController@form 19.876003265381繝溘Μ遘・ 
[2021-07-23 23:09:37] local.DEBUG: Packages\DDDEcSample\InterfaceAdapters\Controllers\Api\OrderController@check 繝｡繝｢繝ｪ 421.9609375KB  
[2021-07-23 23:09:37] local.DEBUG: Packages\DDDEcSample\InterfaceAdapters\Controllers\Api\OrderController@check 33.753156661987繝溘Μ遘・ 
[2021-07-23 23:09:44] local.DEBUG: Packages\DDDEcSample\InterfaceAdapters\Controllers\Api\OrderController@save 繝｡繝｢繝ｪ 1334.2734375KB  
[2021-07-23 23:09:44] local.DEBUG: Packages\DDDEcSample\InterfaceAdapters\Controllers\Api\OrderController@save 2552.1411895752繝溘Μ遘・ 
```
  
### 軽量ddd
```
[2021-07-23 23:11:33] local.DEBUG: Packages\LightDDDEcSample\InterfaceAdapters\Controllers\ProductController@list 繝｡繝｢繝ｪ 5049.25KB  
[2021-07-23 23:11:33] local.DEBUG: Packages\LightDDDEcSample\InterfaceAdapters\Controllers\ProductController@list 177.73199081421繝溘Μ遘・ 
[2021-07-23 23:11:36] local.DEBUG: Packages\LightDDDEcSample\InterfaceAdapters\Controllers\ProductController@detail 繝｡繝｢繝ｪ 600.1328125KB  
[2021-07-23 23:11:36] local.DEBUG: Packages\LightDDDEcSample\InterfaceAdapters\Controllers\ProductController@detail 18.326997756958繝溘Μ遘・ 
[2021-07-23 23:11:38] local.DEBUG: Packages\LightDDDEcSample\InterfaceAdapters\Controllers\Api\CartController@add 繝｡繝｢繝ｪ 417.765625KB  
[2021-07-23 23:11:38] local.DEBUG: Packages\LightDDDEcSample\InterfaceAdapters\Controllers\Api\CartController@add 19.247770309448繝溘Μ遘・ 
[2021-07-23 23:11:38] local.DEBUG: Packages\LightDDDEcSample\InterfaceAdapters\Controllers\CartController@list 繝｡繝｢繝ｪ 382.2265625KB  
[2021-07-23 23:11:38] local.DEBUG: Packages\LightDDDEcSample\InterfaceAdapters\Controllers\CartController@list 10.499000549316繝溘Μ遘・ 
[2021-07-23 23:11:40] local.DEBUG: Packages\LightDDDEcSample\InterfaceAdapters\Controllers\OrderController@form 繝｡繝｢繝ｪ 382.2265625KB  
[2021-07-23 23:11:40] local.DEBUG: Packages\LightDDDEcSample\InterfaceAdapters\Controllers\OrderController@form 9.2220306396484繝溘Μ遘・ 
[2021-07-23 23:11:49] local.DEBUG: Packages\LightDDDEcSample\InterfaceAdapters\Controllers\Api\OrderController@check 繝｡繝｢繝ｪ 506.1171875KB  
[2021-07-23 23:11:49] local.DEBUG: Packages\LightDDDEcSample\InterfaceAdapters\Controllers\Api\OrderController@check 30.539989471436繝溘Μ遘・ 
[2021-07-23 23:11:53] local.DEBUG: Packages\LightDDDEcSample\InterfaceAdapters\Controllers\Api\OrderController@save 繝｡繝｢繝ｪ 1061.2578125KB  
[2021-07-23 23:11:53] local.DEBUG: Packages\LightDDDEcSample\InterfaceAdapters\Controllers\Api\OrderController@save 2517.3659324646繝溘Μ遘・ 
```
  
### MVC
```
[2021-07-23 23:10:28] local.DEBUG: Packages\MvcSample\App\Http\Controllers\ProductController@list 繝｡繝｢繝ｪ 2735.3828125KB  
[2021-07-23 23:10:28] local.DEBUG: Packages\MvcSample\App\Http\Controllers\ProductController@list 84.88392829895繝溘Μ遘・ 
[2021-07-23 23:10:31] local.DEBUG: Packages\MvcSample\App\Http\Controllers\ProductController@detail 繝｡繝｢繝ｪ 627.4375KB  
[2021-07-23 23:10:31] local.DEBUG: Packages\MvcSample\App\Http\Controllers\ProductController@detail 22.572994232178繝溘Μ遘・ 
[2021-07-23 23:10:34] local.DEBUG: Packages\MvcSample\App\Http\Controllers\Api\CartController@add 繝｡繝｢繝ｪ 838.9921875KB  
[2021-07-23 23:10:34] local.DEBUG: Packages\MvcSample\App\Http\Controllers\Api\CartController@add 50.947904586792繝溘Μ遘・ 
[2021-07-23 23:10:34] local.DEBUG: Packages\MvcSample\App\Http\Controllers\CartController@list 繝｡繝｢繝ｪ 639.7109375KB  
[2021-07-23 23:10:34] local.DEBUG: Packages\MvcSample\App\Http\Controllers\CartController@list 20.750045776367繝溘Μ遘・ 
[2021-07-23 23:10:36] local.DEBUG: Packages\MvcSample\App\Http\Controllers\OrderController@form 繝｡繝｢繝ｪ 639.7109375KB  
[2021-07-23 23:10:36] local.DEBUG: Packages\MvcSample\App\Http\Controllers\OrderController@form 20.180940628052繝溘Μ遘・ 
[2021-07-23 23:10:45] local.DEBUG: Packages\MvcSample\App\Http\Controllers\Api\OrderController@check 繝｡繝｢繝ｪ 813.6875KB  
[2021-07-23 23:10:45] local.DEBUG: Packages\MvcSample\App\Http\Controllers\Api\OrderController@check 57.819128036499繝溘Μ遘・ 
[2021-07-23 23:10:53] local.DEBUG: Packages\MvcSample\App\Http\Controllers\Api\OrderController@save 繝｡繝｢繝ｪ 1375.6796875KB  
[2021-07-23 23:10:53] local.DEBUG: Packages\MvcSample\App\Http\Controllers\Api\OrderController@save 1949.3370056152繝溘Μ遘・ 
```
  
# メリット・デメリット
## ddd
### メリット
- クラスの凝集度が高くなり、1クラス当りのステップ数は少なくなって可読性、メンテナンス性が高くなる
- レイヤー毎にインターフェースで依存関係逆転の原則を用いることで、疎結合な実装となる
- 疎結合な為UnitTestを実装しやすい
### デメリット
- クラス数、ステップ数が多くなる
- ドメインモデル→UseCaseData→ViewModelとレイヤーをまたぐ毎にデータの変換が必要となり、パフォーマンスが低下する
  
## 軽量ddd
### メリット
- 低凝集、疎結合、UnitTestの実装のしやすさはdddのメリットを継承
- dddに比べてファイル数、実装量が削減される
### デメリット
- ドメインモデル→ViewModelを、ドメインモデルの配列化で実現しているが、パフォーマンスはdddからそれほど改善しない
  
## MVC
### メリット
- ddd、軽量dddと比べて実装量、ファイル数が圧倒的に少ない
### デメリット
- コントローラー、モデルクラスにビジネスロジックが集中し、メンテナンス性が悪い神クラスが生まれやすくなる
- フレームワークと密結合な実装となるため、UnitTestが実装し辛く、実装するには工夫が必要となる
　　
# デモサイト
以下にデモサイトを構築しました。  
- ddd
http://www.take14.shop/ddd/product/list  
- 軽量ddd
http://www.take14.shop/lightddd/product/list  
- MVC
http://www.take14.shop/mvc/product/list  
　　
####基本認証をかけているので、ご覧になりたい方は以下のID、パスワードをご利用下さい  

| ID | パスワード |
| ---- | ---- |
| take14 | UP6-hL$Z.8ghBn?c |
