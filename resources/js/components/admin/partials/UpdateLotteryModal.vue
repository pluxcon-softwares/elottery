<template>
    <div>
        <div class="modal fade" id="updateLotteryModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Lottery Type</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form @submit.prevent="">
                    <div class="form-group">
                        <label for="">Country</label>
                        <select class="form-control" v-model="lotteryForm.country_id">
                            <option value="">Select</option>
                            <option v-for="country in getCountries" :key="country.id"
                            :value="lotteryForm.country_id">{{ country.country }}</option>
                        </select>
                        <HasError :form="lotteryForm" field="country_id" class="text-red-700" />
                    </div>

                    <div class="form-group">
                        <label for="">Lottery Type</label>
                        <input type="text" v-model="lotteryForm.name" class="form-control">
                        <HasError :form="lotteryForm" field="name" class="text-red-700" />
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <Button :form="lotteryForm" class="btn btn-primary">Save</Button>
            </div>
            </div>
        </div>
        </div>
    </div>
</template>

<script>
import { createNamespacedHelpers } from 'vuex';
const {mapActions, mapGetters, mapState} = createNamespacedHelpers('lottery');
import {Button, HasError} from 'vform/src/components/bootstrap5';
export default {
    components:{
        Button,
        HasError,
    },

    methods:{
        ...mapActions([])
    },

    computed:{
        ...mapGetters(['getCountries']),
        ...mapState(['lotteryForm']),
    },

    created(){}
}
</script>
