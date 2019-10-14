<template>

    <div class="box">
        <div class="panel panel-default col-md-12">
              
            <div class="panel-body">
                <form>

                    <div class="form-group col-md-12">
                        <label for="name">Name:</label>
                        <input type="text" v-model="name" class="form-control" placeholder="Enter Name"  id="name" required>
                    </div>

                    <div class="form-group col-md-12">
                        <label for="description">description:</label>
                        <textarea v-model="description"  class="form-control"  id="description" cols="20" rows="5" placeholder="Type Description" required></textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="pull-right" style="margin-right:30px;">

                                <input type="button" v-on:click="sendOrderReq" class="btn btn-sm btn-success" value="Add">
                            </div>
                        </div>
                    </div>
                    <!-- <button type="button" @click="openModal">open</button> -->
                    <hr>
                </form>
            </div>

        </div>
        <!-- /.panel -->
        <modal-component v-model="modalOpen"></modal-component>
    </div>
    <!-- .box -->

</template>


<style>

</style>


<script>

    import ModalComponent from './ModalComponent';

    export default {
        props: ['id',],

        components : {
            ModalComponent,
        },

        data:  () => {
            return {
                name: '',
                description: '',
                modalOpen: false,
            }
        },

        methods: {
            // post data
            sendOrderReq: function (event)  {
                // e.preventDefault();

                console.log(`${this.id}__its time to update message:`);
                console.log(`Name: ${this.name}, Description: ${this.description}`);

                // post to db
                  axios.post('/admin/orderPrerequests', {
                        id: this.id,
                        name: this.name,
                        description: this.description,
                    })
                    .then(response => {

                        

                        let data = response.data;

                        if(data.code == 1){
                                // clear the fields
                            this.name = '';
                            this.description = '';
                            alert("Data posted")
                        }else{
                            this.name = '';
                            this.description = '';
                            alert("Error occured");
                        };
                    })
                    .catch(error => {
                        this.name = '';
                        this.description = '';
                        alert("Fatal Error occured");

                        console.log(error);
                    });
            }, 

            // show response
            openModal() {
                this.modalOpen = !this.modalOpen;
                console.log("opening modal..")
            }  
        },
        mounted:  function ()  {
            // console.log(this.id);
        },


        created:  function ()  {
            console.log("post sent")
        },

        watch: {
            name:  (params) => {
                    console.log('typing..')
                
            }
        }

        // computed: function () {
            
        // }
    }
</script>