<template>
    <div>
        <b-modal
            id="modal-category"
            ref="modal"
            title="Add Category"
            @show="resetModal"
            @hidden="resetModal"
            @ok="handleOk"
        >       
            <form ref="form" @submit.stop.prevent="handleSubmit">
                <b-form-group
                label="Category"
                label-for="name-input"
                invalid-feedback="Category name is already exists"
                :state="nameState"
                >
                <b-form-input
                    id="name-input"
                    v-model="name"
                    :state="nameState"
                    required
                ></b-form-input>
                </b-form-group>
            </form>
    </b-modal>
    </div>
</template>
<script>
export default {
    name:'Category',
    data() {
      return {
        name: '',
        nameState: null,
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
      },
      handleOk(bvModalEvt) {
        // Prevent modal from closing
        bvModalEvt.preventDefault()

        // Trigger submit handler
        this.handleSubmit()
      },
      handleSubmit() {
         
        axios.post('/api/category', {
                name: this.name,
            })
            .then(response =>{
                this.$emit('getCategory')                
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
          this.$bvModal.hide('modal-category')
        })
      }
    }
  }
</script>