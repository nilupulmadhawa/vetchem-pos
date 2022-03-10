<template>
    <div>
        <b-modal
            id="modal-supplier"
            ref="modal"
            title="Add Brand"
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
    name:'Supplier',
    data() {
      return {
        name: '',
        nameState: null,
        companyName: '',
        companyNameState: null,
        phoneNumber: '',
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
        this.name = ''
        this.nameState = null
        this.companyName = ''
        this.companyNameState = null
        this.phoneNumber = ''
        this.phoneNumberState = null
      },
      handleOk(bvModalEvt) {
        // Prevent modal from closing
        bvModalEvt.preventDefault()

        // Trigger submit handler
        this.handleSubmit()
      },
      handleSubmit() {
         
        axios.post('/api/supplier', {
                name: this.name,
                company: this.companyName,
                phone_number: this.phoneNumber,
            })
            .then(response =>{
              console.log(response.data);
                this.$emit('getSuppliers')                
            })
            .catch(error =>{
            console.log(error);
            })
        // Exit when the form isn't valid
        if (!this.checkFormValidity()) {
          return
        }
        // Push the name to submitted names
        
        this.submittedNames.push(this.name)
        // Hide the modal manually
        this.$nextTick(() => {
          this.$bvModal.hide('modal-supplier')
        })
      }
    }
  }
</script>