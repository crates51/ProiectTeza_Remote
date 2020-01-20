<template>
  <span>
    <div v-if="check_isButton('true')" v-on:click="showAlert" class="btn btn-danger float-right">
        <i v-bind:class="icon_type"></i>
    </div>
    
    <div v-if="check_isButton('false')" v-on:click="showAlert" class="float-right">
        <i v-bind:class="icon_type"></i>
    </div>
  </span>
</template>

<script>

import Vue from 'vue';
import {bus} from "../../app"

export default {

    data() {
        return {
          usernameInput: 3,
        };
    },
    props:{
      booking_id:{
        type: Number ,
        default: "Error: No title Proped"
      },
      icon_type:{
        type: String ,
        default: "Error: No title Proped"
      },
      isbutton:{
        type:String,
        default: "Error: No status Proped"
      },
    },
    methods: {
        showAlert(){          
          let self=this
            Swal.fire({
              title: 'Are you sure you want to delete ?',
              text: "You won't be able to revert this!",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
              if (result.value) {
                axios.get('bookings/'+ self.booking_id + '/destroy',{'test':true})
                .then(response => { 
                  if(response.data.status=="destroyed"){
                    console.log("The booking has been destroyed from database");
                      bus.$emit('bookingDestroyed',{
                        'bookings':response.data.bookings,
                        'clients':response.data.clients,
                        'booking':response.data.booking,
                      });
                        Swal.fire({
                          title: 'Booking Deleted',
                          icon: 'success',
                          showConfirmButton:false,
                          timer: 1500,
                          timerProgressBar: true,
                        })
                  }
                  else if(response.data.status=="failed"){
                    console.log("There has been a problem: "+response.data.message);
                  }
                })
                .catch(error => {
                    console.log(error.response)
                });
              }
            })
        },
        check_isButton(x){
          if(this.isbutton == x) return true;
          else return false;
        }
    }
}
</script>