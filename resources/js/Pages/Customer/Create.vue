<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, useForm } from '@inertiajs/vue3';
import Swal from 'sweetalert2';

const form = useForm({
    name: '',
    phone_number: '',
    email: '',
    desired_budget: '',
    message: ''
});

const submit = () => {
    form.post(route('customer.store'), {
        onSuccess: () => {
            form.reset();
            notify()
        }
    });
};

const notify = () => {
    const swalWithBootstrapButtons = Swal.mixin({
        buttonsStyling: true
    });

    swalWithBootstrapButtons.fire({
        title: 'Customer',
        text: 'Successfully registered customer.',
        icon: 'success',
        showConfirmButton: false,
        timer: 1500
    });
};

</script>

<template>
    <GuestLayout>
        <Head title="Customer" />

        <form @submit.prevent="submit">
            <div>
                <InputLabel for="name" value="Name" />

                <TextInput
                    id="name"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.name"
                    required
                    autofocus
                />

                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <div class="mt-4">
                <InputLabel for="phone_number" value="Phone Number" />

                <TextInput
                    id="phone_number"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.phone_number"
                    required
                />

                <InputError class="mt-2" :message="form.errors.phone_number" />
            </div>

            <div class="mt-4">
                <InputLabel for="email" value="Email Address" />

                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 block w-full"
                    v-model="form.email"
                    required
                />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-4">
                <InputLabel for="desired_budget" value="Desired Budget" />

                <TextInput
                    id="desired_budget"
                    type="number"
                    step="0.01"
                    class="mt-1 block w-full"
                    v-model="form.desired_budget"
                    required
                />

                <InputError class="mt-2" :message="form.errors.desired_budget" />
            </div>

            <div class="mt-4">
                <InputLabel for="message" value="Message" />

                <textarea
                    id="message"
                    class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full"
                    v-model="form.message"
                    required
                >
                </textarea>

                <InputError class="mt-2" :message="form.errors.message" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Save
                </PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template>
