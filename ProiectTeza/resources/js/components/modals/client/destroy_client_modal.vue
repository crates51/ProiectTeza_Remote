<template>
  <span>
    <!-- <span> -->
        <b-button type="button" v-if="check_isButton('true')" v-on:click="checkForSafeDestroy" class="btn btn-danger float-right">
            <i v-bind:class="icon_type"></i>
        </b-button>
        
        <!-- <i v-if="check_isButton('false')" v-on:click="showAlert" v-bind:class="icon_type"></i> -->
    <!-- </span> -->
    
    <!-- <b-btn v-b-modal="'modal1-test-'+client.clientId">Modal 1</b-btn> -->
<!-- 
     <b-modal :id="'modal1-test-'+client.clientId" hide-backdrop title="Modal 1">
      <p class="my-4">Test</p>
    </b-modal> -->

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
            trigger="clickToOpen"
            :options="{
              placement: 'right',
              modifiers: { offset: { offset: '0,10px' } }
            }">
            <div class="popper TransferBookingDiv">
             <div class="mb-2 overflow-auto">Transfer booking to..</div>
             <div class="mb-1 client_to_transfer_to"
             v-on:click="transferbooking(booking, client)" 
             v-for="(client, index) in localclients">
               <span>{{index+1}}.{{client.First_Name}} {{client.Last_Name}}</span>
             </div>
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
  </span>
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
          localclients: this.clients,
          bookingsbyClient:null,
        };
    },
    props:{
      client:{
        type: Object ,
        default: "Error: No title Proped"
      },
      clients:{
        type: Array ,
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
    mounted(){
      // console.log("localclients: ",this.localclients);
       bus.$on("clientUploaded",(data)=>{
            axios.get('api/clients')  
              .then(response => { 
                this.localclients = response.data.clients;
              })
          })
         bus.$on("clientDestroyed",(data)=>{
            axios.get('api/clients')  
              .then(response => { 
                this.localclients = response.data.clients;
              })
          })
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
                  bus.$emit('clientDestroyed',{});
                  Toast_delete_this_customer.fire({
                    icon: 'success',
                    title: 'Client '+response.data.clientDestroyed.First_Name+' deleted successfully'
                  })
                }
                else if(response.data.status=="failed"){
                }
              })
              .catch(error => {
                  console.log(error.response)
              });
            }
          })
        },

        //Transfer a booking to a new client 
        transferbooking(booking,newClient){
           Swal.fire({
              title: 'Are you sure you want to transfer booking '+ booking.bookingId+' to '+newClient.First_Name+'?',
              text: 'This booking is now owned by '+this.localclient.Last_Name+" "+this.localclient.First_Name,
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes, transfer it!'
            }).then((result) => {
              if (result.value) {
                axios.put('bookings/'+booking.bookingId,{ 
                    "email": this.localclient.Email,
                    "first_name": this.localclient.First_Name,
                    "last_name": this.localclient.Last_Name,
                    "phone": this.localclient.Phone,
                    "adults": booking.Adults,
                    "children": booking.Children,
                    "check_in": booking.Checkin,
                    "check_out": booking.Checkout,
                    "specificRoom": booking.roomId,
                    "status": booking.Status,
                    "bookingId":booking.bookingId,
                    "clientId": newClient.clientId,
                  })
                .then(response => { 
                  Toast_delete_this_customer.fire({
                    icon: 'success',
                    title: 'Booking '+booking.bookingId+' transfered successfully'
                  })

                  bus.$emit('bookingUpdated',{'clients':response.data.clients,
                                              'bookings':response.data.bookings,
                                              'booking':response.data.booking,
                                              'client':response.data.client
                                              });

                  axios.get('api/bookings/client/'+this.client.clientId)  
                  .then(response => { 
                      this.bookingsbyClient=response.data.bookingsbyClient;
                      // console.log("response.data.bookingsbyClient: ",response.data.bookingsbyClient);
                      if(this.bookingsbyClient.length == 0){
                        // console.log("There are no more booking")
                        this.$refs['modal-destroy-client-conflicts'].hide();
                        this.deleteClient(this.client);
                      }
                       // bus.$emit('bookingUpdated');

                  });
                })
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
                      // console.log("self.bookingsbyClient: ",self.bookingsbyClient);
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
              confirmButtonText: 'Yes, delete them all!'
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

<style>
    .TransferBookingDiv{
        width:170px;
        max-height:165px;
        border-radius: 0.25rem;
        overflow-y:scroll;
        text-align: left;
        }
    .TransferBookingDiv > .client_to_transfer_to{
        cursor: pointer;
        -o-transition: .5s;
        -ms-transition: .5s;
        -moz-transition: .5s;
        -webkit-transition: .5s;
        transition: .5s
    }

    .TransferBookingDiv > .client_to_transfer_to:hover{
        color: #ca9905;
        -o-transition: .5s;
        -ms-transition: .5s;
        -moz-transition: .5s;
        -webkit-transition: .5s;
        transition: .5s;
    }
</style>