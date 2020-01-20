<template>
	<div>
    <!-- 
     :key="booking.bookingdId" is necessarry for refresh, don't change it, unless with a better option
     -->
	   <booking_in_bookingslist
	   v-for="booking in localbookings"
     :booking="booking"
     :client ="findClient(booking)"
     :is_auth="is_auth"
     :rooms="rooms"
     :key="booking.bookingdId"
	   />
  </div>
</template>

<script>
import {bus} from "../app"

    export default {
    	 data(){
        return{
          localbookings: this.bookings,
          localclients: this.clients
        }
       },

       props:{
            clients:{
              type: Array ,
              default: "Error: No title Proped"
            },
            bookings:{
              type: Array ,
              default: "Error: No title Proped"
            },
            rooms:{
              type: Array ,
              default: "Error: No title Proped"
            },
            is_auth:{
              type: Number ,
              default: "Error: No title Proped"
            }
        },

        mounted(){
          bus.$on("bookingUploaded",(data)=>{
            this.localbookings = data.bookings;
            this.localclients = data.clients;
          }),

          bus.$on("bookingDestroyed",(data)=>{
            this.localbookings = data.bookings;
            this.localclients = data.clients;
          })
        },

        methods:{
          findClient(booking){
            return this.localclients.find(client => client.clientId == booking.clientId);
          },
        }
    }
</script>
