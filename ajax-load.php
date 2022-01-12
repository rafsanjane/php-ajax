<?php

require_once 'libs/config.php';

$sql = "SELECT * FROM students";
$result = mysqli_query($conn, $sql) or die("SQL Query Failed.");
$output = "";



if (mysqli_num_rows($result) > 0) {


  while ($row = mysqli_fetch_assoc($result)) {
?>
    <tr>
      <td align='center'><?php echo $row['id']; ?></td>
      <td><?php echo $row["first_name"] . " " . $row["last_name"] ?></td>
      <td align='center'><?php echo $row['email']; ?></td>
      <td align='center'><button class='edit-btn' data-id='<?php echo $row['id']; ?>'>Edit</button></td>
      <td align='center'><button Class='delete-btn' data-id='<?php echo $row['id']; ?>'>Delete</button></td>
    </tr>

<?php
  }


  mysqli_close($conn);

  echo $output;
} else {
  echo "<td colspan='5' align='center'><h2 >No Record Found.</h2></td>";
}
?>