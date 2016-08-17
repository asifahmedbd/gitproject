<?php
 error_reporting(0);	
 $response = file_get_contents("https://www.googleapis.com/youtube/v3/channels?key=AIzaSyCIWtqQD5H-578uIb1tv6tU_Athxr6V_H8&forUsername=romeoasif&part=contentDetails");
 //$response = file_get_contents("https://www.googleapis.com/youtube/v3/playlists?key=AIzaSyCIWtqQD5H-578uIb1tv6tU_Athxr6V_H8&part=contentDetails,snippet&id=PLxzbcbB-eorqmh1QRVRCwM1bVzoHhnRsQ");
 $searchResponse = json_decode($response,true);
 
 //echo '<pre>'.print_r ($searchResponse, true).'</pre>'; exit;
 
 $data = $searchResponse['items'];
 $pid =  $data[0]['contentDetails']['relatedPlaylists']['uploads'];

 $nextPageToken = '';
 while(!is_null($nextPageToken)) {
     $request = "https://www.googleapis.com/youtube/v3/playlistItems?key=AIzaSyCIWtqQD5H-578uIb1tv6tU_Athxr6V_H8&playlistId=PLxzbcbB-eorqmh1QRVRCwM1bVzoHhnRsQ&part=snippet&maxResults=50&pageToken=$nextPageToken";

    $response = file_get_contents($request);
    $videos = json_decode($response,true);

    
    $nextPageToken = $videos['nextPageToken'];
}

echo '<pre>'.print_r ($videos, true).'</pre>'; //exit;
?>

<!DOCTYPE html>
<html>
<head>
<title>Romeo's Youtube Playlist</title>

<!-- Meta Tag -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Library CSS -->
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">

<!-- Library JS -->
<script src="jquery/jquery-1.11.1.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>

<!-- Template CSS -->
<link href="style/style.css" rel="stylesheet">
</head>
<body>
	<!-- Page -->
	<div id="page" class="page">

		<content class="videobox">
				<div class="container">
					<div class="row">
						
						<div class="col-xs-12 col-sm-12 col-md-7 col-lg-7">
								<div class="embed-responsive embed-responsive-16by9">
									<iframe class="embed-responsive-item" width="853" height="480" src="https://www.youtube-nocookie.com/embed/videoseries?list=PLxzbcbB-eorqmh1QRVRCwM1bVzoHhnRsQ" frameborder="0" allowfullscreen></iframe>
								</div>
							</div>
						
							<div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
								<div class="playlist-container">
									<ol id="myplaylist">
									<?php foreach($videos['items'] as $key=>$val ) { ?>
										<li><a href=""><span class="vidthumbnail"><img src="<?php echo $val['snippet']['thumbnails']['default']['url']; ?>" width="72" height="54" /></span><span class="vidtitle"><?php echo $val['snippet']['title']; ?></span></a></li>
									<?php } ?>	
									</ol>
								</div>
							</div>
							
							<div class="clearfix"></div>
						
						
					</div>
				</div>
		</content>

	</div><!-- /#page -->
</body>
</html>
