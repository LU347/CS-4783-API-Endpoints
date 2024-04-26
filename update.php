<!DOCTYPE html>
    <head>
        <title></title>
        <link rel="stylesheet" href="/assets/css/index.css">
    </head>
    <body>
       <?php include("header.php"); ?>
        <main>
			<section class="update-home-page">
				<div class="parent">
                    <div class="update-home-grid">
						<div class="card">
                            <h3>Update Equipment</h3>
                            <p><em>Update existing equipment with a valid device, manufacturer, status, and serial number</em></p>
                            <button name="update-serial" onclick="location.href='update_equipment.php'">Click to Update Equipment</button>
                        </div>
                        <div class="card">
                            <h3>Update Device</h3>
                            <p><em>Update an existing device type or device status</em></p>
                            <button name="update-device" onclick="toggleNewForms()">Click to Update Device</button>
                        </div>
                        <div class="card">
                            <h3>Update Manufacturer</h3>
                            <p><em>Update an existing manufacturer</em></p>
                            <button name="update-manufacturer" onclick="toggleNewForms()">Click to Update Manufacturer</button>
                        </div>
						<div class="card">
                            <h3>Update Serial Number</h3>
                            <p><em>Update an existing Serial number with a valid device id, and manufacturer id</em></p>
                            <button name="update-serial" onclick="toggleNewForms()">Click to Update Serial Number</button>
                        </div>
                    </div>
                </div>
			</section>
			<section class="new-device-manu" id="deviceForms" style="display: none">
				<div class="new-device-manu-grid">
					<div class="new-form-container">
						<form method="POST" class="form" action="">
							<label for="devices">Select Device Name:</label>
							<select name="device_id">
									<option selected disabled>Choose Here</option>
							</select>
							<label for="device-input">Update Device Name:</label>
							<input type="text" name="updated_str" placeholder="Example: Computer"><br>
							<button type="submit" value="submit_update_device" name="submit_update_device">Update Device</button>
						</form>
						
					</div>
					<div class="new-form-container">
						<form method="POST" class="form" action="">
							<label for="devices">Select Device:</label>
							<select name="device_id">
									<option selected disabled>Choose Here</option>
							</select>
							<label for="device-input">Update Device Status:</label>
							<select name="new_device_status">
								<option selected disabled>Choose Here</option>
							</select>
							<button type="submit" value="submit_device_status" name="submit_device_status">Update Status</button>
						</form>
						
					</div>
				</div>
			</section>
			<section class="new-device-manu" id="manuForms" style="display: none">
				<div class="new-device-manu-grid">
					<div class="new-form-container">
						<form method="POST" class="form" action="">
							<label for="manufacturers">Select Manufacturer:</label>
							<select name="manufacturer_id">
									<option selected disabled>Choose Here</option>
							</select>
							<label for="manufacturer-input">Update Manufacturer to:</label>
							<input type="text" name="updated_str" placeholder="Example: Apple"><br>
							<button type="submit" value="submit_update_manufacturer" name="submit_update_manufacturer">Update Manufacturer</button>
						</form>
					</div>
					<div class="new-form-container">
						<form method="POST" class="form" action="">
							<label for="manufacturers">Select Manufacturer:</label>
							<select name="manufacturer_id">
									<option selected disabled>Choose Here</option>
							</select>
							<label for="manufacturer-input">Update Manufacturer Status:</label>
							<select name="manufacturer_status">
								<option selected disabled>Choose Here</option>
							</select>
							<button type="submit" value="submit_manufacturer_status" name="submit_manufacturer_status">Update Status</button>
						</form>
					</div>
				</div>
			</section>
			<section class="new-device-manu" id="serialForms" style="display: none">
				<div class="new-form-container">
					<form method="POST" class="form" action="">
						<label for="serial-input">Input Serial Number (exact):</label>
						<input type="text" name="serial_number" id="serialInput" placeholder="Example: SN-XXXXX"><br>
						<label for="device-input">Update Serial Number (exact) to:</label>
						<input type="text" name="updated_str" id="serialInput" placeholder="Example: SN-XXXX"><br>
						<button type="submit" value="submit_new_serial" name="submit_new_serial">Submit</button>
					</form>
					
				</div>
			</section>
			<section class="status-notifications">
				<div class="parent">
				</div>
			</section>
		</main>
    </body>
	<script>
		//https://www.w3schools.com/howto/howto_js_toggle_hide_show.asp
		//todo: refactor
		function toggleNewForms()
		{
			console.log(event.target.name);
			let buttonName = event.target.name;
			if (buttonName == "update-device")
            {
              let div = document.getElementById("deviceForms");
              if (div.style.display === "none") {
                  div.style.display = "block";
              } else {
                  div.style.display = "none";
              }
            } else if (buttonName == "update-manufacturer") {
              let div = document.getElementById("manuForms");
              if (div.style.display === "none") {
                  div.style.display = "block";
              } else {
                  div.style.display = "none";
              }
            } else if (buttonName == "update-serial") {
			  let div = document.getElementById("serialForms");
              if (div.style.display === "none") {
                  div.style.display = "block";
              } else {
                  div.style.display = "none";
              }
            }
		}
	</script>
</html>
