<?php
#To use these examples you need to have the librear php curl installed

#Get a api key in the panel and add it here 
define('API_KEY', 'Your api key');

#Function to launch a get request to a URL sent by parameter. 
function getCurlRequest($url)
{
	#Create session curl
	$curl = curl_init();
	
	#Add all info for request to object curl
	curl_setopt_array($curl, array
	(
	  CURLOPT_URL => $url,#URL
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,#VERSION
	  CURLOPT_CUSTOMREQUEST => "GET",#METHOD
	  CURLOPT_HTTPHEADER => array #HEADER
	  (
		"apikey:".API_KEY,
		"content-type: application/json"
	  )
	));
	#Sent the request
	$response = curl_exec($curl);
	#Get the error if there
	$err = curl_error($curl);
	#Closes a cURL session
	curl_close($curl);

	if ($err) 
	{
		echo "cURL Error #:" . $err;
	}
	else
	{
		echo $response;
	}
}

#Function to launch a POST request to create planner with curl.
function postCurlPlanner()
{
	#Create session curl
	$curl = curl_init();
	#Create Json object to send data of planner
	$data = array("date"=>"","hour"=>"","form"=>"","userTo"=>"","userFrom"=>"3.","client"=>"","content"=>"","latitude"=>"","longitude"=>"");
	$data_json = json_encode($data);
	
	#Add all info for request to object curl
	curl_setopt_array($curl, array
	(
	  CURLOPT_URL => "http://api.workingdaysuite.com/planner",#URL
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,#VERSION
	  CURLOPT_CUSTOMREQUEST => "POST",#METHOD
	  CURLOPT_POSTFIELDS => $data_json,#DATA
	  CURLOPT_HTTPHEADER => array #HEADER
	  (
		"apikey:".API_KEY,
		"content-type: application/json"
	  )
	));
	#Sent the request
	$response = curl_exec($curl);
	#Get the error if there
	$err = curl_error($curl);
	#Closes a cURL session
	curl_close($curl);

	if ($err) 
	{
	  echo "cURL Error #:" . $err;
	}
	else
	{
	  echo $response;
	}
}
#Invoke funtion getCurlRequest
getCurlRequest("http://api.workingdaysuite.com/tracker");

#Invoke function postCurlPlanner
postCurlPlanner();
?>
