# 概要 
Laravelで同じ実装をドメイン駆動設計(DDD)とMVCで比較してみました。フロントはReactで実装しています。設計思想はドメイン駆動設計(以下DDD)、アーキテクチャはクリーンアーキテクチャを採用しました。LaravelのWebアプリケーションをDDDやクリーンアーキテクチャで構築すると、MVCで構築するのと比べて実装量やファイル数が増えるのでは？また、処理速度も遅くなるのでは？という懸念を抱いておりました。ただ、それは実際に試してみないとわからないと思い、同じ機能をDDD、MVCで実装し、比較する事にしました。やるなら実践的なプロジェクトが望ましいし、イメージし易いと考えて、題材はECのデモサイトにしました。構築パターンは、DDD、軽量DDD、MVCの3パターンです。DDD、軽量DDDの違いは、DDDはクリーンアーキテクチャに忠実に実装したのに比べて、軽量DDDはPresenter、ViewModel、UseCaseDataを共通クラスに実装して実装量の削減をしています。  
  
結果は下にまとめますが、やはり懸念していた通りパフォーマンスはMVC > 軽量DDD > DDDという結果で、ファイル数やステップ数もDDD > 軽量DDD > MVCと予測通りでした。ただ、パフォーマンスは思っていた程DDDが悪い結果では無かったです。  
  
