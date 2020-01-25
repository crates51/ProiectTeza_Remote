<template>
	<div>
    <!-- 
     :key="booking.bookingdId" is necessarry for refresh, don't change it, unless with a better option
     -->
	   <booking_in_bookingslist
	   v-for="booking in localbookings"
     :is_auth="is_auth"
     :rooms="rooms"
     :key="booking.unique_bookingId+booking.created_at"
     v-if="tell(booking)"
     :booking="booking"
     :client ="findClient(booking)"
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
            console.log("this.localbookings: ",this.localbookings);
            
          })
        },

        methods:{
          findClient(booking){
            console.log("findClient booking: ",booking);
            return this.localclients.find(client => client.clientId == booking.clientId);
          },
          tell(booking){
            console.log("v-if booking: ",booking);
            return true;
          },
        }
    }
</script>
