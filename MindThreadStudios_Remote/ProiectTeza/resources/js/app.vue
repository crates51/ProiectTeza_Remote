<template>
  <div>
    <new_booking_modal
      :isbutton ="false"
      icon_type=""
      :rooms="localrooms"
    />

    <div class="row ">
      <div class="col-4 col-md-4 offset-4 mt-2  text-center mb-5">
        <div id="countBBackground">
          <span id="countB">{{this.localbookings.length}}</span>
        </div>
      </div>
    </div>
    <div class="row">
      <div class=" col-md-2 offset-3 text-center mb-5">
        <div class="rectangleShape">
          <a @click="setValue('section','Rooms')" class="insideShapeText">Rooms</a>
        </div>
      </div>
      <div class=" col-md-2 text-center mb-5">
        <div class="rectangleShape">
          <a @click="setValue('section','Bookings')" class="insideShapeText">Bookings</a>
        </div>
      </div>
      <div class=" col-md-2 text-center mb-5">
        <div class="rectangleShape">
          <a @click="setValue('section','Clients')" class="insideShapeText">Clients</a>
        </div>
      </div>
    </div>
    <div v-if="checkValue('section','Rooms')">
      <roomssection
       :rooms="localrooms"
       :bookings="localbookings"
       :clients="localclients"
       :totalfloors="totalfloors"
       />
    </div>
    <div v-else-if="checkValue('section','Bookings')">
        <bookingssection
        :bookings="localbookings"
        :clients="localclients"
        :rooms="localrooms"
        :is_auth="is_auth"
        />
    </div>
    <div v-else-if="checkValue('section','Clients')">
      <span>Clients</span>
    </div>
  </div>
</template>

<script>
import Cookies from 'js-cookie'
import {bus} from "../js/app"

export default {
  data() {
    return {
      section: 'Bookings',
      localbookings: this.bookings,
      localclients: this.clients,
      localrooms: this.rooms
    };
  },
  props:{
    rooms:{
      type: Array ,
      default: "Error: No title Proped"
    },
    clients:{
      type: Array ,
      default: "Error: No title Proped"
    },
    bookings:{
      type: Array ,
      default: "Error: No title Proped"
    },
    is_auth:{
      type: Number ,
      default: "Error: No title Proped"
    },
    totalfloors:{
      type: Number ,
      default: "Error: No title Proped"
    },
  },
  created(){
  },
  mounted(){
            bus.$on("bookingUpdated",(data)=>{
              this.localbookings=data.bookings;
              this.localclients=data.clients;
            }); 

            bus.$on("bookingDestroyed",(data)=>{
              this.localbookings = data.bookings;
              this.localclients = data.clients;
            });

            bus.$on("bookingUploaded",(data)=>{
             this.localbookings = data.bookings;
             this.localclients = data.clients;
            });

        console.log("main localbookings: ",this.localbookings);
        console.log("main localclients: ",this.localclients);    
            
  },
  methods:{
    setValue(type,value){
      if(type=='section'){
        this.section=value;
      // console.log("The section will be changed in "+this.section);
      }
    },
    checkValue(type,value){
      if(type=='section'){
        if(this.section==value)return true;
      }
    }
  }
};

</script>




<style scoped lang="scss">

.insideShapeText{
  top:20%;
  font-family: 'Arvo', serif;
  font-size: 120%;
  font-weight: bold;
  text-decoration: none!important;
  position: relative;
  cursor: pointer;
  color:white;
  -o-transition: .5s;
  -ms-transition: .5s;
  -moz-transition: .5s;
  -webkit-transition: .5s;
  transition: .5s;  
}

.insideShapeText:hover{
    color: #edb83a !important;
}

</style>