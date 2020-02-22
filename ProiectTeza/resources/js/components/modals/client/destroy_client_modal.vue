<template>
  <div>
    <span>
        <div v-if="check_isButton('true')" v-on:click="checkForSafeDestroy" class="btn btn-danger float-right">
        <!-- <div v-if="check_isButton('true')" v-on:click="showAlert" class="btn btn-danger float-right"> -->
            <i v-bind:class="icon_type"></i>
        </div>
        
        <div v-if="check_isButton('false')" v-on:click="showAlert" class="float-right">
            <i v-bind:class="icon_type"></i>
        </div>
      </span>
  
    <b-modal :no-close-on-esc="true" ref="modal-destroy-client-conflicts" id="modal-destroy-client-conflicts" title="Delete Client" hide-footer>
      <b-form v-if="bookingsbyClient" @submit.prevent="onSubmit">
        <div class="mb-3">
          <div v-if="bookingsbyClient.length == 1">
            There is <b>{{bookingsbyClient.length}}</b> conflict for {{localclient.Last_Name}} {{localclient.First_Name}}
          </div>
          <div v-else-if="bookingsbyClient.length > 1">
            There are <b>{{bookingsbyClient.length}}</b> conflicts for {{localclient.Last_Name}} {{localclient.First_Name}}
          </div>
        </div>
        <hr>
        <div
        v-if="index <= 9"
        v-for="(booking, index) in bookingsbyClient"
        :key="booking.unique_bookingId"
        class="mb-2">
        <div class="row">
          <div class="col-md-9 d-flex align-items-center">
           <span> 
            Booking <b>{{booking.bookingId}}</b> in room <b>{{booking.roomId}}</b> is occupied by <b>{{localclient.First_Name}}</b></span>
            <!-- <span> {{index}}</span> -->
          </div>
          <div class="col-md-3 d-flex justify-content-around">
            <popper
            trigger="hover"
            :options="{
              placement: 'top',
              modifiers: { offset: { offset: '0,10px' } }
            }">
            <div class="popper">
             Delete this booking
            </div>
            <span v-on:click="deleteBooking(booking.bookingId)" class="btn btn-danger btn-sm" slot="reference">
              <i v-bind:class="icon_type"></i>
            </span>
          </popper>
          
          <popper
            trigger="hover"
            :options="{
              placement: 'top',
              modifiers: { offset: { offset: '0,10px' } }
            }">
            <div class="popper">
             <div>Change this booking</div>
             <div>(Still working on this)</div>
            </div>
            <span class="btn btn-warning btn-sm" slot="reference">
              <i class="fas fa-exchange-alt"></i>
            </span>
          </popper>
          
          </div>
        </div>
        </div>
          <hr v-if="(bookingsbyClient.length > 1)">
          <div class="row">
           <div v-if="((bookingsbyClient.length -10) > 0)" class="col-md-6 d-flex align-items-center">
             <div v-if="(bookingsbyClient.length - 10) == 1">
               <div>There is <b>{{bookingsbyClient.length - 10}}</b> more conflict!</div>
             </div>
             <div v-else-if="(bookingsbyClient.length - 10) > 1">
               <div>There are <b>{{bookingsbyClient.length - 10}}</b> more conflicts!</div>
             </div>
           </div>
           <div v-if="((bookingsbyClient.length -10) > 0)" class="col-md-6 d-flex align-items-center justify-content-end">
              <span class="mr-3 ">.. or delete them all </span>
              <span class="btn btn-danger" v-on:click="deleteBookings()">
                <i class="fas fa-trash-alt"></i>
              </span>
           </div>
           <div v-else-if="(bookingsbyClient.length > 1)" class="col-md-6 offset-6 d-flex align-items-center justify-content-end">
              <span class="mr-3 ">.. or delete them all </span>
              <span class="btn btn-danger" v-on:click="deleteBookings()">
                <i class="fas fa-trash-alt"></i>
              </span>
           </div> 
          </div>
      </b-form>
    </b-modal>
  </div>
</template>

<script>

import Vue from 'vue';
import {bus} from "../../../app"

import Popper from 'vue-popperjs';
import 'vue-popperjs/dist/vue-popper.css';

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

