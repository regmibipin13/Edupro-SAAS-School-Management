<template>

</template>

<script>

	export default {
        props:['request'],
		data: function() {
			return {
				classroom_id:'',
				sections:[],
				section_id:'',
				date:'',
			};
		},
		watch:{
			classroom_id() {
				axios.get('/classrooms/'+this.classroom_id+'/sections').then((response) => {
					this.sections = response.data;
				}).catch((error) => {
					console.log(error);
				})
			}
		},
        mounted() {
			this.classroom_id = this.request.classroom_id
			this.section_id = this.request.section_id
			this.date = this.request.date
        }
	}

</script>
