<!DOCTYPE html>
<html lang="ja" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>【STEP】お問い合わせ</title>
  </head>
  <body>
    <p>
      {{ $contact->name }}さんからお問い合わせがありました。
    </p>

    <p>
      お問い合わせ内容：<br>
      {{ $contact->text }}
    </p>

    <p>
      メールアドレス：<br>
      {{ $contact->email }}
    </p>

  </body>
</html>
