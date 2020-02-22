<template>
	<div>
<!-- Aici nu voi mai face lista de componente.. cred ca e mai eficiente asa -->
    <div
    v-for="client in localclients"
    :key="client.First_Name+client.Last_Name+client.Email+client.Phone"
    >
    <div  class="card pt-2 pb-2 pr-2 pl-2 mb-3 bookingList">
      <div class="row">
        <div class="col-md-1 clientId my-auto" style="text-align:center">
          <span>{{client.clientId}}</span>
        </div>
        <div class="col-md-3">
          <div class="row">
            Full Name: {{client.First_Name}} {{client.Last_Name}}
          </div>
          <div class="row">
            Email: {{client.Email}}
          </div>
          <div class="row">
            Phone: {{client.Phone}}
          </div>
        </div>
        <div class="col-md-6">
          <!-- Column for other infos -->
          <!-- Total Bookings: {{totalBookings(client.clientId)}} -->
        </div>
        <div class="col-md-2 align-self-center">
          <!-- Column for buttons -->
          <edit_client_modal 
            :client ="client"
            :isbutton ="true"
            icon_type="fas fa-pencil-alt"
          />
          <destroy_client_modal 
          isbutton="true" 
          icon_type="fa fa-trash" 
          :client="client"
          />

        </div>
      </div>
    </div>
    </div>
  </div>
</template>

<script>
import {bus} from "../app"
import Cookies from 'js-cookie'

    export default {
    	 data(){
        return{
          localclients: null,
          localbookings: null          
        }
       },

       props:{
       },

        created(){
          axios.get('api/clients')  
              .then(response => { 
                this.localclients = response.data.clients;
              })

          axios.get('api/bookings')  
            .then(response => { 
                this.localbookings = response.data.bookings;
              })
        },

        mounted(){
           bus.$on("bookingUploaded",(data)=>{
            axios.get('api/clients')  
              .then(response => { 
                this.localclients = response.data.clients;
            })
          })

          bus.$on("clientUpdated",(data)=>{
            axios.get('api/clients')  
              .then(response => { 
                this.localclients = response.data.clients;
              })
          })

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

        updated(){
        },

        methods:{
          totalBookings(clientId){
            var bookingsforClient=0;
            if(this.localbookings){
             for(var i=0;i<this.localbookings.length;i++){
               if(this.localbookings[i].clientId == clientId){
                bookingsforClient++;               
               }
             }
             return bookingsforClient;
            }
          },
        },
    }
</script>

