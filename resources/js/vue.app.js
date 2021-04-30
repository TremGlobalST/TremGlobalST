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
        meetStartRaw: '',
        meetEndRaw: '',
        noMeet: false,
        startingMeet: true,
        whileMeet: false,
        remainingTime: '',
    },
    mounted: async function () {
        this.getMeet();
        setInterval(() => {
            this.date = moment().format('HH:mm - DD/MM/YYYY');
        }, 1000);
        /*setInterval(() => {
            this.getMeet();
        }, 60000);*/
    },
    watch: {
        date: function() {
            this.getMeet();
        }
    },
    methods: {
        getMeet: async function() {
            const response = await axios.post(`/api/room/${roomId}/meet`);

            if (response.data !== null) {
                this.meetTitle = response.data.title;
                this.meetStart = moment(response.data.start_date).format('HH:mm');
                this.meetEnd = moment(response.data.end_date).format('HH:mm');
                this.meetStartRaw = moment(response.data.start_date);
                this.meetEndRaw = moment(response.data.end_date);
            } else {
                this.meetTitle = '';
                this.meetStart = '';
                this.meetEnd = '';
                this.meetStartRaw = '';
                this.meetEndRaw = '';
            }

            this.dateDiff();
        },
        dateDiff: function() {

            const now = moment();
            console.log(now.diff(this.meetStartRaw, 'minutes') - 1, now.diff(this.meetStartRaw, 'minutes'));
            if (this.meetStartRaw === '') {
                this.noMeet = true;
                this.startingMeet = false;
                this.whileMeet = false;
            } else if (now.diff(this.meetStartRaw, 'minutes') - 1 < -10) {
                this.noMeet = true;
                this.startingMeet = false;
                this.whileMeet = false;
            } else if (now.diff(this.meetStartRaw, 'minutes') - 1 >= -10
                && now.diff(this.meetStartRaw, 'minutes') - 1 < 0
                && this.meetStart != moment().format('HH:mm')) {
                this.noMeet = false;
                this.startingMeet = true;
                this.whileMeet = false;
                this.remainingTime = Math.abs(now.diff(this.meetStartRaw, 'minutes') - 1);
            } else if (now.diff(this.meetStartRaw, 'minutes') - 1 >= 0 || this.meetStart == moment().format('HH:mm')) {
                this.noMeet = false;
                this.startingMeet = false;
                this.whileMeet = true;
            }
        }
    },
    //unMounted: () => clearInterval(this.interval),
})
