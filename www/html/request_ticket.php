<?php
	require_once __DIR__ . '/google-api/vendor/autoload.php'; 
	require_once __DIR__ . '/functions.php';

	/** 
	 * This file gets called when the user wants to book tickets. 
	 * Note that we submit anything they request - a later stage will determine whether or not
	 * this request turns into an actual booked ticket.
	 */

	// Get config from .ini file
	$config = parse_ini_file("./config.ini");

	// get google sheets service reference
	$service = getSheetsService();

  	$spreadsheetId = $config['GOOGLE_SHEET_ID'];
	$range = 'Sheet1!A:B';

	$email = get_crsid() . "@cam.ac.uk";
	$request_id = uniqid("req_");
	$guest_name = "Christopher Little";
	$ticket_type = "Queue Jump";
	$request_date = time();
	  
	$values = new Google_Service_Sheets_ValueRange(array(
		'values' => array(
			array($request_id, $email, $guest_name, $ticket_type, $request_date)
		)
	));

	$options = array(
		'valueInputOption' => "RAW"
	);

	$service->spreadsheets_values->append( $spreadsheetId, $range, $values,  $options);


	$response = $service->spreadsheets_values->get($spreadsheetId, $range);

	echo "{\"success\": true, \"status\": \"OK\"}";
?>
