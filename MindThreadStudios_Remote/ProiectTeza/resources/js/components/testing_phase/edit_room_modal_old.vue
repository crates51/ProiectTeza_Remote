<template>
	<div>
		<a @click.prevent="show"> Press Me</a>
		
		<modal name="modal-login" @opened="opened" :width="798">
	  		<form method="post">
	  		<div class="row modal-header">
	  			<div class="col-md-4">
	  				<span class="modal-title">Edit Room</span>
	  			</div>
	  		</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-4 offset-2">
						<div class="form-group">
							<label for="floorId" class="text-center" > Floor Id</label>
							<input id ="floorId" class="form-control text-center" type="number" value="42" ref="floorId" @keydown.shift.tab.prevent="">
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="numberOfBeds" class="text-center"> Number of beds</label>
							<input id ="numberOfBeds" class="form-control text-center" type="number" value="42">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4 offset-4">
						<div class="form-group tac">
				    		<input type="checkbox" class="form-check-input" id="exampleCheck1">
				    		<label class="form-check-label" for="exampleCheck1">Sea Sight</label>
						</div>	
					</div>
				</div>
				<div class="col-md-2 offset-5">
				  <button type="submit" class="btn btn-dark" @keydown.tab.exact.prevent="" >Submit</button>
				</div>		
			</div>
			</form>
		</modal>
	</div>
</template>

<script>
export default {
	methods: {
	  show(){
	    this.$modal.show('modal-login')
	  },
	  opened(){
	  	this.$refs.floorId.focus()
	  },
	  hide(){
	    this.$modal.hide('modal-login')
	  }
	}
}
</script>


<style>

	.modal-header span.modal-title{
	  	  font-size: 18px;
		}

</style>