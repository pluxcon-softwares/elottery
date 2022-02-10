<template>
    <div class="chart">
        <div class="mt-3">
            <div class="card card-primary card-tabs">
              <div class="card-header p-0 pt-1">
                <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
                  <li class="pt-2 px-3"><h3 class="card-title">Chart</h3></li>
                  <li class="nav-item">
                    <a class="nav-link active" data-toggle="pill" href="#custom-tabs-two-home"><i class="fas fa-clock"></i> Date Chart</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" data-toggle="pill" href="#custom-tabs-two-profile"><i class="fas fa-calendar"></i> Event Chart</a>
                  </li>
                </ul>
              </div>
              <div class="card-body bg-gray-200 text-gray-900">
                <div class="tab-content" id="custom-tabs-two-tabContent">
                  <div class="tab-pane fade show active" id="custom-tabs-two-home" role="tabpanel" aria-labelledby="custom-tabs-two-home-tab">
                     <date-chart-form />
                  </div>
                  <div class="tab-pane fade" id="custom-tabs-two-profile" role="tabpanel" aria-labelledby="custom-tabs-two-profile-tab">
                      <event-chart-form />
                  </div>
                </div>
              </div>
              <!-- /.card -->
            </div>
        </div>

        <div class="mt-3 flex">
            <div class="chart-table w-full">
                <!-- <table class="w-full text-xs" id="chartTbl">
                    <thead>
                        <tr class="text-center">
                            <th class="bg-indigo-400 text-white text-xs">EVENT GAME</th>
                            <th class="bg-indigo-400 text-white text-xs">EVENT</th>
                            <th class="bg-indigo-500 text-white text-xs">EVENT DATE</th>
                            <th class="bg-green-600 text-white text-xs">W1</th>
                            <th class="bg-green-600 text-white text-xs">W2</th>
                            <th class="bg-green-600 text-white text-xs">W3</th>
                            <th class="bg-green-600 text-white text-xs">W4</th>
                            <th class="bg-green-600 text-white text-xs">W5</th>
                            <th class="bg-green-600 text-white text-xs">WTOTALS</th>
                            <th class="bg-red-600 text-white text-xs">M1</th>
                            <th class="bg-red-600 text-white text-xs">M2</th>
                            <th class="bg-red-600 text-white text-xs">M3</th>
                            <th class="bg-red-600 text-white text-xs">M4</th>
                            <th class="bg-red-600 text-white text-xs">M5</th>
                            <th class="bg-red-600 text-white text-xs">MTOTALS</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(chart, index) in charts" :key="index" class="text-center">
                            <td>
                                {{ chart.lottery.name }}
                            </td>
                            <td class="bg-indigo-400 text-white">{{ chart.event }}</td>
                            <td class="bg-indigo-500 text-white">{{ chart.event_date }}</td>
                            <td class="text-green-600">{{ chart.w1 }}</td>
                            <td class="text-green-600">{{ chart.w2 }}</td>
                            <td class="text-green-600">{{ chart.w3 }}</td>
                            <td class="text-green-600">{{ chart.w4 }}</td>
                            <td class="text-green-600">{{ chart.w5 }}</td>
                            <td class="bg-green-600 text-white">{{ chart.wtotal }}</td>
                            <td class="text-red-600">{{ chart.m1 }}</td>
                            <td class="text-red-600">{{ chart.m2 }}</td>
                            <td class="text-red-600">{{ chart.m3 }}</td>
                            <td class="text-red-600">{{ chart.m4 }}</td>
                            <td class="text-red-600">{{ chart.m5 }}</td>
                            <td class="bg-red-600 text-white">{{ chart.mtotal }}</td>
                        </tr>
                    </tbody>
                </table> -->

                <div class="card">
    <DataTable :value="getDataTable" :paginator="true" class="p-datatable-sm p-datatable-striped" :rows="10"
         :filters.sync="filters" filterDisplay="menu" :loading="loading" responsiveLayout="scroll"
        :globalFilterFields="['name','event','event_date','w1', 'w2', 'w3', 'w4', 'w5', 'wtotal',
        'm1', 'm2', 'm3', 'm4', 'm5', 'mtotal']">

        <template #empty>
            No customers found.
        </template>
        <template #loading>
            Loading customers data. Please wait.
        </template>

        <Column v-for="col in pColumns" :key="col.field" :field="col.field" :header="col.header" headerClass="text-xs" bodyClass="text-xs">
            <template #filter="{filterModel,filterCallback}">
                <InputText type="text" v-model="filterModel.value" @click="filterCallback()" class="p-column-filter" :placeholder="`Search by ${col.field} - ${filterModel.matchMode}`"/>
            </template>
        </Column>

        <!-- <Column field="name" header="Game" headerClass="text-xs" bodyClass="text-xs">
            <template #filter="{filterModel,filterCallback}">
                <InputText type="text" v-model="filterModel.value" @click="filterCallback()" class="p-column-filter" :placeholder="`Search by game - ${filterModel.matchMode}`"/>
            </template>

            <template #body={data}>
                {{ data.lottery.name }}
            </template>
        </Column>

        <Column field="event" header="Event" headerClass="text-xs" bodyClass="text-xs">
            <template #filter="{filterModel,filterCallback}">
                <InputText type="text" v-model="filterModel.value" @click="filterCallback()" class="p-column-filter" :placeholder="`Search by event - ${filterModel.matchMode}`"/>
            </template>

            <template #body={data}>
                {{ data.event }}
            </template>
        </Column>

        <Column field="event_date" header="Date" headerClass="text-xs" bodyClass="text-xs">
            <template #filter="{filterModel,filterCallback}">
                <InputText type="text" v-model="filterModel.value" @click="filterCallback()" class="p-column-filter" :placeholder="`Search by event_date - ${filterModel.matchMode}`"/>
            </template>

            <template #body={data}>
                {{ data.event_date }}
            </template>
        </Column>

        <Column field="w1" header="w1" headerClass="text-xs" bodyClass="text-xs">
            <template #filter="{filterModel,filterCallback}">
                <InputText type="text" v-model="filterModel.value" @click="filterCallback()" class="p-column-filter" :placeholder="`Search by w1 - ${filterModel.matchMode}`"/>
            </template>

            <template #body={data}>
                {{ data.w1 }}
            </template>
        </Column>

        <Column field="w2" header="w2" headerClass="text-xs" bodyClass="text-xs">
            <template #filter="{filterModel,filterCallback}">
                <InputText type="text" v-model="filterModel.value" @click="filterCallback()" class="p-column-filter" :placeholder="`Search by w2 - ${filterModel.matchMode}`"/>
            </template>

            <template #body={data}>
                {{ data.w2 }}
            </template>
        </Column>

        <Column field="w3" header="w3" headerClass="text-xs" bodyClass="text-xs">
            <template #filter="{filterModel,filterCallback}">
                <InputText type="text" v-model="filterModel.value" @click="filterCallback()" class="p-column-filter" :placeholder="`Search by w3 - ${filterModel.matchMode}`"/>
            </template>

            <template #body={data}>
                {{ data.w3 }}
            </template>
        </Column>

        <Column field="w4" header="w4" headerClass="text-xs" bodyClass="text-xs">
            <template #filter="{filterModel,filterCallback}">
                <InputText type="text" v-model="filterModel.value" @click="filterCallback()" class="p-column-filter" :placeholder="`Search by w4 - ${filterModel.matchMode}`"/>
            </template>

            <template #body={data}>
                {{ data.w4 }}
            </template>
        </Column>

        <Column field="w5" header="w5" headerClass="text-xs" bodyClass="text-xs">
            <template #filter="{filterModel,filterCallback}">
                <InputText type="text" v-model="filterModel.value" @click="filterCallback()" class="p-column-filter" :placeholder="`Search by w5 - ${filterModel.matchMode}`"/>
            </template>

            <template #body={data}>
                {{ data.w5 }}
            </template>
        </Column>

        <Column field="wtotal" header="wtotal" headerClass="text-xs" bodyClass="text-xs">
            <template #filter="{filterModel,filterCallback}">
                <InputText type="text" v-model="filterModel.value" @click="filterCallback()" class="p-column-filter" :placeholder="`Search by wtotal - ${filterModel.matchMode}`"/>
            </template>

            <template #body={data}>
                {{ data.wtotal }}
            </template>
        </Column>

        <Column field="m1" header="m1" headerClass="text-xs" bodyClass="text-xs">
            <template #filter="{filterModel,filterCallback}">
                <InputText type="text" v-model="filterModel.value" @click="filterCallback()" class="p-column-filter" :placeholder="`Search by m1 - ${filterModel.matchMode}`"/>
            </template>

            <template #body={data}>
                {{ data.m1 }}
            </template>
        </Column>

        <Column field="m2" header="m2" headerClass="text-xs" bodyClass="text-xs">
            <template #filter="{filterModel,filterCallback}">
                <InputText type="text" v-model="filterModel.value" @click="filterCallback()" class="p-column-filter" :placeholder="`Search by m2 - ${filterModel.matchMode}`"/>
            </template>

            <template #body={data}>
                {{ data.m2 }}
            </template>
        </Column>

        <Column field="m3" header="m3" headerClass="text-xs" bodyClass="text-xs">
            <template #filter="{filterModel,filterCallback}">
                <InputText type="text" v-model="filterModel.value" @click="filterCallback()" class="p-column-filter" :placeholder="`Search by m3 - ${filterModel.matchMode}`"/>
            </template>

            <template #body={data}>
                {{ data.m3 }}
            </template>
        </Column>

        <Column field="m4" header="m4" headerClass="text-xs" bodyClass="text-xs">
            <template #filter="{filterModel,filterCallback}">
                <InputText type="text" v-model="filterModel.value" @click="filterCallback()" class="p-column-filter" :placeholder="`Search by m4 - ${filterModel.matchMode}`"/>
            </template>

            <template #body={data}>
                {{ data.m4 }}
            </template>
        </Column>

        <Column field="m5" header="m5" headerClass="text-xs" bodyClass="text-xs">
            <template #filter="{filterModel,filterCallback}">
                <InputText type="text" v-model="filterModel.value" @click="filterCallback()" class="p-column-filter" :placeholder="`Search by m5 - ${filterModel.matchMode}`"/>
            </template>

            <template #body={data}>
                {{ data.m5 }}
            </template>
        </Column>

        <Column field="mtotal" header="mtotal" headerClass="text-xs" bodyClass="text-xs">
            <template #filter="{filterModel,filterCallback}">
                <InputText type="text" v-model="filterModel.value" @click="filterCallback()" class="p-column-filter" :placeholder="`Search by mtotal - ${filterModel.matchMode}`"/>
            </template>

            <template #body={data}>
                {{ data.mtotal }}
            </template>
        </Column> -->

    </DataTable>
    </div>
            </div>
        </div>
    </div>
