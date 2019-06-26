<template>
	<div class="carousel-inner">
	    <div class="carousel-item active">
	        <img class="d-block w-100" src="imgs/forCarousel/slide_1.jpg" alt="First slide">
	        <div class="carousel-caption d-none d-md-block">
		    <h1>{{title}}</h1>
		    <h3>{{subtitle}}</h3>
		    <div class="desc">{{desc}}</div>
		  </div>
	    </div>
</div>
</template>

<script>
	export default{
		props:{
          title:{
            type: String,
            default: "Error: No title Proped"
          },
          subtitle:{
            type:String,
            default: "Error: No subtitle Proped"
          },
          desc:{
            type:String,
            default: "Error: No desc Proped"
          }
        }
	}
</script>

<style>
	
</style>