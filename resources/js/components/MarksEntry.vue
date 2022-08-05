<template>
</template>

<script>
import axios from 'axios';
    export default {
        props:['studentsLists','subject','exam'],
        data:function() {
            return {
                students:[],
            };
        },
        methods:{
            onSubmit: function() {
                let loader = this.$loading.show({
                    container: this.$refs.formContainer,
                    canCancel: false,
                });

                axios.post('/marks',{
                    students:this.students,
                    exam:this.exam,
                    subject:this.subject
                }).then((response) => {
                    if(response.data.hasOwnProperty('status') && response.data.status == 'success') {
                        Vue.$toast.success('Student Marks Updated Successfully');
                    }
                }).catch((error) => {
                    Vue.$toast.error('Something went wrong . Please try again later');

                })
                loader.hide();
            }
        },
        mounted() {
            this.students = this.studentsLists;
        },
    }
</script>
