<?php
include 'ChatData.php';

?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />
	<title>konter-srayk.ru - KC - eTo }I{u3Hb!</title>
	<script type="text/javascript" src="HttpRequest.js"></script>
	<script type="text/javascript" src="Translate.js"></script>
	<link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
<div id="Chat">
<?foreach($ChatData as $LamakPhrase):?>
<p>- <?=htmlspecialchars($LamakPhrase)?></p>
<?endforeach;?>
</div>
<textarea id="LamakWord""></textarea>
<textarea id="Translated" onfocus="LamakSays()"></textarea>
</body>
</html>