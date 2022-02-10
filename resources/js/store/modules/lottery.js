import axios from "axios";
import Form from 'vform';
export default {
    //namespaced: true,
    state:{
        countryForm: new Form({
            name: ''
        }),

        lotteryForm: new Form({
            country_id: '',
            name: ''
        }),
        countries: [],
        lotteries: [],
    },

    getters: {
        getCountries: state => { return state.countries },
        getLotteries: state => { return state.lotteries },
    },

    actions:{
        async fetchCountries({commit}){
            const countries = await axios.get('/api/countries');
            commit('setCountries', countries.data);
        },

        async fetchLotteries({commit}){
            const lotteries = await axios.get('/api/lotteries');
            commit('setLotteries', lotteries.data);
        },

        async submitCountry({state, commit}){
            state.countryForm.post('/api/country/create', this.countryForm);
            const countries = await axios.get('/api/countries');
            commit('setCountries', countries.data);
        },

        async submitLottery({state}){
            state.lotteryForm.post('/api/lottery/create', this.lotteryForm);
        },

        async fetchLotteriesByCountry({state, commit}, e){
            const country_id = e.target.value;
            const lotteries = await axios.post('/api/lotteries-by-country', {country_id: country_id});
            if(lotteries.data == null){
                commit('setLotteries', []);
            }else{
                commit('setLotteries', lotteries.data);
            }
        },

        async fetchLotteryByID({commit}, lottery_id){
            const lottery = await axios.post('/api/lottery/lottery-by-id', {
                lottery_id: lottery_id
            });
            const formData = {
                country_id: lottery.data.country.map(data =>{ return data.id }),
                name: lottery.data.name,
            };
            commit('updateLotteryForm', formData);
            console.log(lottery.data);
        },

        selectCountry({state}, e){
            state.lotteryForm.country_id = parseInt(e.target.value);
        },
    },

    mutations: {
        setCountries:(state, payload) => { state.countries = payload },
        setLotteries:(state, payload) => { state.lotteries = payload },
        updateLotteryForm:(state, payload) => {
            state.lotteryForm.country_id = payload.country_id;
            state.lotteryForm.name = payload.name
        }
    }
};
