<template>
<div>
    <div v-if="rooms.length">
        <datepicker/>
        <div  v-for="(n, i) in totalfloors+1">
            <div class="row">
                <div class="col-md-4 offset-4 text-center mb-2">
                    <span v-if="groundfloor(i)" class="floorIdTitle">
                        Ground Floor
                    </span>
                    <span v-else class="floorIdTitle">
                        Floor {{i}}
                    </span>
                </div>
            </div>
            <div class="row">
                  <room_in_roomlist
                            v-for="room in localrooms" v-if="(room.floorId == i)"
                            :booking="find('booking',room)"
                            :room="room"
                            :rooms="rooms"
                            :client="find('client',room)"
                            :key="room.roomId+find('booking_unique_id',room)+find('booking_id',room)"
                    />
              </div>
            </div>
        </div>
    <div v-else>
        <div class="tac">
            <p class="h1">Momentan nu exista camere</p>
            <i class="far fa-frown fa-10x"></i>
        </div>
    </div>
</div>
</template>

<script>
import {bus} from "../app"
import Cookies from 'js-cookie'

    export default {
           data(){
              return {
               date : this.get_date(),
               localrooms: this.rooms,
               localbookings: null,
               localclients: null,
               test:null,
              }
          },
          props:{
            rooms:{
              type: Array ,
              default: "Error: No title Proped"
            },
            bookings:{
              type: Array ,
              default: "Error: No title Proped"
            },
            clients:{
              type: Array ,
              default: "Error: No title Proped"
            },
            totalfloors:{
              type: Number ,
              default: "Error: No title Proped"
            }
        },
        created(){
             axios.get('api/clients')  
              .then(response => { 
                this.localclients = response.data.clients;

                axios.get('api/bookings/date/'+this.date.replace(/\//g, '-'))  
                .then(response => { 
                  this.localbookings=response.data.bookingsbyDate;
                })
              })

          bus.$on("dateUpdated",(data)=>{
            this.date = data;
             axios.get('api/bookings/date/'+this.date.replace(/\//g, '-'))  
                .then(response => { 
                  this.localbookings=response.data.bookingsbyDate;
                })
          });
        },

        mounted(){
          Cookies.set('section', 'Rooms')
          
          bus.$on("bookingUploaded",(data)=>{
              axios.get('api/bookings/date/'+this.date.replace(/\//g, '-'))  
                .then(response => { 
                  this.localbookings=response.data.bookingsbyDate;
                })
              this.localclients=data.clients;
          }),

          bus.$on("bookingUpdated",(data)=>{
              axios.get('api/bookings/date/'+this.date.replace(/\//g, '-'))  
                .then(response => { 
                  this.localbookings=response.data.bookingsbyDate;
                })
              this.localclients=data.clients;
            }); 

          bus.$on("bookingDestroyed",(data)=>{
            if(Cookies.get('section')=="Rooms"){
              axios.get('api/bookings/date/'+this.date.replace(/\//g, '-'))  
                .then(response => { 
                  this.localbookings=response.data.bookingsbyDate;
                })
              // this.localclients = data.clients;
              axios.get('api/clients')  
              .then(response => { 
                this.localclients = response.data.clients;
              })
            }
          })
        },
        
        methods:{
            groundfloor(i){
                if(!i)return true
                else return false;
            },
            roomonfloor(roomfloorid,i){
                if(roomfloorid==i)return true
                else return false;
            },
            find(toFind,room){
              if(toFind=="booking_unique_id"){
                var localbooking = _.find(this.localbookings, function(booking){ return ((booking.roomId == room.roomId)); });
                if(localbooking){
                  return localbooking.unique_bookingId;
                }

                return 0;
               }
               else if(toFind=="booking_id"){
                var localbooking = _.find(this.localbookings, function(booking){ return ((booking.roomId == room.roomId)); });
                if(localbooking){
                  return localbooking.bookingId;
                }

                return 0;
               }
               else if(toFind=="booking"){
                var localbooking = _.find(this.localbookings, function(booking){ return ((booking.roomId == room.roomId)); });
                if (localbooking) return localbooking;
                else return false;
               }
               else if(toFind=="client"){
                var localbooking = _.find(this.localbookings, function(booking){ return ((booking.roomId == room.roomId)); });
                if(localbooking){
                  var localclient = _.find(this.localclients, function(client){
                   return ((localbooking.clientId == client.clientId));
                  });
                  if (localclient) return localclient;
                  else return false;  
                }
               }
            },
            get_date(){
              var today = new Date();
              var dd = String(today.getDate()).padStart(2, '0');
              var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
              var yyyy = today.getFullYear();
              today = dd + '/' + mm + '/' + yyyy;
              return today;
    },
        }
    }
</script>
