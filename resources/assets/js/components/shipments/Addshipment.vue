<template>
<v-layout row justify-center>
    <v-dialog v-model="addShipment" persistent>
        <v-card>
            <v-card-title>
                Add Shipment
            </v-card-title>
            <v-container grid-list-md v-show="!loader">
                <v-card-text>
                    <v-layout wrap>
                        <v-form ref="form" @submit.prevent="submit">
                            <v-container grid-list-xl fluid>
                                <v-layout wrap>
                                    <!-- <div v-for="client in Allcustomer" :key="client.id" v-if="client.id = selectC.id"> -->

                                    <!--  -->
                                    <v-flex sm6>
                                        <h3><b>Pickup At</b></h3>
                                        <v-divider></v-divider>
                                        <v-layout wrap>
                                            <v-flex xs6 sm6>
                                                <v-text-field v-model="user.name" :rules="rules.name" color="blue darken-2" label="Client name" required></v-text-field>
                                            </v-flex>
                                            <!-- </div> -->
                                            <v-flex xs6 sm6>
                                                <v-text-field v-model="user.email" :rules="emailRules" color="blue darken-2" label="Client Email" required></v-text-field>
                                            </v-flex>
                                            <v-flex xs6 sm6>
                                                <v-text-field v-model="user.address" :rules="rules.name" color="blue darken-2" label="Client Address" required></v-text-field>
                                            </v-flex>
                                            <v-flex xs6 sm6>
                                                <v-text-field v-model="user.city" :rules="rules.name" color="blue darken-2" label="Client City" required></v-text-field>
                                            </v-flex>
                                            <v-flex xs6 sm6>
                                                <v-text-field v-model="user.phone" color="blue darken-2" label="Client Phone" required></v-text-field>
                                            </v-flex>

                                            <v-flex xs6 sm6>
                                                <v-text-field v-model="user.postal_code" :rules="rules.name" color="blue darken-2" label="Assigned Staff" required></v-text-field>
                                            </v-flex>
                                            <v-flex xs6 sm6>
                                                <v-text-field v-model="user.country" :rules="rules.name" color="blue darken-2" label="Assigned Staff" required></v-text-field>
                                            </v-flex>

                                            <v-flex xs6 sm6>
                                                <v-text-field v-model="form.from_city" :rules="rules.name" color="blue darken-2" label="From" required></v-text-field>
                                            </v-flex>
                                        </v-layout>
                                    </v-flex>
                                    <v-flex sm6>
                                        <h3><b>Deriver To</b></h3>
                                        <v-divider></v-divider>
                                        <v-layout wrap>
                                            <v-flex xs6 sm6>
                                                <v-text-field v-model="form.client_name" :rules="rules.name" color="blue darken-2" label="Client name" required></v-text-field>
                                            </v-flex>
                                            <!-- </div> -->
                                            <v-flex xs6 sm6>
                                                <v-text-field v-model="form.client_email" :rules="emailRules" color="blue darken-2" label="Client Email" required></v-text-field>
                                            </v-flex>
                                            <v-flex xs6 sm6>
                                                <v-text-field v-model="form.client_address" :rules="rules.name" color="blue darken-2" label="Client Address" required></v-text-field>
                                            </v-flex>
                                            <v-flex xs6 sm6>
                                                <v-text-field v-model="form.client_city" :rules="rules.name" color="blue darken-2" label="Client City" required></v-text-field>
                                            </v-flex>
                                            <v-flex xs6 sm6>
                                                <v-text-field v-model="form.client_phone" color="blue darken-2" label="Client Phone" required></v-text-field>
                                            </v-flex>

                                            <v-flex xs6 sm6>
                                                <v-text-field v-model="form.postal_code" :rules="rules.name" color="blue darken-2" label="Assigned Staff" required></v-text-field>
                                            </v-flex>
                                            <v-flex xs6 sm6>
                                                <v-text-field v-model="form.to_city" :rules="rules.name" color="blue darken-2" label="To" required></v-text-field>
                                            </v-flex>
                                        </v-layout>
                                    </v-flex>
                                    <v-layout wrap>
                                        <v-flex sm12>
                                            <h3><b>Parcel Details</b></h3>
                                            <v-divider></v-divider>
                                            <v-layout wrap>
                                                <div v-for="product in form.products">
                                                    <v-flex xs12>
                                                        <v-textarea v-model="product.product_name" color="blue">
                                                            <div slot="label">
                                                                Product Description
                                                            </div>
                                                        </v-textarea>
                                                    </v-flex>
                                                    <v-flex sm12>
                                                        <v-text-field v-model="form.to_city" :rules="rules.name" color="blue darken-2" label="# of Pieces" required></v-text-field>
                                                    </v-flex>
                                                    <v-flex xs12 sm12>
                                                        <v-text-field v-model="product.quantity" color="blue darken-2" label="Quantity" required></v-text-field>
                                                    </v-flex>
                                                    <v-flex xs12 sm12>
                                                        <v-text-field v-model="product.price" color="blue darken-2" label="Price" required></v-text-field>
                                                    </v-flex>
                                                    <v-flex sm12>
                                                        <v-text-field v-model="product.weight" :rules="rules.name" color="blue darken-2" label="Total Weight" required></v-text-field>
                                                    </v-flex>
                                                     <v-flex xs12 sm12>
                                                        <v-text-field v-model="form.booking_date" :type="'date'" color="blue darken-2" label="Booking Date" required></v-text-field>
                                                    </v-flex>

                                                    <v-flex xs12 sm12>
                                                        <v-text-field v-model="form.derivery_date" :type="'date'" color="blue darken-2" label="Deriery Date" required></v-text-field>
                                                    </v-flex>

                                                     <v-flex xs12 sm12>
                                                        <v-text-field v-model="form.derivery_time" :type="'time'" color="blue darken-2" label="Ready Time" required></v-text-field>
                                                    </v-flex>
                                                    <v-flex xs12 sm12>
                                                        <v-select :items="Allcustomer" v-model="selectC" :hint="`${selectC.name}`" label="Select Client" single-line item-text="name" item-value="id" return-object persistent-hint></v-select>
                                                    </v-flex>
                                                    <v-flex xs12 sm12>
                                                        <v-select :items="AllDrivers" v-model="selectD" :hint="`${select.name}`" label="Select Driver" single-line item-text="name" item-value="id" return-object persistent-hint></v-select>
                                                    </v-flex>
                                                    <v-flex xs12 sm12>
                                                        <v-select :items="AllBranches" v-model="selectB" :hint="`${selectB.branch_name}`" label="Select Branch" single-line item-text="branch_name" item-value="id" return-object persistent-hint></v-select>
                                                    </v-flex>
                                                    <v-btn @click="remove(product)" icon class="mx-0">
                                                        <v-icon color="pink darken-2" small>delete</v-icon>
                                                    </v-btn>
                                                </div>

                                                <v-divider></v-divider>
                                                
                                                <v-flex xs12 sm12>
                                                    <v-text-field v-model="subTotal" color="blue darken-2" label="Price" disabled></v-text-field>
                                                </v-flex>
                                                <v-btn color="primary" flat @click="add_product">Add product</v-btn>
                                            </v-layout>
                                        </v-flex>
                                    </v-layout>

                                    <v-flex xs12 sm12>
                                        <v-layout wrap>
                                            <v-divider></v-divider>

                                            <v-flex sm4>
                                                <h3><b>Service Type</b></h3>
                                                <v-divider></v-divider>
                                                <v-layout wrap>
                                                    <select class="custom-select custom-select-md col-md-3" v-model="form.shipment_type">
                                                        <option value="yes">Type A</option>
                                                        <option value="no">Type B</option>
                                                    </select>
                                                </v-layout>
                                            </v-flex>
                                            <v-flex sm4>
                                                <h3><b>Package Type</b></h3>
                                                <v-divider></v-divider>
                                                <v-layout wrap>
                                                    <select class="custom-select custom-select-md col-md-3" v-model="form.shipment_type">
                                                        <option value="yes">Type A</option>
                                                        <option value="no">Type B</option>
                                                    </select>
                                                </v-layout>
                                            </v-flex>
                                            <v-flex sm4>
                                                <h3><b>Special Instructions</b></h3>
                                                <v-divider></v-divider>
                                                <v-layout wrap>
                                                    <v-flex xs12 sm12>

                                                        <v-textarea v-model="form.remark" color="blue">
                                                            <div slot="label">
                                                                Instructions
                                                            </div>
                                                        </v-textarea>
                                                    </v-flex>
                                                    <div class="form-group col-md-4">
                                                        <label for="insurance" class="col-md-4 col-form-label text-md-right">Insuarance</label>
                                                        <select class="custom-select" v-model="form.insuarance_status">
                                                            <option value="yes">Yes</option>
                                                            <option value="no">No</option>
                                                        </select>
                                                    </div>
                                                    <!-- </div>  -->
                                                    <div class="form-group col-md-4">
                                                        <label for="payment" class="col-md-4 col-form-label text-md-right">Paid</label>
                                                        <select class="custom-select custom-select-md col-md-3" v-model="form.payment">
                                                            <option value="yes">Yes</option>
                                                            <option value="no">No</option>
                                                        </select>
                                                    </div>
                                                </v-layout>
                                            </v-flex>
                                        </v-layout>
                                    </v-flex>
                                    <!--  -->

                                </v-layout>
                                <div class="row">

                                </div>
                                <v-flex xs6 sm6>
                                    <v-text-field v-model="form.bar_code" color="blue darken-2" label="Barcode" required></v-text-field>
                                </v-flex>
                                <barcode v-bind:value="form.bar_code"></barcode>
                            </v-container>
                        </v-form>
                    </v-layout>
                    <!-- <v-layout wrap>
                        <div v-for="product in form.products">
                            <v-flex xs12>
                                <v-textarea v-model="product.product_name" color="blue">
                                    <div slot="label">
                                        Product Description
                                    </div>
                                </v-textarea>
                            </v-flex>
                            <v-flex xs12 sm12>
                                <v-text-field v-model="product.weight" :rules="rules.name" color="blue darken-2" label="Product Weight" required></v-text-field>
                            </v-flex>
                            <v-flex xs12 sm12>
                                <v-text-field v-model="product.quantity" color="blue darken-2" label="Quantity" required></v-text-field>
                            </v-flex>
                            <v-flex xs12 sm12>
                                <v-text-field v-model="product.price" color="blue darken-2" label="Price" required></v-text-field>
                            </v-flex>
                            <v-btn @click="remove(product)" icon class="mx-0">
                                <v-icon color="pink darken-2" small>delete</v-icon>
                            </v-btn>
                        </div>
                    </v-layout> -->
                </v-card-text>
                <v-card-actions>
                    <v-btn flat @click="resetForm">reset</v-btn>
                    <v-btn flat @click="close">Close</v-btn>
                    <v-spacer></v-spacer>
                    <v-btn flat color="primary" @click="save" :loading="loading" :disabled="loading">Add Shipment</v-btn>
                </v-card-actions>
            </v-container>
            <div v-show="loader" style="text-align: center">
                <v-progress-circular :width="3" indeterminate color="red" style="margin: 1rem"></v-progress-circular>
            </div>
        </v-card>
    </v-dialog>
