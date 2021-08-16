<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Remover Produto
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="grid grid-cols-1 sm:grid-cols-1 lg:grid-cols-4">
                         <template>
                            <div>
                                <inertia-link href="/product">Voltar</inertia-link>
                                <inertia-link href="/produtos/create">Cadastrar Produto</inertia-link>
                            </div>
                        </template>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-1 lg:grid-cols-4">  
                        <div></div>
                        <div>  
                        <form @submit.prevent="submit">
                            <p>Você tem certeza que deseja remover este produto ? {{produto.nome_produto}}</p>
                            <p>Nome: {{produto.nome_produto}}</p>
                            <a :href="'./' + produto.imagem_produto">
                                <img :src="'../../../' + produto.imagem_produto">
                            </a>
                            <p>preço: {{produto.preco}} Quantidade: {{produto.quantidade}}</p>

                            <div class="flex items-center border-b border-teal-500 py-2">
                                <button type="submit" class="flex-shrink-0 bg-teal-500 hover:bg-teal-700 border-teal-500 hover:border-teal-700 text-sm border-4 text-white py-1 px-2 rounded">
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
        props: ['produto'],
        methods:{
            submit(produto)
            {
                var id = this.produto.id;
                this.$inertia.post(`/produtos/destroy/${id}`, this.id)
                .then(function(response){
                    window.alert('O produto foi removido com sucesso');
                    window.location.href = "/product";
                })
                .catch(function(error){
                    return window.alert('Erro:' + error + ' Não foi possivel remover o produto...');
                })
                
            }
        }
    }
</script>
