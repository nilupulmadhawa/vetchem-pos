<template>
    <div>
        <b-modal
            id="modal-supplier-details"
            ref="lotInfo"
            title="asas"
            ok-only
        >  
        <div>   
          <button class="btn btn-secondary  btn-sm" >Add New Lot</button>
          
        </div>
    </b-modal>
    </div>
</template>
<script>
export default {
    name:'SupplierDetails',
    data() {
      return {
       
      }
    },
    props:{
        sDetails:Array,
    },
    methods: {
      
    }
  }
</script>