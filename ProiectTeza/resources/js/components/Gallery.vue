<template>
	<div>
		{{lightBox()}}
		<h1>{{title}}</h1>
		<div class="asd">
		    <a href="imgs/icons/terrace_facility.png" data-caption="Image caption">
		        <img src="imgs/icons/terrace_facility.png" alt="First image" class="img-fluid">
		    </a>
		</div>
	</div>
</template>

<script>
    export default {

	  data:function(){
        return {
        	title:"Titlu Urias"
		}
	  },
	  methods:{
	  	lightBox: function(){
	  		console.log("method runned1");
            const baguetteBox = require('baguettebox.js');
	  		baguetteBox.run('.asd');
	  		console.log("method runned");
	  	}
	  }
	}
</script>

<style>

</style>