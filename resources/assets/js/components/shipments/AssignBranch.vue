<template>
  <v-layout row justify-center>
      
        <v-dialog v-model="OpenAssignBranch" persistent width="500px">
  
          <v-card v-if="OpenAssignBranch">
  
            <v-card-title>
  
              Assign Branch
  
            </v-card-title>
  
            <v-container grid-list-md>
  
              <v-layout row wrap>
  
                <v-flex xs12>
  
                  <v-card>
  
                <select class="custom-select custom-select-md col-md-12" v-model="form.branch_id" style="font-size: 15px;">
  
                  <option v-for="branch in AllBranches" :key="branch.id" :value="branch.id">{{ branch.branch_name }}</option>
  
                </select>
  
                    <v-flex xs12 sm12>
  
                      <v-textarea v-model="form.remark" color="blue">
  
                        <div slot="label">
  
                          Remark <small>(optional)</small>
  
                        </div>
  
                      </v-textarea>
  
                    </v-flex>
  
  
                  </v-card>
  
                </v-flex>
  
              </v-layout>
  
               <v-card-actions>
                  <v-btn flat @click="close">Close</v-btn>
                    <v-spacer></v-spacer>
                  <v-btn color="primary" flat @click="branchAssign" :loading="loading" :disabled="loading">Update Branch</v-btn>
                </v-card-actions>
        
              </v-container>
  
            <v-divider></v-divider>
  
          </v-card>
        </v-dialog>

  </v-layout>
</template>

<script>
export default {
  props: ['OpenAssignBranch', 'updateitedItem', 'selectedItems', 'AllBranches'],
  data () {

    return {
      loading: false,

      snackbar: false,

      timeout: 5000,

      message: "",

      color: "",
      
      form: {},
    }
  },  

  methods: {
    branchAssign() {
      // alert(this.updateitedItem.id);
      this.loading = true
      axios
        .post(`/assignBranch`, {selected: this.selectedItems ,form: this.form})

        .then(response => {
          this.loading = false
          this.$emit("alertRequest");
        //   this.$emit("closeRequest");
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

  mounted() {
  }
}
</script>