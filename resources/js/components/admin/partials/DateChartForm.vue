<template>
    <div class="date-chart">
                    <form @submit.prevent="submitDateChartForm">
                        <div class="form-group">
                            <select v-model="DateChartForm.game_id" @change="dateGameChange" class="form-control form-control-sm">
                                <option value="">Select Game</option>
                                <option v-for="game in getGames" :key="game.id"
                                :value="game.id">{{ game.country.name }} | {{ game.name }}</option>
                            </select>
                            <HasError :form="DateChartForm" field="game_id" class="text-red-600 text-sm" />
                        </div>
                        <div class="form-group">
                            <table class="w-full">
                                <thead class="text-xs text-center">
                                    <tr>
                                        <td>START YEAR</td>
                                        <td>START MONTH</td>
                                        <td>START DAY</td>
                                        <!-- <td>&nbsp;</td> -->
                                        <td>END YEAR</td>
                                        <td>END MONTH</td>
                                        <td>END DAY</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="">
                                        <td>
                                            <!-- select start year -->
                                            <select v-model="DateChartForm.start_year" class="form-control form-control-sm">
                                                <option value="">....</option>
                                                <option v-for="(year, index) in years" :key="index" :value="year">
                                                    {{ year }}
                                                </option>
                                            </select>
                                            <HasError :form="DateChartForm" field="start_year" class="text-red-600 text-sm" />
                                        </td>

                                        <td>
                                            <!-- select start year -->
                                            <select v-model="DateChartForm.start_month" class="form-control form-control-sm">
                                                <option value="">....</option>
                                                <option v-for="(month, index) in months" :key="index" :value="index">
                                                    {{ month }}
                                                </option>
                                            </select>
                                            <HasError :form="DateChartForm" field="start_month" class="text-red-600 text-sm" />
                                        </td>

                                        <td>
                                            <!-- select start year -->
                                            <select v-model="DateChartForm.start_day" class="form-control form-control-sm">
                                                <option value="">....</option>
                                                <option v-for="(day, index) in days" :key="index" :value="day">
                                                    {{ day }}
                                                </option>
                                            </select>
                                            <HasError :form="DateChartForm" field="start_day" class="text-red-600 text-sm" />
                                        </td>

                                        <!-- <td>
                                            <i class="fas fa-bars"></i>
                                        </td> -->

                                        <td>
                                            <!-- select start year -->
                                            <select v-model="DateChartForm.end_year" class="form-control form-control-sm">
                                                <option value="">....</option>
                                                <option v-for="(e_year, index) in years" :key="index" :value="e_year">{{ e_year }}</option>
                                            </select>
                                            <HasError :form="DateChartForm" field="end_year" class="text-red-600 text-sm" />
                                        </td>

                                        <td>
                                            <!-- select start year -->
                                            <select v-model="DateChartForm.end_month" class="form-control form-control-sm">
                                                <option value="">....</option>
                                                <option v-for="(e_month, index) in months" :key="index" :value="index">{{e_month}}</option>
                                            </select>
                                            <HasError :form="DateChartForm" field="end_month" class="text-red-600 text-sm" />
                                        </td>

                                        <td>
                                            <!-- select start year -->
                                            <select v-model="DateChartForm.end_day" class="form-control form-control-sm">
                                                <option value="">....</option>
                                                <option v-for="(e_day, index) in days" :key="index" :value="e_day">{{e_day}}</option>
                                            </select>
                                            <HasError :form="DateChartForm" field="end_day" class="text-red-600 text-sm" />
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="form-group">
                            <table class="table w-full">
                                <tbody>
                                    <tr>
                                        <td><Button :form="DateChartForm" class="btn btn-block btn-sm btn-danger">SUBMIT DATE SEARCH</Button></td>
                                        <td><button @click.prevent="clearChart" class="btn btn-block btn-sm btn-default">CLEAR RESULT</button></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </form>
    </div>
</template>

<script>
import { createNamespacedHelpers } from 'vuex';
const { mapState, mapGetters, mapActions } = createNamespacedHelpers('chart');
import {Button, HasError} from 'vform/src/components/bootstrap5';

export default {
    components:{
        Button, HasError
    },

    methods:{
        ...mapActions(['fetchGames', 'dateGameChange', 'submitDateChartForm', 'clearChart']),
    },

    computed:{
        ...mapGetters(['getGames']),
        ...mapState(['DateChartForm', 'years', 'months', 'days']),
    },

    created(){
        this.fetchGames();
    }
}
</script>
