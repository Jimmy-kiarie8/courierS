
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
 
window.Vue = require('vue');
import VueRouter from 'vue-router'
import Vuetify from 'vuetify'
import Print from 'vue-print-nb'
// import * as VueGoogleMaps from 'vue2-google-maps'
import VueChartkick from 'vue-chartkick'
import Chart from 'chart.js'
import 'material-design-icons-iconfont/dist/material-design-icons.css'
import '@fortawesome/fontawesome-free/css/all.css' // Ensure you are using css-loader
import 'vuetify/dist/vuetify.min.css'
import VueCharts from 'vue-chartjs'
import { Bar, Line } from 'vue-chartjs'
import JsonExcel from 'vue-json-excel'

// vue.use(Vuetify, {
//     iconfont: 'mdi'
// })
Vue.use(VueChartkick, {adapter: Chart})
 
/*Vue.use(VueGoogleMaps, {
  load: {
    // key: 'AIzaSyBNzKeF6ZwxlAOUCyeH8UxvvYRHP_w_Guk',
    libraries: 'places',
  },
})*/
 
Vue.use(Print); 
Vue.use(Vuetify)
Vue.use(VueRouter)

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
// axios.defaults.baseURL = 'http://courier.dev/api/getData';
Vue.component('downloadExcel', JsonExcel)
Vue.component('file-management', require('./components/upload/FileManagement.vue'));
Vue.component('attachment-list', require('./components/upload/AttachmentList.vue'));
Vue.component('upload-list', require('./components/upload/Upload.vue'));
let dashboard = require('./components/Dashboard.vue');

let myHeader = require('./components/include/Header.vue');
let myUser = require('./components/users/User.vue');
let myDrivers = require('./components/drivers/Driver.vue');
let myShipment = require('./components/shipments/Shipment.vue');
let myScanner = require('./components/scanner/Scanner.vue');
let myContainer = require('./components/containers/Container.vue');
let myMap = require('./components/reports/Map.vue');
let myBranch = require('./components/branches/Branch.vue');
let myProfile = require('./components/users/Profile.vue');
let myCompany = require('./components/company/Company.vue');
let myCustomer = require('./components/customers/Customer.vue');
let mysubsicriber = require('./components/emails/Subscribe.vue');
let myInvice = require('./components/invoices/Invoice.vue');
let myReceipt = require('./components/receipt/Receipt.vue');
let myReports = require('./components/reports/Reports.vue');
// let myPdf = require('./components/csv/Csv.vue');
let myPdf = require('./components/csv/test.vue');
let mybranchShip = require('./components/branches/BranchShipments.vue');
let myRoles = require('./components/users/roles/Roles.vue');
let myscheduled = require('./components/shipments/Scheduled.vue');
let myTasks = require('./components/tasks/Task.vue');
let myUploadFile = require('./components/upload/UploadFile.vue');
let myCharges = require('./components/charge/Charge.vue');

const routes = [
{path: '/', component: dashboard },
{path: '/users', component: myUser },
{path: '/drivers', component: myDrivers },
{path: '/shipments', component: myShipment },
{path: '/scanner', component: myScanner },
{path: '/containers', component: myContainer },
{path: '/branches', component: myBranch },
{path: '/profile', component: myProfile },
{path: '/companies', component: myCompany },
{path: '/subscribers', component: mysubsicriber },
{path: '/customers', component: myCustomer },
{path: '/invoices', component: myInvice },
{path: '/receipts', component: myReceipt },
{path: '/reports', component: myReports },
{path: '/csv', component: myPdf },
{path: '/roles', component: myRoles },
{path: '/branch/:id', component: mybranchShip },
{path: '/scheduled', component: myscheduled },
{path: '/tasks', component: myTasks },
{path: '/uploads', component: myUploadFile },
{path: '/charges', component: myCharges },


]
const router = new VueRouter({
// mode: 'history',
	routes // short for `routes: routes`
})

const app = new Vue({
    el: '#app',
    router,
    components: {
    	myHeader, myUser, myDrivers, myShipment, myScanner, myContainer, myMap,
        myBranch, myProfile, myCompany, myCustomer, mysubsicriber, myInvice, myReceipt,
        myReports, myPdf, mybranchShip, myRoles, myscheduled, myTasks, myUploadFile, myCharges
    },
    data: {
    shipments: [],
    loading: false,
    error: false,
    query: ''
}, 
methods: {
    search: function() {
        // Clear the error message.
        this.error = '';
        // Empty the shipments array so we can fill it with the new shipments.
        this.shipments = [];
        // Set the loading property to true, this will display the "Searching..." button.
        this.loading = true;

        // Making a get request to our API and passing the query to it.
        this.$http.get('/search?q=' + this.query).then((response) => {
            // If there was an error set the error message, if not fill the shipments array.
            response.body.error ? this.error = response.body.error : this.shipments = response.body;
            // The request is finished, change the loading to false again.
            this.loading = false;
            // Clear the query.
            this.query = '';
        });
    }
}
});
