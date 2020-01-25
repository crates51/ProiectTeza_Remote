<template>
    <div>
        <div>
            <div class="row mb-4">
                <div class="col-md-4">
                    Name   
                </div>
                <div class="col-md-4">
                    
                </div>
                <div class="col-md-4">
                    Last Played
                </div>
            </div>
            <div class="mb-4" v-for="player in localplayers" v-if="localplayers">
                <div class="row">
                    <div class="col-md-4 ">
                        {{player.First_Name}} {{player.Last_Name}}   
                    </div>
                    <div class="col-md-4">
                    
                    </div>
                    <div class="col-md-4">
                        {{player.Last_Played}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>


    export default {
        data(){
            return{
              localplayers: null,
            }
        },

        mounted() {
            console.log('Component mounted.')
            this.localplayers = "Vladislav"

            axios.get('players/', "null")
            .then(response => { 
                console.log(response);
                this.localplayers=response.data.players;
            })
            .catch(error => {
                console.log(error.response)
            });
        }
    }
</script>
