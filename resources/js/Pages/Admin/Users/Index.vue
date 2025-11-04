<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

defineProps({
    users: Array
});

const page = usePage();
const flashMessage = computed(() => page.props.flash?.message);

const formatRoles = (roles) => {
    if (!roles || roles.length === 0) {
        return 'N/A';
    }
    return roles.map(role => role.name).join(', ');
};
</script>

<template>
    <Head title="Gerenciar Usuários" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    Gerenciamento de Usuários e Papéis
                </h2>

                </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">

                        <div v-if="flashMessage" class="mb-4 p-4 rounded-md bg-green-100 dark:bg-green-900 ...">
                            <p class="text-sm font-medium text-green-800 ...">{{ flashMessage }}</p>
                        </div>

                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left ...">Nome</th>
                                    <th scope="col" class="px-6 py-3 text-left ...">E-mail</th>
                                    <th scope="col" class="px-6 py-3 text-left ...">Papéis (Roles)</th>
                                    <th scope="col" class="relative px-6 py-3"><span class="sr-only">Ações</span></th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">

                                <tr v-if="users.length > 0" v-for="user in users" :key="user.id">
                                    <td class="px-6 py-4 ...">{{ user.name }}</td>
                                    <td class="px-6 py-4 ...">{{ user.email }}</td>
                                    <td class="px-6 py-4 ...">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-300">
                                            {{ formatRoles(user.roles) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-right ...">
                                        <Link :href="route('admin.users.edit', user.id)" class="text-indigo-600 ...">Editar Papéis</Link>
                                    </td>
                                </tr>

                                <tr v-else>
                                    <td colspan="4" class="px-6 py-4 text-center ...">
                                        Nenhum usuário encontrado.
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>