</v-layout>
</template>

<script>
import VueBarcode from "vue-barcode";
export default {
    props: ["addShipment", "user"],
    components: {
        barcode: VueBarcode
    },
    data() {
        const defaultForm = Object.freeze({
            client_name: "",
            client_phone: "",
            client_email: "",
            client_address: "",
            client_city: "",
            assign_staff: "",
            airway_bill_no: "",
            shipment_type: "",
            payment: "",
            total_freight: "",
            insuarance_status: "",
            booking_date: null,
            derivery_date: null,
            derivery_time: null,
            bar_code: "",
            getTotal: '',
            products: [{
                product_name: '',
                weight: null,
                quantity: 1,
                price: 0,
            }],
        });
        return {
            AllDrivers: [],
            Allcustomer: [],
            AllBranches: [],
            loading: false,
            selectD: {
                name: 'Select Driver'
            },
            selectC: {
                name: 'Select Client'
            },
            selectB: {
                branch_name: 'Select Name'
            },
            select: [],
            notifications: false,
            list: {},
            loader: false,
            dmodal1: false,
            pdialog2: false,
            dmodal2: false,
            tmodal: false,
            sound: true,
            widgets: false,
            form: Object.assign({}, defaultForm),
            emailRules: [
                v => {
                    return !!v || "E-mail is required";
                },
                v =>
                /^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/.test(v) ||
                "E-mail must be valid"
            ],
            rules: {
                name: [val => (val || "").length > 0 || "This field is required"]
            },
            items: [{
                    state: "Yes",
                    abbr: "yes"
                },
                {
                    state: "No",
                    abbr: "no"
                }
            ]
        };
    },
    methods: {
        save() {
            this.loading = true;
            axios
                .post("/shipment", {
                    form: this.$data.form,
                    selectD: this.$data.selectD,
                    selectC: this.$data.selectC,
                    selectB: this.$data.selectB,
                    user: this.user
                })
                .then(response => {
                    this.loading = false;
                    // console.log(response);
                    this.$emit('alertRequest');
                    // this.$emit('closeRequest');
                    this.$parent.AllShipments.push(response.data);
                    // this.$emit('closeRequest');
                    this.resetForm;
                })
                .catch(error => {
                    this.loading = false;
                    this.errors = error.response.data.errors;
                });
        },
        close() {
            this.$emit("closeRequest");
        },
        resetForm() {
            this.form = Object.assign({}, this.defaultForm);
            this.$refs.form.reset();
        },
        add_product() {
            this.form.products.push({
                product_name: '',
                weight: '',
                quantity: 1,
                price: 0,
            })
        },
        remove(product) {
            const index = this.form.products.indexOf(product)
            this.form.products.splice(index, 1)
        }
    },
    computed: {
        subTotal: function () {
            return this.form.products.reduce(function (carry, product) {
                return carry + parseFloat(product.price);
            }, 0);
        },
        // vat: function() {
        //     return this.grandTotal * parseFloat(0.16);
        //     // (this.subTotal - parseFloat(this.form.discount)) * parseFloat(0.16);
        // },
        // grandTotal: function() {
        //     return this.subTotal - parseFloat(this.form.discount);
        // },
        formIsValid() {
            return (
                this.form.client_name &&
                this.form.client_phone &&
                this.form.client_email &&
                this.form.client_address &&
                this.form.client_city &&
                this.form.assign_staff &&
                this.form.airway_bill_no &&
                this.form.total_weight &&
                this.form.shipment_type &&
                this.form.payment &&
                this.form.total_freight &&
                this.form.insuarance_status &&
                this.form.booking_date &&
                this.form.derivery_date
            );
        }
    },
    mounted() {
        axios
            .get("/getDrivers")
            .then(response => {
                this.AllDrivers = response.data;
                this.loader = false;
            })
            .catch(error => {
                console.log(error);
                this.errors = error.response.data.errors;
            });
        axios
            .get("/getCustomer")
            .then(response => {
                this.Allcustomer = response.data;
                this.loader = false;
            })
            .catch(error => {
                console.log(error);
                this.errors = error.response.data.errors;
            });
        axios
            .get("/getBranch")
            .then(response => {
                this.AllBranches = response.data;
            })
            .catch(error => {
                console.log(error);
                this.errors = error.response.data.errors;
            });
    },
};
</script>
