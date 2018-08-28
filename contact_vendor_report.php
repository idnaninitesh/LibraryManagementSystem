<?php

require 'core.inc.php';
require 'connect.inc.php';

?>

<html>
    <head>
        <title>Print statistics</title>
    </head>
    <body>
        <script>
            window.print();
        </script>
        <a href="contact_vendor.php">Back to Vendors</a><br><br>
        <?php
            $query="SELECT Vendor.*, Vendor_Contact.Contact_no FROM Vendor,Vendor_Contact WHERE Vendor.Vendor_ID=Vendor_Contact.Vendor_ID";
		$query_run=mysql_query($query);
		if($query_run)
			{
				echo '<b>Vendors:</b><br><br>';
				if(mysql_num_rows($query_run)==0)
					echo 'No Vendors available';
				else
				{
					echo '<table border="1" cellpadding="10" style="width:100%; border-collapse: collapse; text-align: center; "><thead><tr><th>Vendor ID</th><th>Name</th><th>Email ID</th><th>Contact No.</th></tr></thead><tbody>';
					while($arr=mysql_fetch_assoc($query_run))
					{
						echo '<tr><td>'.$arr['Vendor_ID'].'</td><td>'.$arr['Name'].'</td><td><a href="mailto:'.$arr['Email_id'].'?Subject=Order%20new%20books" target="_top">'.$arr['Email_id'].'</a></td><td>'.$arr['Contact_no'].'</td></tr>';
					}
					echo '</tbody></table>';
				}
			}
        ?>
