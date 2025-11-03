<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

// 1. Recebe a prop 'branches' que o Controller enviou
defineProps({
    branches: Array // Define que 'branches' é um Array (ou Object)
});

const page = usePage();
const flashMessage = computed(() => page.props.flash?.message);
</script>

<template>
    <Head title="Gerenciar Filiais" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    Gerenciamento de Filiais
                </h2>
                
                <Link 
                    href="/admin/branches/create" 
                    class="px-4 py-2 bg-indigo-600 dark:bg-indigo-400 text-white dark:text-gray-800 rounded-md font-semibold text-xs uppercase tracking-widest hover:bg-indigo-500 dark:hover:bg-indigo-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150"
                >
                    Nova Filial
                </Link>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        
                        <div 
                            v-if="flashMessage" 
                            class="mb-4 p-4 rounded-md bg-green-100 dark:bg-green-900 border border-green-200 dark:border-green-700"
                        >
                            <p class="text-sm font-medium text-green-800 dark:text-green-300">
                                {{ flashMessage }}
                            </p>
                        </div>
                        
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Nome</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Endereço</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Status</th>
                                    <th scope="col" class="relative px-6 py-3">
                                        <span class="sr-only">Ações</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                
                                <tr v-if="branches.length > 0" v-for="branch in branches" :key="branch.id">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">{{ branch.name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">{{ branch.address }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <span :class="branch.is_active ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300' : 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300'" 
                                              class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full">
                                            {{ branch.is_active ? 'Ativa' : 'Inativa' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <Link :href="route('admin.branches.edit', branch.id)" class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-900 dark:hover:text-indigo-100">Editar</Link>
                                    </td>
                                </tr>

                                <tr v-else>
                                    <td colspan="4" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300 text-center">
                                        Nenhuma filial encontrada.
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