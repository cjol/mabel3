<?
	require_once __DIR__ . '/google-api/vendor/autoload.php'; 


	function getSheetsService() {
		$client = new Google_Client();
		// Load previously authorized credentials from a file.
		$credentialsPath = __DIR__ . '/credentials.json';
		if (!file_exists($credentialsPath)) {
		die("Could not find Google Sheets credentials.");
		} 
		$accessToken = json_decode(file_get_contents($credentialsPath), true);
		$client->setAccessToken($accessToken);
		// Refresh the token if it's expired.
		if ($client->isAccessTokenExpired()) {
		$client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
		file_put_contents($credentialsPath, json_encode($client->getAccessToken()));
		}

		// Get the API client and construct the service object.
		return new Google_Service_Sheets($client);
    }
    
    // Get CRSID from raven (or default)
    function get_crsid() {
        $config = parse_ini_file("./config.ini");
        if ($config["LOCAL_USER"]) {
            $crsid = $config["DEFAULT_CRSID"];
        } else if (isSet($_SERVER['REMOTE_USER'])) {
            $crsid = $_SERVER['REMOTE_USER'];
        } else {
            die("Raven authentication failed :(");
        }
        return $crsid;
    }
?>
