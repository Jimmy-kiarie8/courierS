<template>
<v-layout row justify-center>

    <v-dialog v-model="UpdateShipment" persistent width="500px">
        <v-card v-if="UpdateShipment">
            <v-card-title>
                Update Shipment
            </v-card-title>
            <v-container grid-list-md>
                <v-layout row wrap>
                    <v-container fill-height>

                        <v-card>
                            <!-- <v-flex xs12 sm12>
                                <v-text-field
                                v-model="updateitedItem.client_city"
                                :rules="rules.name"
                                color="blue darken-2"
                                label="Current City"
                                required
                                ></v-text-field>
                            </v-flex> -->
                            <!-- <vue-google-autocomplete ref="address" id="map" classname="form-control" placeholder="Please type your address" v-on:placechanged="getAddressData" country="ke"></vue-google-autocomplete> -->
                            <!-- <select class="custom-select custom-select-md col-md-12" v-model="updateitedItem.status">
                                <option value="waiting_pproval">Awaiting Approval</option>
                                <option value="approved">Approved</option>
                            </select> -->
                            <select class="custom-select custom-select-md col-md-12" v-model="updateitedItem.status">
                                <option value="Awaiting Approval">Awaiting Approval</option>
                                <option value="Approved">Approved</option>
                                <option value="Arrived">Arrived</option>
                                <option value="Awaiting Confirmation">Awaiting Confirmation</option>
                                <option value="Cancelled">Cancelled</option>
                                <option value="Cleared">Cleared</option>
                                <option value="Delivered">Delivered</option>
                                <option value="Despatched">Despatched</option>
                                <!-- <option value="Cancled">Cancled</option> -->
                                <option value="Hold">Hold</option>
                                <option value="Not Peaking">Not Peaking</option>
                                <option value="Out For Destination">Out For Destination</option>
                                <option value="Out For Delivery">Out For Delivery</option>
                                <option value="Returned">Returned</option>
                                <option value="Ready For Depart">Ready For Depart</option>
                                <option value="Scheduled">Scheduled</option>
                                <option value="Shipment Collected">Shipment Collected</option>
                                <option value="Transit">Transit</option>
                                <option value="Waiting for Scan">Waiting for scan</option>
                            </select>
                            <div v-if="updateitedItem.status === 'scheduled'">
                                <v-flex xs12 sm12>
                                    <v-text-field v-model="updateitedItem.scheduled_date" color="blue darken-2" label="Schedule Date" type="date"></v-text-field>
                                </v-flex>
                                <v-flex xs12 sm12>
                                    <v-text-field v-model="updateitedItem.derivery_time" color="blue darken-2" label="Schedule Time" type="time"></v-text-field>
                                </v-flex>
                                <v-flex xs4 sm12>
                                    <v-text-field v-model="updateitedItem.location" color="blue darken-2" label="Location" required></v-text-field>
                                </v-flex>
                            </div>
                            <v-flex xs12 sm12>
                                <v-textarea v-model="updateitedItem.remark" color="blue">
                                    <div slot="label">
                                        Remark <small>(optional)</small>
                                    </div>
                                </v-textarea>
                            </v-flex>
                            <v-btn color="primary" flat @click="UpdateStatus" :loading="loading" :disabled="loading">Update Status</v-btn>
                        </v-card>
                    </v-container>
                </v-layout>
                <v-divider></v-divider>
                <v-divider></v-divider>
                <v-card-actions>
                    <v-btn flat @click="close">Close</v-btn>
                </v-card-actions>
            </v-container>
            <v-divider></v-divider>
        </v-card>
    </v-dialog>

</v-layout>
</template>

<script>
// import VueGoogleAutocomplete from "vue-google-autocomplete";
export default {
    props: ['UpdateShipment', 'AllProducts', 'updateitedItem'],
    components: {
        // VueGoogleAutocomplete,
    },
    data() {

        return {
            loading: false,

        }
    },

    methods: {
        UpdateStatus() {
            // alert(this.updateitedItem.id);
            this.loading = true
            axios
                .post(`/updateStatus/${this.updateitedItem.id}`, {
                    formobg: this.updateitedItem,
                    address: this.address
                })
                .then(response => {
                    this.loading = false
                })
                .catch(error => {
                    this.loading = false;
                    this.errors = error.response.data.errors;
                });
        },

        // getAddressData: function(addressData, placeResultData, id) {
        //   this.address = addressData;
        // },

        close() {
            this.$emit("closeRequest");
        },

    },

    mounted() {
        // this.$refs.address.focus();
    }
}
</script>
