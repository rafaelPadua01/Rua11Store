<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="grid grid-cols-1 sm:grid-cols-1 lg:grid-cols-8">
                        <div>
                            <inertia-link href="/subcategorias">Voltar</inertia-link>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-1 lg:grid-cols-4">
                        <div></div>
                        <form @submit.prevent="submit" class="w-full max-w-sm">
                            <div class="flex items-center">
                                <p>Você tem certeza que deseja remover está subcategoria ? <b>{{subcategoria.nome_subcategoria}}</b></p>
                                
                            </div>
                            <div class="flex items-center">
                                <p></p>
                                <br>
                            </div>
                          
                           
                            <div class="flex items-center border-b border-teal-500">
                                <div></div>
                                <button type="submit" class="flex-shrink-0 border-transparent bg-red-500 hover:bg-red-700 border-red-500 hover:border-red-700 text-sm border-4 text-white py-1 px-2 rounded">
                                    Remover
                                </button>
                            </div>
                          
                            <br>
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
        props: ['subcategoria'],
        data(){
            return {
                forms: {
                    id: null,
                }
            }
        },
        methods:{
            submit(subcategoria){
                var id = this.subcategoria.id;
                this.$inertia.post(`/subcategorias/destroy/${id}`, this.form, this.id)
                .then(function(response){
                    window.alert('Subcategoria removida com sucesso...');
                     window.location.href = '/subcategorias'; 
                })
                .catch(function(error){
                    window.alert('Erro: ' + error +' contate o suporte técnico...');
                });
            }
        }
    }
</script>
