<template>
    <div class="load-result">
        <div class="row">
            <div class="grid grid-cols-1 gap-5 py-2 px-5 mt-3 md:grid-cols-2">
                <div class="card card-primary">
                    <div class="card-header">
                        <h1 class="card-title">Load Results in Batch</h1>
                    </div>
                    <div class="card-body">
                        <form @submit.prevent="uploadFile">

                            <div class="form-group">
                                <label for="" class="label-control">Lottery Type</label>

                                <select class="form-control" v-model="uploadForm.lottery_type" @change="selectLotteryTypeOption">
                                    <option value="">Select Lottery Type</option>
                                    <option v-for="lottery_type in getLotteryTypes" :key="lottery_type.id" :value="lottery_type.id">
                                        {{ lottery_type.name }}
                                    </option>
                                </select>
                                <HasError :form="uploadForm" field="lottery_type" class="text-sm text-yellow-300" />
                            </div>

                            <div class="form-group">
                                <input type="file" name="csv_file" @change="handleSelectedFile" />
                                <div v-if="uploadForm.progress">Progress: {{ uploadForm.progress.percentage }}%</div>
                            </div>

                            <div class="form-group">
                                <Button :form="uploadForm" class="btn btn-sm btn-success float-right">Upload</Button>
                            </div>

                        </form>
                        <div class="card-body mt-5">
                                <div class="callout callout-danger">
                                <h5>Note!</h5>

                                <p>
                                    Result file should be in Csv format, and file should have headers
                                    of: event, event_Date, w1, w2, w3, w4, w5, m1, m2, m3, m4, m5
                                </p>
                                </div>
                        </div>
                    </div>

                </div>

                <div class="card card-success">
                    <div class="card-header">
                        <h1 class="card-title">Enter Lottery Result</h1>
                    </div>
                    <div class="card-body">
                        <form @submit.prevent="storeLotteryResult" class="">
                            <div class="form-group">
                                <div class="grid grid-cols-2 gap-2">
                                    <div>
                                        <label for="" class="label-control" @change="createResultFormSelect">Lottery Type</label>
                                        <select v-model="createResultForm.lottery_id" class="form-control">
                                            <option value="" selected>Select Lottery Type</option>
                                            <option v-for="lottery_type in getLotteryTypes" :key="lottery_type.id"
                                            :value="lottery_type.id">{{ lottery_type.name }}</option>
                                        </select>
                                        <HasError :form="createResultForm" field="lottery_id" />
                                    </div>
                                    <div>
                                        <label for="">Choose Event Date</label>
                                        <input type="date" v-model="createResultForm.event_date" class="form-control">
                                        <HasError :form="createResultForm" field="event_date" />
                                    </div>
                                </div>
                            </div>

                            <div class="group mb-3">
                                <label for="">Event Number</label>
                                <input type="text" v-model="createResultForm.event" class="form-control">
                                <HasError :form="createResultForm" field="event" />
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-1">

                            <div class="form-group">
                                <label for="" class="label-control">Winning Number</label>
                                <table class="table">
                                    <thead class="bg-gray-200">
                                        <tr>
                                            <th class="text-sm text-center">w1</th>
                                            <th class="text-sm text-center">w2</th>
                                            <th class="text-sm text-center">w3</th>
                                            <th class="text-sm text-center">w4</th>
                                            <th class="text-sm text-center">w5</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <input type="text" v-model="createResultForm.w1" class="form-control">
                                                <HasError :form="createResultForm" field="w1" />
                                            </td>
                                            <td>
                                                <input type="text" v-model="createResultForm.w2" class="form-control">
                                                <HasError :form="createResultForm" field="w2" />
                                            </td>
                                            <td>
                                                <input type="text" v-model="createResultForm.w3" class="form-control">
                                                <HasError :form="createResultForm" field="w3" />
                                            </td>
                                            <td>
                                                <input type="text" v-model="createResultForm.w4" class="form-control">
                                                <HasError :form="createResultForm" field="w4" />
                                            </td>
                                            <td>
                                                <input type="text" v-model="createResultForm.w5" class="form-control">
                                                <HasError :form="createResultForm" field="w5" />
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="form-group">
                                <label for="" class="label-control">Machine Number</label>
                                <table class="table">
                                    <thead class="bg-gray-200">
                                        <tr>
                                            <th class="text-sm text-center">m1</th>
                                            <th class="text-sm text-center">m2</th>
                                            <th class="text-sm text-center">m3</th>
                                            <th class="text-sm text-center">m4</th>
                                            <th class="text-sm text-center">m5</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <input type="text" v-model="createResultForm.m1" class="form-control">
                                                <HasError :form="createResultForm" field="m1" />
                                            </td>
                                            <td>
                                                <input type="text" v-model="createResultForm.m2" class="form-control">
                                                <HasError :form="createResultForm" field="m2" />
                                            </td>
                                            <td>
                                                <input type="text" v-model="createResultForm.m3" class="form-control">
                                                <HasError :form="createResultForm" field="m3" />
                                            </td>
                                            <td>
                                                <input type="text" v-model="createResultForm.m4" class="form-control">
                                                <HasError :form="createResultForm" field="m4" />
                                            </td>
                                            <td>
                                                <input type="text" v-model="createResultForm.m5" class="form-control">
                                                <HasError :form="createResultForm" field="m5" />
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            </div>

                            <div class="form-group">
                                <Button :form="createResultForm" class="btn btn-sm btn-success float-right">Enter Result</Button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="grid grid-cols-1">

            </div>
        </div>
    </div>
</template>

<script>
import { createNamespacedHelpers } from 'vuex';
const {mapGetters, mapActions, mapState} = createNamespacedHelpers('result');
import { HasError, Button } from 'vform/src/components/bootstrap5';

export default {

    components:{
        HasError,
        Button,
    },

    data(){
        return{}
    },

    methods:{
        ...mapActions(['fetchLotteryTypes', 'selectLotteryTypeOption',
        'handleSelectedFile', 'uploadFile', 'createResultFormSelect',
        'storeLotteryResult']),

        submitUploadFile(){
            const success = this.uploadFile();
            if(success !== null)
            {
                console.log(success);
            }
        },
    },

    computed:{
        ...mapGetters(['getLotteryTypes']),
        ...mapState(['uploadForm', 'createResultForm'])
    },

    created(){
        this.fetchLotteryTypes();
    }
}
</script>
