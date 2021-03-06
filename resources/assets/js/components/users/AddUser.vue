<template>
<v-layout row justify-center>
    <v-dialog v-model="openAddRequest" persistent max-width="700px">
        <v-card>
            <v-card-title fixed>
                <span class="headline">Add User</span>
            </v-card-title>
            <v-card-text>
                <v-container grid-list-md>
                    <v-layout wrap v-show="!loader">
                        <v-form ref="form" @submit.prevent>
                            <v-container grid-list-xl fluid>
                                <v-layout wrap>
                                    <v-flex xs12 sm6>
                                        <v-text-field v-model="form.name" :rules="rules.name" color="purple darken-2" label="Full name" required></v-text-field>
                                        <small class="has-text-danger" v-if="errors.name">{{ errors.name[0] }}</small>
                                    </v-flex>
                                    <v-flex xs12 sm6>
                                        <v-text-field v-model="form.email" :rules="emailRules" color="blue darken-2" label="Email" required></v-text-field>
                                        <small class="has-text-danger" v-if="errors.email">{{ errors.email[0] }}</small>
                                    </v-flex>
                                    <v-flex xs12 sm6>
                                        <v-text-field :append-icon="e1 ? 'visibility_off' : 'visibility'" :type="e1 ? 'password' : 'text'" v-model="form.password" name="input-10-2" label="Enter your password" hint="At least 6 characters" min="8" value="" class="input-group--focused"></v-text-field>
                                        <small class="has-text-danger" v-if="errors.password">{{ errors.password[0] }}</small>
                                    </v-flex>
                                    <v-flex xs12 sm6>
                                        <v-text-field v-model="form.address" :rules="rules.name" color="blue darken-2" label="Address" required></v-text-field>
                                        <small class="has-text-danger" v-if="errors.address">{{ errors.address[0] }}</small>
                                    </v-flex>
                                    <v-flex xs12 sm6>
                                        <v-text-field v-model="form.city" :rules="rules.name" color="blue darken-2" label="City" required></v-text-field>
                                        <small class="has-text-danger" v-if="errors.city">{{ errors.city[0] }}</small>
                                    </v-flex>
                                    <v-flex xs12 sm6>
                                        <v-text-field v-model="form.country" :rules="rules.name" color="blue darken-2" label="Country" required></v-text-field>
                                        <small class="has-text-danger" v-if="errors.country">{{ errors.country[0] }}</small>
                                    </v-flex>
                                    <v-flex xs12 sm6>
                                        <v-text-field v-model="form.phone" :rules="rules.name" color="blue darken-2" label="Phone" required></v-text-field>
                                        <small class="has-text-danger" v-if="errors.phone">{{ errors.phone[0] }}</small>
                                    </v-flex>
                                    <v-flex xs12 sm6>
                                        <v-text-field v-model="form.zipcode" :rules="rules.name" color="blue darken-2" label="Zip Code" required></v-text-field>
                                        <small class="has-text-danger" v-if="errors.zipcode">{{ errors.zipcode[0] }}</small>
                                    </v-flex>

                                    <small class="has-text-danger" v-if="errors.branch">{{ errors.branch[0] }}</small>
                                    <!-- </v-flex> -->
                                    <select class="custom-select custom-select-md col-md-3" v-model="form.role_id">
                      <option value="1">Admin</option>
                      <option value="2">Company Admin</option>
                      <option value="3">Customer</option>
                      <option value="4">Driver</option>
                    </select>
                                    <select class="custom-select custom-select-md col-md-3" v-model="form.branch_id">
                      <option v-for="branches in AllBranches" :key="branches.id" :value="branches.id">{{ branches.branch_name }}</option>
                    </select>
                                </v-layout>
                            </v-container>
                            <v-card-actions>
                                <v-btn flat @click="resetForm">reset</v-btn>
                                <v-btn flat @click="close">Close</v-btn>
                                <v-spacer></v-spacer>
                                <v-btn :disabled="loading" flat color="primary" @click="save" :loading="loading">Submit</v-btn>
                            </v-card-actions>
                        </v-form>
                    </v-layout>
                    <div v-show="loader" style="text-align: center; width: 100%;">
                        <v-progress-circular :width="3" indeterminate color="red" style="margin: 1rem"></v-progress-circular>
                    </div>
                </v-container>
            </v-card-text>
        </v-card>
    </v-dialog>
</v-layout>
</template>

<script>
export default {
    props: ['openAddRequest', 'AllBranches'],
    data() {
        const defaultForm = Object.freeze({
            name: '',
            password: '',
            email: '',
            phone: null,
            zipcode: null,
            branch: '',
            address: '',
            city: '',
            country: '',
        })
        return {
            loading: false,
            errors: {},
            defaultForm,
            loader: false,
            e1: false,
            form: Object.assign({}, defaultForm),
            emailRules: [
                v => {
                    return !!v || 'E-mail is required'
                },
                v => /^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/.test(v) || 'E-mail must be valid'
            ],
            rules: {
                name: [val => (val || '').length > 0 || 'This field is required']
            },
        }
    },
    methods: {
        save() {
            this.loading = true
            axios.post('/users', this.$data.form).
            then((response) => {
                    this.loading = false
                    console.log(response);
                    this.$parent.Allusers.push(response.data)
                    this.close;
                    this.resetForm();
                    this.$emit('closeRequest');
                    this.$emit('alertRequest');

                })
                .catch((error) => {
                    this.loading = false
                    this.errors = error.response.data.errors
                })
        },
        resetForm() {
            this.form = Object.assign({}, this.defaultForm)
            this.$refs.form.reset()
        },
        close() {
            this.$emit('closeRequest')
        },
    },
    mounted() {
        axios.post('getCompanyAdmin')
            .then((response) => {
                this.Allusers = response.data
            })
            .catch((error) => {
                this.errors = error.response.data.errors
            })
    },
    computed: {
        formIsValid() {
            return (
                this.form.name &&
                this.form.email &&
                this.form.phone &&
                this.form.password &&
                this.form.zipcode &&
                this.form.branch &&
                this.form.address &&
                this.form.city &&
                this.form.country
            )
        },
    },
    mounted() {

    }
}
</script>
