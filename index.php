<?php //统计中文词频 by XDash @2012.10.17
header("content-type:text/html; charset=utf-8");


//编辑以下两处参数
$filePath="txt.txt";//定义统计来源路径
$chars=2;//统计几字词，默认为二字词


$wordArray =array();

$file=fopen($filePath,"r");
while(!FEOF($file)){
	
	//读出一行
	$singleLine=trim(fgets($file));
			
	//数字、英文、标点、空格过滤
	$singleLine=preg_replace("/[0-9]{1}/", "", $singleLine);
	$singleLine=preg_replace("/[a-zA-Z]{1}/", "", $singleLine);			
	$singleLine=preg_replace("/[ '.,:;*?~`!@#$%^&+=\-)(<>{}]|\]|\[|\/|\\\|\"|\|/", "", $singleLine);		
	$singleLine=str_replace(" ", "", $singleLine);			
		
	//只处理字数多于2的行
	if (strlen($singleLine)>2){
				
		for($i=0;$i<strlen($singleLine)-$chars*3;$i=$i+3){//一个汉字在utf-8下算三个字符
			$word=substr($singleLine,$i,$chars*3);
			$wordArray[]=$word;
			//echo $word;
		}		
	}
		
}

//关闭文件	
fclose($file);
	
//对频数进行统计
$wordArrayOut=array_count_values($wordArray);
//根据统计次数降序排列 
arsort($wordArrayOut);

//输出结果
$i=1;
foreach($wordArrayOut as $key=>$value){
	$rankNo=$i<10?"0".$i:$i; 
	echo "$key  $value<br />";
	$i++;
}
	

?>