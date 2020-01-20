<template>
  <div class="row">
    <div class="mb-4 col-md-4 offset-4 tac">
      <a-date-picker @change="onChange" >
        <div class="floorIdTitle">
          <i class="far fa-calendar-alt fa-lg"></i>
          <span id="datePickerText">{{this.dateShown}}</span>
        </div>
      </a-date-picker>
    </div>
  </div>
</template>
<script>
import moment from 'moment'
import {bus} from "../app"

export default {
  data(){
      return {
        date : new Date(),
        monthNames : ["January", "February", "March", "April", "May", "June","July", "August", "September", "October", "November", "December"],
        dateShown : null,
      }
  },
  created() {
            this.dateShown = this.date.getDate() +" "+ this.monthNames[this.date.getMonth()];
  },
  // after the doc has been created
  mounted(){
  },
  methods: {
    onChange(value, dateString) {
      this.dateShown = value.format('DD') + " " +value.format('MMMM');
      bus.$emit('dateUpdated',value.format('DD')+"/"+value.format('MM')+"/"+value.format('YYYY'));
    },
  }
}
</script>


// 