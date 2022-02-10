<template>
    <div class="row grid grid-cols-1 gap-5 p-3 sm:grid-cols-2">
        <div class="mt-3">
            <div class="card card-default">
                <div class="card-body">
                    <form @submit.prevent="" class="">
                        <div class="form-group">
                            <label for="">Game Type</label>
                            <select class="form-control"  @change="fetchLotteriesByCountry">
                                <option value="">Select</option>
                                <option v-for="country in getCountries" :key="country.id" :value="country.id">
                                    {{ country.name }}
                                </option>
                            </select>
                        </div>

                    </form>
                </div>
            </div>
        </div>

        <div class="mt-3">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Lottery Country</h3>
                </div>
                <div class="card-body">
                    <table class="table table-responsive table-striped table-condenced" id="countryTbl">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Game Name</th>
                                <th>Country</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="lottery in getLotteries" :key="lottery.id">
                                <td>{{ lottery.id }}</td>
                                <td>{{ lottery.name }}</td>
                                <td>{{ lottery.country.name }}</td>
                                <td>
                                    <button @click="showUpdateLotteryModal(lottery.id)" class="bg-yellow-500 py-1 px-2.5 rounded-full text-center text-white"><i class="fas fa-edit"></i></button>
                                    &nbsp; &nbsp; &nbsp;
                                    <button class="bg-red-500 py-1 px-2.5 rounded-full text-center text-white"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Update Lottery Modal -->
        <update-lottery-modal />
    </div>
</template>

<script>
import { createNamespacedHelpers } from 'vuex';
const { mapGetters, mapActions } = createNamespacedHelpers('lottery');
import UpdateLotteryModal from './partials/UpdateLotteryModal.vue';
export default {
    components:{
        UpdateLotteryModal
    },

    data(){
        return{}
    },

    methods:{
        ...mapActions(['fetchLotteries', 'fetchCountries', 'fetchLotteriesByCountry',
        'fetchLotteryByID']),

        showUpdateLotteryModal(lottery_id){
            $(function(){
                $('#updateLotteryModal').modal('show');
            });
        },
    },

    computed:{
        ...mapGetters(['getLotteries', 'getCountries']),
    },

    created(){

        this.fetchLotteries(),
        this.fetchCountries(),

        $(function(){
            //const countryTbl = $('#countryTbl').DataTable({});
        });
    }
}
</script>
