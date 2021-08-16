<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Remover Categoria
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
                                <p>Você tem certeza Que deseja Remover esta Categoria ? {{categoria.nome_categoria}}</p>
                                <form class="w-full max-w-sm" @submit.prevent="submit">
                                    <input type="hidden" id="id_categoria" name="id_categoria" v-model="form.id_categoria" value="categoria.id">
                                   
                                    <button type="submit" class="flex-red-0 border-transparent bg-red-500 hover:bg-red-700 border-red-500 hover:border-red-700 text-sm border-4 text-white py-1 px-2 rounded">
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
                form: {
                    id_categoria: null,
                }
            }
        },
        methods: {
            submit(categoria){
                var id = this.categoria.id
                this.$inertia.post(`/categorias/destroy/${id}`, this.form, this.id)
                .then(function(response){
                    window.alert('Categoria removida com sucesso...');
                    window.location.href = '/categorias';  
                })
                .catch(function(error){
                    window.alert('Erro:' + error + 'Não foi possível remover esta categoria');
                    
                });
            }
        }
    }
</script>
