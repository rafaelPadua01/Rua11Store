<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Cadastrar Produto
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="grid grid-cols-1 sm:grid-cols-1 lg:grid-cols-4">
                        <template>
                             <inertia-link href="/produtos">Voltar</inertia-link>
                        </template>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-1 lg:grid-cols-4">
                       <div></div>
                    
                       <form class="w-full max-w-lg" @submit.prevent="submit" enctype="multipart/form-data">
                        <div class="flex items-center border-b border-teal-500 py-2">
                            <p>Preencha o formulário para cadastrar um novo produto</p>
                        </div>

                            <div class="flex items-center border-b border-teal-500 py-2">
                                <input id="nome_produto" type="text" placeholder="nome do produto" v-model="form.nome_produto" class="appearence-none bg-transparent border-none w-full text-gray mr-3 py-1 px-2 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                            </div>

                            <div class="flex items-center border-b border-teal-500 py-2">
                                <label for="file">Imagens do produto:</label>
                                <input type="file" name="file[]" id="file" placeholder="selecione até três imagens" @change="handleFile" multiple> 
                            </div>
                            
                            <div class="flex items-center border-b border-teal-500 py-2">
                                <template>
                                    <div class="flex justify-between items-center">
                                        <label for="status">Produto Disponível ?</label>
                                        <span v-if="currentState" class="toggle_label">sim</span>
                                        <span v-if="! currentState" class="toggle_label">não</span>

                                        <input type="checkbox" id="toggle_button" v-model="checkedValue">
                                        <!--
                                        <div class="w-12 h-6 flex items-center bg-gray-300 rounded-full p-1 duration-300 ease-in-out" 
                                            :class="{'bg-green-400' : toggleActive}" @click="toggleActive = !toggleActive" value="disponivel">
                                           
                                            <div class="bg-white w-4 h-4 rounded-full shadow-md transform duration-300 ease-in-out"
                                                 :class="{'translate-x-6' : toggleActive}" :v-model="form.status" value="maconha">
                                                    {{this.form.status}}
                                            </div>
                                        </div> -->
                                    </div>
                                </template>
                            </div>
                           <div class="flex items-center border-b border-teal-500 py-2">
                                        
                                    <div class="inline-block relative w-64">
                                        

                                        <label for="id_categoria">Selecione a categoria: </label>
                                        <select class='block appearence-none w-full bg-white border border-gray-400 text-gray-700 py-3 px-4 pr-8 rounded shadow leading-tight focus:outline-none focus:bg-white focus:border-gray-500' id="grid-state"
                                            v-model="form.id_categoria">
                                                <option>Selecione a categoria...</option>
                                                <option id="id_categoria" v-for="categoria in categorias" v-bind:key="categoria.id"
                                                     :value="categoria.id"
                                                    :v-model="form.id_categoria">{{categoria.nome_categoria}}</option>
                                            </select>
                                        
                                            <!-- Select Subcategorias -->
                                            <label for="id_subcategoria">Selecione a subcategoria: </label>
                                        <select class='block appearence-none w-full bg-white border border-gray-400 text-gray-700 py-3 px-4 pr-8 rounded shadow leading-tight focus:outline-none focus:bg-white focus:border-gray-500' id="grid-state"
                                            v-model="form.id_subcategoria">
                                                <option>Selecione a Subcategoria...</option>
                                                <option id="id_subcategoria" v-for="subcategoria in subcategorias"
                                                    v-bind:key="subcategoria.id" 
                                                    :v-if="subcategoria.id_categoria === categorias[firstOption]"
                                                    :value="subcategoria.id"
                                                    :v-model="form.id_subcategoria">{{subcategoria.nome_subcategoria}}</option>
                                            </select>
                                            
                                            
                                    <div class="inline-block relative w-64">
                                        <label for="id_subcategoria">Selecione a subcategoria: </label>
                                        <select class='block appearence-none w-full bg-white border border-gray-400 text-gray-700 py-3 px-4 pr-8 rounded shadow leading-tight focus:outline-none focus:bg-white focus:border-gray-500' id="grid-state"
                                            v-model="secondOption" v-if="firstOption">
                                                <option>Selecione a Subcategoria...</option>
                                                <option id="id_subcategoria" v-for="subcategoria in subcategorias[firstOption]"
                                                    v-bind:key="subcategoria.id" 
                                                    :value="subcategoria.id">{{subcategoria.nome_subcategoria}}</option>
                                            </select>
                                    </div>
                                 </div>
                            </div>
                            
                            
                            
                            <div class="flex items-center border-b border-teal-500 py-2">
                                <label for="preco">
                                    Preço (R$):
                                </label>
                                <input type="text" placeholder="10.50" id="preco" name="preco" v-model="form.preco" class="aṕpareance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">

                            </div>
                           

                             <div class="flex items-center border-b border-teal-500 py-2">
                                <label for="quantidade">
                                  Quantidade:
                                </label>
                                <input type="number" step="1" placeholder="10" id="quantidade" name="quantidade" v-model="form.quantidade" class="aṕpareance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">

                            </div>
                            

                            <div class="flex items-center border-b border-teal-500 py-2">
                                <label for="descricao">
                                  Descrição:
                                </label>
                                <textarea id="descricao" v-model="form.descricao" name="descricao" class="aṕpareance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"></textarea>

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
        props:['categorias', 'subcategorias'],
        data(){
            return{
                    firstOption: null,
                    secondOption: null,
                form:{
                    id_categoria: null,
                    id_subcategoria: null,
                    nome_produto: null,
                    file: '',
                   // referencia: null,
                    preco: null,
                    quantidade: null,
                    descricao: null,
                    status: null,
                },
                //toggleActive: false,
                currentState: false,
            }
        },
        computed: {
            isActive(){
                return this.currentState;
            },
            checkedValue: {
                get(){
                    return this.currentState
                },
                set(newValue)
                {
                    this.currentState = newValue;
                }
            }
            
        },
        methods: {
            
            submit()
            {
                var data = new FormData()
                data.append('id_categoria', this.form.id_categoria || '')
                data.append('id_subcategoria', this.form.id_subcategoria || '')
                data.append('nome_produto', this.form.nome_produto || '')
                data.append('file', this.form.file || '')
                data.append('status', this.checkedValue || '');
                data.append('preco', this.form.preco || '')
                data.append('quantidade', this.form.quantidade || '')
                data.append('descricao', this.form.descricao || '')

                this.$inertia.post('/produtos/store',  data)
                .then(function(response){
                    window.alert('produto cadastrado com sucesso...');
                    window.location.href = '/product';
                })
                .catch(function(error){
                    window.alert('Erro:' + error + ' Contate o suporte técnico...');
                });
            },
            handleFile(e){
                this.form.file = e.target.files[0];
            },
        }
    }
