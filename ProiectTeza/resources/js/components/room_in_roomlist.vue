<template>
  <div :id="'card_'+localroom.roomId" class="card col-md-4 py-3 mb-5 roomsList">
    <div class="row">
      <div class="col-md-4 offset-4 text-center">
         Room {{localroom.roomId}}
      </div>
      <div class="col-md-4 text-right">
        <edit_rooms_modal 
          :room ="localroom"
          :isbutton ="false"
          icon_type="fas fa-wrench fa-sm"
        />

        <edit_booking_modal 
          v-if="localbooking"
          :booking="localbooking"
          :client ="localclient"
          :isbutton ="false"
          :rooms="rooms"
          :key="localbooking.bookingId"
          icon_type="fas fa-user-cog fa-sm"
          />

        <clientdeletemodal 
          v-if="localbooking"
          class='ml-1'
          isbutton='false'
          icon_type='fas fa-user-minus fa-sm'
          :booking_id='localbooking.bookingId'
          />
      </div>
    </div>
    <div v-if="localbooking" class="row" >
      <vuepopper 
        class="col-md-6 offset-3 text-center Status"
        trigger="hover" 
        :client="localclient"
        :booking="localbooking"
      />
    </div>
    <div class="row" >
      <div class="col-md-4 offset-4 text-center Status">
        <span  v-if="localbooking">Ocupat</span>
        <span v-else-if="!localbooking">Disponibil</span>
      </div> 
    </div>
  </div>
</template>
<script>
import moment from 'moment'
import {bus} from "../app"

export default {
    data(){
        return {
         date : this.get_date(),
         localclient: null,
         localbooking: null,
         localroom: this.room,
         localrooms: this.rooms,
        }
    },
  props:{
      room:{
        type: Object,
        default: "Error: No title Proped"
      },
      rooms:{
        type: Array,
        default: "Error: No title Proped"
      },
      filteredBookings:{
        type: [Array,Boolean] ,
        default: "Error: No title Proped"
      },
      clients:{
        type: Array ,
        default: "Error: No title Proped"
      }
  },

  created() {
  },

  mounted(){


    let self=this;
    this.localbooking = _.find(this.filteredBookings, function(booking){ return ((self.date >= booking.Checkin)&&(self.date < booking.Checkout)); });
    if(this.localbooking){
       this.localclient = _.find(this.clients, function(client){ return (client.clientId == self.localbooking.clientId);});
          $("#card_"+this.localroom.roomId).css("background-color","#ff9999");
    }
    else{
          $("#card_"+this.localroom.roomId).css("background-color","#ffffff");
    }
    // console.log("this.filteredBookings: ",this.filteredBookings);
    // console.log("this.rooom: ",this.room);
    // console.log("localbooking: ",this.localbooking);
    // console.log("localclient: ",this.localclient);

    bus.$on("dateUpdated",(data)=>{
        this.date = data;
        let self=this;
        this.localbooking = _.find(this.filteredBookings, function(booking){ return ((self.date >= booking.Checkin)&&(self.date < booking.Checkout)); });

        if(this.localbooking){
          this.localclient = _.find(this.clients, function(client){ return (client.clientId == self.localbooking.clientId)});
          $("#card_"+this.localroom.roomId).css("background-color","#ff9999");
        }
        else{
          $("#card_"+this.localroom.roomId).css("background-color","#ffffff");
        }
    });

    bus.$on("bookingUpdated",(data)=>{
       if(this.localbooking){
        // Se va curata camera pe care o editam
        if((this.localbooking.bookingId == data.booking.bookingId)){
         $("#card_"+this.localroom.roomId).css("background-color","#ffffff");
         this.localbooking = null;
         this.localclient = null;
        }
       }
       if(this.localroom.roomId == data.booking.roomId){
        if ((this.date >= data.booking.Checkin)&&(this.date < data.booking.Checkout)){
        // Se va adauga cazarea pe care o editam in casuta necesara
          this.localclient = data.client;
          this.localbooking = data.booking;
          $("#card_"+this.localroom.roomId).css("background-color","#ff9999");
        }
      }
      // Cazul in care un cline detine mai multe cazari si se editeaza iformatiile unui client, sa se modifice la toate cazarile detinute de client
      if((this.localbooking)&&(this.localclient.Phone == data.client.Phone))this.localclient=data.client;
    });

    // Cand se adauga o cazare noua in roomlist
     bus.$on("bookingUploaded",(data)=>{
       if(this.localroom.roomId == data.booking.roomId){
          this.localclient = data.client;
          this.localbooking = data.booking;
          $("#card_"+this.localroom.roomId).css("background-color","#ff9999");
       }
    }),

    // Cand se sterge o cazare din roomlist
    bus.$on("bookingDestroyed",(data)=>{
      if(this.localroom.roomId == data.booking.roomId){
          this.localbooking =null;
          $("#card_"+this.localroom.roomId).css("background-color","#ffffff");
       }
    })

    bus.$on("roomUpdated",(data)=>{

       if(this.localroom.roomId == data.roomId){
          this.localroom.floorId = data.floorId;
          this.localroom.nrOfBeds = data.nrOfBeds;
          this.localroom.seaSight = data.seaSight;
        }
    }); 

 
  }, 
  methods: {
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


