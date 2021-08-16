<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
               Cadastrar Categorias
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                
                   <div class="grid grid-cols-1 sm:grid-cols-1 lg:grid-cols-4">
                        
                        <div>
                            <template>
                                <inertia-link href="/categorias">Voltar</inertia-link>
                            </template>
                        </div>
                    </div>


                      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4">
                        <div></div>
                        <div class="border border-1 shadow">
                            <p class="text-base sm:text-xs lg:text-sm font-sans sm:font-serif lg:font-sans antialised sm:subpixel-antialised">
                                Preencha este formulário para cadastrar novas categorias
                            </p>
                            <form class="w-full max-w-sm" @submit.prevent="submit">
                                
                                <label for="nome_categoria">Nome Categoria:</label>
                                <input id="nome_categoria" class="appearence-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none"
                                    type="text" placeholder="Nome Categoria" aria-label="nome_categoria"
                                        v-model="form.nome_categoria" required>
                                <br>

                                <div class="flex-auto items-center inline-flex">
                                    <button type="submit" class="flex-shrink-0 border-transparent bg-teal-500 hover:bg-teal-700 border-teal-500 hover:border-teal-700 text-sm border-4 text-white py-1 px-2 rounded">
                                        Salvar
                                    </button>
                                </div>
                                
                            </form>
                        </div>
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
        data(){
            return{
                form:{
                    nome_categoria: null,
                },
            }
        },
        methods:
        {
            submit(){
                this.$inertia.post('store', this.form)
                .then(function(response){
                    window.alert('Nova categoria Cadastrada com sucesso...');
                })
                .catch(function(error){
                    window.alert('Erro Ao cadastrar nova categoria' + error + 'Contate o suporte técnico');
                });
            },
        },
    }
</script>
