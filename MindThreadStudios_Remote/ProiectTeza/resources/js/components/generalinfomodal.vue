<template>
  <div v-on:click="showAlert" class="btn btn-danger float-right" id="autoLaunch" style="display: none">
      <i class="fa fa-trash"></i>
  </div>
</template>

<script>

import Vue from 'vue';
import swal from 'sweetalert2';
window.Swal = swal;

// import VueRouter from 'vue-route\r'
// Vue.use(VueRouter);

// const router = new VueRouter({
//   mode: 'history',
//   routes: [
//     {
//       path: 'bookings',
//       name: 'user'
//     },
//   ]
// })


export default {

    data:function(){
        return {
          accomodationName:"",
          totalRooms:0,

        };
    },
  
    props:{
      booking_id:{
        type: String ,
        default: "Error: No title Proped"
      },
    },
    methods: {
        showAlert(){          
          let self=this;
           this.$swal.fire({
              title: 'How many rooms your accomodation has?',
              type: 'question',
              input: 'range',
              inputAttributes: {
                min: 8,
                max: 120,
                step: 1
              },
              inputValue: 23
            }).then((result)=>{
                   (async function getName () {
                const {value: name} = await Swal.fire({
                  title: 'Enter your accomodation name please',
                  input: 'text',
                  inputValue: '',
                  showCancelButton: true,
                  inputValidator: (value) => {
                    if (!value) {
                      return 'You need to write something!'
                    }
                  }
                })
                // 
                if (name) {
                  self.accomodationName=name;
                  self.totalRooms=result.value;
                  Swal.fire(
                    {
                      title: `Your accomodation is named:\n `+name+'\n\n Total rooms in accomodation:\n'+self.totalRooms
                    }).then(function(){
                      console.log("send name: " + self.accomodationName);
                      console.log("send totalRooms: " + self.totalRooms);

                      window.location.href = "generalInfo/"+self.accomodationName+"/"+self.totalRooms+"/store";
                    })
                }
                })()
            })

           // .then((result) => {
           //    if (result.value) {
           //      window.location.href = "generalInfo/totalRooms/"+result.value+"/store";
           //    }
           //  })
            // (async function getName () {

            //     const {value: name} = await Swal.fire({
            //       title: 'Enter your accomodation name please',
            //       input: 'text',
            //       inputValue: '',
            //       showCancelButton: true,
            //       inputValidator: (value) => {
            //         if (!value) {
            //           return 'You need to write something!'
            //         }
            //       }
            //     })
                
            //     if (name) {
            //       self.accomodationName=name;
            //       Swal.fire(
            //         {
            //           title: `Your accomodation is named:\n `+name
            //         }).then(function(){
            //           console.log("send name: " + self.accomodationName);
            //           window.location.href = "generalInfo/name/"+self.accomodationName+"/store";
            //         })
            //     }
            //     })()
        }
    }
}
</script>

            // this.$swal.fire({
              // title: 'How many rooms your accomodation has?',
              // type: 'question',
              // input: 'range',
              // inputAttributes: {
                // min: 0,
                // max: 120,
                // step: 1
              // },
              // inputValue: 25
            // }).then((result) => {
              // if (result.value) {
                // window.location.href = "generalInfo/totalRooms/"+result.value+"/store";
              // }
            // })