</template>

<script>
import { createNamespacedHelpers } from 'vuex';
const {mapState, mapActions, mapGetters} = createNamespacedHelpers('chart');
import DateChartForm from '../admin/partials/DateChartForm.vue';
import EventChartForm from '../admin/partials/EventChartForm.vue';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import InputText from 'primevue/inputtext';
import { FilterMatchMode, FilterOperator } from 'primevue/api';

export default {
    components:{
        DateChartForm,
        EventChartForm,
        DataTable,
        Column,
        InputText,
    },
    data(){
        return{
            filters: {
                'name':{operator: FilterOperator.AND, constraints:[{value: null, matchMode: FilterMatchMode.STARTS_WITH}]},
                'event':{value: null, matchMode: FilterMatchMode.STARTS_WITH},
                'event_date':{value: null, matchMode: FilterMatchMode.STARTS_WITH},
                'w1':{value: null, matchMode: FilterMatchMode.STARTS_WITH},
                'w2':{value: null, matchMode: FilterMatchMode.STARTS_WITH},
                'w3':{value: null, matchMode: FilterMatchMode.STARTS_WITH},
                'w4':{value: null, matchMode: FilterMatchMode.STARTS_WITH},
                'w5':{value: null, matchMode: FilterMatchMode.STARTS_WITH},
                'wtotal':{value: null, matchMode: FilterMatchMode.STARTS_WITH},
                'm1':{value: null, matchMode: FilterMatchMode.STARTS_WITH},
                'm2':{value: null, matchMode: FilterMatchMode.STARTS_WITH},
                'm3':{value: null, matchMode: FilterMatchMode.STARTS_WITH},
                'm4':{value: null, matchMode: FilterMatchMode.STARTS_WITH},
                'm5':{value: null, matchMode: FilterMatchMode.STARTS_WITH},
                'mtotal':{value: null, matchMode: FilterMatchMode.STARTS_WITH},
            },
            loading: false,
        }
    },
    methods:{
        ...mapActions(['showDateChartForm', 'showEventChartForm']),
    },

    computed:{
        ...mapGetters(['getCharts', 'getDataTable']),
        ...mapState(['ShowDateChartForm', 'ShowEventChartForm', 'charts', 'pColumns']),
    },

    created(){

    }
}
</script>
