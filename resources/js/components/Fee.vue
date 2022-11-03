<template>
    <div>

    </div>
</template>

<script>
import axios from 'axios';

export default {
    props:['classrooms'],
    data: function() {
        return {
            classroom_id:'',
            section_id:'',
            student_id:'',
            sections:[],
            pending_fee:'',
            payment_untill:'',
            other_payments:0,
            payment_method:'',
            description:''


        };
    },
    computed:{
        total() {
            return this.pending_fee.monthly_fee ?? 0 + this.pending_fee.transportationFee ?? 0 + this.pending_fee.foodFee ?? 0
        },
        grandTotal() {
            return parseFloat(this.total) + parseFloat(this.other_payments);
        }
    },
    watch:{
        classroom_id() {
            axios.get('/fees/create',{
                params:{
                    classroom_id:this.classroom_id
                }
            }).then((response) => {
                this.sections = response.data;
            }).catch((error) => {
                console.log(error);
            })
        }
    },
    methods:{
        search() {
           if(this.student_id == null || this.student_id == '') {
            Vue.$toast.error('Student Id should be entered');
            return;
           }

           let loader = this.$loading.show({
                container: this.$refs.formContainer,
                canCancel: false,
            });
           axios.get('/fees/pending',{
            params:{
                student_id:this.student_id
            }
           }).then((response) => {
            this.pending_fee = response.data;
            loader.hide();
           }).catch((error) => {
            console.log(error);
            loader.hide();
           })
        },
        pay() {
            // if(this.other_payments == null || this.other_payments == '') {
            //     Vue.$toast.error('Min value for other payments is 0')
            //     return;
            // }
            if(this.payment_untill == null || this.payment_untill == '') {
                Vue.$toast.error('Payment untill is required')
                return;
            }
            if(this.payment_method == null || this.payment_method == '') {
                Vue.$toast.error('Payment method is required')
                return;
            }
            let loader = this.$loading.show({
                container: this.$refs.formContainer,
                canCancel: false,
            });
            axios.post('/pay/fee',{
                student_id:this.student_id,
                regular_fee:this.pending_fee.monthly_fee,
                transportation_fee:this.pending_fee.transportationFee,
                food_fee:this.pending_fee.foodFee,
                other_payements:this.other_payments,
                payment_untill:this.payment_untill,
                description:this.description,
                payment_method:this.payment_method,
            }).then((response) => {
                Vue.$toast.success('Fee Payment Completed Successfully');
                window.location.href = response.data;

            }).catch((error) => {
                console.log(error);
                Vue.$toast.error('Something went wrong please try again');
                loader.hide();
            })
        }
    }
}
</script>
