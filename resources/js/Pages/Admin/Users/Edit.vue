<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import InputError from '@/Components/InputError.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const props = defineProps({
    user: Object,
    allRoles: Array
});

const form = useForm({
    roles: props.user.roles.map(role => role.name)
});

const submit = () => {
    form.put(route('admin.users.update', props.user.id));
};
</script>

<template>
    <Head :title="'Editar Papéis de ' + user.name" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    Editar Papéis de: {{ user.name }}
                </h2>
                <Link 
                    :href="route('admin.users.index')"
                    class="px-4 py-2 bg-gray-600 dark:bg-gray-500 text-white rounded-md font-semibold text-xs uppercase"
                >
                    Voltar
                </Link>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        
                        <div class="mb-4 text-gray-600 dark:text-gray-400">
                            <strong>Usuário:</strong> {{ user.name }}<br>
                            <strong>E-mail:</strong> {{ user.email }}
                        </div>
                        
                        <form @submit.prevent="submit" class="space-y-6">

                            <div>
                                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                    Atribuir Papéis
                                </h3>
                                <p class="text-sm text-gray-600 dark:text-gray-400">
                                    Selecione os papéis que este usuário deve ter.
                                </p>
                                <div class="mt-4 space-y-2">
                                    <label v-for="role in allRoles" :key="role.id" class="flex items-center">
                                        <input 
                                            type="checkbox" 
                                            :value="role.name" 
                                            v-model="form.roles"
                                            class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500"
                                        />
                                        <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ role.name }}</span>
                                    </label>
                                </div>
                                <InputError class="mt-2" :message="form.errors.roles" />
                            </div>

                            <div class="flex items-center gap-4">
                                <PrimaryButton :disabled="form.processing">Salvar Papéis</PrimaryButton>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>