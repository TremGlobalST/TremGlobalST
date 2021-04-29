import Vue from 'vue';
import moment from 'moment';
import axios from 'axios';

new Vue({
    el: '#app',
    data: {
        date: moment().format('HH:mm - DD/MM/YYYY'),
        interval: null,
        meetTitle: '',
        meetStart: '',
        meetEnd: '',
        noMeet: true,
        startingMeet: false,
        whileMeet: true,
    },
    mounted: async function () {
        this.getMeet();
        setInterval(() => {
            this.date = moment().format('HH:mm - DD/MM/YYYY');
        }, 1000);
        setInterval(() => {
            this.getMeet();
        }, 60000);
    },
    methods: {
        getMeet: async function() {
            const response = await axios.post(`/api/room/${roomId}/meet`);

            this.meetTitle = response.data.title;
            this.meetStart = moment(response.data.start_date).format('HH:mm');
            this.meetEnd = moment(response.data.end_date).format('HH:mm');
            console.log(response);
        }
    },
    //unMounted: () => clearInterval(this.interval),
})
