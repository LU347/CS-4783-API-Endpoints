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

function get_data($msg)
{
  $tmp = $msg[3];
  $payload_Data = explode("Data:", $tmp);
  return json_decode( $payload_Data[1], true);
}

function display_search_results($result) 
{
    $resultArray = json_decode( $result, true );
    $status = get_msg_status( $resultArray );

    if ( strcmp( $status, "Success" ) == 0 ) 
    {
      $data = get_data( $resultArray );
      $num_results = count( $data );

      echo "<table class='view-table' style='border:1px solid; width:90%'>
                <tr>
                  <th>MANUFACTURER STATUS</th>
				  <th>DEVICE STATUS</th>
                  <th>DEVICE TYPE</th>
                  <th>MANUFACTURER</th>
                  <th>SERIAL NUMBER</th>
                </tr>";

      for ( $i = 0; $i < $num_results; $i++ ) {
        $row = explode( ",", $data[ $i ] );
        echo "<tr>";
        for ( $j = 0; $j < 5; $j++ ) {
			if (strcmp($row[$j], "ACTIVE") === 0)
			{
				echo "<td style='color:green'>";
				echo $row[ $j ];
          		echo "</td>";
			} elseif (strcmp($row[$j], "INACTIVE") === 0) {
				echo "<td style='color:red'>";
				echo $row[ $j ];
          		echo "</td>";
			} else {
				echo "<td>";
				echo $row[ $j ];
          		echo "</td>";
			}
        }
        echo "</tr>";
       }
      echo "</table>";
    }

    if ( strcmp( $status, "ERROR" ) == 0 ) 
    {
      $msg = explode( "MSG:", $resultArray[ 1 ] );
      echo "<div class='parent'>";
      echo "<div class='errorNotification'><p>";
      echo $msg[1];
      echo "</p></div>";
      echo "</div>";
    }
}
?>