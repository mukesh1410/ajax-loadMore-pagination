<?php

$conn = mysqli_connect("localhost","root","","test") or die("Connection failed");

$limit = 5;
if(isset($_POST['page_no'])){
  $page = $_POST['page_no'];
}else{
  $page = 0;
}

$sql = "SELECT * FROM students LIMIT {$page},$limit";
$query = mysqli_query($conn,$sql) or die("Query Unsuccessful.");
  
if(mysqli_num_rows($query) > 0){
  $output = "";
  $output .= "<tbody>";
    while($row = mysqli_fetch_assoc($query)) {
      $last_id = $row["id"];
      $output .= "<tr><td align='center'>{$row["id"]}</td><td>{$row["first_name"]} {$row["last_name"]}</td></tr>";
    }     
      $output .= "</tbody>
                  <tbody id='pagination'>
                    <tr>
                      <td colspan='2'>
                        <button id='ajaxbtn' data-id='{$last_id}'>Load More</button>
                      </td>
                    </tr>
                  </tbody>";
    echo $output;              
}else{
  echo "";
}

mysqli_close($conn);
?>