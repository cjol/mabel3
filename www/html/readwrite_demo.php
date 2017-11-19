<?php
	require_once __DIR__ . '/google-api/vendor/autoload.php'; 
	require_once __DIR__ . '/functions.php';

	// Get config from .ini file
	$config = parse_ini_file("./config.ini");

	// get google sheets service reeerence
	$service = getSheetsService();

  	$spreadsheetId = $config['GOOGLE_SHEET_ID'];
	$range = 'Sheet1!A:B';
	  
	$values = new Google_Service_Sheets_ValueRange(array(
		'values' => array(
			array("Bar", 1)
		)
	));

	$options = array(
		'valueInputOption' => "RAW"
	);

	$service->spreadsheets_values->append( $spreadsheetId, $range, $values,  $options);


	$response = $service->spreadsheets_values->get($spreadsheetId, $range);
	$values = $response->getValues();

	var_dump($values);

?>
