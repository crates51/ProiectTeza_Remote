<template>
<div>
    <div  class="card pt-3 pr-3 pl-3 mb-5 bookingList">
        <div class="row">
            <div class="col-md-4 col-sm-4">
                <div class="row">
                    <div class="col text-center subtitlesDatalist">
                        Full Name   
                    </div>
                </div>
                <div class="row">
                    <div class="col text-center">
                        <span>{{localclient.Last_Name}} {{localclient.First_Name}}</span>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-4">
                <div class="row">
                    <div class="col text-center subtitlesDatalist">
                        Contact
                    </div>
                </div>
                <div class="row">
                    <div class="col text-center">
                        <span @change="say()"> Phone: {{localclient.Phone}}</span>
                    </div>  
                </div>
                <div class="row">
                    <div class="col text-center">
                        <span> E-mail: {{localclient.Email}}</span>
                    </div>  
                </div>
            </div>
            <div class="col-md-4 col-sm-4 ">
                <div class="row">
                    <div class="col text-center subtitlesDatalist">
                        Rooms    
                    </div>
                </div>
                <div class="row">
                    <div class="col text-center">
                        Room Id:  <span class="font-weight-bold">{{localbooking.roomId}}</span> 
                    </div>
                </div>
                <div class="row">
                    <div class="col text-center">
                      <span v-if="(this.localbooking.Adults == 1 || this.localbooking.Adults == 0)">
                            There will be <span class="font-weight-bold"> {{localbooking.Adults}}</span> Adult and
                                          <span class="font-weight-bold"> {{localbooking.Children}}</span>  
                            <span v-if="(this.localbooking.Children == 1 || this.localbooking.Children == 0)">child</span>
                            <span v-else>children</span>
                      </span>
                      <span v-else>
                            There will be <span class="font-weight-bold"> {{localbooking.Adults}}</span> Adults and
                                          <span class="font-weight-bold"> {{localbooking.Children}}</span> 
                            <span v-if="(this.localbooking.Children == 1 || this.localbooking.Children == 0)">child</span>
                            <span v-else>children</span>
                      </span>   
                    </div>
                </div>              
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-4">
                <div class="row pt-3 pl-3 pr-3 mt-5">
                    <div class="col text-center subtitlesDatalist">
                        Status
                    </div>
                </div>
                <div class="row">
                    <div class="col text-center">
                        <!-- Client asked for booking but not yet accepted -->
                        <div v-if="checkValue('Status','Pending')">
                            <div style="display:none" :id="'CancelTooltip_CancelAnchor'+booking.bookingId" class="mb-2 mt-2 CancelTooltip">
                                <span> Decline The Booking</span>
                            </div>
                            <div style="display:none" :id="'AcceptTooltip_'+booking.bookingId" class="mb-2 mt-2 AcceptTooltip">
                                <span> Accept The Booking</span>
                            </div>
                            <clientstatusmodal popuptype="error" message="Declined" status='Cancel' booking_id="localbooking.bookingId"></clientstatusmodal>
                            <span style="color: #FFAA00FF" >{{localbooking.Status}}</span>
                            <clientstatusmodal popuptype="success" message="Accepted" status='Accept' booking_id="localbooking.bookingId"></clientstatusmodal>
                        </div>
                        <span v-if="checkValue('Status','During the stay')" class="text-success">{{localbooking.Status}}</span>
                        <span v-if="checkValue('Status','Booked')" class="text-success">{{localbooking.Status}}</span>
                        <span v-if="checkValue('Status','Canceled')" class="text-danger">{{localbooking.Status}}</span>
                        <span v-if="checkValue('Status','Finished')" class="text-primary">{{localbooking.Status}}</span>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card p-3 mt-5">
                    <div class="row">
                        <div class="col-md-6 text-center">Check-In</div>
                        <div class="col-md-6 text-center">Check-Out</div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 text-center">{{localbooking.Checkin}}</div>
                        <div class="col-md-6 text-center">{{localbooking.Checkout}}</div>
                    </div>
                </div>  
            </div>

            <div class="col-md-4 align-self-end">
                <div class="row">
                    <div class="col-md-4">
                        <edit_booking_modal 
                        :booking="localbooking"
                        :client ="localclient"
                        :isbutton ="true"
                        :rooms = "rooms"
                        icon_type="fas fa-pencil-alt"
                        v-if="checkValue('is_auth', 1)"
                        :key="localclient.First_Name+localclient.Last_Name+localclient.Email+localclient.Phone"
                        />
                    </div>
                    <div class="col-md-4 tac">
                        <a class="btn btn-dark" :href="'bookings/'+localbooking.bookingId" >
                            <i class="fas fa-sign-in-alt"></i>
                        </a>
                    </div>
                    <div v-if="checkValue('is_auth', 1)" class="col-md-4">
                        <clientdeletemodal isbutton="true" icon_type="fa fa-trash" :booking_id="localbooking.bookingId"/>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 offset-4 text-center pt-3" id="clientId">
                <span>
                    {{localbooking.bookingId}}
                </span>
            </div>
        </div>
    </div>
</div>

</template>

<script>
import {bus} from "../app"

    export default {
        data() {
          return {
            localclient: this.client,
            localbooking: this.booking
          }
        },

        props:{
            client:{
              type: Object ,
              default: "Error: No title Proped"
            },
            booking:{
              type: Object ,
              default: "Error: No title Proped"
            },
            rooms:{
              type: Array ,
              default: "Error: No title Proped"
            },
            is_auth:{
              type: Number ,
              default: "Error: No title Proped"
            }
        },
        created(){},
        mounted() {
            bus.$on("bookingUpdated",(data)=>{
                if(this.localbooking.bookingId == data.booking.bookingId){
                    this.localclient = data.client;
                    this.localbooking = data.booking;
                }
                // Cazul in care un cline detine mai multe cazari si se editeaza iformatiile unui client, sa se modifice la toate cazarile detinute de client
                if((this.localclient.clientId == data.client.clientId)){
                    this.localclient=data.client;
                }
            })
        },
        updated(){},
        methods:{
   
            checkValue(type,value){
                if(type=="Adults"){
                    if (this.localbooking.Adults==value)return true
                 }
                 if(type=="Children"){
                    if (this.localbooking.Children==value)return true
                 }
                 if(type=="Status"){
                    if (this.localbooking.Status==value)return true
                 }
                if(type=="is_auth"){
                    return this.is_auth;
                 }
            }
        }
    }
</script>
