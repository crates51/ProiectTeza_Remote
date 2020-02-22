<template>
	<div>
	<b-modal :no-close-on-esc="true" ref="modal-new-client" id="modal-new-client" title="New Client" hide-footer>
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
			<div class="col-md-6 offset-3" style="text-align:center">
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
import {bus} from "../../../app"

import { validationMixin } from 'vuelidate'
import { between, numeric, email, required, minLength, maxLength} from 'vuelidate/lib/validators'

export default {
	components: {
      'popper': Popper
    },
	 data() {
      return {
        form: {
          email: '',
          first_name: '',
          last_name: '',
          phone: '',
          // This one will be used for checing if the user has changed the number when we found a client for that number
	      phone_changed: true,
	      client_choosed: false,
        },
		show: true,
      }
    },
	props:{},
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
			}
  	   }
 	},
    created(){},
    mounted(){},
	methods:{
		onSubmit(evt) {
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

        	axios.post('api/client', this.form )
			.then(response => { 
				// console.log(response);
				if(response.data.status=="uploaded"){
					// console.log("The booking has been uploaded into database");
			        this.$refs['modal-new-client'].hide()
				    bus.$emit('clientUploaded',{
				    	// 'bookings':response.data.bookings,
				    	// 'clients':response.data.clients,
				    	// 'booking':response.data.booking,
				    	// 'client':response.data.client
				    });
				    Toast_add_this_customer.fire({
					  icon: 'success',
					  title: 'Client '+response.data.client.First_Name+' added successfully'
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

        	// Trick to reset/clear native browser form validation state
        	this.show = false
        	this.$nextTick(() => {
        	  this.show = true
        	})
      	},
      	handleChange(value) {
          this.form.interval=value;
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
              'Change phone',
              cancelButtonText:
              'Cancel',
              allowOutsideClick:false,
            }).then((result) => {
	            if (result.value) {
	            	self.form.phone_changed=false;
					Toast_this_customer.fire({
					  icon: 'warning',
					  title: 'Change the phone number, please'
				  	})
	            }
            })
        },
	}
}
</script>

<style>
</style>