<?php
include 'connection.php';

$sql="SELECT* FROM `screenbizz` ORDER BY OrderID";

if( !( $selectRes = mysqli_query( $conn, $sql) ) ){
    echo 'Retrieval of data from Database Failed - #'.mysql_errno().': '.mysql_error();
}else{
    ?>
	<table border="2">
  	<thead>
   		<tr>
      		<th>Order Id</th>
      		<th>Model</th>
      		<th>Color</th>
      		<th>Profit</th>
    	</tr>
  </thead>
  <tbody>
    <?php
      if( mysqli_num_rows( $selectRes )==0 ){
        echo '<tr><td colspan="4">No Rows Returned</td></tr>';
      }else{
        while( $row = mysqli_fetch_assoc( $selectRes ) ){
          echo "<tr><td>{$row['OrderID']}</td><td>{$row['Model']}</td><td>{$row['Color']}</td><td>{$row['Profit']}</td></tr>\n";
        }
      }
    ?>
  </tbody>
</table>
    <?php
  }

?>