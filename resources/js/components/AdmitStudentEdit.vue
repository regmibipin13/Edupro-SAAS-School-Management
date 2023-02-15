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
                blood_group:'',
                is_transportation_fee:0,
                is_tution_fee:0,
                pickup_point:'',
                is_food_fee:0,
                doc:'',
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
            axios.patch(this.route,this.form).then((response) => {
                if(response.data.hasOwnProperty('status') && response.data.status == 'success') {
                    loader.hide();
                    Vue.$toast.success('Student Updated Successfully');
                    // this.resetValues();

                }
            }).catch((error) => {
                this.errors = error.response.data.errors;
                loader.hide();
            });
        },

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
        console.log("Mounted")
        if(typeof this.student !== 'undefined' && this.student !== null) {
            this.form.name = this.student.user.name;
            this.form.email = this.student.user.email;
            this.form.phone = this.student.user.phone;
            this.form.gender = this.student.user.gender;
            this.form.city = this.student.user.city;
            this.form.address = this.student.user.address;
            this.form.dob = this.student.user.dob;
            this.form.admitted_date = this.student.admitted_date;
            this.form.blood_group = this.student.blood_group;
            this.form.is_transportation_fee = this.student.is_transportation_fee;
            this.form.is_food_fee = this.student.is_food_fee;
            this.form.is_tution_fee = this.student.is_tution_fee;
            // this.form.doc = this.student.doc;
            this.form.pickup_point = this.student.pickup_point;
            this.classroom = this.student.classroom;
            this.section = this.student.section;
            this.parent = this.student.parent;
        }

    }
}
</script>
