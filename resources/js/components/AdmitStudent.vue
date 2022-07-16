<template>
    <div>

    </div>
</template>
<script>
import axios from 'axios';

export default {
    props:['classes','route','student'],
    data: function() {
        return {
            form:{
                name:'',
                email:'',
                phone:'',
                gender:'',
                city:'',
                address:'',
                dob:'',
                admitted_date:'',
                classroom_id:'',
                section_id:'',
                parent_id:'',
                blood_group:''
            },
            section:'',
            classroom:'',
            parent:'',
            sections:[],
            errors:'',
            isLoading:false,
        };
    },
    methods:{
        submit: function() {
            let loader = this.$loading.show({
                container: this.$refs.formContainer,
                canCancel: false,
            });
            axios.post('/students',this.form).then((response) => {
                if(response.data.hasOwnProperty('status') && response.data.status == 'success') {
                    loader.hide();
                    Vue.$toast.success('Student Admitted Successfully');
                    this.resetValues();
                    
                }
            }).catch((error) => {
                this.errors = error.response.data.errors;
                loader.hide();
            });
        },
        resetValues() {
            this.form = {
                name:'',
                email:'',
                phone:'',
                gender:'',
                city:'',
                address:'',
                dob:'',
                admitted_date:'',
                classroom_id:'',
                section_id:'',
                parent_id:'',
                blood_group:''
            };
            this.section = '';
            this.classroom = '';
            this.parent = '';
            this.sections = '';
            this.errors = '';
            isLoading = false;
        }

    },
    watch:{
        classroom(classroom) {
            if(classroom !== '') {
                this.form.classroom_id = this.classroom.id;
                this.sections = this.classroom.sections
            }

        },
        section(section) {
            if(section !== '') {
                this.form.section_id = this.section.id;
            }
        },
        parent(parent) {
            if(parent !== '') {
                this.form.parent_id = this.parent.id;
            }
        },

    },
    mounted() {

    }
}
</script>
