<?php


function is_bookingActual($room,$allbookings,$allclients, $today){
	global $roomId;
	$roomId = $room->roomId;
	
	$specificBooking = $allbookings->first(function($item) {
		global $roomId;
		return $item->roomId == $roomId;
	});
	
	//Will be verified if there's a booking first 
	if($specificBooking)$specificClient=$allclients[$specificBooking->clientId-1];

	//Will be verified if there's a booking first 
	if (($specificBooking)&&($today >= $specificBooking->Checkin)&&($today < $specificBooking->Checkout)) return true;
	else return false;	 
}

// function getSpecificClient($room,$allbookings,$allclients){
	
// 	global $roomId;
// 	$roomId = $room->roomId;
	
// 	$specificBooking = $allbookings->first(function($item) {
// 		global $roomId;
// 		return $item->roomId == $roomId;
// 	});

// 	$specificClient=$allclients[$specificBooking->clientId-1];

// 	return $specificClient->First_Name;
// }

