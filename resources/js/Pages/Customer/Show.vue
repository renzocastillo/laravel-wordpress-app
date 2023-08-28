<script setup>
    import AuthenticatedLayout from './../../Layouts/AuthenticatedLayout.vue';
    import { Head, useForm } from '@inertiajs/vue3';
    import InputLabel from './../../Components/InputLabel.vue';
    import TextInput from './../../Components/TextInput.vue';

    const props = defineProps({
        customer: {type: Object}
    });

    const customerDesiredBudgetString  = props.customer.desired_budget.toString();
    
</script>

<template>
    <Head title="Customers" />
    <AuthenticatedLayout>
        <template #header>
            <div class="container-fluid mt-3 gb-white">
                <div>
                    <InputLabel for="name" value="Name" />

                    <TextInput
                        id="name"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="props.customer.name"
                    />
                </div>

                <div class="mt-4">
                    <InputLabel for="phone_number" value="Phone Number" />

                    <TextInput
                        id="phone_number"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="customer.phone_number"
                    />
                </div>

                <div class="mt-4">
                    <InputLabel for="email" value="Email Address" />

                    <TextInput
                        id="email"
                        type="email"
                        class="mt-1 block w-full"
                        v-model="customer.email"
                    />
                </div>

                <div class="mt-4">
                    <InputLabel for="desired_budget" value="Desired Budget" />

                    <TextInput
                        id="desired_budget"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="customerDesiredBudgetString"
                    />
                </div>

                <div class="mt-4">
                    <InputLabel for="message" value="Message" />

                    <textarea
                        id="message"
                        class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full"
                        v-model="customer.message"
                    >
                    </textarea>
                </div>
            </div>
        </template>
    </AuthenticatedLayout>
</template>