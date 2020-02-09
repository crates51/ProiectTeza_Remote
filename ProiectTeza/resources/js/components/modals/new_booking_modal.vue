<template>
	<div>
		<!-- <div class="row ">
			<div class="col-4 col-md-4 offset-4 mt-4 text-center mb-5">
				<div class="titleBackground">
					<a href="addclientModal" data-toggle="modal" data-target="#addclientModal" id="title">{{$data['title']}}</a>
					<a v-b-modal="'modal-new-booking'" class="title">NEW BOOKING</a>
				</div>
			</div>
		</div>

	    <div id="myBtn" class="titleBackground">
			<a class="title" v-b-modal="'modal-new-booking'">NEW BOOKING</a>
	    </div> -->

	    <i id="myBtn" v-b-modal="'modal-new-booking'" class="fas fa-plus-circle fa-4x title"></i>

		  <b-modal :no-close-on-esc="true" ref="modal-new-booking" id="modal-new-booking" title="New Booking" hide-footer>
			    <b-form  @submit.prevent="onSubmit" @reset="onReset">
			     <div class="row">
					<div class="col-md-5 offset-1">
					    <b-form-group id="input-group-1" label="Last Name:" label-for="input-1">
							<b-form-input
		        			  id="input-1"
							  v-model.trim="$v.form.last_name.$model"
							  :class="{'is-invalid':$v.form.last_name.$error, 'is-valid':!$v.form.last_name.$invalid}"
							  placeholder="Enter Last Name"
		        			></b-form-input>
		        			<b-form-invalid-feedback>
	        					<span v-if="!$v.form.last_name.required">
        						  This is a required field.
	        					</span>
	        					<span v-if="!$v.form.last_name.minLength">
        						  First Name must have at least {{$v.form.last_name.$params.minLength.min}} letters.
	        					</span>
	        					<span v-if="!$v.form.last_name.maxLength">
	        					  Hol' up cowboy!
        						  First Name must have at most {{$v.form.last_name.$params.maxLength.max}} letters.
	        					</span>
        					</b-form-invalid-feedback>
						</b-form-group>
					</div>
					<div class="col-md-5">
						<b-form-group id="input-group-2" label="First Name:" label-for="input-2">
							<b-form-input
		        			  id="input-2"
							  v-model.trim="$v.form.first_name.$model"
							  :class="{'is-invalid':$v.form.first_name.$error, 'is-valid':!$v.form.first_name.$invalid}"
		        			  placeholder="Enter First Name"
		        			></b-form-input>
		        			<b-form-invalid-feedback>
	        					<span v-if="!$v.form.first_name.required">
        						  This is a required field.
	        					</span>
	        					<span v-if="!$v.form.first_name.minLength">
        						  First Name must have at least {{$v.form.first_name.$params.minLength.min}} letters.
	        					</span>
	        					<span v-if="!$v.form.first_name.maxLength">
	        					  Hol' up cowboy!
        						  First Name must have at most {{$v.form.first_name.$params.maxLength.max}} letters.
	        					</span>
        					</b-form-invalid-feedback>
						</b-form-group>
					</div>
				 </div>
				 <div class="row">
					<div class="col-md-5 offset-1">
					    <b-form-group id="input-group-3" label="Email adress:" label-for="input-3">
							<b-form-input
		        			  id="input-3"
		        			  v-model.trim="$v.form.email.$model"
							  :class="{'is-invalid':$v.form.email.$error, 'is-valid':!$v.form.email.$invalid}"
		        			  placeholder="Enter email"
		        			></b-form-input>
		        			<b-form-invalid-feedback>
	        					<span v-if="!$v.form.email.required">
        						  This is a required field.
	        					</span>
	        					<span v-if="!$v.form.email.email">
								  This has to be a valid email
	        					</span>
        					</b-form-invalid-feedback>
						</b-form-group>
					</div>
					<div class="col-md-5">
						<b-form-group id="input-group-4" label="Phone:" label-for="input-4">
							<b-form-input
		        			  id="input-4"
							  v-model.trim="$v.form.phone.$model"
							  :class="{'is-invalid':$v.form.phone.$error, 'is-valid':!$v.form.phone.$invalid}"
		        			  placeholder="Enter Phone"
		        			  type="tel"
		        			></b-form-input>
		        			<b-form-invalid-feedback>
	        					<span v-if="!$v.form.phone.required">
        						  This is a required field.
	        					</span>
	        					<span v-if="!$v.form.phone.minLength">
        						  Phone nr. must have at least {{$v.form.phone.$params.minLength.min}} letters.
	        					</span>
	        					<span v-if="!$v.form.phone.maxLength">
	        					  Hol' up cowboy!
        						  Phone nr. must have at most {{$v.form.phone.$params.maxLength.max}} letters.
	        					</span>
	        					<span v-if="!$v.form.phone.numeric">
        						  Phone nr. must be numeric only.
	        					</span>
	        					<span v-if="!$v.form.phone.changed">
        						  Please change this number
	        					</span>
        					</b-form-invalid-feedback>
						</b-form-group>
					</div>
				 </div>
				 <div class="row">
					<div class="col-md-5 offset-1">
					    <b-form-group id="input-group-5" label="Adults:" label-for="input-5">
							<b-form-input
		        			  id="input-5"
							  v-model.trim="$v.form.adults.$model"
							  :class="{'is-invalid':$v.form.adults.$error, 'is-valid':!$v.form.adults.$invalid}"
		        			  placeholder="Enter adults nr."
		        			  type="number"
		        			></b-form-input>
		        			<b-form-invalid-feedback>
	        					<span v-if="!$v.form.adults.required">
        						  This is a required field.
	        					</span>
	        					<span v-if="!$v.form.adults.between">
									Adults nr must be between {{$v.form.adults.$params.between.min}} and {{$v.form.adults.$params.between.max}}

	        					</span>
	        					<span v-if="!$v.form.adults.numeric">
        						  Adults nr. must be numeric only.
	        					</span>
        					</b-form-invalid-feedback>
						</b-form-group>
					</div>
					<div class="col-md-5">
						<b-form-group id="input-group-6" label="Children:" label-for="input-6">
							<b-form-input
		        			  id="input-6"
		        			  v-model.trim="$v.form.children.$model"
							  :class="{'is-invalid':$v.form.children.$error, 'is-valid':!$v.form.children.$invalid}"
		        			  placeholder="Enter children nr."
		        			  type="number"
		        			></b-form-input>
		        			<b-form-invalid-feedback>
	        					<span v-if="!$v.form.children.required">
        						  This is a required field.
	        					</span>
	        					<span v-if="!$v.form.children.between">
									Children nr must be between {{$v.form.children.$params.between.min}} and {{$v.form.children.$params.between.max}}
	        					</span>
	        					<span v-if="!$v.form.children.numeric">
        						  Children nr. must be numeric only.
	        					</span>
        					</b-form-invalid-feedback>
						</b-form-group>
					</div>
				 </div>
				 <div class="row mb-2">
					<div class="col-md-5 offset-1">
						<span>Check-in:</span>
					</div>
					<div class="col-md-5 ">
						<span>Check-out:</span>
					</div>
				</div>
				 <div class="row mb-2">
					<div class="col-md-10 offset-1">
				    	<a-range-picker 
				    		id="input-7"
	        			    v-model.trim="$v.form.interval.$model"
						    :class="{'is-invalid':$v.form.interval.$error, 'is-valid':!$v.form.interval.$invalid}"
				    		@change="handleChange"
							:placeholder="['Check-in', 'Check-out']"
							format="DD/MM/YYYY"
	        				:value="form.interval"
				    	 />
					</div>
			    </div>	
				<div class="row">
					<div class="col-md-6 offset-3">
					    <b-form-group id="input-group-10" label="Room :" label-for="input-10">
							<b-form-input
		        			  id="input-10"
		        			  v-model.trim="$v.form.specificRoom.$model"
							  :class="{'is-invalid':$v.form.specificRoom.$error, 'is-valid':!$v.form.specificRoom.$invalid}"
		        			  type="number"
		        			  placeholder="Enter Room"
		        			></b-form-input>
		        			<b-form-invalid-feedback>
	        					<span v-if="!$v.form.specificRoom.required">
        						  This is a required field.
	        					</span>
	        					<span v-if="!$v.form.interval.required">
									There's no interval.
	        					</span>
	        					<span v-if="!$v.form.specificRoom.numeric">
        						  Room nr. must be numeric only.
	        					</span>
	        					<span v-if="!$v.form.specificRoom.roomExist">
        						  This building has a total of {{localrooms.length}} rooms and starts from 1.
	        					</span>
	        					<span v-if="!$v.form.specificRoom.roomAvailable">
								  This room is not available for the specific dates.
	        					</span>
        					</b-form-invalid-feedback>
						</b-form-group>
					</div>
				 </div>
				<div class="row">
					<div class="col-md-6 offset-3" style="text-align:center">
			      		<!-- <b-button type="submit" class="mr-2" variant="primary" :disabled="$v.form.$invalid">Submit</b-button> -->
			      		<b-button type="submit" class="mr-2" variant="primary" :disabled="$v.form.$invalid">Submit</b-button>
			      		<b-button type="reset" variant="danger">Reset</b-button>
			   		</div>
			    </div>
		    </b-form>
	  </b-modal>
	</div>
