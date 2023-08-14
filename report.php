<?php
// Database Connection file
include('db_connect.php');
?>
<table border="1">
<thead>
<tr>Members Report
<th>ID</th>
<th>Members Name</th>
<th>Email</th>
<th>Status</th>
<th>Package</th>
<th>TrainerID</th>
</tr>
</thead>
<?php
// File name
$filename="Members";
// Fetching data from data base
$query=mysqli_query($conn,"select * from usertable");
$cnt=1;
while ($row=mysqli_fetch_array($query)) {
?>
            <tr>
               
                <td><?php echo $row['id'];?></td>
                <td><?php echo $row['name'];?></td>
                <td><?php echo $row['email'];?></td>
                <td><?php echo $row['status'];?></td>
                <td><?php echo $row['plan'];?></td>
                <td><?php echo $row['tid'];?></td>
		

            </tr>
<?php
$cnt++;
// Genrating Execel  filess
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=".$filename."-Report.xls");
header("Pragma: no-cache");
header("Expires: 0");
} ?>
</table>
