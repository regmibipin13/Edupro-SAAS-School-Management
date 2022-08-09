<template>
</template>

<script>
import axios from 'axios';
export default {
    props:['request','studentLists'],
    data: function() {
        return {
            classroom_id:'',
            sections:[],
            section_id:'',
            date:'',
            students:[],
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

    methods:{
        onSubmit: function() {
            let loader = this.$loading.show({
                container: this.$refs.formContainer,
                canCancel: false,
            });

            axios.post('/attendances',{
                date:this.date,
                students: this.students
            }).then((response) => {
                if(response.data.hasOwnProperty('status') && response.data.status) {
                    loader.hide();
                    Vue.$toast.success('Attendance Recorded Successfully');
                }
            }).catch((error) => {
                loader.hide();
                Vue.$toast.error('Attendance Recording Failed . Please try again later');
            })
        }
    },
    mounted() {
        this.classroom_id = this.request.classroom_id
        this.section_id = this.request.section_id
        this.date = this.request.date

        this.students = this.studentLists
    }
}
</script>
