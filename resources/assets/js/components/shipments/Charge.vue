<template>
<v-layout row justify-center>
    <v-dialog v-model="mySCharges" persistent width="500px">
        <v-card v-if="mySCharges">
            <v-card-title>
                Charges
            </v-card-title>
            <v-container grid-list-md>
                <v-layout row wrap>
                    <v-flex xs12>
                        <v-container fill-height>
                            <v-layout align-center>
                                <v-flex sm12>
                                    <div class="form-group col-md-12">
                                        <label for="type" class="col-md-4 col-form-label text-md-right">Shipment Type</label>
                                        <select class="custom-select" v-model="form.type">
                                            <option value="OverNight">OverNight</option>
                                            <option value="Distance">Distance Based</option>
                                        </select>
                                    </div>
                                    <div v-if="form.type === 'OverNight'">
                                        <v-select :items="AllBranches" v-model="select" :hint="`${select.branch_name}, ${select.id}`" label="Select Branch" single-line item-text="branch_name" item-value="id" return-object persistent-hint></v-select>
                                    </div>
                                    <div v-if="form.type === 'Distance'">
                                        <v-flex sm12>
                                            <v-text-field v-model="form.distance" color="blue darken-2" label="Distance" type="number" required></v-text-field>
                                        </v-flex>
                                    </div>
                                        <v-flex sm12>
                                            <v-text-field v-model="form.charges" color="blue darken-2" label="Distance" disabled></v-text-field>
                                        </v-flex>
                                </v-flex>
                            </v-layout>
                        </v-container>
                    </v-flex>
                </v-layout>
                <v-card-actions>
                    <v-btn flat @click="close">Close</v-btn>
                    <v-spacer></v-spacer>
                    <v-btn flat @click="update" :loading="loading" :disabled="loading" color="primary">Update</v-btn>
                </v-card-actions>
            </v-container>
        </v-card>
    </v-dialog>
</v-layout>
</template>

<script>
export default {
    props: ['updateCharges', 'mySCharges'],
    data() {
        return {
            AllBranches: [],
            form: {
                type: '',
                distance: '',
                charges: '',
            },
            select: [],
            loading: false
        }
    },
    methods: {
        update() {
            this.loading = true;
            axios.post(`/shipCharge/${this.updateCharges.id}`, {
                form: this.form,
                select: this.select
                })
                .then(response => {
                    this.loading = false;
                    // console.log(response);
                    this.$emit('alertRequest');
                    // this.$emit('closeRequest');
                    // this.close()
                })
                .catch(error => {
                    this.loading = false;
                    this.errors = error.response.data.errors;
                });
        },
        close() {
            this.$emit("closeRequest");
        },
    },
    //   computed: { 
  
    //   subTotal: function() {
    //       for (let i = 0; i < select.charges.length; i++) {
    //           const charges = select.charges['charge'];
    //       }
    //     return charges.reduce(function(carry, product) {
    //       return carry + (parseFloat(charges))
    //     }, 0);
    //   },  
    // },
    mounted() {
        axios
            .get("/getBranchCharge")

            .then(response => {
                this.AllBranches = response.data;

                this.loader = false;
            })

            .catch(error => {
                console.log(error);

                this.errors = error.response.data.errors;

                this.loader = false;
            });
    },
}
</script>
