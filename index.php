<?php
if (isset($_POST['location'])) {
	$location=$_POST['location'];
	$map_url='https://maps.googleapis.com/maps/api/geocode/json?address='.urlencode($location);
	$maps_json=file_get_contents($map_url);
	$maps_array=json_decode($maps_json,true);

	$latitude=$maps_array['results'][0]['geometry']['location']['lat'];
	$longitude=$maps_array['results'][0]['geometry']['location']['lng'];
//die($longitude);
	//https://api.instagram.com/v1/locations/search?lat=48.858844&lng=2.294351&access_token=3663659031.0816597.0e3d506de3b74fd2b58a601a73c2ef5a
	$location_id_url='https://api.instagram.com/v1/locations/search?lat='.$latitude.'&lng='.$longitude.'&access_token=3663659031.0816597.0e3d506de3b74fd2b58a601a73c2ef5a';
	
	$insta_json=file_get_contents($location_id_url);
		$insta_location_array=json_decode($insta_json,true);
	$location_id=$insta_location_array['data'][0]['id'];
	//die($location_id);

	https://api.instagram.com/v1/locations/{location-id}/media/recent?access_token=ACCESS-TOKEN
	$insta_url='https://api.instagram.com/v1/locations/'.$location_id.'/media/recent?access_token=3663659031.0816597.0e3d506de3b74fd2b58a601a73c2ef5a';
die($insta_url);
		$insta_json=file_get_contents($insta_url);
		$insta_array=json_decode($insta_json,true);

}



?>


<!DOCTYPE html>
<html>
<head>
	<title>Cola Geogram</title>
</head>
<body>


<form action="" method="post">
	
	<input type="text" name="location" >
	<button type="submit">Submit</button>

	<br><br>
	<?php
if (isset($insta_array)) {
	foreach ($insta_array['data'] as $image) {

		echo '<img src="'.$image['images']['low_resolution']['url'].'" alt=""/>';
	}
}
	?>

	</form>
</body>
</html>