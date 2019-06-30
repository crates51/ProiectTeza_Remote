<template>
  <HotelDatePicker />
<!-- <datepicker></datepicker> -->


</template>

<script>
import HotelDatePicker from 'vue-hotel-datepicker'

export default {
  components: {
    HotelDatePicker,
  },
  firstDayOfWeek: 3
}

// import Datepicker from 'vuejs-datepicker';

// export default {
//   // ...
//   components: {
//     Datepicker
//   }
//   // ...
// }

</script>