<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Adicionar produtos
            </h2>
            
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="grid-cols-1 sm:grid-cols-1 lg:grid-cols-4">
                        <template>
                            <div class="flex-auto items-center inline-flex">
                                <inertia-link href="/product">Voltar</inertia-link>
                            </div>
                        </template>
                    </div>
                     <div class="grid-cols-1 sm:grid-cols-1 lg:grid-cols-4"></div>
                    <div class="grid-cols-1 sm:grid-cols-1 lg:grid-cols-4">
                        <div></div>
                        <template>
                            <div class="flex-auto items-center py-2 px-4">
                                <p>Gostaria de Adicionar mais produtos há 
                                    <br>
                                    <b>{{produto.nome_produto}}</b> 
                                    <b>Quantidade: {{produto.quantidade}}</b> 
                                    <div class="flex items-center border-b border-teal-500 py-2">
                                        <form class="w-full max-w-lg" @submit.prevent="submit" method="post">
                                             <input type="number" id="quantidade" name="quantidade" v-model="form.quantidade" step='1'
                                                class="aṕpareance-none block w-auto bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                                >
                                                <br>
                                            <button type="submit" class="flex-shrink-0 bg-teal-500 hover:bg-teal-700 border-teal-500 hover:border-teal-700 text-sm border-4 text-white py-1 px-2 rounded">
                                                Salvar
                                            </button>
                                        </form>
                                       
                                     </div>
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
  

    export default {
        components: {
            AppLayout,
           
        },
        props: ['produto'],
        data(){
            return {
                form:{
                    quantidade: null,
                }
            }
        },
        methods: {
            submit(produto){
                var id = this.produto.id;
                this.$inertia.post(`/produtos/include/${id}`, this.form)
                .then(function(response){
                    window.alert('Quantidade alterada com sucesso....');
                    window.location.reload();
                })
                .catch(function(error){
                    window.alert('Não foi possível alterar a quantidade deste produto' + error + 'contate o suporte técnico');
                })
            }
        }
    }
</script>
