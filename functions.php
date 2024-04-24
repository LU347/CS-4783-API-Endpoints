<?php
function call_api($url) 
{
  $ch = curl_init($url);
  $data = "";
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); //ignore ssl
  curl_setopt($ch, CURLOPT_POST, 1 ); //tell curl we are using post
  curl_setopt($ch, CURLOPT_POSTFIELDS, $data ); //this is the data
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); //prepare a response
  curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'content-type: application/x-www-form-urlencoded',
    'content-length: ' . strlen($data) ) );
  $result = curl_exec($ch);
  curl_close($ch);
  return $result;
}

function get_msg_status($msg)
{
	$tmp = $msg[0];	//placeholder for the status row
    $status = explode("Status:", $tmp); //explodes status to get the status variable
	$status[1] = trim($status[1]); //this should get success or error
	return $status[1];
}

function get_msg_data($msg) 
{
  $tmp = $msg[1];
  $payload_Data = explode( "MSG:", $tmp);
  return json_decode( $payload_Data[1], true);
}
?>