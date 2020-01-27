<template>
	<div>
    <!-- 
     :key="booking.bookingdId" is necessarry for refresh, don't change it, unless with a better option
     -->
	   <booking_in_bookingslist
	   v-for="booking in localbookings"
     :is_auth="is_auth"
     :rooms="rooms"
     :id="'boookingCard_'+booking.bookingId"
     :key="booking.unique_bookingId"
     :booking="booking"
     :client ="findClient(booking)"
	   />
      <a-pagination v-model="currentPage" :hideOnSinglePage="true" style="text-align:center" :defaultPageSize="5" @change="onChange" :total="localbookingssize" />
  <!-- {{localbookings.length}} -->
  </div>
</template>

<script>
import {bus} from "../app"

    export default {
    	 data(){
        return{
          localbookings: null,
          localclients: null,
          currentPage: 1,
          localbookingssize: null
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

        created(){
          this.localclients=this.clients;

          axios.get('api/bookings/page/1')  
              .then(response => { 
                this.localbookings = response.data.bookingsbyPage;
              })

          // axios.get('api/clients')  
          //     .then(response => { 
          //       console.log(response.data.clients);
          //       console.log("this.clients: ",this.clients);
          //       this.localclients = this.clients;
          //     })
            
            axios.get('api/bookings')  
              .then(response => { 
                this.localbookingssize = response.data.bookings.length;
                // console.log(this.localbookingssize);
              })
        },

        mounted(){
          bus.$on("bookingUploaded",(data)=>{
            axios.get('api/clients')  
              .then(response => { 
                this.localclients = response.data.clients;
              })

              axios.get('api/bookings')  
              .then(response => { 
                this.localbookingssize = response.data.bookings.length;
                if(((this.localbookingssize/5)*10)%10)this.currentPage=Math.floor(this.localbookingssize/5)+1;
                else this.currentPage=Math.floor(this.localbookingssize/5);

                axios.get('api/bookings/page/'+this.currentPage, {})  
                .then(response => { 
                  this.localbookings = response.data.bookingsbyPage;
                })
              })
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

          onChange(value, dateString) {
              axios.get('api/clients')  
              .then(response => { 
                // console.log("response: ",response.data.clients);
                this.localclients = response.data.clients;
              })
              
              axios.get('api/bookings/page/'+value, {})  
              .then(response => { 
                this.localbookings = response.data.bookingsbyPage;
              })

          }
        },
    }
</script>
