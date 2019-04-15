<?php
include "post--statuses--update-02.php";
$host = "http://askmona.org/";
$topicid = 4504;
tw("いつのまに ブームが過ぎ去り 廃BOT こっそり宣伝 使ってください♪");
while(true){
	sleep(1);
	$resid = file_get_contents("res.txt");
//	$lastup = file_get_contents("lastup.txt");
	$lastup = 0;
	if(!($date = file_get_contents($host."v1/responses/list?t_id=".$topicid."&topic_detail=1&if_modified_since=".$lastup))) exit("error : couldn't get date from server");
	file_put_contents("lastup.txt", time());
	$json = json_decode($date);
	if($json->status != 1){
		if($json->status == 2){
			echo "no more update";
			continue;
		}else{
			exit("error : ".$json->error);
		}
	}
	$resmax = $json->topic->count;
	if($resid > $resmax){
		echo("max");
		continue;
	}
	if(!($date = file_get_contents($host."v1/responses/list?t_id=".$topicid."&from=".$resid))) exit("error : couldn't get date from server");
	$json = json_decode($date);
	if($json->status != 1) exit($json->error);
	echo $resid."\n";
	if(strstr($json->responses[0]->response, "#tanka")) tw("=".$json->responses[0]->u_name.$json->responses[0]->u_dan."=\n".$json->responses[0]->response."\n=http://askmona.orgより=");
	$resid+=1;
	file_put_contents("res.txt", $resid);
}
//var_dump($json->responses);
?>
