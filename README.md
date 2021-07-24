# 概要 
LaravelでECのデモサイトで構築しました。設計思想はドメイン駆動設計(以下ddd)、アーキテクチャはクリーンアーキテクチャを採用しました。LaravelのWebアプリケーションをdddやクリーンアーキテクチャで構築すると、MVCで構築するのと比べて実装量やファイル数が増えるのでは？また、処理速度も遅くなるのでは？という懸念を抱いておりました。ただ、それは実際に試してみないとわからないと思い、同じ機能をddd、MVCで実相し、比較する事にしました。やるなら実践的なプロジェクトが望ましいし、イメージし易いと考えて、題材はECのデモサイトにしました。構築パターンは、ddd、軽量ddd、MVCの3パターンです。ddd、軽量dddの違いは、dddはクリーンアーキテクチャに忠実に実装したのに比べて、軽量dddはプレゼンター、ViewModel、UseCaseDataを共通クラスに実装して実装量の削減をしています。  
結果は下にまとめますが、やはり懸念していた通りパフォーマンスはMVC > 軽量ddd > dddという結果で、ファイル数やステップ数もddd > 軽量ddd > MVCと予測通りでした。ただ、パフォーマンスは思っていた程dddが悪い結果では無かったです。  
  
なお、Viewはbladeを使っているものの、ほぼ全てReactで実装しました。SPAにも出来たのですが、本プロジェクトの趣旨ではないのでSPAにはあえてしていません。Reactより使い慣れてるVue.jsの方が実装しやすかったのですが、いい機会だったのでついでにReactもかじってみました。material uiを使うことで、スマホアプリのようなリッチなUI表現に仕上がりました。かつ、レスポンシブにも対応しています。   
  
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
商品一覧のように大量のレコードをDBから取得して表示する箇所は、MVC > 軽量ddd > dddという結果でした。これは、dddの場合取得したレコードをドメインモデルに変換するコストがかかるためです。  
一方意外だったのは、その他はほとんど軽量dddに軍配が上がって軽量ddd > MVC > dddという結果になった点です。詳しくは分析しておりませんが、MVCは手続き型で実装しているので、処理効率が悪い部分があるのでしょうか。もしくは単なる誤差という可能性もあります。いずれにしても気にするほどの差ではありません。商品一覧だけ100ms単位で差が出ているので、大量データ取得・表示のパフォーマンスに影響が出ると考えるのが良さそうです。なお、注文確定処理が2000ms前後と時間がかかっているのは、注文確定のお知らせメール送信処理が含まれるためです。  

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
[2021-07-23 23:00:19] local.DEBUG: Packages\DDDEcSample\InterfaceAdapters\Controllers\ProductController@list メモリ 6298.953125KB  
[2021-07-23 23:00:19] local.DEBUG: Packages\DDDEcSample\InterfaceAdapters\Controllers\ProductController@list 288.98096084595ミリ秒  
[2021-07-23 23:07:51] local.DEBUG: Packages\DDDEcSample\InterfaceAdapters\Controllers\ProductController@detail メモリ 649.6484375KB  
[2021-07-23 23:07:51] local.DEBUG: Packages\DDDEcSample\InterfaceAdapters\Controllers\ProductController@detail 62.504053115845ミリ秒  
[2021-07-23 23:08:28] local.DEBUG: Packages\DDDEcSample\InterfaceAdapters\Controllers\Api\CartController@add メモリ 418.6953125KB  
[2021-07-23 23:08:28] local.DEBUG: Packages\DDDEcSample\InterfaceAdapters\Controllers\Api\CartController@add 153.38611602783ミリ秒  
[2021-07-23 23:08:28] local.DEBUG: Packages\DDDEcSample\InterfaceAdapters\Controllers\CartController@list メモリ 468.3046875KB  
[2021-07-23 23:08:28] local.DEBUG: Packages\DDDEcSample\InterfaceAdapters\Controllers\CartController@list 36.375999450684ミリ秒  
[2021-07-23 23:09:27] local.DEBUG: Packages\DDDEcSample\InterfaceAdapters\Controllers\OrderController@form メモリ 468.3046875KB  
[2021-07-23 23:09:27] local.DEBUG: Packages\DDDEcSample\InterfaceAdapters\Controllers\OrderController@form 19.876003265381ミリ秒  
[2021-07-23 23:09:37] local.DEBUG: Packages\DDDEcSample\InterfaceAdapters\Controllers\Api\OrderController@check メモリ 421.9609375KB  
[2021-07-23 23:09:37] local.DEBUG: Packages\DDDEcSample\InterfaceAdapters\Controllers\Api\OrderController@check 33.753156661987ミリ秒  
[2021-07-23 23:09:44] local.DEBUG: Packages\DDDEcSample\InterfaceAdapters\Controllers\Api\OrderController@save メモリ 1334.2734375KB  
[2021-07-23 23:09:44] local.DEBUG: Packages\DDDEcSample\InterfaceAdapters\Controllers\Api\OrderController@save 2552.1411895752ミリ秒  
```
  
### 軽量ddd
```
[2021-07-23 23:11:33] local.DEBUG: Packages\LightDDDEcSample\InterfaceAdapters\Controllers\ProductController@list メモリ 5049.25KB  
[2021-07-23 23:11:33] local.DEBUG: Packages\LightDDDEcSample\InterfaceAdapters\Controllers\ProductController@list 177.73199081421ミリ秒  
[2021-07-23 23:11:36] local.DEBUG: Packages\LightDDDEcSample\InterfaceAdapters\Controllers\ProductController@detail メモリ 600.1328125KB  
[2021-07-23 23:11:36] local.DEBUG: Packages\LightDDDEcSample\InterfaceAdapters\Controllers\ProductController@detail 18.326997756958ミリ秒  
[2021-07-23 23:11:38] local.DEBUG: Packages\LightDDDEcSample\InterfaceAdapters\Controllers\Api\CartController@add メモリ 417.765625KB  
[2021-07-23 23:11:38] local.DEBUG: Packages\LightDDDEcSample\InterfaceAdapters\Controllers\Api\CartController@add 19.247770309448ミリ秒  
[2021-07-23 23:11:38] local.DEBUG: Packages\LightDDDEcSample\InterfaceAdapters\Controllers\CartController@list メモリ 382.2265625KB  
[2021-07-23 23:11:38] local.DEBUG: Packages\LightDDDEcSample\InterfaceAdapters\Controllers\CartController@list 10.499000549316ミリ秒  
[2021-07-23 23:11:40] local.DEBUG: Packages\LightDDDEcSample\InterfaceAdapters\Controllers\OrderController@form メモリ 382.2265625KB  
[2021-07-23 23:11:40] local.DEBUG: Packages\LightDDDEcSample\InterfaceAdapters\Controllers\OrderController@form 9.2220306396484ミリ秒  
[2021-07-23 23:11:49] local.DEBUG: Packages\LightDDDEcSample\InterfaceAdapters\Controllers\Api\OrderController@check メモリ 506.1171875KB  
[2021-07-23 23:11:49] local.DEBUG: Packages\LightDDDEcSample\InterfaceAdapters\Controllers\Api\OrderController@check 30.539989471436ミリ秒  
[2021-07-23 23:11:53] local.DEBUG: Packages\LightDDDEcSample\InterfaceAdapters\Controllers\Api\OrderController@save メモリ 1061.2578125KB  
[2021-07-23 23:11:53] local.DEBUG: Packages\LightDDDEcSample\InterfaceAdapters\Controllers\Api\OrderController@save 2517.3659324646ミリ秒  
```
  
### MVC
```
[2021-07-23 23:10:28] local.DEBUG: Packages\MvcSample\App\Http\Controllers\ProductController@list メモリ 2735.3828125KB  
[2021-07-23 23:10:28] local.DEBUG: Packages\MvcSample\App\Http\Controllers\ProductController@list 84.88392829895ミリ秒  
[2021-07-23 23:10:31] local.DEBUG: Packages\MvcSample\App\Http\Controllers\ProductController@detail メモリ 627.4375KB  
[2021-07-23 23:10:31] local.DEBUG: Packages\MvcSample\App\Http\Controllers\ProductController@detail 22.572994232178ミリ秒  
[2021-07-23 23:10:34] local.DEBUG: Packages\MvcSample\App\Http\Controllers\Api\CartController@add メモリ 838.9921875KB  
[2021-07-23 23:10:34] local.DEBUG: Packages\MvcSample\App\Http\Controllers\Api\CartController@add 50.947904586792ミリ秒  
[2021-07-23 23:10:34] local.DEBUG: Packages\MvcSample\App\Http\Controllers\CartController@list メモリ 639.7109375KB  
[2021-07-23 23:10:34] local.DEBUG: Packages\MvcSample\App\Http\Controllers\CartController@list 20.750045776367ミリ秒  
[2021-07-23 23:10:36] local.DEBUG: Packages\MvcSample\App\Http\Controllers\OrderController@form メモリ 639.7109375KB  
[2021-07-23 23:10:36] local.DEBUG: Packages\MvcSample\App\Http\Controllers\OrderController@form 20.180940628052ミリ秒  
[2021-07-23 23:10:45] local.DEBUG: Packages\MvcSample\App\Http\Controllers\Api\OrderController@check メモリ 813.6875KB  
[2021-07-23 23:10:45] local.DEBUG: Packages\MvcSample\App\Http\Controllers\Api\OrderController@check 57.819128036499ミリ秒  
[2021-07-23 23:10:53] local.DEBUG: Packages\MvcSample\App\Http\Controllers\Api\OrderController@save メモリ 1375.6796875KB  
[2021-07-23 23:10:53] local.DEBUG: Packages\MvcSample\App\Http\Controllers\Api\OrderController@save 1949.3370056152ミリ秒  
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
- ドメインモデル→ViewModelを、ドメインモデルの配列化で実現しているが、大量データ取得時のパフォーマンスはMVCには及ばない
  
