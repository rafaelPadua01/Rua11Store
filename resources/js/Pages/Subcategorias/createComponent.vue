<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Cadastro de Subcategoria
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                   <div class="grid grid-cols-1 sm:grid-cols-1 lg:grid-cols-4">
                       <template>
                           <inertia-link href="/subcategorias">Voltar</inertia-link>
                       </template>
                   </div>

                   <div class="grid grid-cols-1 sm:grid-cols-1 lg:grid-cols-4">
                       <template>
                           <div></div>
                           <div>
                               <p>Preencha o formulário de cadastro de nova subcategoria</p>
                               <form class="w-full max-w-lg" @submit.prevent="submit">
                                   <div class="flex items-center border-b border-teal-500 py-2">
                                        
                                        <input type="text" id="nome_subcategoria" v-model="form.nome_subcategoria" placeholder="Nome subcategoria..."
                                            class="appearence-none bg-transparent border-none w-full text-gray mr-3 py-1 px-2 leading-tight focus:outline-none">
                                        
                                    
                                   </div>
                                   <br>
                                    <div class="flex items-center border-b border-teal-500 py-2">
                                        
                                            <div class="inline-block relative w-64">
                                                <select class='block appearence-none w-full bg-white border border-gray-400 text-gray-700 py-3 px-4 pr-8 rounded shadow leading-tight focus:outline-none focus:bg-white focus:border-gray-500' id="grid-state"
                                                    v-model="form.id_categoria">
                                                        <option>Selecione a categoria...</option>
                                                        <option id="id_categoria" v-for="categoria in categorias" v-bind:key="categoria.id" :value="categoria.id">{{categoria.nome_categoria}}</option>
                                                </select>
                                            </div>
                                   </div>
                                  <br>
                                   <div>
                                        <button type="submit" class="flex-shrink-0 bg-teal-500 hover:bg-teal-700 border-teal-500 hover:border-teal-700 text-sm border-4 text-white py-1 px-2 rounded">Salvar</button>
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
        props: ['categorias'],
        data(){
            return{
                categoria: '',
                form:{
                    nome_subcategoria: null,
                    nome_categoria: null,
                    id_categoria: null,
                }
            }
        },
        methods:
        {
            submit(categoria)
            {
                var id = this.form.id_categoria;
                this.$inertia.post(`/subcategorias/store/${id}`, this.form, this.id)
                .then(function(response){
                    window.alert('Subcategoria cadastrada com sucesso...');
                })
                .catch(function(error){
                    window.alert('Erro: '  +  error + ' Contate o suporte técnico...');
                });
            }
        }
    }
</script>
