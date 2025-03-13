<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $data['title'] }}</title>
    <style type="text/css">
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #FFF;
        }

        table {
            width: 100%;
            table-layout: fixed;
        }

        .email-container {
            width: 600px;
            margin: 0 auto;
            background-color: #FFF;
            padding: 20px;
        }

        h1 {
            font-size: 24px;
            margin-bottom: 20px;
            text-align: center;
        }

        .announcement-title {
            text-align: center;
            font-weight: 700;
        }

        p {
            font-size: 16px;
            color: #333;
            line-height: 1.5;
            margin: 10px 0;
        }

        .footer {
            font-size: 14px;
            color: #999;
            text-align: center;
            margin-top: 20px;
        }

        @media only screen and (max-width: 600px) {
            .email-container {
                width: 100% !important;
                padding: 10px !important;
            }

            h1 {
                font-size: 20px;
            }

            p {
                font-size: 14px;
            }
        }
    </style>
</head>

<body>
    <table>
        <tr>
            <td>
                <table class="email-container">
                    <tr>
                        <td>
                            <h1>{{ $data['title'] }}</h1>
                            <p class="announcement-title">お知らせ内容</p>
                            <p>{{ $data['content'] }}</p>
                            <p>※本メールに心当たりのない方は、お手数ですが、破棄をお願いいたします。</p>
                        </td>
                    </tr>
                    <tr>
                        <td class="footer">
                            本メールには返信はできませんのでご了承ください。
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>
