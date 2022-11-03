<template>
    <div>

    </div>
</template>

<script>
export default {
    props:['timeLists','classrooms','request'],
    data: function() {
        return {
            times:[],
            sections:[],
            classroom_id:'',
            section_id:'',
            subjects:[],
            changed:false,
            timeOptions:[],
        };
    },
    methods:{
        timeChange(time, index) {
            this.times[index] = time;
        },
        addTimetable() {
            this.times.push({});
        },
        removeTimetable(index) {
            this.times.splice(index, 1);
        },
        next() {
            if(this.classroom_id == '' || this.section_id == '') {
                Vue.$toast.error('Please enter class and section');
                return false;
            } else {
                window.location.href='/timetables/create?classroom_id='+this.classroom_id+'&section_id='+this.section_id;

            }
        },
        onSubmit() {
             let loader = this.$loading.show({
                container: this.$refs.formContainer,
                canCancel: false,
            });
            if(this.classroom_id == '' || this.section_id == '') {
                Vue.$toast.error('Please select classrooms');
                loader.hide();
                return;
            }

            axios.post('/timetables',{
                classroom_id:this.classroom_id,
                section_id:this.section_id,
                times:this.times
            }).then((response) => {
                if(response.data.hasOwnProperty('status') && response.data.status) {
                    loader.hide();
                    Vue.$toast.success('Timetable Updated Successfully');
                } else {
                    loader.hide();
                    Vue.$toast.error('Timetable Update Failed.');
                }
            }).catch((error) => {
                loader.hide();
                console.log(error);
                Vue.$toast.error('Something went wrong. Please try again later');
            })
        },
    },
    watch:{
        classroom_id() {
            var self = this;
            axios.get('/classrooms/'+this.classroom_id+'/sections').then((response) => {
                self.sections = response.data;
                // self.section_id = self.sections[0].id;
            }).catch((error) => {
                console.log(error);
            })

            axios.get('/classrooms/'+this.classroom_id+'/subjects').then((response) => {
                self.subjects = response.data;
            }).catch((error) => {
                console.log(error);
            })

            this.changed = true;
        },
    },
    mounted() {
        // this.times = this.timeLists;
        this.timeOptions = this.timeLists;
        this.classroom_id = this.request.classroom_id;
        this.section_id = this.request.section_id

        var time;
        var _this = this;
        axios.get('/timetables',{
            params:{
                classroom_id:this.classroom_id,
                section_id:this.section_id
            }
        }).then((response) => {
            if(response.data.length > 0) {
                response.data.forEach(function(t){
                    _this.times.push(t.time);
                });
            }
        }).catch((error) => {
            console.log(error);
        })
    }
}
</script>
