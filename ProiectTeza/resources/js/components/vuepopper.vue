<template>
  <popper
    :trigger="trigger"
    :options="{
      placement: 'top',
      modifiers: { offset: { offset: '0,10px' } }
    }">
    <div class="popper BookingInfoTooltip">
         {{client.Last_Name}} {{client.First_Name}} <br>
          <i class='fas fa-phone mr-1 mt-3'></i>  {{client.Phone}}<br> 
          <i class='fas fa-envelope mr-1'></i>    {{client.Email}}<br>
          <i class='fas fa-male fa-lg mr-1'></i>  {{booking.Adults}}
          <i class='fas fa-child fa-lg mr-1 ml-4'></i>{{booking.Children}}<br>
          {{booking.Checkin}} <i class='mx-3 fas fa-angle-double-right mt-3'></i>{{booking.Checkout}}<br>
          <i class="fas fa-id-card-alt fa-lg mr-2"></i>{{booking.bookingId}}
    </div>
    <span slot="reference">
      {{client.Last_Name}} {{client.First_Name}}
    </span>
  </popper>
</template>

<script>
  import Popper from 'vue-popperjs';
  import 'vue-popperjs/dist/vue-popper.css';

  export default {
    components: {
      'popper': Popper
    },
    props:{
      trigger:{
        type: String ,
        default: "Error: No title Proped"
      },
      client:{
        type: Object ,
        default: "Error: No title Proped"
      },
      booking:{
        type: Object ,
        default: "Error: No title Proped"
      },
    },
     created(){
      // console.log("Popper for booking "+this.booking.bookingId+" created");
    },
    mounted(){
      // console.log("Popper for booking "+this.booking.bookingId+" mounted");
    },
    updated(){
      // console.log("Popper for booking "+this.booking.bookingId+" updated");
    }
  }
</script>

<style>
    .BookingInfoTooltip{
        cursor: pointer;
        background: #9799b5 ;
        border: 1px solid #565978;
        width:310px;
        height:155px;
        border-radius: 0.25rem;
        }
</style>