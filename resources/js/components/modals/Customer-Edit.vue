<template>
    <div>
        <b-modal
            id="modal-customer-edit"
            ref="modal"
            title="Edit Customer"
            @show="resetModal"
            @hidden="resetModal"
            @ok="handleOk"
        >       
            <form ref="form" @submit.stop.prevent="handleSubmit">
                <b-form-group
                label="Customer Name"
                label-for="name-input"
                invalid-feedback="Customer name is already exists"
                >
                <b-form-input
                    id="name-input"
                    v-model="csname"
                    required
                ></b-form-input>
                </b-form-group>

                 <b-form-group
                label="Phone Number"
                label-for="Number-input"
                invalid-feedback="Number name is already exists"
                >
                <b-form-input
                    id="Number-input"
                    v-model="number"
                    required
                ></b-form-input>
                </b-form-group>

                 <b-form-group
                label="Description"
                label-for="des-input"
                invalid-feedback="Description is already exists"
                >
                <b-form-input
                    id="des-input"
                    v-model="description"
                    required
                ></b-form-input>
                </b-form-group>
            </form>
    </b-modal>
    </div>
</template>
<script>
export default {
    name:'CustomerEdit',
    data() {
      return {
        csname:'',
        nameState: null,
        number: '',
        companyNameState: null,
        description: '',
        phoneNumberState: null,
        submittedNames: [],
      }
    },
    methods: {
        // async getEvents() {
        //     await axios.get("/api/category/check/" + this.name)
        //         .then((response) => {
        //             res = response.data;
        //             console.log(res);
                   
        //         })
        //         .catch((error) => {
        //             console.log(error);
        //         });
        //     return res;
        //     },
        checkFormValidity() {
            // async axios.get("/api/category/check/" + this.name)
            //     .then((response) => {
            //         res = response.data;
            //         console.log(res);
                   
            //     })
            //     .catch((error) => {
            //         console.log(error);
            //     });
        const valid = true
        this.nameState = valid
        return valid
      },
      resetModal() {
      },
      handleOk(bvModalEvt) {
        // Prevent modal from closing
        bvModalEvt.preventDefault()

        // Trigger submit handler
        this.handleSubmit()
      },
      handleSubmit() {
        axios.post('/api/cusedit', {
                id: this.$route.params.id,
                name: this.csname,
                number: this.number,
                description: this.description,
            })
            .then(response =>{
              if (response.data) {
                alert('Updated')
              }
                this.$emit('getCustomer')                
                this.$emit('getInvoice')                
            })
            .catch(error =>{
            console.log(error);
            })
        // Exit when the form isn't valid
        if (!this.checkFormValidity()) {
          return
        }
        // Push the name to submitted names
        
        // Hide the modal manually
        this.$nextTick(() => {
          this.$bvModal.hide('modal-customer-edit')
        })
      },
      getcustomerdet() {
            axios
                .get("/api/customer/"+this.$route.params.id)
                .then((response) => {
                  console.log(response.data[0].phone_number);
                    this.csname= response.data[0].name;
                    this.number= response.data[0].phone_number;
                    this.description= response.data[0].description;
                })

                .catch((error) => {
                    console.log(error);
                });
        },
    },
    mounted: function () {
        this.getcustomerdet();
    },
  }
</script>