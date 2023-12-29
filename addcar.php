<?php

$plate = $_POST['plate'];
$country = $_POST['car_country'];
$Model = $_POST['Model'];
$price = $_POST['price'];
$manual = $_POST['type'];
$color = $_POST['color'];
$office = $_POST['office_country'];
$detail = $_POST['detail'];
if($manual==="manual"){
	$type="manual";
}
else{
	$type="automatic";
}
$img_name="";
if (isset($_POST['submit']))
{
  if (isset($_FILES['glryimage'])) {
     $img_name = $_FILES['glryimage']['name'];
  }
}


$conn = mysqli_connect("localhost", "root", "", "car rental system");

if (!$conn) {

    echo "Connection failed!";

}else {
	$stmt = $conn->prepare("SELECT office_id FROM office WHERE country='$office'");
    $stmt->execute();
    $result = $stmt->get_result(); 
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $office=$row["office_id"];   
              
         
	if ($img_name!='')
	{  	$ext = pathinfo($img_name, PATHINFO_EXTENSION);
		$allowed = ['png', 'gif', 'jpg', 'jpeg'];
 
		if (in_array($ext, $allowed))
		{
		$img_data = addslashes(file_get_contents($_FILES['glryimage']['tmp_name']));
		$stmt = $conn->prepare("insert into Car(plate_id,price, country, model,type,color,detail,image,office_id) values(?, ?, ?,?, ?, ?, ?, ?,?)");
		$stmt->bind_param("sssssssss", $plate,$price, $country, $Model,$type,$color,$detail,$img_data,$office);
		$execval = $stmt->execute();
		include("addcar.html");
        exit();
		
		$stmt->close();
		$conn->close();}}  
	}
	else{
		echo "No office in that country";
	}
	} 
		
?>