<template>
    <div class="games">
    <div class="container grid grid-cols-1 md:grid-cols-2 p-3 content-center gap-10">
        <div class="grid grid-cols-1 mt-3 w-1/1">
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">Countries</h3>
                </div>
                <div class="card-body">
                    <form @submit.prevent="submitCountry">
                    <div class="form-group">
                        <label for="" class="label-control">Country Code (eg: GH)</label>
                        <input type="text" v-model="countryForm.name" placeholder="Enter Lottery Country" class="form-control">
                        <HasError :form="countryForm" field="name" class="text-red" />
                    </div>
                    <Button :form="countryForm" class="btn btn-sm btn-primary float-right">Submit</Button>
                </form>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 mt-3 w-1/1">
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">Create Lottery Type</h3>
                </div>
                <div class="card-body">
                    <form @submit.prevent="submitLottery">
                    <div class="form-group">
                        <label for="" class="label-control">Country</label>
                        <select class="form-control" :v-model="lotteryForm.country_id" @change="selectCountry">
                            <option value="">Select Country</option>
                            <option v-for="country in getCountries" :key="country.id" :value="country.id">
                                {{ country.name }}
                            </option>
                        </select>
                        <HasError :form="lotteryForm" field="country_id" class="text-sm text-red" />
                    </div>

                    <div class="form-group">
                        <label for="" class="label-control">Game Name(Eg: Monday Special)</label>
                        <input type="text" v-model="lotteryForm.name" class="form-control">
                        <HasError :form="lotteryForm" field="name" class="text-sm text-red" />
                    </div>

                    <div class="form-group">
                        <Button :form="lotteryForm" class="btn btn-sm btn-default float-right">Submit</Button>
                    </div>

                </form>
                </div>
            </div>
        </div>
    </div>

    </div>
</template>

<script>
import {createNamespacedHelpers} from 'vuex';
const { mapActions, mapGetters, mapState } = createNamespacedHelpers('lottery');
import {HasError, Button} from 'vform/src/components/bootstrap5';
export default {
    components: {
        HasError,
        Button,
    },

    data(){
        return{
        }
    },

    methods:{
        ...mapActions(['fetchCountries', 'submitCountry', 'submitLottery',
                'selectCountry']),
    },

    computed:{
         ...mapGetters(['getCountries', 'getLotteries']),
         ...mapState(['countryForm', 'lotteryForm']),
    },

    created(){
        this.fetchCountries();
        $(function(){
            $('#countryTbl').DataTable();
        });
    },
    mounted(){}
}
</script>
