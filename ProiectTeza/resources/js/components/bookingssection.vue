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
import Cookies from 'js-cookie'

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
          //       this.localclients = this.clients;
          //     })
            
            axios.get('api/bookings')  
              .then(response => { 
                this.localbookingssize = response.data.bookings.length;
              })
        },

        mounted(){
          // console.log("Bookings section");
          Cookies.set('section', 'Bookings')

          bus.$on("bookingUploaded",(data)=>{
            axios.get('api/clients')  
              .then(response => { 
                this.localclients = response.data.clients;
              })

              axios.get('api/bookings')  
              .then(response => { 
                // It will send you to the correct page
                this.localbookingssize = response.data.bookings.length;
                if(((this.localbookingssize/5)*10)%10)this.currentPage=Math.floor(this.localbookingssize/5)+1;
                else this.currentPage=Math.floor(this.localbookingssize/5);

                axios.get('api/bookings/page/'+this.currentPage, {})  
                .then(response => { 
                  this.localbookings = response.data.bookingsbyPage;
                  this.$nextTick(() => {  
                       if($("#boookingCard_"+data.booking.bookingId).html()){
                        $('html, body').animate({
                           scrollTop: $("#boookingCard_"+data.booking.bookingId).offset().top
                       }, 2000,function(){
                        var div = $("#boookingCard_"+data.booking.bookingId+" .card.bookingList");
                            div.animate({borderWidth: '20px'}, "800",function(){
                             div.delay(800).animate({borderWidth: '1px'}, "800");
                            });
                       });
                      }
                  })
                })
              })
          }),

          bus.$on("bookingDestroyed",(data)=>{
            // console.log("You are in "+Cookies.get('section')+" section");
             // => 'value'
            if(Cookies.get('section')=="Bookings"){
              // console.log("Deleting from bookings section");
              axios.get('api/bookings/page/'+this.currentPage, {})  
              .then(response => {
                // this.$delete(this.localbookings,3 )
                this.localbookings = response.data.bookingsbyPage;
                // Improvizatie naspa pentru a da refresh la componente
                // Practic schimva key la fiecare compoenta cu ceva foarte random
                if(this.localbookings[0])this.localbookings[0].unique_bookingId = response.data.bookingsbyPage[0].unique_bookingId+Math.random()* 100;
                if(this.localbookings[1])this.localbookings[1].unique_bookingId = response.data.bookingsbyPage[1].unique_bookingId+Math.random()* 100;
                if(this.localbookings[2])this.localbookings[2].unique_bookingId = response.data.bookingsbyPage[2].unique_bookingId+Math.random()* 100;
                if(this.localbookings[3])this.localbookings[3].unique_bookingId = response.data.bookingsbyPage[3].unique_bookingId+Math.random()* 100;
                // this.localbookingssize = data.bookings.length;
              })

              axios.get('api/bookings')  
              .then(response => { 
                this.localbookingssize = response.data.bookings.length;
                // this.localbookings = response.data.bookings;
              });
              
              axios.get('api/clients')  
              .then(response => { 
                this.localclients = response.data.clients;
              })

            // this.localbookings = data.bookings;
            // this.localclients = data.clients;
            }
          })
        },

        methods:{
      

          findClient(booking){
            return this.localclients.find(client => client.clientId == booking.clientId);
          },

          onChange(value, dateString) {
              axios.get('api/clients')  
              .then(response => { 
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