export default {
    components: {
      'popper': Popper
    },
    data() {
        return {
          usernameInput: 3,
          localclient: this.client,
          bookingsbyClient:null,
        };
    },
    props:{
      client:{
        type: Object ,
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
      checkForSafeDestroy(){
          axios.get('api/bookings/client/'+this.client.clientId)  
              .then(response => { 
                // If there are bookings for this client, you will have a modal appeared on screen, to work on them
                if(response.data.bookingsbyClient.length){
                  this.bookingsbyClient=response.data.bookingsbyClient;
                  this.$refs['modal-destroy-client-conflicts'].show();
                }
                else{
                  // If not, you will be able to delete the client
                  this.deleteClient(this.client);
                }
              })
      },

        deleteClient(client){   
          let self=this;

          Swal.fire({
            title: 'Are you sure you want to delete client  '+ client.First_Name+'?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
          }).then((result) => {
            if (result.value) {
              axios.delete('api/client/'+ client.clientId,)
              .then(response => { 
                if(response.data.status=="destroyed"){
                  console.log(response);
                  bus.$emit('clientDestroyed',{});
                  Toast_delete_this_customer.fire({
                    icon: 'success',
                    title: 'Client '+response.data.clientDestroyed.First_Name+' deleted successfully'
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

        deleteBooking(bookingId){   
          let self=this;

            Swal.fire({
              title: 'Are you sure you want to delete booking  '+ bookingId+'?',
              text: "You won't be able to revert this!",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
              if (result.value) {
                axios.get('bookings/'+ bookingId + '/destroy',)
                .then(response => { 
                  if(response.data.status=="destroyed"){
                  
                  axios.get('api/bookings/client/'+this.client.clientId)  
                  .then(response => { 
                      self.bookingsbyClient=response.data.bookingsbyClient;
                      console.log("self.bookingsbyClient: ",self.bookingsbyClient);
                      if(self.bookingsbyClient.length == 0){
                        this.$refs['modal-destroy-client-conflicts'].hide();
                        this.deleteClient(self.client);
                      }

                  });
                    bus.$emit('bookingDestroyed',{
                        'bookings':response.data.bookings,
                        'clients':response.data.clients,
                        'booking':response.data.booking,
                    });
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

         deleteBookings(client){   
            Swal.fire({
              title: 'Are you sure you want to delete all the bookings for '+ this.client.First_Name+'?',
              text: "You won't be able to revert this!",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
              if (result.value) {
                axios.delete('api/bookings/client/'+ this.client.clientId)
                .then(response => { 
                  
                  bus.$emit('bookingDestroyed');

                  if(response.data.status=="destroyed"){
                  console.log(response);
                    axios.get('api/bookings/client/'+this.client.clientId)  
                    .then(response => { 
                        self.bookingsbyClient=response.data.bookingsbyClient;
                        console.log("self.bookingsbyClient: ",self.bookingsbyClient);
                     

                        if(self.bookingsbyClient.length == 0){
                          this.$refs['modal-destroy-client-conflicts'].hide();

                          // bus.$emit('bookingDestroyed',{
                          // 'bookings':response.data.bookings,
                          // 'clients':response.data.clients,
                          // 'booking':response.data.booking,
                          // });

                          this.deleteClient(this.client);
                        }
                    });
                  }
                })
                  // axios.get('api/bookings/client/'+this.client.clientId)  
                  // .then(response => { 
                  //     self.bookingsbyClient=response.data.bookingsbyClient;
                  //     console.log("self.bookingsbyClient: ",self.bookingsbyClient);
                  //     if(self.bookingsbyClient.length == 0){
                  //       this.$refs['modal-destroy-client-conflicts'].hide();
                  //       this.deleteClient(self.client);
                  //     }

                  // });
                    // bus.$emit('bookingDestroyed',{
                    //     'bookings':response.data.bookings,
                    //     'clients':response.data.clients,
                    //     'booking':response.data.booking,
                    // });
                    //     Toast_delete_this_customer.fire({
                    //       icon: 'success',
                    //       title: 'Booking for '+response.data.client.First_Name+' deleted successfully'
                    //     })
              //     }
              //     else if(response.data.status=="failed"){
              //       console.log("There has been a problem: "+response.data.message);
              //     }
              //   })
              //   .catch(error => {
              //       console.log(error.response)
              //   });
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