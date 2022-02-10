import axios from "axios";
import Swal from "sweetalert2";
import Form from 'vform';

export default {
    //namespaced: true,

    state: {
        lottery_types: [],

        uploadForm: Form.make({
            lottery_type: '',
            csv_file: null,
        }),

        createResultForm: new Form({
            lottery_id: '',
            event: '',
            event_date: '',
            w1: '',
            w2: '',
            w3: '',
            w4: '',
            w5: '',
            m1: '',
            m2: '',
            m3: '',
            m4: '',
            m5: '',
        }),
    },

    getters: {
        getLotteryTypes: (state) => {return state.lottery_types},
    },

    actions: {
        async fetchLotteryTypes({commit}){
            const response = await axios.get('/api/lotteries');
            commit('setLotteryTypes', response.data);
        },

        selectLotteryTypeOption({state}, e){
            state.uploadForm.lottery_type = e.target.value;
        },

        handleSelectedFile({state}, e){
           const file = e.target.files[0];
           state.uploadForm.csv_file = file;
        },

        async uploadFile({state}){
            const response = await state.uploadForm.post('/api/result/upload');
            //return response.data.success;
            //console.log(response.data);
            if(response.data.success !== null){
                Swal.fire({
                    title: 'success',
                    text: `${response.data.success}`,
                    icon: 'success',
                    showConfirmButton: true,
                    confirmButtonText: 'Ok'
                });

                state.uploadForm.reset();
            }
        },

        // lottery_type data for createResultForm select element
        createResultFormSelect({state}, e){
            state.createResultForm.lottery_type = e.target.value;
        },

        //Store lottery result
        async storeLotteryResult({state}){
            const response = await state.createResultForm.post('/api/result/store');
            if(response.data.success){
                Swal.fire({
                    title: 'success',
                    text: `${response.data.success}`,
                    icon: 'success',
                    showConfirmButton: true,
                    confirmButtonText: 'Ok',
                });
                state.createResultForm.reset();
            }
        }
    },

    mutations: {
        setLotteryTypes: (state, payload) => { state.lottery_types = payload },
    }
};
