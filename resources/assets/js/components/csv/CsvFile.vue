<template>
<v-dialog v-model="OpenCsv" persistent width="400px">
    <v-card>
        <v-card-title>
            Upload Excel Shipment
        </v-card-title>
        <v-container grid-list-md>
            <v-card-text>
                <v-layout wrap>

                    <form action="csv/import" method="post" enctype="multipart/form-data">
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Paid</label>
                            <!-- <div class="col-md-12"> -->
                            <select class="custom-select custom-select-md col-md-3" name="client">
                                <option v-for="client in Allcustomers" :key="client.id" :value="client.id">{{ client.name }}</option>
                            </select>
                        </div>

                        <v-btn color="red" darken-1 raised @click="onPickFile" style="color: #fff;">Upload</v-btn>
                        <input type="file" name="shipment" id="csv" ref="fileInput" style="display: none">
                        <v-divider></v-divider>
                        <v-card-actions>
                            <v-btn flat @click="close">Close</v-btn>
                            <v-spacer></v-spacer>
                            <v-btn flat type="submit" color="primary">Upload</v-btn>
                        </v-card-actions>
                    </form>
                </v-layout>
            </v-card-text>
        </v-container>
    </v-card>
</v-dialog>
</template>

<script>
export default {
    props: ['OpenCsv'],
    data() {
        return {
            imagePlaced: false,
            Allcustomers: [],
        }
    },
    methods: {
        onPickFile() {
            this.$refs.fileInput.click()
        },
        close() {
            this.$emit('closeRequest')
        }
    },

    mounted() {
        axios
            .get("getCustomer")

            .then(response => {
                this.Allcustomers = response.data;

                this.loader = false;
            })

            .catch(error => {
                this.errors = error.response.data.errors;

                this.loader = false;
            });

    },
}
</script>
