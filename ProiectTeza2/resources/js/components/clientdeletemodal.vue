<template>
  <div v-on:click="showAlert" class="btn btn-danger float-right">
      <i class="fa fa-trash"></i>
  </div>
</template>

<script>

import Vue from 'vue';
// import VueRouter from 'vue-router'
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

    data() {
        return {};
    },
    props:{
      booking_id:{
        type: String ,
        default: "Error: No title Proped"
      },
    },
    methods: {
        showAlert(){          
          let self=this

            this.$swal.fire({
              title: 'Are you sure?',
              text: "You won't be able to revert this!",
              type: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
            if (result.value) {
              this.$swal.fire(
                'Deleted!',
                'The client has been deleted.',
                'success'
              ).then(function() {
              // Redirect the user
                window.location.href = "bookings/"+ self.booking_id + '/destroy';
                // window.location.href = "bookings"+ this.booking_id + '/update/Canceled';
              });
        // router.push({ name: "user"})
              // window.location = "bookings";

            }
            })
        }
    }
}
</script>