</script>

<style>
    .toggle_button {
        vertical-align: middle;
        user-select: none;
        cursor: pointer;

    }
    .toggle_button input[type="checkbox"] {
        opacity: 0;
        position: absolute;
        width: 1px;
        height: 1px;
    }
    .toggle_button .toggle_switch{
        display: inline-block;
        height: 12px;
        width: 1px;
        border-radius: 6px;
        width: 40px;
        background: #BCFBD9;
        box-shadow: inset 0 0 1px #BFCBD9;
        position: relative;
        position: relative;
        margin-left: 10px;
        transition: all .25s;


    }
    .toggle_button .toggle_switch::after,
    .toggle_button .toggle_switch::before {
        content: "";
        position: absolute;
        display: block;
        height: 18px;
        width: 18px;
        border-radius: 50%;
        left: 0;
        top: -3px;
        transform: translateX(0);
        transition: all .25s cubic-bezier(0.5, -.6, .5, 1.6);
    }
    .toggle_button .toggle_switch::after{
        background-color: #4D4D4D4D;
        box-shadow: 0 0 1px #666;
    }
    .toggle_button .toggle_switch::before{
        background: #4D4D4D;
        box-shadow: 0 0 0 3px rgba(0,0,0),0.1; 
        opacity: 0;   
    }

</style>