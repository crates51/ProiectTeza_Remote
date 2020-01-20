<template>
    <div>
        <div>
            <div class="row mb-4">
                <div class="col-md-4">
                    Name   
                </div>
                <div class="col-md-4">
                    Experience  
                </div>
                <div class="col-md-4">
                    Rank
                </div>
            </div>
            <div :id="'player_'+player.Rank" class="mb-4" v-for="player in localplayers" v-if="localplayers">
                <div class="row">
                    <div class="col-md-4">
                        {{player.First_Name}} {{player.Last_Name}}   
                    </div>
                    <div class="col-md-4">
                        {{player.Experience}}
                    </div>
                    <div class="col-md-4">
                        {{player.Rank}}
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
            axios.get('players/', "null")
            .then(response => { 
                console.log(response);
                this.localplayers=response.data.players_byRank.data;
            })
            .catch(error => {
                console.log(error.response)
            });

            $("#player_1").css("color","red");
        }
    }
</script>

<style>
    color:white;
</style>