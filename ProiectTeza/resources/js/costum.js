$(document).ready(function(){

	//==========================ON START-UP========================== 
	$("#autoLaunch").trigger('click');
	$(window).on('load',function(){
      $('#prepareRoomsModal').modal('show');
    });

  //====================================================ROOMS==================================================== 

	// alert($(".roomsList .Status").text());

	// if($(".roomsList .Status").text() == "Disponibil")alert("Found");
$('.roomsList').find('.Status').each(function(i) { 
	// console.log("Test");

	// Search if string exists in text
	if(($(this).text().indexOf("Ocupat") >= 0)||($(this).text().indexOf("Busy") >= 0)){
		console.log($(this).text());
		$(this).parent().parent().css("background-color","#ff9999");
	}
})

// Details popUp on name Hovering

$('[id^=roomCardclientName_]').mouseover(function(event){


	var current_booking_id = event.target.id.slice(event.target.id.indexOf("_")+1);
	
    var booking    = $(this).data("booking"),
    	client     = $(this).data("client");

    $("#BookingInfoTooltip_"+current_booking_id).fadeIn();
	var popper= new Popper($("#"+event.target.id),$("#BookingInfoTooltip_"+current_booking_id),{
		placement: "top"
	});
	
	// console.log(booking.bookingId);
})

$('[id^=roomCardclientName_]').mouseleave(function(event) {
	var current_booking_id = event.target.id.slice(event.target.id.indexOf("_")+1);
	$("#BookingInfoTooltip_"+current_booking_id).fadeOut();
})

	//==========================ACCEPTING-DECLINING-BOOKINGS========================== 

	var refCancel = $(".CancelAnchor");
	var refAccept = $(".AcceptAnchor");


	refCancel.mouseover(function(event) {
		var current_id = event.target.id.slice(event.target.id.indexOf("_")+1);
		// console.log("#cancelTooltip_"+current_id);
		$("#CancelTooltip_"+current_id).fadeIn();
		var popper= new Popper($("#"+event.target.id),$("#CancelTooltip_"+current_id),{
			placement: "top"
		});
	});

	refCancel.mouseleave(function(event) {
		var current_id = event.target.id.slice(event.target.id.indexOf("_")+1);
		$("#CancelTooltip_"+current_id).fadeOut();
	})


	refAccept.mouseover(function(event) {
		var current_id = event.target.id.slice(event.target.id.indexOf("_")+1);

		// popupAccept.fadeIn(300);
		$("#AcceptTooltip_"+current_id).fadeIn();

		var popper= new Popper($("#"+event.target.id),$("#AcceptTooltip_"+current_id),{
			placement: "top"
		});
	});

	refAccept.mouseleave(function(event) {
		var current_id = event.target.id.slice(event.target.id.indexOf("_")+1);
		$("#AcceptTooltip_"+current_id).fadeOut(300);
	})

	//====================================================EDIT MODALS==================================================== 
	function formatDate(date) {
	    var d = new Date(date),
	        month = '' + (d.getMonth() + 1),
	        day = '' + d.getDate(),
	        year = d.getFullYear();
	
	    if (month.length < 2) month = '0' + month;
	    if (day.length < 2) day = '0' + day;
	
	    return [day, month, year].join('/');
	};

	//==========================EDIT Rooms MODAL========================== 

	$('#editroomsModal').on('shown.bs.modal', function(event) {
		 var link       = $(event.relatedTarget),
        	 modal      = $(this),
        	 room       = link.data("room");
    
    	$(".modal-body #RoomformContainer").attr("action","/rooms/"+room.roomId);

		$(".modal-body #room_editFloor_input").val(room.floorId);
		$(".modal-body #room_editNumberOfBeds_input").val(room.nrOfBeds);
		console.log(room.seaSight);
		if(room.seaSight==1){
			$(".modal-body #room_editseaSight_input").prop("checked",true);
		}
		else{
			$(".modal-body #room_editseaSight_input").prop("checked",false);
		}
	})



    

	//==========================EDIT Booking MODAL========================== 

	//Sending data from anchor to the modal itself

	// $(".openEditModal").on('click', function(e) {
	// 	$('#editclientModal').modal('toggle', $(this));
	// });
	
	$('#editbookingModal').on('shown.bs.modal', function(event) {
    var link       = $(event.relatedTarget),
        modal      = $(this),
        booking    = link.data("booking"),
        client     = link.data("client");

        $(".modal-body #BookingformContainer").attr("action","/bookings/"+booking.bookingId);

        var checkin = booking.Checkin.replace(/-/g, "/");
        var checkout = booking.Checkout.replace(/-/g, "/");

		var strtotime = require('locutus/php/datetime/strtotime');
		
        $(".modal-body #booking_editFirstName_Form")  .val(client.First_Name);
		$(".modal-body #booking_editLastName_Form")	  .val(client.Last_Name);
        $(".modal-body #booking_editEmail_input")     .val(client.Email)
		$(".modal-body #booking_editPhone_input")	  .val(client.Phone);
		$(".modal-body #booking_editAdults_input")    .val(booking.Adults);
		$(".modal-body #booking_editTotalRooms_input").val(booking.totalRooms);
		$(".modal-body #booking_editChildren_input")  .val(booking.Children);
		$(".modal-body #booking_editCheckIn_input")   .val(formatDate(checkin));
		$(".modal-body #booking_editCheckOut_input")  .val(formatDate(checkout));
		$(".modal-body #booking_editStatus_input")    .val(booking.Status);
		$(".modal-body #booking_specificRoomInput")   .val(booking.roomId);

     // booking_specificRoomInput
});

$('#findAutomaticRadio').click(function(event) {
	   if($('#findAutomaticRadio').is(':checked')) {
		    $('#specificRoomInput').parent().parent().hide();
		    $('#nrOfBedsInput').parent().parent().show();
		    $('#seaSightInput').parent().parent().show();
	    }
});

$('#findManualRadio').click(function() {
	   if($('#findManualRadio').is(':checked')) { 
		    $('#specificRoomInput').parent().parent().show();
		    $('#nrOfBedsInput').parent().parent().hide();
		    $('#seaSightInput').parent().parent().hide();
	   	}
});



			//New Client, Edit Client
//Inserting Specific Rooms acording to Tootal Rooms

// $('#totalRoomsInput').change(function(){
// 	$( "#specificInsert" ).append( 
// 	"<p>Test</p>"+
// 	"<div class='row'>"+
// 	    "<div class='col-md-4 offset-4' >"+
// 	    	"<div class='form-group'>"+
// 	    		"{{Form::number('specificRoom','',['class' =>'form-control tac','id' =>'specificRoomInput','min' => 1,'max' => $data['currentGeneralInfo']->totalRooms,'placeholder' => 'Specific Room'])}}"+
// 	    	"</div>"+
// 	    "</div>"+
//     "</div>" 
// 	);
// 	console.log("Click!");

// })

})


