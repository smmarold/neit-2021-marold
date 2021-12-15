<?php

include('model_disney.php');

$contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';

if ($contentType === "application/json") {
  //Receive the RAW post data.
  $content = trim(file_get_contents("php://input")); 
  $decoded = json_decode($content, true);
  $action = $decoded['action'];
  
  $votes = json_encode([ "test"=> 'test']);
  //var_dump($action);

  //Check the action attribute that was sent. If it is a 'vote', call insertDisneyVote from model_disney.php (which calls getVotes anyway). 
  //If the action was 'get', we simply call getVotes instead. 
  if($action == "vote"){
      $votes = insertDisneyVote($decoded['character_id']);
      //$returnObj =  json_encode($votes);
  } 
  else if($action == 'get'){
      $votes = getVotes();
      //$returnObj =  json_encode($votes);
      
  }
  //ECHO. ECHO. ECHO. Return doesn't work for AJAX calls, apparently. ;)
  echo ($votes);

  //If json_decode failed, the JSON is invalid.
  // if( is_array($decoded)) {
  //     echo json_encode($decoded['user_name1']);
  // } else {
  //   return('Invalid JSON');
  // }
}

?>