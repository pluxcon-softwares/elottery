<template>
    <div class="event-chart">
        <form @submit.prevent="submitChartEventForm">
                        <div class="form-group">
                            <select v-model="EventChartForm.game_id" @change="eventGameChange" class="form-control form-control-sm">
                                <option value="">Select Game</option>
                                <option v-for="game in getGames" :key="game.id" :value="game.id">
                                    {{ game.name }}
                                </option>
                            </select>
                            <HasError :form="EventChartForm" field="game_id" class="text-sm text-red-600" />
                        </div>
                        <div class="form-group">
                            <table class="w-full">
                                <thead class="text-xs text-center">
                                    <tr>
                                        <td>SELECT FROM EVENT</td>
                                        <td>SELECT TO EVENT</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <!-- select from event -->
                                            <select v-model="EventChartForm.start_event" class="form-control form-control-sm">
                                                <option value="">....</option>
                                                <option v-for="(event, index) in start_events" :key="index" :value="event">
                                                    {{ event }}
                                                </option>
                                            </select>
                                            <HasError :form="EventChartForm" field="start_event" class="text-sm text-red-600" />
                                        </td>

                                        <!-- <td>
                                            <i class="fas fa-bars"></i>
                                        </td> -->

                                        <td>
                                            <!-- select to event -->
                                            <select v-model="EventChartForm.end_event" class="form-control form-control-sm">
                                                <option value="">....</option>
                                                <option v-for="(event, index) in end_events" :key="index" :value="event">
                                                    {{ event }}
                                                </option>
                                            </select>
                                            <HasError :form="EventChartForm" field="end_event" class="text-sm text-red-600" />
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="form-group">
                            <table class="table w-full">
                                <tbody>
                                    <tr>
                                        <td><Button :form="EventChartForm" class="btn btn-block btn-sm btn-primary">SUBMIT EVENT SEARCH</Button></td>
                                        <td><button @click.prevent="clearChart" class="btn btn-block btn-sm btn-default">CLEAR RESULT</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </form>
    </div>
</template>

<script>
import { createNamespacedHelpers } from 'vuex';
import { Button, HasError } from 'vform/src/components/bootstrap5';
const { mapState, mapGetters, mapActions } = createNamespacedHelpers('chart');
import pButton from 'primevue/button';
export default {

    components:{ Button, HasError, pButton },

    methods:{
        ...mapActions(['submitChartEventForm', 'eventGameChange', 'fetchGames', 'clearChart'])
    },

    computed:{
        ...mapState(['EventChartForm', 'start_events', 'end_events']),
        ...mapGetters(['getCharts', 'getGames']),
    },

    created(){},

}
</script>
