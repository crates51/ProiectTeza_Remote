<template>
	<div>
<!-- Aici nu voi mai face lista de componente.. cred ca e mai eficiente asa -->
    <div
    v-for="client in localclients"
    :key="client.clientId"
    >
    <div  class="card pt-2 pb-2 pr-2 pl-2 mb-3 bookingList">
      <div class="row">
        <div class="col-md-1 clientId my-auto" style="text-align:center">
          <span>{{client.clientId}}</span>
        </div>
        <div class="col-md-3">
          <div class="row">
            Full Name: {{client.First_Name}} {{client.Last_Name}}
          </div>
          <div class="row">
            Email: {{client.Email}}
          </div>
          <div class="row">
            Phone: {{client.Phone}}
          </div>
        </div>
        <div class="col-md-8">
          <!-- Column for other infos -->
        </div>
      </div>
    </div>
    </div>
  </div>
</template>

<script>
import {bus} from "../app"
import Cookies from 'js-cookie'

    export default {
    	 data(){
        return{
          localclients: null,
        }
       },

       props:{
        },

        created(){
          console.log("It has been created");
          axios.get('api/clients')  
              .then(response => { 
                this.localclients = response.data.clients;
              })
        },

        mounted(){
           bus.$on("bookingUploaded",(data)=>{
            axios.get('api/clients')  
              .then(response => { 
                this.localclients = response.data.clients;
                console.log("this.localclients: ",this.localclients);
            })
          })

          // bus.$on("bookingUpdated",(data)=>{
          //   axios.get('api/clients')  
          //     .then(response => { 
          //       this.localclients = response.data.clients;
          //       console.log("this.localclients: ",this.localclients);
          //   })
          // })
        },

        methods:{
        },
    }
</script>

