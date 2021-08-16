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

                    <div class="grid grid-cols-1 sm:grid-cols-1 lg:grid-cols-4">
                        <p>Atualize as informação deste produto</p>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-1 lg:grid-cols-4">
                        <div></div>
                        <form class="w-full max-w-lg" @submit.prevent="submit" enctype="multipart/form-data">
                        <div class="flex items-center border-b border-teal-500 py-2">
                            <p>
                                Preencha o formulário para alterar as informações deste produto:
                                    
                                    <pre><img :src="'../../' + produto.imagem_produto"></pre>
                                   <br>
                                    
                                        
                            </p>
                        </div>
                        <br>

                            <div class="flex items-center border-b border-teal-500 py-2">
                                <input id="nome_produto" name="nome_produto" type="text" :placeholder="produto.nome_produto" v-model="form.nome_produto" 
                                    class="appearence-none bg-transparent border-none w-full text-gray mr-3 py-1 px-2 leading-tight 
                                        focus:outline-none focus:bg-white focus:border-gray-500">
                            </div>
                           

                            <div class="flex items-center border-b border-teal-500 py-2">
                                <label for="file">Imagens do produto:</label>
                                <input type="file" name="file[]" id="file" placeholder="selecione até três imagens" @change="handleFile" multiple> 
                            </div>

                           <div class="flex items-center border-b border-teal-500 py-2">
                                        
                                    <div class="inline-block relative w-64">
                                        <label for="id_categoria">Selecione a categoria: </label>
                                        <select class='block appearence-none w-full bg-white border border-gray-400 text-gray-700 py-3 px-4 pr-8 rounded shadow leading-tight focus:outline-none focus:bg-white focus:border-gray-500' id="grid-state"
                                            v-model="form.id_categoria">
                                                <option>Selecione a categoria...</option>
                                                <option id="id_categoria" v-for="categoria in categorias" v-bind:key="categoria.id" :value="categoria.id">{{categoria.nome_categoria}}</option>
                                            </select>
                                        
                                            <!-- Select Subcategorias -->
                                            
                                            
                                    <div class="inline-block relative w-64">
                                        <label for="id_subcategoria">Selecione a subcategoria: </label>
                                        <select class='block appearence-none w-full bg-white border border-gray-400 text-gray-700 py-3 px-4 pr-8 rounded shadow leading-tight focus:outline-none focus:bg-white focus:border-gray-500' id="grid-state"
                                            v-model="form.id_subcategoria">
                                                <option>Selecione a Subcategoria...</option>
                                                <option id="id_subcategoria" v-for="subcategoria in subcategorias" v-bind:key="subcategoria.id" :value="subcategoria.id">{{subcategoria.nome_subcategoria}}</option>
                                            </select>
                                    </div>
                                 </div>
                            </div>
                            
                            
                            
                            <div class="flex items-center border-b border-teal-500 py-2">
                                <label for="preco">
                                    Preço (R$):
                                </label>
                                <input type="text" :placeholder="produto.preco" id="preco" name="preco" v-model="form.preco" class="aṕpareance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">

                            </div>
                           

                             <div class="flex items-center border-b border-teal-500 py-2">
                                <label for="quantidade">
                                  Quantidade:
                                </label>
                                <input type="number" step="1" :placeholder="produto.quantidade" id="quantidade" name="quantidade" v-model="form.quantidade" class="aṕpareance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">

                            </div>
                            

                            <div class="flex items-center border-b border-teal-500 py-2">
                                <label for="descricao">
                                  Descrição:
                                </label>
                                <textarea id="descricao" v-model="form.descricao" name="descricao" :placeholder="produto.descricao" class="aṕpareance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"></textarea>

                            </div>

                           
                            
                            <div class="flex items-center border-b border-teal-500 py-2">
                                <div></div>
                                <button type="submit" class="flex-shrink-0 bg-teal-500 hover:bg-teal-700 border-teal-500 hover:border-teal-700 text-sm border-4 text-white py-1 px-2 rounded">
                                    Salvar
                                </button>
                            </div>


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
        props: ['produto', 'categorias', 'subcategorias'],
        data()
        {
            return {
                form:{
                    id_categoria: null,
                    id_subcategoria: null,
                    nome_produto: null,
                    file: '',
                   // referencia: null,
                    preco: null,
                    quantidade: null,
                    descricao: null,
                },
            }
        },
        methods:{
            submit(produto)
            {
                var id = this.produto.id;
                var data = new FormData()
                data.append('categoria_id', this.form.id_categoria || '')
                data.append('subcategoria_id', this.form.id_subcategoria || '')
                data.append('nome_produto', this.form.nome_produto || '')
                data.append('file', this.form.file || '')
                data.append('preco', this.form.preco || '')
                data.append('quantidade', this.form.quantidade || '')
                data.append('descricao', this.form.descricao || '')
                
                this.$inertia.post(`/produtos/update/${id}`, data)
                .then(function(response){
                    window.alert('Produto atualizado com sucesso...');
                })
                .catch(function(error){
                    window.alert('Erro:' + error + ' não foi possível atualizar este produto');
                });
            },
            handleFile(e)
            {
                this.form.file = e.target.files[0];
            },
        }
    }
</script>
