<!DOCTYPE html>
<html>
<head>
    <title>予約リマインダー</title>
</head>
<body>
    <p>{{ $reservation['user_name'] }} 様</p>
    <p>本日「{{ $reservation['shop_name'] }}」にてご予約があります。</p>
    <p>予約内容</p>
    <ul>
        <li>店舗: {{ $reservation['shop_name'] }} </li>
        <li>予約日: {{ $reservation['date'] }} </li>
        <li>予約時間: {{ $reservation['time'] }}</li>
        <li>人数: {{ $reservation['people'] }}人</li>
    </ul>
    <p>お忘れないようご注意ください。</p>
</body>
</html>
