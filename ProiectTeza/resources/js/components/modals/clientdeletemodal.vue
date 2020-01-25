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
          let self=this;
          console.log("self.booking_id "+self.booking_id+" will be deleted");   

          const Toast_delete_this_customer = Swal.mixin({
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
              // title: 'Are you sure you want to delete ?',
              // text: "You won't be able to revert this!",
              title: 'This feature is still in development :(',
              // text: "This feature is still in development :(",
              icon: 'warning',
              showCancelButton: true,
              showConfirmButton: false,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
              if (result.value) {
                axios.get('bookings/'+ self.booking_id + '/destroy',)
                .then(response => { 
                  if(response.data.status=="destroyed"){
                    console.log("The booking has been destroyed from database");
                      bus.$emit('bookingDestroyed',{
                        'bookings':response.data.bookings,
                        'clients':response.data.clients,
                        'booking':response.data.booking,
                      });
                      console.log("response ",response);
                        // Swal.fire({
                        //   title: 'Booking Deleted',
                        //   icon: 'success',
                        //   showConfirmButton:false,
                        //   timer: 1500,
                        //   timerProgressBar: true,
                        // })
                        Toast_delete_this_customer.fire({
                          icon: 'success',
                          title: 'Booking for '+response.data.client.First_Name+' deleted successfully'
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