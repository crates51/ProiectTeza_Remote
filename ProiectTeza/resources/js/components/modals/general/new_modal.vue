<template>
	<div>
		<div class="animatedContainer">
			<popper
		    :trigger="trigger"
		    :options="{
		      placement: 'top',
		      modifiers: { offset: { offset: '0,10px' } }
		    }">
		    <div class="popper">
		     Add Room
		    </div>
		    <i slot="reference" id="animatedButtonChild1" class="fas fa-key fa-2x title animatedButtonGroup"></i>
			</popper>

			<popper
		    :trigger="trigger"
		    :options="{
		      placement: 'top',
		      modifiers: { offset: { offset: '0,10px' } }
		    }">
		    <div class="popper">
		     Add Booking
		    </div>
		    <i v-b-modal="'modal-new-booking'" slot="reference" id="animatedButtonChild2" class="fas fa-address-book fa-2x title animatedButtonGroup"></i>
			</popper>

			<popper
		    :trigger="trigger"
		    :options="{
		      placement: 'left',
		      modifiers: { offset: { offset: '0,10px' } }
		    }">
		    <div class="popper">
		     Add Client
		    </div>
		    <i v-b-modal="'modal-new-client'" slot="reference" id="animatedButtonChild3" class="fas fa-user-plus fa-2x title animatedButtonGroup"></i>
			</popper>
		    <i id="animatedButtonParent" @click="animate()" class="fas fa-plus-circle fa-4x title animatedButtonGroup"></i>
		</div>	

		 <new_client_modal/>
		 <new_booking_modal/>

	</div>
</template>

<script>
import moment from 'moment'
import {bus} from "../../../app"

import Popper from 'vue-popperjs';
import 'vue-popperjs/dist/vue-popper.css';

export default {
	components: {
      'popper': Popper
    },
	 data() {
      return {
        buttonNr: 2,
        raza: 70,
        buttonX: 20,
        buttonY: 20,
		buttonBloomed:false,
      }
    },
	props:{
		trigger:{
        	type: String ,
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
	methods:{
		animate(){
			if(!this.buttonBloomed){
				$( "#animatedButtonChild1" ).css('opacity',0);
				$( "#animatedButtonChild1" ).css('display','block');
				$( "#animatedButtonChild1" ).animate({
	  			  opacity: 1,
	  			  bottom: this.buttonY+this.raza,
	  			}, 250, function() {
	  			});
	  			$( "#animatedButtonChild2" ).css('opacity',0);
				$( "#animatedButtonChild2" ).css('display','block');
				$( "#animatedButtonChild2" ).animate({
	  			  opacity: 1,
	  			  bottom: Math.sin(0.785398)*this.raza+this.buttonY,
	  			  right: Math.cos(0.785398)*this.raza+this.buttonX,
	  			}, 250);

	  			$( "#animatedButtonChild3" ).css('opacity',0);
				$( "#animatedButtonChild3" ).css('display','block');
				$( "#animatedButtonChild3" ).animate({
	  			  opacity: 1,
	  			  right: this.raza+this.buttonX,
	  			}, 250);
	  			this.buttonBloomed=true;
			}
			else{
				$( "#animatedButtonChild1" ).animate({
	  			  opacity: 0,
	  			  bottom: this.buttonY,
	  			}, 250);
				$( "#animatedButtonChild2" ).animate({
	  			  opacity: 0,
	  			  bottom: this.buttonY,
	  			  right: this.buttonX,
	  			}, 250);
				$( "#animatedButtonChild3" ).animate({
	  			  opacity: 0,
	  			  right: this.buttonX,
	  			}, 250);
	  			this.buttonBloomed=false;
			}
		},
	}
}
</script>

<style>
.animatedButtonGroup {
  position: fixed;
  z-index: 99;
  border: none;
  outline: none;
  cursor: pointer;
}
#animatedButtonParent {
  bottom: 20px;
  right: 20px;
}
#animatedButtonChild1 {
  bottom: 20px;
  right: 20px;
  display:none;
}
#animatedButtonChild2 {
  bottom: 20px;
  right: 20px;
  display:none;
}
#animatedButtonChild3 {
  bottom: 20px;
  right: 20px;
  display:none;
}
</style>