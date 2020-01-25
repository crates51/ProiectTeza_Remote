<template>
    <div>
        <div class="row py-5">
            <div class="col-md-6 offset-3" style="text-align:center;">
                <h1>Doofenshmirtz Defense Game</h1>
            </div>
        </div>
        <div class="row">
        <!-- <div class="row justify-content-center"> -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">History of Played Games</div>

                    <div class="card-body">
                        <historyplayedgames_section/>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Leaderboard</div>
                    <div class="card-body">
                       <leaderbord_section/>
                    </div>
                </div>
            </div>
        </div> 
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
