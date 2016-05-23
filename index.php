<?php 
require 'src/Facebook.php';

$fb = new Facebook\Facebook([
  'app_id' => '1722350238025805',
  'app_secret' => '3785743700eeb3f2752d39c5825a9ceb',
  'default_graph_version' => 'v2.2',
  		"cookie" => true,
		'fileUpload' => true,
  ]);
  

$data = [
  'message' => 'My awesome photo upload example.',
  'source' => $fb->fileToUpload('/path/to/photo.jpg'),
];

try {
  // Returns a `Facebook\FacebookResponse` object
  $response = $fb->post('/me/photos', $data, '{access-token}');
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}

$graphNode = $response->getGraphNode();

echo 'Photo ID: ' . $graphNode['id'];

?>
