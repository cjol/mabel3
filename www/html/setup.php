<?php
	// Connect to Google sheets
	require_once __DIR__ . '/google-api/vendor/autoload.php'; 

  	  $client = new Google_Client();
  	  $client->setApplicationName('Mabel 3');
  	  $client->setScopes(implode(' ', array(
  	  	Google_Service_Sheets::SPREADSHEETS)
  	  ));
  	  $client->setAuthConfig(__DIR__ . '/client_secret.json');
  	  $client->setAccessType('offline');

  	  // Load previously authorized credentials from a file.
  	  $credentialsPath = __DIR__ . '/credentials.json';
      	// Request authorization from the user.
      	$authUrl = $client->createAuthUrl();
      	printf("Open the following link in your browser:\n%s\n", $authUrl);
      	print 'Enter verification code: ';
      	$authCode = trim(fgets(STDIN));

      	// Exchange authorization code for an access token.
      	$accessToken = $client->fetchAccessTokenWithAuthCode($authCode);

      	// Store the credentials to disk.
      	if(!file_exists(dirname($credentialsPath))) {
      	  mkdir(dirname($credentialsPath), 0700, true);
      	}
      	file_put_contents($credentialsPath, json_encode($accessToken));
      	printf("Credentials saved to %s\n", $credentialsPath);
?>
