<script setup>
    import AuthenticatedLayout from './../../Layouts/AuthenticatedLayout.vue';
    import { Head, Link, useForm } from '@inertiajs/vue3';
    import VueTailwindPagination from '@ocrv/vue-tailwind-pagination';
    import Swal from "sweetalert2";
    import {inject} from "vue";
    import axios from "axios";

    const formPage = useForm({});

    const props = defineProps({
        customers: {type: Object}
    });

    const swalWithBootstrapButtons = Swal.mixin({
        buttonsStyling: true
    });

    const showExportWPConfirmation = (customer) => {

        swalWithBootstrapButtons.fire({
            title: `Are you sure you wanto to create a WordPress account for this customer?`,
            text: `A new user account for ${customer.name} will be created at WordPress.`,
            icon: 'warning',
            showConfirmButton: true,
            showCancelButton: true,
            confirmButtonText: 'Yes, export!',
            cancelButtonText: 'No, cancel!',
        }).then((result) => {
            if (result.isConfirmed) {
                storeCustomerWordpress(customer.id);
            }
        });
    };

    const storeCustomerWordpress = async (customer_id) => {
        axios.post(route('customer.create_user', {customerId: customer_id}))
        .then((response) => {
            if (response.status == 200) {
                swalWithBootstrapButtons.fire({
                    title: 'Success!',
                    text: 'Customer successfully exported to WordPress.',
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 1500
                });
            } else {
                swalWithBootstrapButtons.fire({
                    title: 'Error!',
                    text: response.message,
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        })
        .catch((error) => {
            if(error.response.data.message){
                swalWithBootstrapButtons.fire({
                    title: 'Error!',
                    text: error.response.data.message,
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 1500
                });
            }else{
                swalWithBootstrapButtons.fire({
                    title: 'Error!',
                    text: error.response.data,
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        });
    };

    const onPageClick = (event) => {
        formPage.get(route('customer.index', { page: event }));
    };
</script>

<style>
td.message {
    width: 33%;
}
td a{
    display: block;
    text-align: center;
}

</style>

<template>
    <Head title="Customers" />
    <AuthenticatedLayout>
        <template #header>
            <div class="container-fluid mt-3 gb-white">
                <div class="row mt-3">
                    <div class="col-md-10 offset-md-1">
                        <div class="table-responsive-sm">
                            <table class="table table-sm table-bordered table-striped-columns">
                                <thead>
                                    <tr>
                                        <th>
                                            Name
                                        </th>
                                        <th>
                                            Phone Number
                                        </th>
                                        <th>
                                            Email Address
                                        </th>
                                        <th>
                                            Desired Budget
                                        </th>
                                        <th>
                                            Message
                                        </th>
                                        <th>
                                            Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="customer in customers.data" :key="customer.id">
                                        <td  :class="'name'">
                                            {{ customer.name }}
                                        </td>
                                        <td :class="'phone'">
                                            {{ customer.phone_number }}
                                        </td>
                                        <td :class="'email'">
                                            {{ customer.email }}
                                        </td>
                                        <td :class="'budget'">
                                            {{ customer.desired_budget }}
                                        </td>
                                        <td :class="'message'">
                                            {{ customer.message }}
                                        </td>
                                        <td :class="'actions'">
                                            <Link :href="route('customer.show', customer.id)"
                                            :class="'px-4 py-2 bg-green-400 text-white border rounded-md font-semibold text-xs'"
                                            >
                                                <i class="fa-solid fa-eye"></i>Show
                                            </Link>
                                            <button
                                                @click="showExportWPConfirmation(customer)"
                                                :class="'px-4 py-2 bg-blue-400 text-white border rounded-md font-semibold text-xs'"
                                            >
                                                <i class="fa-solid fa-file-export"></i>Create WordPress Account
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-10 offset-md-1">
                        <VueTailwindPagination
                            :current="customers.currentPage"
                            :total="customers.total"
                            :per-page="customers.perPage"
                            @page-changed="onPageClick($event)"
                        ></VueTailwindPagination>
                    </div>
                </div>
            </div>
        </template>
    </AuthenticatedLayout>
</template>
