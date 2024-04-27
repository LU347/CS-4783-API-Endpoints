<!DOCTYPE html>
    <head>
        <title></title>
        <link rel="stylesheet" href="/assets/css/index.css">
    </head>
    <body>
        <?php include("header.php"); ?>
        <main>
            <section class="home-page">
				<?php					
		 			if (isset($_REQUEST['msg']))
					{
						$success_msg = "";
						
						switch($_REQUEST['msg']) {
							case "DeviceUpdated":
								$success_msg = "Device successfully updated!";
								break;
							case "ManufacturerUpdated":
								$success_msg = "Manufacturer successfully updated!";
								break;
							case "SerialUpdated":
								$success_msg = "Serial Number successfully updated!";
								break;
							case "EquipmentUpdated":
								$success_msg = "Equipment successfully updated!";
								break;
							case "DeviceAdded":
								$success_msg = "Device successfully added!";
								break;
							case "ManufacturerAdded":
								$success_msg = "Manufacturer successfully added!";
								break;
							case "EquipmentAdded":
								$success_msg = "Equipment successfully added!";
								break;
							default:
								break;
						}
						
						echo "
						<div class='parent'>
							<div class='successNotification'>
								<p>$success_msg</p>
							</div>
						</div>";
					}
				 ?>
                <div class="parent">
                    <div class="home-grid">
                        <div class="card">
                            <h3>View Search Equipment</h3>
                            <p><em>Search equipment by their device type, manufacturer, or serial number, or status</em></p>
                            <a href="view.php">
								<button name="search-button">Go to Search Page</button>
							</a>
                        </div>
                        <div class="card">
                            <h3>Add Equipment</h3>
                            <p><em>Add equipment with a valid device type, manufacturer, and serial number</em></p>
                            <a href="add.php">
								<button name="add-button">Go to Add Page</button>
							</a>
                        </div>
						<div class="card">
                            <h3>Update Equipment</h3>
                            <p><em>Update equipment with a valid device type, manufacturer, and serial number</em></p>
                            <a href="update.php">
								<button name="update-button">Go to Update Page</button>
							</a>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </body>
</html>