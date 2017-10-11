<?php
if (isset($_POST['location'])) {
	$location=$_POST['location'];
	$map_url='https://maps.googleapis.com/maps/api/geocode/json?address='.urlencode($location);
	$maps_json=file_get_contents($map_url);
	$maps_array=json_decode($maps_json,true);

	$latitude=$maps_array['results'][0]['geometry']['location']['lat'];
	$longitude=$maps_array['results'][0]['geometry']['location']['lat'];

	$insta_url='https://api.instagram.com/v1/media/search?lat='.$latitude.'&lng='.$longitude.'&client_id=80af76d6cc464409be091cc993a7e6ea';

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