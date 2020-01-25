<template>
      <!-- <a v-bind:href="'/bookings/' + booking_id + '/update/Canceled'"> -->
        <div style="display: inline-block">
          <i v-if="checkStatus('Accept')" v-on:click="showAlert" v-bind:id="status +'Anchor_' + booking_id" v-bind:class="'far fa-check-circle fa-lg pl-3 ' + status + 'Anchor'"    style="color:green"></i>
          <i v-if="checkStatus('Cancel')" v-on:click="showAlert" v-bind:id="status +'Anchor_' + booking_id" v-bind:class="'fas fa-ban fa-lg pr-3 ' + status + 'Anchor'"    style="color:tomato"></i>
          
        </div>

</template>

<script>

import Vue from 'vue';

export default {

    data() {
        return {};
    },
    props:{
      booking_id:{
        type: String ,
        default: "Error: No type Proped"
      },
      status:{
        type:String,
        default: "Error: No status Proped"
      },
      message:{
        type:String,
        default: "Error: No message Proped"
      },
      popuptype:{
        stype:String,
        default: "Error: No popupType Proped"
      }
    },
    methods: {
        showAlert(){          
          let self=this

            this.$swal.fire({
              // toast: true,
              // position: 'top-end',
              title: self.message,
              type:  self.popuptype,
              timer: 1000,
              showConfirmButton: false,
            }).then(function(){
                if (self.status=="Accept")window.location.href = "bookings/"+ self.booking_id + '/update/Booked';
                else window.location.href = "bookings/"+ self.booking_id + '/update/'+self.status+'ed';

            })
        },
        checkStatus(x){
          if(this.status == x) return true;
          else return false;
        },
    }
}
</script>