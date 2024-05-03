<!DOCTYPE html>
    <head>
        <title></title>
        <link rel="stylesheet" href="/assets/css/index.css">
    </head>
    <body>
        <?php include("header.php"); ?>
        <main>
            <section class="update-page">
				<?php
					ob_start();
                    include("functions.php");
                    $result = call_api("https://ec2-18-220-186-80.us-east-2.compute.amazonaws.com/api/list_devices");
                    $resultsArray = json_decode($result, true);
                    $devices = get_msg_data($resultsArray);

                    $result = call_api("https://ec2-18-220-186-80.us-east-2.compute.amazonaws.com/api/list_manufacturers");
                    $resultsArray = json_decode($result, true);
                    $manufacturers = get_msg_data($resultsArray);
				?>
				<div class="parent"><h1>Update Equipment</h1></div>
				<div class="parent">
					<form method="POST" action="" style="color:black; border: 1px solid; padding: 10px">
						<label>Old Equipment</label><br>
						<label for="device">Device:</label>
						<select name="device_id">
							<option selected disabled>Choose Device</option>
							<?php
                              foreach($devices as $key=>$value)
                              {
                                  echo '<option value="'.$key.'">'.$value.'</option>';
                              }
                            ?>
						</select>
						<label for="manufacturer">Manufacturer:</label>
						<select name="manufacturer_id">
							<option selected disabled>Choose Manufacturer</option>
							<?php
                              foreach($manufacturers as $key=>$value)
                              {
                                  echo '<option value="'.$key.'">'.$value.'</option>';
                              }
                            ?>
						</select>
						<label for="serial_number">Serial #:</label>
						<input type="text" id="serialInput" name="serial_number" placeholder="Format: SN-09091asda309asd">
						
						<br><br>
						
						<label>Update Values</label><br>
						<label for="device">Device:</label>
						<select name="new_device">
							<option selected disabled>Choose Device</option>
							<?php
                              foreach($devices as $key=>$value)
                              {
                                  echo '<option value="'.$key.'">'.$value.'</option>';
                              }
                            ?>
						</select>
						<label for="manufacturer">Manufacturer:</label>
						<select name="new_manu">
							<option selected disabled>Choose Manufacturer</option>
							<?php
                              foreach($manufacturers as $key=>$value)
                              {
                                  echo '<option value="'.$key.'">'.$value.'</option>';
                              }
                            ?>
						</select>
						<label for="serial_number">Serial #:</label>
						<input type="text" id="serialInput" name="new_serial" placeholder="Format: SN-09091asda309asd">
						<button type="submit" name="submit" value="submit" style="color: white; background-color:#6898d4; border: none; padding: 10px">Update Equipment</button>
					</form>
				</div>
            </section>
			<section class="results">
				<div class="parent">
					
				</div>
			</section>
			<section class="status-notifications">
				<div class="parent">
					<?php
						ob_start();					
						if (isset($_REQUEST['msg']) && $_REQUEST['msg'] == "Error" && $_REQUEST['val'])
						{
							echo "<div class='parent'>";
							echo "<div class='errorNotification'><p>";
							echo $_REQUEST['val'];
							echo "</p></div>";
							echo "</div>";
						}
					?>
				</div>
			</section>
        </main>
    </body>
	<script>
		
    </script>
</html>
<?php
ob_start();
if ( isset( $_POST[ 'submit' ] ) ) {
  $manufacturer_id = $_POST[ 'manufacturer_id' ];
  $device_id = $_POST[ 'device_id' ];
  $serial_number = $_POST[ 'serial_number' ];
  $new_device = $_POST['new_device'];
  $new_manu = $_POST['new_manu'];
  $new_serial = $_POST['new_serial'];

  $url = "";

  if ($new_device && (!$new_manu && !$new_serial))
  {
      $url = "https://ec2-18-220-186-80.us-east-2.compute.amazonaws.com/api/new_update_equipment?device_id=$device_id&manufacturer_id=$manufacturer_id&serial_number=$serial_number&new_device=$new_device";
  }

  if ($new_manu && (!$new_device && !$new_serial))
  {
      $url = "https://ec2-18-220-186-80.us-east-2.compute.amazonaws.com/api/new_update_equipment?device_id=$device_id&manufacturer_id=$manufacturer_id&serial_number=$serial_number&new_manu=$new_manu";
  }

  if ($new_serial && (!$new_device && !$new_manu))
  {
      $encoded_serial = urlencode($new_serial);
      $url = "https://ec2-18-220-186-80.us-east-2.compute.amazonaws.com/api/new_update_equipment?device_id=$device_id&manufacturer_id=$manufacturer_id&serial_number=$serial_number&new_serial=$encoded_serial";
  }

  if ($new_device && $new_manu && (!$new_serial))
  {
      $url = "https://ec2-18-220-186-80.us-east-2.compute.amazonaws.com/api/new_update_equipment?device_id=$device_id&manufacturer_id=$manufacturer_id&serial_number=$serial_number&new_device=$new_device&new_manu=$new_manu";
  }

  if ($new_device && $new_manu && $new_serial) {
      $encoded_serial = urlencode($new_serial);
      $url = "https://ec2-18-220-186-80.us-east-2.compute.amazonaws.com/api/new_update_equipment?device_id=$device_id&manufacturer_id=$manufacturer_id&serial_number=$serial_number&new_device=$new_device&new_manu=$new_manu&new_serial=$encoded_serial";
  }

  $result = call_api($url);
  $resultsArray = json_decode($result, true);
  $status = trim(get_msg_status($resultsArray));
  $msg = substr($resultsArray[1], 4);

  if (strcmp($status, "Success") == 0) 
  {
      header("Location: index.php?msg=EquipmentUpdated");
      die();
  }

  if (strcmp($status, "ERROR") == 0) 
  {
      header("Location: update_equipment.php?msg=Error&val=$msg");
      die();
  }
}
?>