<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

// 1. Define a estrutura do nosso formulário
const form = useForm({
    name: '',
    address: '',
    contact_phone: '',
    is_active: true // Começa como 'Ativa' por padrão
});

// 2. Define a função de submit (por enquanto, vazia)
const submit = () => {
    // Faz o POST para a rota 'admin.branches.store', passando os dados do formulário
    form.post(route('admin.branches.store'));
};
</script>

<template>
    <Head title="Nova Filial" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    Criar Nova Filial
                </h2>
                <Link 
                    href="/admin/branches"
                    class="px-4 py-2 bg-gray-600 dark:bg-gray-500 text-white rounded-md font-semibold text-xs uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-gray-400"
                >
                    Voltar
                </Link>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        
                        <form @submit.prevent="submit" class="space-y-6">

                            <div>
                                <InputLabel for="name" value="Nome da Filial" />
                                <TextInput 
                                    id="name" 
                                    type="text" 
                                    class="mt-1 block w-full" 
                                    v-model="form.name" 
                                    required 
                                    autofocus 
                                    autocomplete="off"
                                />
                                </div>

                            <div>
                                <InputLabel for="address" value="Endereço (Opcional)" />
                                <TextInput 
                                    id="address" 
                                    type="text" 
                                    class="mt-1 block w-full" 
                                    v-model="form.address"
                                    autocomplete="off"
                                />
                                </div>

                            <div>
                                <InputLabel for="contact_phone" value="Telefone (Opcional)" />
                                <TextInput 
                                    id="contact_phone" 
                                    type="tel" 
                                    class="mt-1 block w-full" 
                                    v-model="form.contact_phone"
                                    autocomplete="off"
                                />
                                </div>
                            
                            <div class="block">
                                <label class="flex items-center">
                                    <input type="checkbox" v-model="form.is_active" name="is_active" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" />
                                    <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">Filial Ativa</span>
                                </label>
                            </div>

                            <div class="flex items-center gap-4">
                                <PrimaryButton :disabled="form.processing">Salvar</PrimaryButton>
                                </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>