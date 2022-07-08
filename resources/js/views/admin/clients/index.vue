<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="float-left mt-2">Clientes</h3>
                    </div>

                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Email</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="client in clients" :key="client.id">
                                <td>{{ client.id }}</td>
                                <td>{{ client.name }}</td>
                                <td>{{ client.email }}</td>
                            </tr>
                            </tbody>
                        </table>
                        <paginator :pagination="pagination" @changePage="index"></paginator>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Paginator from "../../../components/Paginator";
    import Client from "../../../models/admin/client";

    export default {
        components: {Paginator},

        data() {
            return {
                clients: [],
                pagination: {},
            }
        },

        methods: {
            index(page = 1) {
                let params = {
                    page: page,
                };

                Client.get(params, data =>{
                    this.clients = data.data;
                    this.pagination = data.meta;
                });
            }
        },

        created() {
            this.index();
        }
    }
</script>