</template>

<script>
import moment from 'moment'
import {bus} from "../../app"

import { validationMixin } from 'vuelidate'
import { between, numeric, email, required, minLength, maxLength} from 'vuelidate/lib/validators'

export default {
	 data() {
      return {
        form: {
          email: '',
          first_name: '',
          last_name: '',
          phone: '',
          adults: '',
          children: '',
          check_in: '',
          check_out: '',
          interval: [,],
          specificRoom: '',
          // This one will be used for checing if the user has changed the number when we found a client for that number
	      phone_changed: true,
	      client_choosed: false,
        },
        localrooms: this.rooms,
        show: true,
      }
    },
	props:{
		isbutton:{
			type:Boolean,
			default: "Error: No status Proped"
			},
		icon_type:{
		  type: String ,
		  default: "Error: No title Proped"
		},
		rooms:{
        	type: Array ,
        	default: "Error: No title Proped"
        },
    },
    validations: {
      	form: {
	       	first_name: {
	          required,
	          minLength: minLength(3),
	          maxLength: maxLength(50)
	      	},
	        last_name: {
	          required,
	          minLength: minLength(3),
	          maxLength: maxLength(50)
	        },
	        email: {
	          required, 
	          email
	        },
	      	phone: {
            	required,
            	numeric,
            	minLength: minLength(3),
            	maxLength: maxLength(20),
			    changed(value) {
			        if (value === '') return true
			        return new Promise((resolve, reject) => {
				    	if(this.form.phone_changed){
				    		this.form.client_choosed=false;
							this.changed = true
				    		resolve(true)
				    	}
				    	else {
			            	this.form.phone_changed=true;
							this.changed = false
				    		resolve(false)
				    	}
			        })
		    	}
			},
	      	adults: {
				required,
				numeric,
				between: between(1, 250)
		      	},
	      	children: {
				required,
				numeric,
				between: between(0, 250)
	      	},
	      	interval: {
				required
	      	},
      		specificRoom: {
			required,
			numeric,
			roomExist(value) {
		        if (value === '') return true
		        return new Promise((resolve, reject) => {
		            resolve(value <= this.localrooms.length && value > 0)
		            // resolve(this.checkroom(value))
		        
		        })
		    },
		    roomAvailable(value) {
		        if (value === '') return true
		        return new Promise((resolve, reject) => {
		        	axios.put('bookings/check', {
		        	   	 'checkin':this.form.interval[0].format("DD/MM/YYYY"),
					   	 'checkout':this.form.interval[1].format("DD/MM/YYYY"),
					   	 'roomId':this.form.specificRoom,
					   	 'bookingId':false,
					   	 'toCheck':'uniqueInterval'
					})	
					.then(response => { 
						// console.log(response);
					    if(response.data.roomAvailable){
							this.roomAvailable = true
					    	resolve(true)
					    }
					    else {
							this.roomAvailable = false
					    	resolve(false)

					    }
					})
					.catch(error => {
					    console.log(error.response)
					});
		        })
		    }
      	},
  	   }
 	},
    created(){
    	// console.log(this.isbutton);
	},
    mounted(){
    	   // var mybutton = document.getElementById("myBtn");

        //   // When the user scrolls down 20px from the top of the document, show the button
        //   window.onscroll = function() {scrollFunction()};

        //   function scrollFunction() {
        //     if (document.body.scrollTop > 150 || document.documentElement.scrollTop > 150) {
        //       mybutton.style.display = "block";
        //     } else {
        //       mybutton.style.display = "none";
        //     }
        //   }
	},
	methods:{
		onSubmit(evt) {
			// evt.preventDefault()
		
			this.form.check_in=this.form.interval[0].format("DD/MM/YYYY");
			this.form.check_out=this.form.interval[1].format("DD/MM/YYYY");
			
			const Toast_add_this_customer = Swal.mixin({
			  toast: true,
			  position: 'top-end',
			  showConfirmButton: false,
			  timer: 3000,
			  timerProgressBar: true,
			  onOpen: (toast) => {
			    toast.addEventListener('mouseenter', Swal.stopTimer)
			    toast.addEventListener('mouseleave', Swal.resumeTimer)
			  }
			});

        	axios.post('bookings', this.form )
			.then(response => { 
				// console.log(response);
				if(response.data.status=="updated"){
					// console.log("The booking has been uploaded into database");
			        this.$refs['modal-new-booking'].hide()
				    bus.$emit('bookingUploaded',{
				    	'bookings':response.data.bookings,
				    	'clients':response.data.clients,
				    	'booking':response.data.booking,
				    	'client':response.data.client
				    });
				    this.form.specificRoom="";

				    Toast_add_this_customer.fire({
					  icon: 'success',
					  title: 'Booking for '+response.data.client.First_Name+' added successfully'
				  	})

				}
				else if(response.data.status=="alreadyExists"){
        			if(!this.form.client_choosed)this.showAlert(response.data.clientFound);
				}
				else if(response.data.status=="failed"){
					console.log("There has been a problem: "+response.data.message);
				}
			})
			.catch(error => {
			    console.log(error.response)
			});
      	},
      	onReset(evt) {
        	evt.preventDefault()
        	// Reset our form values
        	this.form.email = ''
          	this.form.first_name = ''
          	this.form.last_name = ''
          	this.form.phone = ''
          	this.form.adults = ''
          	this.form.children = ''
          	this.form.check_in = ''
          	this.form.check_out = ''
          	this.form.specificRoom = ''
          	// this.form.status = 'Select One'

        	// Trick to reset/clear native browser form validation state
        	this.show = false
        	this.$nextTick(() => {
        	  this.show = true
        	})
      	},
      	handleChange(value) {
          this.form.interval=value;
	    },
    	checkValue(type,value){
            if(type=="isbutton"){
                if (this.isbutton==value)return true
             }
        },
        showAlert(clientFound){    
          // console.log("in show alert "+clientFound);      
          let self=this

          const Toast_this_customer = Swal.mixin({
			  toast: true,
			  position: 'top-end',
			  showConfirmButton: false,
			  timer: 3000,
			  timerProgressBar: true,
			  onOpen: (toast) => {
			    toast.addEventListener('mouseenter', Swal.stopTimer)
			    toast.addEventListener('mouseleave', Swal.resumeTimer)
			  }
			});
            Swal.fire({
              title: 'We found a customer for this phone',
              html:clientFound.Last_Name+" "+clientFound.First_Name+"<br>"+	
              "<i class='fas fa-envelope mr-2'></i>"+clientFound.Email+"<br>"+
              "<i class='fas fa-phone mr-2'></i>"+clientFound.Phone,
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#f28526',
              confirmButtonText: 
              'Use this customer',
              cancelButtonText:
              'Change phone',
              allowOutsideClick:false,
            }).then((result) => {
	            if (result.value) {
	            	self.form.client_choosed=true;
          			self.form.last_name=clientFound.Last_Name;
          			self.form.first_name=clientFound.First_Name;
          			self.form.email=clientFound.Email;
	              	Toast_this_customer.fire({
					  icon: 'success',
					  title: 'This client will be used for the booking'
				  	})
	              	.then(function(){});
	            }
	            else if(result.dismiss="cancel"){
	            	self.form.phone_changed=false;
					Toast_this_customer.fire({
					  icon: 'warning',
					  title: 'Change the phone number, please'
				  	})
	             	.then(function() {
	              	});
	            }
            })
        },
	}
}
</script>

<style>
#myBtn {
  position: fixed;
  bottom: 20px;
  right: 20px;
  z-index: 99;
  border: none;
  outline: none;
  cursor: pointer;
}
</style>