<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Atualizar Produto
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="grid-cols-1 sm:grid-cols-1 lg:grid-cols-4">
                        <template>
                            <div class="flex items-center px-2">
                                <inertia-link href="/product">Voltar</inertia-link>
                            </div>
                        </template>
                    </div>

                    <div class="grid-cols-1 sm:grid-cols-1 lg:grid-cols-4">
                        <p>Atualize as informação deste produto</p>

                        <form>
                            formulário aqui....
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import Welcome from '@/Jetstream/Welcome'

    export default {
        components: {
            AppLayout,
            Welcome,
        },
        props: ['produto'],
    }
</script>
