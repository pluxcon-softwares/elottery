
import axios from 'axios';
import moment from 'moment';
import Form from 'vform';
export default {

    namespaced: true,

    state:{
        DateChartForm: Form.make({
            game_id: '',
            start_year: '',
            start_month: '',
            start_day: '',
            end_year: '',
            end_month: '',
            end_day: '',
        }),

        EventChartForm: Form.make({
            game_id: '',
            start_event: '',
            end_event: '',
        }),

        games: [],
        years: [],
        months: [],
        days: [],
        start_events:[],
        end_events:[],
        pColumns: [
            {field: 'name', header: 'Game'},
            {field: 'event', header: 'Event'},
            {field: 'event_date', header: 'Date'},
            {field: 'w1', header: 'w1'},
            {field: 'w2', header: 'w2'},
            {field: 'w3', header: 'w3'},
            {field: 'w4', header: 'w4'},
            {field: 'w5', header: 'w5'},
            {field: 'wtotal', header: 'wtotal'},
            {field: 'm1', header: 'm1'},
            {field: 'm2', header: 'm2'},
            {field: 'm3', header: 'm3'},
            {field: 'm4', header: 'm4'},
            {field: 'm5', header: 'm5'},
            {field: 'mtotal', header: 'mtotal'},
        ],
        pDataTable: [],
    },

    getters:{
        getGames: (state) => { return state.games },
        getDataTable: (state) => {return state.pDataTable},
    },

    actions:{
        // Fetch all country and games form event chart forms
        async fetchGames({commit}){
            const resp = await axios.get('/api/fetch-games');
            commit('setGames', resp.data);
        },

        async dateGameChange({state}, e){
            const game_id = e.target.value;
            const resp = await axios.post('/api/fetch-chart',{game_id: game_id});

            var monthsObj = {
                '01' : 'January',
                '02': 'February',
                '03': 'March',
                '04': 'April',
                '05': 'May',
                '06': 'June',
                '07': 'July',
                '08': 'August',
                '09': 'September',
                '10': 'October',
                '11': 'November',
                '12': 'December'
            };

            var formatedYears = resp.data.map(date => { return moment(date.event_date).format('YYYY') });
            var formatedDays = resp.data.map(date => { return moment(date.event_date).format('DD') });

            const years = Array.from(new Set(formatedYears))
            const months = monthsObj;
            const days = Array.from(new Set(formatedDays));

            state.years = years.sort();
            state.months = months;
            state.days = days.sort();
        },

        //Fetch Chart by Date
        async submitDateChartForm({ state, commit }){
            const resp = await state.DateChartForm.post('/api/search-date-chart');
            const mapData = resp.data.map(data=>{ return {
                "id" : data.id,
                "name": data.lottery.name,
                "event": data.event,
                "event_date" : data.event_date,
                "w1" : data.w1,
                "w2" : data.w2,
                "w3" : data.w3,
                "w4" : data.w4,
                "w5" : data.w5,
                "wtotal" : data.wtotal,
                "m1" : data.m1,
                "m2" : data.m2,
                "m3" : data.m3,
                "m4" : data.m4,
                "m5" : data.m5,
                "mtotal" : data.mtotal,
                }
            });
            commit('setDataTable', mapData);
        },

        // Change event for EventChartForm select element
        async eventGameChange({state}, e){
            const game_id = e.target.value;
            const resp = await axios.post('/api/fetch-chart/',{game_id: game_id});
            console.log(resp.data.event);
            const STARTEVENT = resp.data.map(data => { return data.event });
            const ENDEVENT = resp.data.map(data => { return data.event });
            state.start_events = STARTEVENT.sort((a, b) => a - b);
            state.end_events = ENDEVENT.sort((a, b) => b - a);
        },

        // Submit Event Chart Form
        async submitChartEventForm({ state, commit }){
            const resp = await state.EventChartForm.post('/api/search-event-chart');
            //console.log(resp.data);
            commit('setCharts', resp.data);
            const mapData = resp.data.map(data=>{ return {
                    "id" : data.id,
                    "name": data.lottery.name,
                    "event": data.event,
                    "event_date" : data.event_date,
                    "w1" : data.w1,
                    "w2" : data.w2,
                    "w3" : data.w3,
                    "w4" : data.w4,
                    "w5" : data.w5,
                    "wtotal" : data.wtotal,
                    "m1" : data.m1,
                    "m2" : data.m2,
                    "m3" : data.m3,
                    "m4" : data.m4,
                    "m5" : data.m5,
                    "mtotal" : data.mtotal,
                }
            });
            commit('setDataTable', mapData);
        },

        // Clear results in chart table
        clearChart({ commit }){
            commit('clearCharts', []);
        },
    },

    mutations:{
        setGames:(state, payload) => { state.games = payload },
        setCharts: (state, payload) => { state.charts = payload },
        clearCharts: (state, payload) => { state.charts = payload },
        setDataTable: (state, payload) => { state.pDataTable = payload },
    }
};
