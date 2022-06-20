<?php
$con=mysqli_connect("localhost", "root", "", "carrentalp");

if(!$con){
	echo "DB not Connected...";
}
else{
	?> <h1>XML of the Booking Details </h1><?php
$result=mysqli_query($con, "Select * from rentedcars");
if($result){
$xml = new DOMDocument("1.0", 'utf-8');


// It will format the output in xml format otherwise
// the output will be in a single row
$xml->formatOutput=true;
$fitness=$xml->createElement("bookings");
$xml->appendChild($fitness);
while($row=mysqli_fetch_array($result)){
	$user=$xml->createElement("booking");
	$fitness->appendChild($user);
	
	$id=$xml->createElement("id", $row['id']);
	$user->appendChild($id);
	
	$car_id=$xml->createElement("car_id", $row['car_id']);
	$user->appendChild($car_id);

	$driver_id=$xml->createElement("driver_id", $row['driver_id']);
	$user->appendChild($driver_id);

	$customer_username=$xml->createElement("customer_username", $row['customer_username']);
	$user->appendChild($customer_username);
	
	$booking_date=$xml->createElement("booking_date", $row['booking_date']);
	$user->appendChild($booking_date);
	
	$rent_start_date=$xml->createElement("rent_start_date", $row['rent_start_date']);
	$user->appendChild($rent_start_date);
	
	$name=$xml->createElement("name", $row['customer_username']);
	$user->appendChild($name);

	$fare=$xml->createElement("fare", $row['fare']);
	$user->appendChild($fare);
	
    $total_amount=$xml->createElement("total_amount", $row['total_amount']);
	$user->appendChild($total_amount);
	
    $rent_end_date=$xml->createElement("rent_end_date", $row['rent_end_date']);
	$user->appendChild($rent_end_date);

    $car_return_date=$xml->createElement("car_return_date", $row['car_return_date']);
	$user->appendChild($car_return_date);

    $status=$xml->createElement("status", $row['return_status']);
	$user->appendChild($status);

    $distance=$xml->createElement("distance", $row['distance']);
	$user->appendChild($distance);
	

	
}
echo "<xmp>".$xml->saveXML()."</xmp>";
$xml->save("report.xml");
}
else{
	echo "error";
}
}
?>