ちなみに便宜上「軽量DDD」という文言を使っておりますが、 本検証で述べている「軽量DDD」は、参考書籍「[エリック・エヴァンスのドメイン駆動設計](https://www.amazon.co.jp/%E3%82%A8%E3%83%AA%E3%83%83%E3%82%AF%E3%83%BB%E3%82%A8%E3%83%B4%E3%82%A1%E3%83%B3%E3%82%B9%E3%81%AE%E3%83%89%E3%83%A1%E3%82%A4%E3%83%B3%E9%A7%86%E5%8B%95%E8%A8%AD%E8%A8%88-Architects%E2%80%99Archive-%E3%82%BD%E3%83%95%E3%83%88%E3%82%A6%E3%82%A7%E3%82%A2%E9%96%8B%E7%99%BA%E3%81%AE%E5%AE%9F%E8%B7%B5-%E3%82%A8%E3%83%AA%E3%83%83%E3%82%AF%E3%83%BB%E3%82%A8%E3%83%B4%E3%82%A1%E3%83%B3%E3%82%B9/dp/4798121967/ref=pd_lpo_2?pd_rd_i=4798121967&psc=1)」でアンチパターンとされているDDDの技術要素だけ取り入れた「軽量DDD」と同意ではありません。（私の理解度が低くDDDを実践しきれていない可能性は否定できませんが・・・）本検証の「軽量DDD」は、ドメイン層については「DDD」の基本構造と全く同じであるためです（ドメインモデル→配列へのデータ変換用の実装は追加していますが、モデリングは全く同じ）。本検証における「軽量DDD」で実装を削っている箇所は、クリーンアーキテクチャのレイヤーをまたぐ際に、ドメインモデル→UseCaseモデル→ViewModelと2回データ変換する処理を、ドメインモデル→配列と1回のデータ変換に削減した箇所です。あとPresenter、InputData、OutputDataも共通クラス化して実装量削減しておりますが、これらもクリーンアーキテクチャのクラス群です。その為、ドメインモデルを削っている訳ではありません。  
  
なお、Viewはbladeを使っているものの、ほぼ全てReactで実装しました。SPAにも出来たのですが、本プロジェクトの趣旨ではないのでSPAにはあえてしていません。Reactより使い慣れてるVue.jsの方が実装しやすかったのですが、いい機会だったのでついでにReactもかじってみました。material uiを使うことで、スマホアプリのようなリッチなUI表現に仕上がりました。かつ、レスポンシブにも対応しています。   
です。  
  

# 実装
実装するに当たって、[nrslib/StrictLaraClean](https://github.com/nrslib/StrictLaraClean)、[shin1x1/laravel-ddd-sampl](https://github.com/shin1x1/laravel-ddd-sample)のお二方のgithubのソースを大いに参考にさせて頂きました。とても勉強になりました。ドメインモデルは最初ただのDTOで、定義する事が目的化するだけだし、Eloquentで取得したデータをそのまま使えばこの実装は不要では？と思ってましたが大間違いでした。参考書籍「[エリック・エヴァンスのドメイン駆動設計](https://www.amazon.co.jp/%E3%82%A8%E3%83%AA%E3%83%83%E3%82%AF%E3%83%BB%E3%82%A8%E3%83%B4%E3%82%A1%E3%83%B3%E3%82%B9%E3%81%AE%E3%83%89%E3%83%A1%E3%82%A4%E3%83%B3%E9%A7%86%E5%8B%95%E8%A8%AD%E8%A8%88-Architects%E2%80%99Archive-%E3%82%BD%E3%83%95%E3%83%88%E3%82%A6%E3%82%A7%E3%82%A2%E9%96%8B%E7%99%BA%E3%81%AE%E5%AE%9F%E8%B7%B5-%E3%82%A8%E3%83%AA%E3%83%83%E3%82%AF%E3%83%BB%E3%82%A8%E3%83%B4%E3%82%A1%E3%83%B3%E3%82%B9/dp/4798121967/ref=pd_lpo_2?pd_rd_i=4798121967&psc=1)」によると、ドメイン層のモデリングと実装こそがDDDの真骨頂で、最も重要との事です。今考えたら「ドメイン駆動設計」なので、そりゃそうですよね・・・ドメイン駆動設計からドメインモデルを省いたら、「？？？？駆動設計」になって駆動させる動力が無くなってしまう・・・(たこの入っていないたこ焼きみたいな・・・)。ドメインモデルはただのプロパティとそのget、setしかないDTOとは似て否なるもので、ドメインモデルにドメイン領域のビジネスルールや仕様等を凝集して実装していくと理解しました。DTOを作っているみたいに単調で面倒ですが、頑張って実装しました。実際やってみると、ドメインモデルが保持するプロパティと、それにまつわるメソッドが1つのクラスに凝集され、プロパティと操作の関連がひと目で分かる造りになりました。オブジェクト指向でプログラミングしているという実感を感じました（まだ不十分でしたらすみません・・・）。特にCart、Order、ProductGroupはプロパティと操作が一体となっており、とても制御・実装・拡張し易かったです。一方、仕様やルールの実装が無く、プロパティとそのget、setしかないValueaObjectがあるので、これらは共通クラスで実装削減してもいいかも知れません。  
なお、参考書籍「[エリック・エヴァンスのドメイン駆動設計](https://www.amazon.co.jp/%E3%82%A8%E3%83%AA%E3%83%83%E3%82%AF%E3%83%BB%E3%82%A8%E3%83%B4%E3%82%A1%E3%83%B3%E3%82%B9%E3%81%AE%E3%83%89%E3%83%A1%E3%82%A4%E3%83%B3%E9%A7%86%E5%8B%95%E8%A8%AD%E8%A8%88-Architects%E2%80%99Archive-%E3%82%BD%E3%83%95%E3%83%88%E3%82%A6%E3%82%A7%E3%82%A2%E9%96%8B%E7%99%BA%E3%81%AE%E5%AE%9F%E8%B7%B5-%E3%82%A8%E3%83%AA%E3%83%83%E3%82%AF%E3%83%BB%E3%82%A8%E3%83%B4%E3%82%A1%E3%83%B3%E3%82%B9/dp/4798121967/ref=pd_lpo_2?pd_rd_i=4798121967&psc=1)」でレイヤ化アーキテクチャ（クリーンアーキテクチャの前身）を推奨している箇所があるのですが、DDDを実践するのにレイヤ化アーキテクチャは必須ではなく、あくまでもレイヤ化アーキテクチャはドメイン層を隔離する手段であり、ドメイン層を隔離出来るなら他のアプローチでもいいと書かれてました。どうしてもレイヤ化アーキテクチャのような技術的アプローチに着目して、それを用いることが目的化しがちですが、ドメイン層の隔離とそのモデリング、実装こそが最も重要との事です。ただ、DDDを実践するに当たってドメイン層の隔離は必須との事なので、何かしらの手段でドメイン層の隔離が必要です。本検証では、そのアーキテクチャにクリーンアーキテクチャを採用しています。  
  
# デモサイト
以下にデモサイトを構築しました。ちなみに注文確定して頂いても問題はありませんが、商品は届きませんのでその旨ご了承ください・・・  
  
- DDD
http://www.take14.shop/ddd/product/list  
- 軽量DDD
http://www.take14.shop/lightddd/product/list  
- MVC
http://www.take14.shop/mvc/product/list  
  
#### 基本認証をかけているので、ご覧になりたい方は以下のID、パスワードをご利用下さい  

| ID | パスワード |
| ---- | ---- |
| take14 | UP6-hL$Z.8ghBn?c |
    
# ミドルウェア 
| ミドルウェア | バージョン |
| ---- | ---- |
| Apache | 2.4.34 |
| PHP | 8.0.7 | 
| PostgreSQL | 13.3 | 
| npm | 6.14.12 | 
  
# フレームワーク・ライブラリ 
| フレームワーク・ライブラリ | バージョン |
| ---- | ---- |
| Laravel | 8.48.1 | 
| React | 17.0.2  |
| material-ui | 4.11.4 | 
| typescript | 4.3.4 | 
| sass | 1.35.1 |
  
# ディレクトリ構成 
### packages/Common
共通モジュール
### packages/DDDEcSample
DDDのモジュール
### packages/LightDDDEcSample
軽量DDDのモジュール
### packages/MvcSample
MVCのモジュール
### tests/Unit/DDDEcSample
### resources/ts
ReactのTypeScriptコード
### resources/sass
Reactで使用するsass
DDDのUnitTest
### tests/Unit/LightDDDEcSample
軽量DDDのUnitTest
### tests/Unit/MvcSample
MVCのUnitTest
### DDDModel
UmbrelloというUMLツールで設計したクラス図、シーケンス図を保存した「Umbrelloモデルファイル.xmi」、それらの画像出力した画像ファイル
  
# プロジェクトの環境構築について
マイグレーションファイル、シーダーファイルを作っているので、それを用いれば環境構築してデバッグ可能です。  
以下コマンドで環境構築出来ます。事前に.env.exampleをコピーして.envを作成し、APP_KEY、DB_〜、MAIL_〜を適切に設定する必要があります。  
  
```
composer install
npm insall
npm run dev
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
正確にはクリーンアーキテクチャではクラス図左下のViewクラスが画面出力を行うのですが、Laravelのコントローラーはコントローラーのメソッドの戻り値でIlluminate\View\Viewを返却する作りとなっているため、そこは妥協してViewクラスはIlluminate\View\Viewを返却し、それをコントローラーのメソッドまで戻り値で引き継いでコントローラーで返却する造りとしています。やろうと思えばViewクラスでIlluminate\View\Viewのインスタンスをシングルトンのオブジェクトに保持させて、Laravelフレームワークを改造してそのIlluminate\View\Viewのインスタンスを使ってレンダリングさせることも出来ますが、そうしたトリッキーな事をするとフレームワークにどういう影響が出るかがわからないので、そこはフレームワークの習わしに従う選択をしています。参考文献「[エリック・エヴァンスのドメイン駆動設計](https://www.amazon.co.jp/%E3%82%A8%E3%83%AA%E3%83%83%E3%82%AF%E3%83%BB%E3%82%A8%E3%83%B4%E3%82%A1%E3%83%B3%E3%82%B9%E3%81%AE%E3%83%89%E3%83%A1%E3%82%A4%E3%83%B3%E9%A7%86%E5%8B%95%E8%A8%AD%E8%A8%88-Architects%E2%80%99Archive-%E3%82%BD%E3%83%95%E3%83%88%E3%82%A6%E3%82%A7%E3%82%A2%E9%96%8B%E7%99%BA%E3%81%AE%E5%AE%9F%E8%B7%B5-%E3%82%A8%E3%83%AA%E3%83%83%E3%82%AF%E3%83%BB%E3%82%A8%E3%83%B4%E3%82%A1%E3%83%B3%E3%82%B9/dp/4798121967/ref=pd_lpo_2?pd_rd_i=4798121967&psc=1)」にもフレームワークとは争うなと書いていたので、妥協可能なところは妥協するのがいい選択だと考えます。  
  
![クラス図](https://github.com/take-t14/laravel-ddd-sample/blob/master/DDDModel/%E3%82%AF%E3%83%A9%E3%82%B9%E5%9B%B3.png?raw=true)
  
### シーケンス図
![シーケンス図](https://github.com/take-t14/laravel-ddd-sample/blob/master/DDDModel/%E3%82%B7%E3%83%BC%E3%82%B1%E3%83%B3%E3%82%B9%E5%9B%B3.png?raw=true)
  
### 集約
CartはCartItemを保持。CartItemは、Productを保持するといった集約にしました。Orderも同じで、OrderItemを保持し、OrderItemはProductを保持するという集約にしています。当初CartItemはCartDetailという名称にしていましたが、DDDの要のユビキタス言語を実践するのであれば不自然な言葉使いだとはたと気付いて、CartItemにしました。それでも不自然かも知れませんが、DDD初学者の為ご容赦下さい・・・手続き型の実装に馴染んでる私の身としてはCartDetailという名前がしっくりしていたのですが、自然言語としては不自然な呼び名だなと思いました。
参考文献、書籍によると、集約に対する操作は原則集約ルートから行うとあったため、それに気をつけつつ実装しました(参考書籍「[ドメイン駆動設計入門 ボトムアップでわかる! ドメイン駆動設計の基本](https://www.amazon.co.jp/%E3%83%89%E3%83%A1%E3%82%A4%E3%83%B3%E9%A7%86%E5%8B%95%E8%A8%AD%E8%A8%88%E5%85%A5%E9%96%80-%E3%83%9C%E3%83%88%E3%83%A0%E3%82%A2%E3%83%83%E3%83%97%E3%81%A7%E3%82%8F%E3%81%8B%E3%82%8B-%E3%83%89%E3%83%A1%E3%82%A4%E3%83%B3%E9%A7%86%E5%8B%95%E8%A8%AD%E8%A8%88%E3%81%AE%E5%9F%BA%E6%9C%AC-%E6%88%90%E7%80%AC-%E5%85%81%E5%AE%A3/dp/479815072X)」より)。(もし間違っていたら申し訳ありません)
  
![集約クラス図](https://raw.githubusercontent.com/take-t14/laravel-DDD-sample/master/DDDModel/%E9%9B%86%E7%B4%84%E3%82%AF%E3%83%A9%E3%82%B9%E5%9B%B3.png)  
  
### ドメインサービス
カートアイテムを追加する処理を実装する際、CartReposutoryで取得した結果に、CartItemを追加する必要がありますが、その際Productを取得して設定する必要があります。ProductReposutoryを使ってProductを取得しますが、複数のRepositoryを操作する必要があり、それをUseCase層に実装するのはぎこちなさを感じました。カートに商品を追加する。という一つのUseCaseを実現するのに、UseCaseがProductIdからProductRepositoryを使ってProductを取り出し、それをCartオブジェクトに追加する。という複数のReoositoryを使った一連の操作を行うのですが、そうした一連の操作もドメイン知識なのではと思った為です。そこで、CartServiceというドメインサービスを作りました。今こうして書いていて、UseCaseでProductRepositoryからProductを取り出し、Cartに対してそれを追加するメソッドを実装してコールする形でもよかったなと思い直しており、ドメインサービスを作るまでも無かったのかも知れません、、、ただ、あくまでも検証なので、実装パターンを試すという意味ではこれはこれで良かったと考えています。なお、参考書籍ではドメインサービスは極力使わないで、ドメインモデルで表現・実装するべきである旨が強調して書かれていました。その気になれば、全部ドメインサービスに書けてしまう為です。それによってドメイン貧血症という、仕様やドメイン知識が何も実装されていないドメインモデルが出来てしまうそうです（参考書籍「[ドメイン駆動設計入門 ボトムアップでわかる! ドメイン駆動設計の基本](https://www.amazon.co.jp/%E3%83%89%E3%83%A1%E3%82%A4%E3%83%B3%E9%A7%86%E5%8B%95%E8%A8%AD%E8%A8%88%E5%85%A5%E9%96%80-%E3%83%9C%E3%83%88%E3%83%A0%E3%82%A2%E3%83%83%E3%83%97%E3%81%A7%E3%82%8F%E3%81%8B%E3%82%8B-%E3%83%89%E3%83%A1%E3%82%A4%E3%83%B3%E9%A7%86%E5%8B%95%E8%A8%AD%E8%A8%88%E3%81%AE%E5%9F%BA%E6%9C%AC-%E6%88%90%E7%80%AC-%E5%85%81%E5%AE%A3/dp/479815072X)」より）。何をドメインモデルで実装し、どういった場合にドメインサービスを用いるかは、慎重な検討と熟練した判断や経験が必要になりそうです。
  
### バリデーションチェック
ドメインモデルのバリデーションチェックは、LaravelのValidatorを使用しても良かったのですが、あえてフレームワークには依存せず独自の実装を選択しました。それはそれで良かったのですが、注文のバリデーションで少し苦戦しました。ドメインモデルのコンストラクタでバリデーションし、エラーの場合はExceptionをthrowする実装としたのですが、例えば氏名、名前が必須入力なのに両方未入力でバリデーションエラーとなった場合、両方のエラーを検知して画面表示したいのですが、try catch 1つだと1個のエラーしか検知して画面表示出来ません。ユーザーにとってはエラーを一つずつしか解消出来ず、これではコンバージョン低下に繋がります。ドメインモデルをnewする毎にtry catchすればいいですが、ソースコードが冗長になりスマートではありません。そこで、ModelFactoryというドメインサービスを作りました。そのファクトリーにバリデーションしたいモデルクラス名を配列で渡したら、配列のモデルクラスのnewとバリデーションチェックを全部やってエラーがあればthrowまでやってくれるクラスにしました。エラーが無ければ、インスタント化したモデルクラスをModelFactoryから取得も出来ます。これでドメインモデルのバリデーションチェックと、そのインスタンス化をスマートに実装出来ました。
  
# 自動テスト 
全機能に対するUnitTestを実装しました。TDDも勉強していた為、実装の過程で実践しました。何度かリファクタリングをしたのですが、その度にグリーン(自動テストオールOK)だったのが、レッド(自動テストオールNG)になりました。そこからグリーンにするまで修正したら、画面テストがキチンと動作する事を確認出来ました。UnitTestで非常に信頼性の高い検証を行える事が、この事から立証出来たと思います。キチンとUnitTestを実装したら、機能追加やリファクタリングを自信を持って行えると思います。  
  
# ステップ数
| 種別 | ファイル数 | ステップ数 |
| ---- | ---- | ---- |
| DDD | 152 | 3,444 |
| 軽量DDD | 102 | 2,298 |
| MVC | 23 | 725 |
  
上記の通り、懸念していたとおりDDDはファイル数、ステップ数共に圧倒的にMVCと比較して多くなる結果となりました。一方でDDDは1クラスの凝集度は高く、ほとんど50ステップ未満なので、実装工数は数ほどのインパクトがあるわけではありません。DDDでは決まった形式でクラスを実装するケースも多く、ほとんどコピペやロジックの組み立ての時間がかからず作業的に実装するケースもあったので、ステップ数の割には工数はかかっていなかったりします。また、クラスの凝集度が高い分、どこに何が記載されているか、このクラスの役割は何かがひと目で把握しやすいメリットもあります。ステップ数、ファイル数が多い＝悪ではないという事を言いたいのですが、それぞれメリット、デメリットがあります。詳細は以下の「メリット・デメリット」でまとめたいと思います。  
  
# パフォーマンス 
app/Http/Middleware/PerformanceLog.php  
上記ファイルにコントローラー実行前後にログを出力し、処理時間、処理に使用したメモリを計測できるようにしました。その計測結果を以下にまとめます。  
商品一覧のように大量のレコードをDBから取得して表示する箇所は、MVC > 軽量DDD > DDDという結果でした。これは、DDDの場合取得したレコードをドメインモデルに変換するコストがかかるためです。  
一方意外だったのは、その他はほとんど軽量DDDに軍配が上がって軽量DDD > MVC > DDDという結果になった点です。詳しくは分析しておりませんが、MVCは手続き型で実装しているので、処理効率が悪い部分があるのでしょうか。もしくは単なる誤差という可能性もあります。いずれにしても気にするほどの差ではありません。商品一覧だけ100ms単位で差が出ているので、大量データ取得・表示のパフォーマンスに影響が出ると考えるのが良さそうです。  
  
## 結果一覧
| 機能 | DDD時間 | DDDメモリ | 軽量DDD時間 | 軽量DDDメモリ | MVC時間 | MVCメモリ |
| ---- | ---- | ---- | ---- | ---- | ---- | ---- |
| 商品一覧画面表示 | 289ms | 6299KB | 178ms | 5049KB | 85ms | 2735KB |
| 商品詳細画面表示 | 63ms | 650KB | 18ms | 600KB | 23ms | 627KB |
| カート追加API | 153ms | 419KB | 19ms | 418KB | 51ms | 839KB |
| カート画面表示 | 36ms | 468KB | 10ms | 382KB | 21ms | 640KB |
| 注文画面表示 | 20ms | 468KB | 9ms | 382KB | 20ms | 640KB |
| 注文バリデーションAPI | 34ms | 422KB | 31ms | 506KB | 58ms | 814KB |
| 注文確定処理 | 252ms | 1011KB | 251ms | 1061KB | 194ms | 1376KB |
  
## エビデンス
### DDD
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
[2021-07-23 23:09:44] local.DEBUG: Packages\DDDEcSample\InterfaceAdapters\Controllers\Api\OrderController@save 252.1411895752ミリ秒  
```
  
### 軽量DDD
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
[2021-07-23 23:11:53] local.DEBUG: Packages\LightDDDEcSample\InterfaceAdapters\Controllers\Api\OrderController@save 251.3659324646ミリ秒  
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
[2021-07-23 23:10:53] local.DEBUG: Packages\MvcSample\App\Http\Controllers\Api\OrderController@save 194.3370056152ミリ秒  
```
  
# メリット・デメリット
DDD、軽量DDD、MVCのメリット・デメリットを比較した結果を以下にまとめます。DDDの記述ボリュームが多くなりましたが、DDDよりは、軽量DDDを採用するほうがいいと考えます。軽量DDDはDDDのメリットを全て継承しつつ、DDDのファイル数、ステップ数が多くなるデメリットをある程度軽減出来ている為です。MVCはファイル数、ステップ数が圧倒的に少なく、実装工数を考えるとMVC一択と判断しがちですが、メンテナンス性を考えると一口にはそうは言いきれません。また、DDDや軽量DDDはファイル数、ステップ数が多いですが、その数字＝工数とも限りません。殆どが1クラス50ステップ未満の凝集度の高いクラスの為、実装効率が高く実行工数は数ほどのインパクトは無いと考えます。また、DDDでは決まった形式でクラスを実装するケースも多く、ほとんどコピペやロジックの組み立ての時間がかからず作業的に実装するケースもあったので、ステップ数の割には工数はかかっていなかったりします。なお、カートのセッション取得箇所を「SessionRepository::get」でgrepすると、DDD、軽量DDDは共に1箇所ですが、MVCは4箇所でした。設計次第で改善出来るかもしれませんが、こうした実装の重複はMVCや手続き型の実装では避けづらいです。処理の重複や類似の仕様が様々な箇所に分散して実装されていくと、変更しづらく影響範囲も読みづらいプロジェクトになっていきます。DDDが目指すのは変更や拡張をしやすい「しなやかな設計（参考文献「[エリック・エヴァンスのドメイン駆動設計](https://www.amazon.co.jp/%E3%82%A8%E3%83%AA%E3%83%83%E3%82%AF%E3%83%BB%E3%82%A8%E3%83%B4%E3%82%A1%E3%83%B3%E3%82%B9%E3%81%AE%E3%83%89%E3%83%A1%E3%82%A4%E3%83%B3%E9%A7%86%E5%8B%95%E8%A8%AD%E8%A8%88-Architects%E2%80%99Archive-%E3%82%BD%E3%83%95%E3%83%88%E3%82%A6%E3%82%A7%E3%82%A2%E9%96%8B%E7%99%BA%E3%81%AE%E5%AE%9F%E8%B7%B5-%E3%82%A8%E3%83%AA%E3%83%83%E3%82%AF%E3%83%BB%E3%82%A8%E3%83%B4%E3%82%A1%E3%83%B3%E3%82%B9/dp/4798121967/ref=pd_lpo_2?pd_rd_i=4798121967&psc=1)」より引用）」ですが、MVCや手続き型の実装ではそうした理想を目指すのが困難だと考えます。運用期間が短かったり、手早く短時間で仕上げたいWEBアプリケーションであれば、MVCでさっと作るのが向いているかもしれませんが、年単位で運用をしながら機能拡張・追加を繰り返して成熟させていきたいWEBアプリケーションやWEBサービスの場合は、DDDか軽量DDDで構築したほうが良さそうだと考えます。 　　
　　
## DDD
### メリット
- クラスの凝集度が高くなり、1クラス当りのステップ数は少なくなって可読性、メンテナンス性が高くなる
- どこに何を実装するかの指針が決まっており、クラスの責務がはっきり分かる形で実装出来るため、ソースコードの重複を避けやすい。（完全には防げないが、重複が発生したらそれを検知してリファクタリングしやすい。例えば手続き型の実装だと関数単位で機能が実装されていって関数が増えていき、その中に重複処理があっても発見しにくくなる。）
- 依存関係逆転の原則により、疎結合な実装となる
- 疎結合な為UnitTestを実装しやすい
- 疎結合な為、DBの変更、フレームワークの変更、HTML・API・コンソール・ViewComposer等のUIやコントローラーの変更をしても、ユースケース層、ドメイン層は影響を受けずそのまま使える。
### デメリット
- ファイル数、ステップ数が多くなる
- ドメインモデル→UseCaseData→ViewModelとレイヤーをまたぐ毎にデータの変換が必要となり、パフォーマンスが低下する
  
## 軽量DDD
### メリット
- 高凝集、疎結合、UnitTestの実装のしやすさはDDDのメリットを継承
- DDDに比べてファイル数、実装量が削減される。
- ドメインモデル→ViewModelを、ドメインモデルの配列化で実現し、DDDと比べて変換回数が少なくなってパフォーマンス改善した
  
### デメリット
- DDDに比べてステップ数が2/3になるが、それでもMVCの3倍以上のステップ数となる
- DDDと比べてパフォーマンス改善したものの、大量データ取得時のパフォーマンスはMVCと比較すると悪い
  
## MVC
### メリット
- DDD、軽量DDDと比べてステップ数、ファイル数が圧倒的に少ない(DDDの1/4以下、軽量DDDの1/3以下)
- DDDと比べてデータの変換が無い為、処理速度が早い傾向にある(特に大量データ取得時)
### デメリット
- コントローラー、モデルクラスにビジネスロジックが集中し、メンテナンス性が悪い神クラスが生まれやすくなる
- 関数単位で機能が実装されていって関数が増えてき、関数同士の関連がわかりづらくなったり、類似処理の重複を避けづらくなってくる
- フレームワークと密結合な実装となるため、UnitTestが実装し辛く、実装するには工夫が必要となる
　 
# Eloquentのパフォーマンス
本プロジェクトの趣旨ではありませんが、Eloquentのパフォーマンスについて検証結果を述べます。商品一覧のデータ取得は最初Eloquentのモデルクラスで取得しておりましたが、DB::tableで取得する方式へ変更しました。理由はパフォーマンスの悪さです。どうもEloquentは大量データを取得する際のパフォーマンスが悪い模様です。理由はEloquentのインスタンスを作成するコストが嵩むからという見解と、whereInで大量にパラメータ指定する際のデータバインドのコストが原因という見解があるようです（参考サイト「[laracasts](https://laracasts.com/discuss/channels/eloquent/eloquent-is-so-slow?page=1)」の記事より）。今回のクエリはwhereInを使ってなくても遅かったため、Eloquentのインスタンス化のコストが主な遅延要因ではないかと考えます。本記事のデモサイトでは、DB::tableでこの問題に対処しました。それでもほとんど使い方はEloquentのモデルクラスと同等なので支障はありませんでした。なお、この問題が本記事のパフォーマンス検証に影響しないように、DDD、軽量DDD、MVC全て、商品一覧だけはdb::tableを使用するコードでパフォーマンス計測しております。  
  
# React
仕事でVue.jsの採用経験があるためVue.jsのほうが慣れておりますが、いい機会なのでReactに挑戦しました。仕事でVue.jsかReactのどちらを使用するか検討した際、Vue.jsのほうがデザイナーにも受け入れてもらいやすそうだと感じてVue.jsを採用しました。あと、私自身JSXアレルギーがあって、Vue.jsのようにテンプレート記法の方が既存の技術（HTML、CSS、js、jQueryを用いた実装）に近い感覚で実装出来て、わかりやすく実装しやすいと思っていました。  
ところが今回Reactに挑戦してみて、JSXアレルギーは誤解だったと考えを改めました。jsコードとHTMLをシームレスに書ける事の便利さに驚きました。JSXはプログラミングしている感覚でHTMLを記述出来ます。なんと言っても自由度の高さです。Vue.jsはHTMLはtemplate、jsロジックはscript、CSSはstyleタグ内に記述するように決まっています。そして、jsロジックの実装ルールも定まっていて、それに沿って実装します。Reactはというと・・・一定のルールはあるものの、かなり自由に実装できます。ただこれは副作用もあります。自由ということは、きちんとコーディング規約を作ったり実装方針や設計を定めないと、メンテナンス性の悪いコードも作れてしまいます。MVCはビューとロジックを別で実装する事で、高いメンテナンス性を実現し、プログラマーとデザイナーが分業しやすくなりました。ReactはHTMLとjsを一緒に書けるのは便利な反面、キチンと設計、実装しないとビューとロジックが混雑してデザイナー、プログラマーの分業に支障が出たり、可読性、メンテナンス性の低下を招くと思います。一長一短ですね・・・  
あと、元々懸念していたデザイナーにはハードルが高い点は当たっています。デザイナーよりはプログラマー寄りのアーキテクチャーで、プログラマーは幸せになれますが、デザイナーは敷居が高く感じるかもしれません。ただ、ReactやVue.jsの登場で、フロントエンドで出来ることは大幅に増えました。一昔前はHTML、CSSで静的コンテンツを制作し、jsやjQueryで動的コンテンツをちょこっと色づけという感じでしたが、ReactやVue.jsでがっつりフロンドで動的コンテンツを実装し、サーバーサイドはREST APIだけ提供し、データの永続化とその復元といったバックエンド処理に徹するという構成も今では珍しくありません。昨今GraphQLという選択肢もあり、フロントエンドに実装の比重が移りつつあります(GraphQLを採用すると、今回検証したDDDも必要無くなるかも・・・)。SEO対策の点ではSPAは不安もあるのでその点十分考慮する必要はありますが、SSRという解決策も用意されています。その事を考えたら、デザイナーもガリガリとプログラミングに参画するのが時代の流れかも知れません。そうした時代の流れに乗るのであれば、Reactも十分選択肢になり得ると考えます。  
今回の趣旨では無いものの、Reactに挑戦してみてReactが広く受け入れられている理由を肌で感じました。少し実装ルールを勉強したら、あとは直感的にどんどん実装していけました。ただ、初めてのReactなのでコード品質は悪いのでそこはご容赦下さい。本格的に導入するには、フォルダ設計、実装方針の策定、CSSのツールの選定等々、色々と事前に勉強・検討する必要がありそう
  
# 参考文献・記事・ソースコード
[エリック・エヴァンスのドメイン駆動設計](https://www.amazon.co.jp/%E3%82%A8%E3%83%AA%E3%83%83%E3%82%AF%E3%83%BB%E3%82%A8%E3%83%B4%E3%82%A1%E3%83%B3%E3%82%B9%E3%81%AE%E3%83%89%E3%83%A1%E3%82%A4%E3%83%B3%E9%A7%86%E5%8B%95%E8%A8%AD%E8%A8%88-Architects%E2%80%99Archive-%E3%82%BD%E3%83%95%E3%83%88%E3%82%A6%E3%82%A7%E3%82%A2%E9%96%8B%E7%99%BA%E3%81%AE%E5%AE%9F%E8%B7%B5-%E3%82%A8%E3%83%AA%E3%83%83%E3%82%AF%E3%83%BB%E3%82%A8%E3%83%B4%E3%82%A1%E3%83%B3%E3%82%B9/dp/4798121967/ref=pd_lpo_2?pd_rd_i=4798121967&psc=1)  
[実践ドメイン駆動設計 (Object Oriented SELECTION)](https://www.amazon.co.jp/%E5%AE%9F%E8%B7%B5%E3%83%89%E3%83%A1%E3%82%A4%E3%83%B3%E9%A7%86%E5%8B%95%E8%A8%AD%E8%A8%88-Object-Oriented-SELECTION-%E3%83%B4%E3%82%A1%E3%83%BC%E3%83%B3%E3%83%BB%E3%83%B4%E3%82%A1%E3%83%BC%E3%83%8E%E3%83%B3/dp/479813161X/ref=pd_bxgy_img_2/355-6470023-9566522?_encoding=UTF8&pd_rd_i=479813161X&pd_rd_r=463b1683-6c04-4380-ab7f-2edc9b0fcdfd&pd_rd_w=7yigR&pd_rd_wg=WMCAu&pf_rd_p=d8f6e0ab-48ef-4eca-99d5-60d97e927468&pf_rd_r=XTJ7Y0A29Y1DX6A5Q0R1&psc=1&refRID=XTJ7Y0A29Y1DX6A5Q0R1)  
[テスト駆動開発](https://www.amazon.co.jp/%E3%83%86%E3%82%B9%E3%83%88%E9%A7%86%E5%8B%95%E9%96%8B%E7%99%BA-Kent-Beck/dp/4274217884/ref=pd_vtp_4/355-6470023-9566522?pd_rd_w=8iHDg&pf_rd_p=949e26f5-c2ef-4c96-bfde-49d7614d0317&pf_rd_r=1RVRDN6654AV76BHD8Z1&pd_rd_r=22490f61-01d2-4ff2-8569-f97eb55cf853&pd_rd_wg=jr32n&pd_rd_i=4274217884&psc=1)  
[ドメイン駆動設計入門 ボトムアップでわかる! ドメイン駆動設計の基本](https://www.amazon.co.jp/%E3%83%89%E3%83%A1%E3%82%A4%E3%83%B3%E9%A7%86%E5%8B%95%E8%A8%AD%E8%A8%88%E5%85%A5%E9%96%80-%E3%83%9C%E3%83%88%E3%83%A0%E3%82%A2%E3%83%83%E3%83%97%E3%81%A7%E3%82%8F%E3%81%8B%E3%82%8B-%E3%83%89%E3%83%A1%E3%82%A4%E3%83%B3%E9%A7%86%E5%8B%95%E8%A8%AD%E8%A8%88%E3%81%AE%E5%9F%BA%E6%9C%AC-%E6%88%90%E7%80%AC-%E5%85%81%E5%AE%A3/dp/479815072X)  
[Laravelで実践クリーンアーキテクチャ](https://qiita.com/nrslib/items/aa49d10dd2bcb3110f22)  
[nrslib/StrictLaraClean](https://github.com/nrslib/StrictLaraClean)  
[ドメイン駆動設計 モデリング/実装ガイド](https://booth.pm/ja/items/1835632)  
[DDDパターンを活用した Laravelアプリケーション開発](https://speakerdeck.com/shin1x1/201703-ddd-with-laravel)  
[shin1x1/laravel-ddd-sampl](https://github.com/shin1x1/laravel-ddd-sample)  
[laracasts](https://laracasts.com/discuss/channels/eloquent/eloquent-is-so-slow?page=1)
