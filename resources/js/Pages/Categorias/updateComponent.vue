<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Atualizar {{categoria.nome_categoria}}
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-1">
                        <template>
                             <div>
                            
                                <inertia-link href="/categorias">Voltar</inertia-link>
                            
                            </div>
                        </template>
                    </div>
                    <div></div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-1">
                        <div></div>
                            <div>
                                <p>Preencha este formulário para atualizar a categoria</p>
                                <form class="w-full max-w-sm" @submit.prevent="submit">
                                    <input type="hidden" id="id_categoria" name="id_categoria" v-model="form.id_categoria" value="categoria.id">
                                    <label for="nome_categoria">Nome Categoria</label>
                                    <input id="nome_categoria" class="appearence-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none"
                                        type="text" :placeholder="categoria.nome_categoria" aria-label="nome_categoria"
                                            v-model="form.nome_categoria" required>
                                    <br>

                                    <button type="submit" class="flex-shrink-0 border-transparent bg-teal-500 hover:bg-teal-700 border-teal-500 hover:border-teal-700 text-sm border-4 text-white py-1 px-2 rounded">
                                        Salvar
                                    </button>
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
        props: ['categoria'],
        data(){
            return {
                form:{
                    nome_categoria: null,
                    id: '',
                }
            }
        },
        methods:{
            submit(categoria){
                var id = this.categoria.id;
                this.$inertia.get(`/categorias/update/${id}`, this.form, this.id)
                .then(function(response){
                    window.alert('Categoria atualizada com sucesso...');
                    window.location.reload();
                })
                .catch(function(error){
                    window.alert('Erro:' + error + 'não foi possível atualizar a categoria...');
                    window.location.reload();
                })
            }
        }
    }
</script>
