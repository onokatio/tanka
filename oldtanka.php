<?php
$host = "http://askmona.org/";
while(true){
  $resid = file_get_contents("res.txt");
  $lastup = file_get_contents("lastup.txt");
  //$resid = 579;
//  if(!($date = file_get_contents($host."v1/responses/list?t_id=3196&topic_detail=1&if_modified_since=".$lastup))) exit("error : couldn't get date from server");
  if(!($date = file_get_contents($host."v1/responses/list?t_id=3196&topic_detail=1"))) exit("error : couldn't get date from server");
  file_put_contents("lastup.txt", time());
  $json = json_decode($date);
  if($json->status != 1){
    if($json->status == 2){
//      echo "no more update";
    }else{
      echo "error : ".$json->error;
    }
  }
  $resmax = $json->topic->count;
  if($resid > $resmax){
//  echo "no more res";
  continue;
  }
  if(!($date = file_get_contents($host."v1/responses/list?t_id=3196&from=".$resid))) exit("error : couldn't get date from server");
  $json = json_decode($date);
  if($json->status != 1) echo "error : ".$json->error;
  echo $resid."\n";
  if(strstr($json->responses[0]->response, "#tanka")){
    //echo $resid." : found tanka\n";
//    echo $resid.":\n";
    echo $json->responses[0]->response."\n";
  }
  $resid = $resid + 1;
  file_put_contents("res.txt", $resid);
}
//var_dump($json->responses);
?>
