<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Editar Subcategoria
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="grid grid-cols-1 sm:grid-cols-1 lg:grid-cols-4">
                        <template>
                            <div></div>
                            <div class="inline-flex">
                                <inertia-link href="/subcategorias">Voltar</inertia-link>
                            </div>
                        </template>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-1 lg:grid-cols-4">
                    <template>
                        <div></div>
                        <div>
                            <form class="w-ful max-w-lg" @submit.prevent="submit">
                                <div class="flex items-center border-b border-teal-500 py-2">
                                    <p>Preencha este formulário para editar as informações da subcategoria</p>
                                </div>
                                <div class="flex items-center border-b border-teal-500 py-2">
                                    <input type="text" :placeholder="subcategoria.nome_subcategoria" id="nome_subcategoria" v-model="form.nome_subcategoria"
                                        class="appearence-none bg-transparent border-none w-full text-gray mr-3 py-1 px-2 leading-tight focus:outline-none">
                                </div>
                                <div class="flex items-center border-b border-teal-500 py-2">
                                    <div class="inline-block relive w-64">
                                        <label for="nome_categoria"></label>
                                        <select v-model="form.categoria_id" id="grid-state" class='block appearence-none w-full bg-white border border-gray-400 text-gray-700 py-3 px-4 pr-8 rounded shadow leading-tight focus:outline-none focus:bg-white focus:border-gray-500'>
                                            <option>Escolha a categoria...</option>
                                            <option v-for="cat in categorias" v-bind:key="cat.id" :value="cat.id">{{cat.nome_categoria}} </option>
                                        </select>
                                    </div>
                                   
                                </div>
                                 <div class="flex items-center border-b border-teal-500 py-2">
                                    <button type="submit" class="flex-shrink-0 border-transparent bg-teal-500 hover:bg-teal-700 border-teal-500 hover:border-teal-700 text-sm border-4 text-white py-1 px-2 rounded">
                                        Salvar
                                    </button>
                                 </div>
                            </form>
                        </div>
                    </template>
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
        props: ['subcategoria', 'categorias'],
        data(){
            return{
                form:{
                    nome_subcategoria: null,
                    categoria_id: null,
                },
            }
        },
        methods: {
            submit(){
                var id = this.subcategoria.id;
                this.$inertia.post(`/subcategorias/update/${id}`, this.form, this.id)
                .then(function(reponse){
                    window.alert('Subcategoria atualizada com sucesso...');
                })
                .catch(function(error){
                    window.alert('Error: ' + error + 'contate o suporte técnico...');
                });
            }
        }
    }
</script>