## MVC
### メリット
- ddd、軽量dddと比べて実装量、ファイル数が圧倒的に少ない
- dddと比べてデータの変換が無い為、処理速度が早い傾向にある(特に大量データ取得時)
### デメリット
- コントローラー、モデルクラスにビジネスロジックが集中し、メンテナンス性が悪い神クラスが生まれやすくなる
- フレームワークと密結合な実装となるため、UnitTestが実装し辛く、実装するには工夫が必要となる
　　
# React
仕事でVue.jsの採用経験があるためVue.jsのほうが慣れておりますが、いい機会なのでReactに挑戦しました。仕事でVue.jsかReactのどちらを使用するか検討した際、Vue.jsのほうがデザイナーにも受け入れてもらいやすそうだと感じてVue.jsを採用しました。あと、私自身JSXアレルギーがあって、Vue.jsのようにテンプレート記法の方が既存の技術（HTML、CSS、js、jQueryを用いた実装）に近い感覚で実装出来て、わかりやすく実装しやすいと思っていました。  
ところが今回Reactに挑戦してみて、JSXアレルギーは誤解だったと考えを改めました。jsコードとHTMLをシームレスに書ける事の便利さに驚きました。JSXはプログラミングしている感覚でHTMLを記述出来ます。なんと言っても自由度の高さです。Vue.jsはHTMLはtemplate、jsロジックはscript、CSSはstyleタグ内に記述するように決まっています。そして、jsロジックの実装ルールも定まっていて、それに沿って実装します。Reactはというと・・・一定のルールはあるものの、かなり自由に実装できます。ただこれは副作用もあります。自由ということは、きちんとコーディング規約を作ったり実装方針や設計を定めないと、メンテナンス性の悪いコードも作れてしまいます。MVCはビューとロジックを別で実装する事で、高いメンテナンス性を実現し、プログラマーとデザイナーが分業しやすくなりました。ReactはHTMLとjsを一緒に書けるのは便利な反面、キチンと設計、実装しないとビューとロジックが混雑してデザイナー、プログラマーの分業に支障が出たり、可読性、メンテナンス性の低下を招くと思います。一長一短ですね・・・  
あと、元々懸念していたデザイナーにはハードルが高い点は当たっています。デザイナーよりはプログラマー寄りのアーキテクチャーで、プログラマーは幸せになれますが、デザイナーは敷居が高く感じるかもしれません。ただ、ReactやVue.jsの登場で、フロントエンドで出来ることは大幅に増えました。一昔前はHTML、CSSで静的コンテンツを制作し、jsやjQueryで動的コンテンツをちょこっと色づけという感じでしたが、ReactやVue.jsでがっつりフロンドで動的コンテンツを実装し、サーバーサイドはREST APIだけ提供し、データの永続化とその復元といったバックエンド処理に徹するという構成も今では珍しくありません。昨今GraphQLという選択肢もあり、フロントエンドに実装の比重が移りつつあります(GraphQLを採用すると、今回検証したdddも必要無くなるかも・・・)。SEO対策の点ではSPAは不安もあるのでその点十分考慮する必要はありますが、SSRという解決策も用意されています。その事を考えたら、デザイナーもガリガリとプログラミングに参画するのが時代の流れかも知れません。そうした時代の流れに乗るのであれば、Reactも十分選択肢になり得ると考えます。  
今回の趣旨では無いものの、Reactに挑戦してみてReactが広く受け入れられている理由を肌で感じました。少し実装ルールを勉強したら、あとは直感的にどんどん実装していけました。ただ、初めてのReactなのでコード品質は悪いのでそこはご容赦下さい。本格的に導入するには、フォルダ設計、実装方針の策定、CSSのツールの選定等々、色々と事前に勉強・検討する必要がありそうです。  
  
# デモサイト
以下にデモサイトを構築しました。  
- ddd  
http://www.take14.shop/ddd/product/list  
- 軽量ddd  
http://www.take14.shop/lightddd/product/list  
- MVC  
http://www.take14.shop/mvc/product/list  
  
#### 基本認証をかけているので、ご覧になりたい方は以下のID、パスワードをご利用下さい  

| ID | パスワード |
| ---- | ---- |
| take14 | UP6-hL$Z.8ghBn?c |
