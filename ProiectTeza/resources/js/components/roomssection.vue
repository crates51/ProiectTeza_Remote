<template>
<div>
    <div v-if="existRooms(rooms)">
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
                            :room="room"
                            :rooms="rooms"
                            :filteredBookings="find('bookings',room)"
                            :clients="localclients"
                            :key="room.id"
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
    export default {
           data(){
              return {
               date : this.get_date(),
               localrooms: this.rooms,
               localbookings: this.bookings,
               localclients: this.clients
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
          bus.$on("dateUpdated",(data)=>{
            this.date = data;
          });
        },

        mounted(){
            bus.$on("bookingUpdated",(data)=>{
              this.localbookings=data.bookings;
              this.localclients=data.clients;
            }); 

          bus.$on("bookingDestroyed",(data)=>{
            this.localbookings = data.bookings;
            this.localclients = data.clients;
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
            existRooms(rooms){
                // If there are rooms return true
                if(rooms.length)return true;
                else return false;
            },    
            find(toFind,room){
               if(toFind=="bookings"){
                  var filteredBookings = this.localbookings.filter(function( obj ) {
                      return obj.roomId === room.roomId;
                  });
                
                if(filteredBookings.length==0)return false
                return filteredBookings;
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
