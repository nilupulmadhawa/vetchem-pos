<template>
    <div>
        <b-modal
            id="modal-supplier-d"
            ref="modal"
            title="Edit Supplier"
            @show="resetModal"
            @hidden="resetModal"
            @ok="handleOk"
        >       
            <form ref="form" @submit.stop.prevent="handleSubmit">
                <b-form-group
                label="Supplier Name"
                label-for="name-input"
                invalid-feedback="Supplier name is already exists"
                :state="nameState"
                >
                <b-form-input
                    id="name-input"
                    v-model="name"
                    :state="nameState"
                    required
                ></b-form-input>
                </b-form-group>

                 <b-form-group
                label="Company"
                label-for="company-input"
                invalid-feedback="Company name is already exists"
                :state="companyNameState"
                >
                <b-form-input
                    id="company-input"
                    v-model="companyName"
                    :state="companyNameState"
                    required
                ></b-form-input>
                </b-form-group>

                 <b-form-group
                label="Phoner Number"
                label-for="number-input"
                invalid-feedback="Phone Number is already exists"
                :state="phoneNumberState"
                >
                <b-form-input
                    id="number-input"
                    v-model="phoneNumber"
                    :state="phoneNumberState"
                    required
                ></b-form-input>
                </b-form-group>
            </form>
    </b-modal>
    </div>
</template>
<script>
export default {
    name:'SupplierEdit',
    data() {
      return {
        name:'asd',
        nameState: null,
        companyName: 'sdsd',
        companyNameState: null,
        phoneNumber: 'dsad',
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
        axios.post('/api/supplierup', {
                id: this.$route.params.id,
                name: this.name,
                company: this.companyName,
                phone_number: this.phoneNumber,
            })
            .then(response =>{
              console.log(response.data);
                this.$emit('getSupplier')                
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
          this.$bvModal.hide('modal-supplier-d')
        })
      },
      getSupplierdet() {
            axios
                .get("/api/supplier/"+this.$route.params.id)
                .then((response) => {
                  console.log(response.data[0].phone_number);
                    this.name= response.data[0].name;
                    this.companyName= response.data[0].company;
                    this.phoneNumber= response.data[0].phone_number;
                })

                .catch((error) => {
                    console.log(error);
                });
        },
    },
    mounted: function () {
        // this.getSupplierdet();
    },
  }
</script>