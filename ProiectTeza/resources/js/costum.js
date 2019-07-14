$(document).ready(function(){

	// var popupCancel = $(".cancelTooltip");
	var refCancel = $(".CancelAnchor");
	
	// var popupAccept = $("#acceptTooltip");
	var refAccept = $(".AcceptAnchor");
	$("#autoLaunch").trigger('click');
	  $(window).on('load',function(){
        $('#prepareRoomsModal').modal('show');
      });
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

//Sending data from anchor to the modal itself


	$(".openEditModal").on('click', function(e) {
		$('#editclientModal').modal('toggle', $(this));
	});


	function formatDate(date) {
	    var d = new Date(date),
	        month = '' + (d.getMonth() + 1),
	        day = '' + d.getDate(),
	        year = d.getFullYear();
	
	    if (month.length < 2) month = '0' + month;
	    if (day.length < 2) day = '0' + day;
	
	    return [day, month, year].join('/');
	}

	$('#editclientModal').on('shown.bs.modal', function(event) {
    var link     = $(event.relatedTarget),
        modal    = $(this),
        booking    = link.data("booking"),
        client    = link.data("client");

        // alert(booking.Status);
        // alert(client.Last_Name);
        $(".modal-body #formContainer").attr("action","http://casajasmin.ro/bookings/"+booking.bookingId);
        // alert($(".modal-body #formContainer").attr("action"));

        // $(".modal-body #editEmail_input").val(client.Email);

        var checkin = booking.Checkin.replace(/-/g, "/");
        var checkout = booking.Checkout.replace(/-/g, "/");

		var strtotime = require('locutus/php/datetime/strtotime');


        $(".modal-body #editFirstName_Form").val(client.First_Name);
		$(".modal-body #editLastName_Form").val(client.Last_Name);
        $(".modal-body #editEmail_input").val(client.Email)
		$(".modal-body #editPhone_input").val(client.Phone);
		$(".modal-body #editAdults_input").val(booking.Adults);
		$(".modal-body #editTotalRooms_input").val(booking.totalRooms);
		$(".modal-body #editChildren_input").val(booking.Children);
		$(".modal-body #editCheckIn_input").val(formatDate(checkin));
		$(".modal-body #editCheckOut_input").val(formatDate(checkout));
		$(".modal-body #editStatus_input").val(booking.Status);
        // alert($(".modal-body #editEmailinput").val());

	// console.log("ad");
    // modal.find("#email").val(email);
    // modal.find("#username").val(username);
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

function sayingHello(){
	alert("hello");
}
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


