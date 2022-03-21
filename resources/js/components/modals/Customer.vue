<template>
    <div>
        <b-modal
            id="modal-customer"
            ref="modal"
            title="Add Customer"
            @show="resetModal"
            @hidden="resetModal"
            @ok="handleOk"
        >       
            <form ref="form" @submit.stop.prevent="handleSubmit">
                <b-form-group
                label="Customer Name"
                label-for="name-input"
                invalid-feedback="Name name is already exists"
                :state="nameState"
                >
                  <b-form-input
                    id="name-input"
                    v-model="name"
                    :state="nameState"
                    required
                  > </b-form-input>
                  </b-form-group>
                <b-form-group
                label="phone Number"
                label-for="number-input"
                invalid-feedback="Number is already exists"
                :state="numberState"
                >
                  <b-form-input
                      id="number-input"
                      v-model="number"
                      :state="numberState"
                      required
                  ></b-form-input>
                </b-form-group>
                <b-form-group
                label="Description"
                label-for="des-input"
                invalid-feedback="Category name is already exists"
                :state="desState"
                >
                  <b-form-input
                      id="des-input"
                      v-model="des"
                      :state="desState"
                      required
                  ></b-form-input>
                  </b-form-group>
            </form>
    </b-modal>
    </div>
</template>
<script>
export default {
    name:'Customer',
    data() {
      return {
        name: '',
        nameState: null,
        des: '',
        desState: null,
        number: '',
        numberState: null,
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
        this.des = ''
        this.desState = null
        this.number = ''
        this.numberState = null
      },
      handleOk(bvModalEvt) {
        // Prevent modal from closing
        bvModalEvt.preventDefault()

        // Trigger submit handler
        this.handleSubmit()
      },
      handleSubmit() {
         
        axios.post('/api/customer', {
                name: this.name,
                des: this.des,
                number: this.number,
            })
            .then(response =>{
              console.log(response.data);
                this.$emit('getCustmers')                
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
          this.$bvModal.hide('modal-customer')
        })
      }
    }
  }
</script>