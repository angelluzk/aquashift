<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, usePage, useForm } from '@inertiajs/vue3';
import { computed } from 'vue';

defineProps({
    services: Array
});

const page = usePage();
const flashMessage = computed(() => page.props.flash?.message);

const confirmDelete = (serviceId) => {
    if (window.confirm('Tem certeza que deseja excluir este serviço?')) {
        useForm({}).delete(route('admin.services.destroy', serviceId), {
            preserveScroll: true,
        });
    }
};
</script>

<template>
    <Head title="Gerenciar Serviços" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    Gerenciamento de Serviços
                </h2>

                <Link 
                    :href="route('admin.services.create')" 
                    class="px-4 py-2 bg-indigo-600 dark:bg-indigo-400 text-white dark:text-gray-800 rounded-md font-semibold text-xs uppercase"
                >
                    Novo Serviço
                </Link>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">

                        <div v-if="flashMessage" class="mb-4 p-4 rounded-md bg-green-100 dark:bg-green-900 border border-green-200 dark:border-green-700">
                            <p class="text-sm font-medium text-green-800 dark:text-green-300">{{ flashMessage }}</p>
                        </div>

                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left ...">Nome</th>
                                    <th scope="col" class="px-6 py-3 text-left ...">Preço (Base)</th>
                                    <th scope="col" class="px-6 py-3 text-left ...">Duração (Min)</th>
                                    <th scope="col" class="px-6 py-3 text-left ...">Status</th>
                                    <th scope="col" class="relative px-6 py-3"><span class="sr-only">Ações</span></th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">

                                <tr v-if="services.length > 0" v-for="service in services" :key="service.id">
                                    <td class="px-6 py-4 ...">{{ service.name }}</td>
                                    <td class="px-6 py-4 ...">R$ {{ service.base_price }}</td>
                                    <td class="px-6 py-4 ...">{{ service.base_duration_minutes }} min</td>
                                    <td class="px-6 py-4 ...">
                                        <span :class="service.is_active ? 'bg-green-100 ...' : 'bg-red-100 ...'">
                                            {{ service.is_active ? 'Ativo' : 'Inativo' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-right ...">
                                        <Link :href="route('admin.services.edit', service.id)" class="text-indigo-600 ...">Editar</Link>
                                        <button @click="confirmDelete(service.id)" class="ms-2 text-red-600 ...">Deletar</button>
                                    </td>
                                </tr>

                                <tr v-else>
                                    <td colspan="5" class="px-6 py-4 text-center ...">
                                        Nenhum serviço encontrado.
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