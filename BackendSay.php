<?php
function UniRecode($S){
	return mb_convert_encoding($S, 'UTF-8', 'Windows-1251');
}

function WinRecode($S){
	return mb_convert_encoding($S, 'Windows-1251', 'UTF-8');
}

function AlterVariant(){
	$A = func_get_args();
	return $A[array_rand($A)];
}

function SaveMessage($Message){
	include 'ChatData.php';
	if(!Is_Array($ChatData)) $ChatData = Array();
	array_unshift($ChatData, $Message);
	$ChatData = array_slice($ChatData, 0, 35);
	$Chat = var_export($ChatData, True);
	$Chat = '<?php $ChatData = '.$Chat.'?>';
	@file_put_contents('ChatData.php', $Chat);
}

$NormalWord = $_POST['NormalWord'];
$NormalWord = stripslashes($NormalWord);
$NormalWord = strip_tags($NormalWord);
$NormalWord = WinRecode($NormalWord);

$Dictionary['/�/e'] = "AlterVariant('@','a','a','a')";
$Dictionary['/�/'] = 'A';
$Dictionary['/�/i'] = '6';
$Dictionary['/�/ie'] = "AlterVariant('B','8')";;
$Dictionary['/�/i'] = 'r';
$Dictionary['/�/e'] = "AlterVariant('g')";
$Dictionary['/�/e'] = "AlterVariant('d','D')";
$Dictionary['/�/i'] = 'e';
$Dictionary['/�/i'] = 'e';
$Dictionary['/�/e'] = "AlterVariant('}I{','>I<')";
$Dictionary['/�/i'] = '3';
$Dictionary['/�/i'] = 'u';
$Dictionary['/�/i'] = 'u';
$Dictionary['/�/i'] = 'k';
$Dictionary['/�/ie'] = "AlterVariant('/I','JI')";
$Dictionary['/�/i'] = 'M';
$Dictionary['/�/i'] = 'H';
$Dictionary['/�/'] = 'o';
$Dictionary['/�/e'] = "AlterVariant('0','O')";
$Dictionary['/�/'] = '/7';
$Dictionary['/�/'] = 'n';
$Dictionary['/�/'] = 'p';
$Dictionary['/�/'] = 'P';
$Dictionary['/�/i'] = 'c';
$Dictionary['/�/ie'] = "AlterVariant('m','T')";
$Dictionary['/�/i'] = 'y';
$Dictionary['/�/i'] = 'qp';
$Dictionary['/�/i'] = 'x';
$Dictionary['/�/e'] = "AlterVariant('c', 'u,')";
$Dictionary['/�/e'] = "AlterVariant('C', 'U,')";
$Dictionary['/�/i'] = '4';
$Dictionary['/�/ie'] = "AlterVariant('w', 'LLI')";
$Dictionary['/�/ie'] = "AlterVariant('LLI,', 'LLI,')";
$Dictionary['/�/i'] = 'bI';
$Dictionary['/�/i'] = 'b';
$Dictionary['/�/ie'] = "AlterVariant('^b')";
$Dictionary['/�/ie'] = "AlterVariant('e')";
$Dictionary['/�/e'] = "AlterVariant('I{}', 'IO')";
$Dictionary['/�/ie'] = "AlterVariant('9', '9I')";

$LamakWord = preg_replace(array_keys($Dictionary), array_values($Dictionary), $NormalWord);
SaveMessage($LamakWord);
echo $LamakWord;
