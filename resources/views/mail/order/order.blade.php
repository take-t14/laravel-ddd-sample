{{$datas["order"]["lastName"]["value"]}} {{$datas["order"]["firstName"]["value"]}} 様
この度は、【ショップ名】でご注文賜り誠にありがとうございます。

お客様のご注文を以下の内容で承りました。
ご確認いただき、内容に誤りなどございましたらお知らせください。

──────────────
■ご注文内容■
〔ご注文番号〕{{$datas["order"]["orderTableId"]["value"]}}
〔ご注文日時〕{{$datas["order"]["insDate"]["value"]}}

@foreach($datas["order"]["items"] as $orderItem)
〔商品名〕{{$orderItem["product"]["productName"]["value"]}}
〔数量〕{{$orderItem["quantity"]["value"]}}
〔商品代金〕¥{{$orderItem["priceTotalTaxin"]["value"]}}円

@endforeach
〔合計〕¥{{$datas["order"]["totalTaxin"]["value"]}}円
──────────────

【銀行振込】
下記口座に合計金額をお振込みください。
ご入金確認後、発送手配致します。

[振込口座先銀行]　○○銀行
[支店名]　○○○支店
[口座種別・番号]　普通 12345678
[口座名]　○○○○○株式会社

---------------【ネットショップの署名】-------------
【ネットショップの名前】 
ショップURL：http://○○○.com
店舗連絡先:○○○@○○○.com

運営会社：株式会社△△
住所：〒601-0001　京都府京都市○○区○○町321
TEL：075-1234-5678　／　FAX：075-1234-5678
営業時間：平日○時～○時まで
----------------------------------------------------

注文URL：{{url()->full()}}