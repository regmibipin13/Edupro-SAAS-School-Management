<template>
    <div>

    </div>
</template>

<script>
export default {
    props:['request'],
    data: function() {
        return {
            classroom_id:'',
            section_id:'',
            sections:[],
        };
    },
    watch:{
         classroom_id() {
            var self = this;
            axios.get('/classrooms/'+this.classroom_id+'/sections').then((response) => {
                self.sections = response.data;
            }).catch((error) => {
                console.log(error);
            })


        },
    },
    mounted() {
        this.classroom_id = this.request.classroom_id;
        this.section_id = this.request.section_id;
    }
}
</script>
