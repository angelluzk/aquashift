<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const props = defineProps({
    service: Object
});

const form = useForm({
    name: props.service.name,
    description: props.service.description,
    base_price: props.service.base_price,
    base_duration_minutes: props.service.base_duration_minutes,
    is_active: props.service.is_active
});

const submit = () => {
    form.put(route('admin.services.update', props.service.id));
};
</script>

<template>
    <Head title="Novo Serviço" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    Criar Novo Serviço
                </h2>
                <Link 
                    :href="route('admin.services.index')"
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
                        
                        <form @submit.prevent="submit" class="space-y-6">

                            <div>
                                <InputLabel for="name" value="Nome do Serviço" />
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

                            <div>
                                <InputLabel for="description" value="Descrição (Opcional)" />
                                <textarea 
                                    id="description" 
                                    class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                    v-model="form.description"
                                    rows="3"
                                ></textarea>
                                <InputError class="mt-2" :message="form.errors.description" />
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <InputLabel for="base_price" value="Preço Base (R$)" />
                                    <TextInput 
                                        id="base_price" 
                                        type="number" 
                                        step="0.01"
                                        class="mt-1 block w-full" 
                                        v-model="form.base_price"
                                        required
                                    />
                                    <InputError class="mt-2" :message="form.errors.base_price" />
                                </div>

                                <div>
                                    <InputLabel for="base_duration_minutes" value="Duração (em minutos)" />
                                    <TextInput 
                                        id="base_duration_minutes" 
                                        type="number"
                                        step="5"
                                        class="mt-1 block w-full" 
                                        v-model="form.base_duration_minutes"
                                        required
                                    />
                                    <InputError class="mt-2" :message="form.errors.base_duration_minutes" />
                                </div>
                            </div>
                            
                            <div class="block">
                                <label class="flex items-center">
                                    <input type="checkbox" v-model="form.is_active" name="is_active" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500" />
                                    <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">Serviço Ativo</span>
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