<template>
	<span>
		<b-button v-if="checkValue('isbutton',true)" class="btn btn-warning" v-b-modal="'modal-room-'+room.roomId">
			<i v-bind:class="icon_type"></i>
		</b-button>
		
		<i v-else v-bind:class="icon_type" v-b-modal="'modal-room-'+room.roomId"></i>

		  <b-modal :ref="'my-modal-room-'+room.roomId" :id="'modal-room-'+room.roomId" :title="'Edit Room '+room.roomId" hide-footer>
			    <b-form  @submit.prevent="onSubmit" @reset="onReset">
			     <div class="row">
					<div class="col-md-5 offset-1">
					    <b-form-group id="input-group-1" label="Floor id:" label-for="input-1">
							<b-form-input
		        			  id="input-1"
		        			  v-model="form.floorId"
		        			  type="number"
		        			  required
							  placeholder="Enter Floor Id"
		        			></b-form-input>
						</b-form-group>
					</div>
					<div class="col-md-5">
						<b-form-group id="input-group-2" label="Number of Beds:" label-for="input-2">
							<b-form-input
		        			  id="input-2"
		        			  v-model="form.nrOfBeds"
		        			  required
		        			  type="number"
		        			  placeholder="Enter the number of beds"
		        			></b-form-input>
						</b-form-group>
					</div>
				 </div>

				 <div class="row">
					<div class="col-md-5 offset-1">
					    <b-form-group id="input-group-3" label="Sea Sight:" label-for="input-3">
          						<b-form-checkbox 
			        			id="input-3"
          						v-model="form.seaSight"
          						required
          						value='1'>Sea sight
          						</b-form-checkbox>
						</b-form-group>
					</div>
				 </div>
				<div class="row">
					<div class="col-md-6 offset-3" style="text-align:center">
			      		<b-button type="submit" class="mr-2" variant="primary">Submit</b-button>
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

export default {
	 data() {
      return {
        form: {
          floorId: this.room.floorId,
          nrOfBeds: this.room.nrOfBeds,
          seaSight: this.room.seaSight,
          roomId:this.room.roomId
        },
        show: true
      }
    },
	props:{
            room:{
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
    created(){
    	// console.log(this.isbutton);
	},
    mounted(){
	},
	methods:{
		onSubmit(evt) {
			evt.preventDefault()
        	axios.put('rooms/'+this.room.roomId, this.form )
			.then(response => { 
				if(response.data.status=="updated"){
					console.log("The data has been updated in the database, for the roomd: "+this.room.roomId);
			        this.$refs['my-modal-room-'+this.room.roomId].hide();
				    bus.$emit('roomUpdated',this.form);
				}
				else if(response.data.status=="failed"){
					console.log("There has been a problem !");
				}
			})
			.catch(error => {
			    console.log(error.response)
			});
      	},
      	onReset(evt) {
        	evt.preventDefault()
        	// Reset our form values
        	this.form.floorId = 0,
          	this.form.nrOfBeds = 0,
          	this.form.seaSight = 0,

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
        }
	}
}
</script>

