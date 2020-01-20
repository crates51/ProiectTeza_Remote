<template>
	<div>
    <div class="jumbotron mt-2">
          <div class="row">
            <div class="col-md-4 offset-4">
              <i class="fas fa-home fa-3x">Building Infos</i> 
            </div>
          </div>
          <div class="row mt-5">
           <div class="col-md-3 offset-3">
            <span class="h1 float-right">Name: </span>
           </div>
           <div class="col-md-3">
            <span class="h1">Name: </span>
           </div>
         </div>
    </div>
          <!-- <i class='fas fa-phone mr-1 mt-3'></i>  {{client.Phone}}<br> -->
  </div>
</template>

<script>
// import {bus} from "../app"

    export default {
    	 data(){
        return{
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
        },

        mounted(){

        },

        methods:{
        }
    }
</script>
