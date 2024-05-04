<!DOCTYPE html>
    <head>
        <title></title>
        <link rel="stylesheet" href="/assets/css/index.css">
    </head>
    <body>
        <?php include("header.php"); ?>
        <main>
            <section class="view-page">
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
				<div class="parent"><h1>View and Search Equipment</h1></div>
				<div class="parent">
					<form method="POST" class="search-bar" action="">
						<label for="status">Status:</label>
						<select name="status">
							<option value="ACTIVE">ACTIVE</option>
							<option value="INACTIVE">INACTIVE</option>
							<option value="BOTH">ACTIVE/INACTIVE</option>
						</select>
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
						<button type="submit" name="submit-equipment">View Equipment</button>
					</form>
				</div>
            </section>
			<section class="results">
				<div class="parent">
					<?php
					ob_start();
					if ( isset( $_POST[ 'submit-equipment' ] ) ) {
					  $status = $_REQUEST[ 'status' ];
					  $manufacturer_id = $_REQUEST[ 'manufacturer_id' ];
					  $device_id = $_REQUEST[ 'device_id' ];
					  $serial_number = $_REQUEST[ 'serial_number' ];
					  $url = "https://ec2-18-220-186-80.us-east-2.compute.amazonaws.com/api/new_search?status=$status";
					  
					  if ($device_id && (!$manufacturer_id && !$serial_number))
					  {
						  $url = "https://ec2-18-220-186-80.us-east-2.compute.amazonaws.com/api/new_search?status=$status&device_id=$device_id";
					  }
						
                      if ($manufacturer_id && (!$device_id && !$serial_number))
					  {
						  $url = "https://ec2-18-220-186-80.us-east-2.compute.amazonaws.com/api/new_search?status=$status&manufacturer_id=$manufacturer_id";
					  }
						
					  if ($serial_number && (!$device_id && !$manufacturer_id))
					  {
						  $encoded_serial = urlencode($serial_number);
						  $url = "https://ec2-18-220-186-80.us-east-2.compute.amazonaws.com/api/new_search?status=$status&serial_number=$encoded_serial";
					  }
						
					  if ($device_id && $manufacturer_id && (!$serial_number))
					  {
						  $url = "https://ec2-18-220-186-80.us-east-2.compute.amazonaws.com/api/new_search?status=$status&device_id=$device_id&manufacturer_id=$manufacturer_id";
					  }
						
					  if ($device_id && $manufacturer_id && $serial_number) {
						  $url = "https://ec2-18-220-186-80.us-east-2.compute.amazonaws.com/api/new_search?status=$status&serial_number=$serial_number&device_id=$device_id&manufacturer_id=$manufacturer_id";
					  }
				
					  $result = call_api( $url );
					  display_search_results($result);
					}
					?>
				</div>
			</section>
        </main>
    </body>
	<script>
		
    </script>
</html>