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

$Dictionary['/à/e'] = "AlterVariant('@','a','a','a')";
$Dictionary['/À/'] = 'A';
$Dictionary['/á/i'] = '6';
$Dictionary['/â/ie'] = "AlterVariant('B','8')";;
$Dictionary['/ã/i'] = 'r';
$Dictionary['/ä/e'] = "AlterVariant('g')";
$Dictionary['/Ä/e'] = "AlterVariant('d','D')";
$Dictionary['/å/i'] = 'e';
$Dictionary['/¸/i'] = 'e';
$Dictionary['/æ/e'] = "AlterVariant('}I{','>I<')";
$Dictionary['/ç/i'] = '3';
$Dictionary['/è/i'] = 'u';
$Dictionary['/é/i'] = 'u';
$Dictionary['/ê/i'] = 'k';
$Dictionary['/ë/ie'] = "AlterVariant('/I','JI')";
$Dictionary['/ì/i'] = 'M';
$Dictionary['/í/i'] = 'H';
$Dictionary['/î/'] = 'o';
$Dictionary['/Î/e'] = "AlterVariant('0','O')";
$Dictionary['/Ï/'] = '/7';
$Dictionary['/ï/'] = 'n';
$Dictionary['/ð/'] = 'p';
$Dictionary['/Ð/'] = 'P';
$Dictionary['/ñ/i'] = 'c';
$Dictionary['/ò/ie'] = "AlterVariant('m','T')";
$Dictionary['/ó/i'] = 'y';
$Dictionary['/ô/i'] = 'qp';
$Dictionary['/õ/i'] = 'x';
$Dictionary['/ö/e'] = "AlterVariant('c', 'u,')";
$Dictionary['/Ö/e'] = "AlterVariant('C', 'U,')";
$Dictionary['/÷/i'] = '4';
$Dictionary['/ø/ie'] = "AlterVariant('w', 'LLI')";
$Dictionary['/ù/ie'] = "AlterVariant('LLI,', 'LLI,')";
$Dictionary['/û/i'] = 'bI';
$Dictionary['/ü/i'] = 'b';
$Dictionary['/ú/ie'] = "AlterVariant('^b')";
$Dictionary['/ý/ie'] = "AlterVariant('e')";
$Dictionary['/þ/e'] = "AlterVariant('I{}', 'IO')";
$Dictionary['/ÿ/ie'] = "AlterVariant('9', '9I')";

$LamakWord = preg_replace(array_keys($Dictionary), array_values($Dictionary), $NormalWord);
SaveMessage($LamakWord);
echo $LamakWord;
