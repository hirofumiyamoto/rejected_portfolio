<?php header("Content-Type:text/html;charset=utf-8"); ?>
<?php

// 日本時間の取得
date_default_timezone_set('Asia/Tokyo');

// このファイルの名前
$script ="contact.php";

// メールの送信先
$to = "hrfmmymt@gmail.com";

// 送信されるメールのタイトル
$sbj = "ポートフォリオ : Contact";

// 送信確認画面の表示(する=1, しない=0)
$chmail = 1;

// 送信後に自動的にジャンプ(する=1, しない=0)
// 0にすると、送信終了画面が表示
$jpage = 0;

// 送信後にジャンプするページ(送信後にジャンプする場合)
// $next = "http://www.○○○";

$from_add = 0;

// 必須入力項目を設定する(する=1, しない=0)
// 原則としてここはしない=0にしておく
$esse = 0;

// 必須入力項目(htmlの<input>で指定したname)
$eles = array('お名前','Email');

$sendm = 0;
foreach($_POST as $key=>$var) {
  if($var == "eweb_submit") $sendm = 1;
}

// 文字の置き換え
$string_from = "＼";
$string_to = "ー";

// 未入力項目のチェック
if($esse == 1) {
  $flag = 0;
  $length = count($eles) - 1;
  foreach($_POST as $key=>$var) {
    $key = strtr($key, $string_from, $string_to);
    if($var == "eweb_submit") ;
    else {
      for($i=0; $i<=$length; $i++) {
        if($key == $eles[$i] && empty($var)) {
          $errm .= "<font color=#f00>「".$key."」は必須入力項目です。</font><br>\n";
          $flag = 1;
        }
      }
    }
  }
  foreach($_POST as $key=>$var) {
    $key = strtr($key, $string_from, $string_to);
    for($i=0; $i<=$length; $i++) {
      if($key == $eles[$i]) {
        $eles[$i] = "eweb_ok";
      }
    }
  }
  for($i=0; $i<=$length; $i++) {
    if($eles[$i] != "eweb_ok") {
      $errm .= "<font color=#f00>「".$eles[$i]."」が未選択です。</font><br>\n";
      $eles[$i] = "eweb_ok";
      $flag = 1;
    }
  }
  if($flag == 1){
    htmlHeader();
?>

入力エラー
<?php echo $errm; ?>

<input type="button" value="前画面に戻る" onClick="history.back()">

<?php 
    htmlFooter();
    exit(0);
  }
}

$body="「".$sbj."」からの発信です\n\n";
$body.="-------------------------------------------------\n\n";
foreach($_POST as $key=>$var) {
  $key = strtr($key, $string_from, $string_to);
  if(get_magic_quotes_gpc()) $var = stripslashes($var);
  if($var == "eweb_submit") ;
  else $body.="[".$key."] ".$var."\n";
}
$body.="\n-------------------------------------------------\n\n";
$body.="送信日時：".date( "Y/m/d (D) H:i:s", time() )."\n";
$body.="ホスト名：".getHostByAddr(getenv('REMOTE_ADDR'))."\n\n";

if($remail == 1) {

$rebody="ありがとうございました。\n";
$rebody.="以下の内容が送信されました。\n\n";
$rebody.="-------------------------------------------------\n\n";
foreach($_POST as $key=>$var) {
  $key = strtr($key, $string_from, $string_to);
  if(get_magic_quotes_gpc()) $var = stripslashes($var);
  if($var == "eweb_submit") ;
  else $rebody.="[".$key."] ".$var."\n";
}
$rebody.="\n-------------------------------------------------\n\n";
$rebody.="送信日時：".date( "Y/m/d (D) H:i:s", time() )."\n";
$reto = $_POST['email'];
$rebody=mb_convert_encoding($rebody,"JIS","utf-8");
$resbj="=?iso-2022-jp?B?".base64_encode(mb_convert_encoding($resbj,"JIS","utf-8"))."?=";
$reheader="From: $to\nReply-To: ".$to."\nContent-Type: text/plain;charset=iso-2022-jp\nX-Mailer: PHP/".phpversion();
}

$body=mb_convert_encoding($body,"JIS","utf-8");
$sbj="=?iso-2022-jp?B?".base64_encode(mb_convert_encoding($sbj,"JIS","utf-8"))."?=";
if($from_add == 1) {
  $from = $_POST['email'];
  $header="From: ".$to."\nReply-To: ".$to."\nContent-Type:text/plain;charset=iso-2022-jp\nX-Mailer: PHP/".phpversion();
} else {
  $header="Reply-To: ".$to."\nContent-Type:text/plain;charset=iso-2022-jp\nX-Mailer: PHP/".phpversion();
}
if($chmail == 0 || $sendm == 1) {
  mail($to,$sbj,$body,$header);
}
else { htmlHeader();
?>

<div class="wrapper">
  <div class="container">
      <div class="row">
      <p>以下の内容で間違いがなければ、「送信」ボタンを押してください。</p>
      <form action="<? echo $script; ?>" method="post">
      <? echo $err_message; ?>
        <table width="600" bgcolor="#ccc" cellspacing="1" cellpadding="3">
        <?php
        foreach($_POST as $key=>$var) {
          $key = strtr($key, $string_from, $string_to);
          if (get_magic_quotes_gpc()) $var = stripslashes($var);
          $var = htmlspecialchars($var);
          $key = htmlspecialchars($key);
          print("<tr><td bgcolor=#fff width=102 align=center>".$key."</td><td bgcolor=#eee>".$var);
        ?>
          <input type="hidden" name="<?= $key ?>" value="<?= $var ?>">
        <?php
          print("</td></tr>\n");
        }
        ?>
        </table>

        <div class="btns">
          <input type="hidden" name="eweb_set" value="eweb_submit">
          <input type="submit" value="送信" class="btn btn-mail">
          <input type="submit" value="前画面に戻る" onClick="history.back()" class="btn btn-mail">
        </div>
      </form>
    </div>
  </div>
</div>
<?php htmlFooter(); } if(($jpage == 0 && $sendm == 1) || ($jpage == 0 && ($chmail == 0 && $sendm == 0))) { htmlHeader(); ?>

<p>ありがとうございました。</p>
<p>送信は無事に終了しました。</p>
<a href="index.html">トップに戻る</a>

<?php htmlFooter(); } else if(($jpage == 1 && $sendm == 1) || $chmail == 0) { header("Location: ".$next); } function htmlHeader() { ?>

<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
  <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>H. Miyamoto Web Design Portfolio</title>
      <meta name="description" content="">
      <meta name="viewport" content="width=device-width">
      <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
      <link rel="stylesheet" href="styles/2549afda.main.css">
      <script src="scripts/vendor/d7100892.modernizr.js"></script>
      <link href="http://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
  </head>
<body>
<!--[if lt IE 10]>
    <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->

<?php } function htmlFooter() { ?>

</body>
</html>

<?php } ?>
