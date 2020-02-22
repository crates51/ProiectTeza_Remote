<template>
	<span>
		<b-button v-if="this.isbutton == true" class="btn btn-warning" v-b-modal="'modal-'+client.clientId">
			<i v-bind:class="icon_type"></i>
		</b-button>
		
		<i v-else v-bind:class="icon_type" v-on:click="reset" v-b-modal="'modal-'+client.clientId"></i>

		  <b-modal :no-close-on-esc="true" :ref="'my-modal-client-'+client.clientId" :id="'modal-'+client.clientId" title="Edit Client" hide-footer>
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
        form: {
          email: this.client.Email,
          first_name: this.client.First_Name,
          last_name: this.client.Last_Name,
          phone: this.client.Phone,
        },
        localclient: this.client,
        localrooms: this.rooms,
        show: true
      }
    },
	props:{
            client:{
              type: [Object,Boolean] ,
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
      }
    },
	methods:{
		reset(){
      		// this.form.email = this.client.Email;
          	// this.form.first_name = this.client.First_Name;
          	// this.form.last_name = this.client.Last_Name;
          	// this.form.phone = this.client.Phone;
		},
		onSubmit(evt) {
			evt.preventDefault()
			this.$v.form.$touch()
        	if (this.$v.form.$anyError) {
        	  // return this.$v.form.$anyError
        	}
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

        	axios.put('api/client/'+this.localclient.clientId, this.form )
			.then(response => { 
				// console.log("response: ",response);
				if(response.data.status=="updated"){
			        this.$refs['my-modal-client-'+this.client.clientId].hide();
				    bus.$emit('clientUpdated',{'clientId':this.localclient.clientId});
			      	Toast_edit_this_customer.fire({
                  	    icon: 'success',
                  	    title: 'Client '+ this.form.first_name +' edited successfully'
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

