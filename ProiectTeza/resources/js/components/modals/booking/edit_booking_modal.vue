<template>
	<span>
		<b-button v-if="checkValue('isbutton',true)" class="btn btn-warning" v-b-modal="'modal-'+booking.bookingId">
			<i v-bind:class="icon_type"></i>
		</b-button>
		
		<i v-else v-bind:class="icon_type" v-on:click="reset" v-b-modal="'modal-'+booking.bookingId"></i>

		  <b-modal :no-close-on-esc="true" :ref="'my-modal-'+booking.bookingId" :id="'modal-'+booking.bookingId" title="Edit Booking" hide-footer>
			    <b-form @submit.prevent="onSubmit" @reset="onReset">
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
	        					<span v-if="!$v.form.phone.unique">
        						  This phone is not unique.
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
				    		@change="handleChange"
							:placeholder="['Check-in', 'Check-out']"
							format="DD/MM/YYYY"
	        				:value="form.interval"
				    	 />
					</div>
			    </div>	
				<div class="row">
					<div class="col-md-5 offset-1">
					    <b-form-group id="input-group-9" label="Status :" label-for="input-9">
		        			<b-form-select
	        				  id="input-9"
		        			  v-model.trim="$v.form.status.$model"
							  :class="{'is-invalid':$v.form.status.$error, 'is-valid':!$v.form.status.$invalid}"
	        				  :options="status"
	        				  required
	        				></b-form-select>
	        				<b-form-invalid-feedback>
	        					<span v-if="!$v.form.status.required">
        						  This is a required field.
	        					</span>
        					</b-form-invalid-feedback>
						</b-form-group>
					</div>
					<div class="col-md-5">
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
	        					<span v-if="!$v.form.specificRoom.numeric">
        						  Room nr. must be numeric only.
	        					</span>
	        					<span v-if="!$v.form.specificRoom.roomExist">
        						  This building has a total of {{localrooms.length}} rooms and starts from 1 
	        					</span>
	        					<span v-if="!$v.form.specificRoom.roomAvailable">
								  This room is not available for the specific dates
	        					</span>
        					</b-form-invalid-feedback>
						</b-form-group>
					</div>
				 </div>
				<div class="row">
					<div class="col-md-6 offset-3" style="text-align:center">
			      		<b-button type="submit" class="mr-2" variant="primary" :disabled="$v.form.$invalid">Submit</b-button>
			      		<b-button type="reset" variant="danger">Reset</b-button>
			   		</div>
			    </div>
		    </b-form>
	  </b-modal>
	</span>
</template>

<script>
import moment from 'moment'
import {bus} from "../../../app"

import { validationMixin } from 'vuelidate'
import { between, numeric, email, required, minLength, maxLength} from 'vuelidate/lib/validators'

export default {
	 mixins: [validationMixin],
	 data() {
      return {
      	localudpate: this.update,
        form: {
          email: this.client.Email,
          first_name: this.client.First_Name,
          last_name: this.client.Last_Name,
          phone: this.client.Phone,
          adults: this.booking.Adults,
          children: this.booking.Children,
          check_in: this.booking.Checkin,
          check_out: this.booking.Checkout,
          interval: [moment(this.booking.Checkin,"DD-MM-YYYY"), moment(this.booking.Checkout,"DD-MM-YYYY")],
          specificRoom: this.booking.roomId,
          status: this.booking.Status,
          bookingId:this.booking.bookingId
        },
        localrooms: this.rooms,
		status: ['During the stay', 'Booked', 'Finished', 'Pending', 'Canceled'],
        show: true
      }
    },
	props:{
            client:{
              type: [Object,Boolean] ,
              default: "Error: No title Proped"
            },
            booking:{
              type: [Object,Boolean] ,
              default: "Error: No title Proped"
            },
            rooms:{
              type: Array ,
              default: "Error: No title Proped"
            },
			isbutton:{
        		type:Boolean,
        		default: "Error: No status Proped"
      		},
      		icon_type:{
      		  type: String ,
      		  default: "Error: No title Proped"
      		},
    },
    created(){},
    mounted(){},
	 updated(){},
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
          unique(value) {
		        if (value === '') return true
		        return new Promise((resolve, reject) => {
		        	axios.put('bookings/check', {'clientId': this.client.clientId,
		        								 'phone': this.form.phone,
										   		 'toCheck':'uniquePhone'
										   	    })
					.then(response => { 
					    if(response.data.uniquePhone){
							this.unique = true
					    	resolve(true)
					    }
					    else {
							this.unique = false
					    	resolve(false)
					    }
					})
					.catch(error => {
					    console.log(error.response)
					});
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
		        	// axios.put('bookings/check/'+this.booking.bookingId, {'checkin':this.form.interval[0].format("DD/MM/YYYY"),
		        	axios.put('bookings/check', {'checkin':this.form.interval[0].format("DD/MM/YYYY"),
        												   'checkout':this.form.interval[1].format("DD/MM/YYYY"),
        												   'roomId':this.form.specificRoom,
        												   'bookingId':this.booking.bookingId,
        												   'toCheck':'uniqueInterval'
        													})
					.then(response => { 
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
      	status: {
			required
      	}
      }
    },
	methods:{
		reset(){
			// console.log("reset");
	      	// this.localupdate=false;
      		// console.log("this.client.First_Name: "+this.client.First_Name);
      		// console.log("this.form.first_name: "+this.form.first_name);
      		this.form.email = this.client.Email;
          	this.form.first_name = this.client.First_Name;
          	this.form.last_name = this.client.Last_Name;
          	this.form.phone = this.client.Phone;
          	// this.form.adults = this.booking.Adult;
          	// this.form.children = this.booking.Children;
          	// this.form.check_in = this.booking.Checkin;
          	// this.form.check_out = this.booking.Checkout;
		},
		onSubmit(evt) {
			evt.preventDefault()
			this.$v.form.$touch()
        	if (this.$v.form.$anyError) {
        	  // return this.$v.form.$anyError
        	}

			this.form.check_in=this.form.interval[0].format("DD/MM/YYYY");
			this.form.check_out=this.form.interval[1].format("DD/MM/YYYY");
		
			const Toast_edit_this_customer = Swal.mixin({
            	toast: true,
            	position: 'top-end',
            	showConfirmButton: false,
            	timer: 3000,
            	timerProgressBar: true,
            	onOpen: (toast) => {
            	  toast.addEventListener('mouseenter', Swal.stopTimer)
            	  toast.addEventListener('mouseleave', Swal.resumeTimer)
        		    },
    	    });

        	axios.put('bookings/'+this.booking.bookingId, this.form )
			.then(response => { 
				if(response.data.status=="updated"){
			        this.$refs['my-modal-'+this.booking.bookingId].hide();
				    bus.$emit('bookingUpdated',{'clients':response.data.clients,'bookings':response.data.bookings,'booking':response.data.booking,'client':response.data.client});


			      	Toast_edit_this_customer.fire({
                  	    icon: 'success',
                  	    title: 'Booking for '+ this.form.first_name +' edited successfully'
                  	  })
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
          	this.form.status = 'Select One'

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
	}
}
</script>

