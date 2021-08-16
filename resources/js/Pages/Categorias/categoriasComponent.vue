<template>
    <app-layout data-app>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
               Categorias
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                   
                    <div class="grid-cols-1 sm:grid-cols-1 lg:grid-cols-4"></div>
                    <div class="grid-cols-1 sm:grid-cols-1 lg:grid-cols-4"></div>
                    <div class="flex-auto items-center py-2 px-4">
                        <v-card>
                            <v-card-title>
                                <v-text-field
                                    v-model="search"
                                    append-icon="mdi-magnify"
                                    label="Busca"
                                    single-line
                                    hide-details>
                                    </v-text-field>

                                    <br>
                                            
                            </v-card-title>

                            <v-data-table
                                :headers="headers"
                                :items="items"
                                :items-per-page="5"
                                item-key="nome_categoria"
                                :search="search"
                                class="elevation-1"
                                loading
                                loading-text="Carregando as categorias...">
                            
                                <template v-slot:top>
                                    <v-toolbar flat>
                                        <v-toolbar-title>Categorias</v-toolbar-title>
                                        <v-divider class="mx-4" inset vertical></v-divider>
                                        <v-spacer></v-spacer>

                                        <v-dialog v-model="dialog" max-width="500px">
                                            <template v-slot:activator="{ on, attrs }">
                                                <v-btn
                                                    color="blue darken-1"
                                                    dark
                                                    class="mb-2"
                                                    v-bind="attrs"
                                                    v-on="on">
                                                        Nova Categoria
                                                </v-btn>
                                            </template>

                                            <v-card>
                                                <v-card-title>
                                                    <span class="headline">{{formTitle}}</span>
                                                </v-card-title>

                                                <v-card-text>
                                                    <v-container>
                                                        <v-row>
                                                            <v-col cols="12" sm="6" md="4" 
                                                                class="flex-auto items-center py-2 px-4">
                                                                <v-subheader>Nome Categoria</v-subheader>
                                                            </v-col>
                                                            <v-col>
                                                                <v-text-field
                                                                    v-model="editedItem.nome_categoria"
                                                                    label="Nome da categoria:"
                                                                    required>
                                                                </v-text-field>
                                                            </v-col>
                                                        </v-row>

                                                    </v-container>
                                                </v-card-text>

                                                <v-card-actions>
                                                    <v-spacer></v-spacer>
                                                    <v-btn
                                                    color="blue darken-1"
                                                    text
                                                    @click="close">
                                                        Cancelar
                                                    </v-btn>
                                                    <v-btn
                                                    color="blue darken-1"
                                                    text
                                                    @click="save">
                                                        
                                                    </v-btn>
                                                </v-card-actions>
                                            </v-card>
                                        </v-dialog>

                                        <v-dialog v-model="dialogDelete" max-width="500px">
                                            <v-card>
                                                <v-card-text class="headline">
                                                    <v-subheader>{{editedItem.nome_categoria}}</v-subheader>
                                                    <p>Você tem certeza que deseja remover esta categoria ???</p>
                                                </v-card-text>

                                                <v-card-actions>
                                                    <v-spacer></v-spacer>
                                                    <v-btn
                                                        class="mr-2"
                                                        color="blue darken-1"
                                                        @click="closeDelete">
                                                            Cancelar
                                                        </v-btn>
                                                        <v-btn
                                                            class="mr-2"
                                                            color="blue darken-1"
                                                            @click="deleteItemConfirm">
                                                                Remover
                                                            </v-btn>
                                                </v-card-actions>
                                            </v-card>
                                        </v-dialog>
                                    </v-toolbar>
                                </template>

                                <template v-slot:item.action="{ item }">
                                  <v-icon
                                    small
                                    class="mr-2"
                                    color="indigo"
                                    @click="editItem(item)">
                                        mdi-pencil
                                    </v-icon>     

                                    <v-icon
                                        small
                                        class="mr-2"
                                        color="indigo"
                                        @click="deleteItem(item)">
                                        mdi-delete
                                    </v-icon> 
                                </template>
                            </v-data-table>
                        </v-card>
                    </div>
                   </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
  //  import Welcome from '@/Jetstream/Welcome'

    export default {
        components: {
            AppLayout,
           // Welcome,
        },
        props: ['categorias'],
        data() {
            return {
                search: "",
                items: [],
                loading: true,
                page: 1,
                itemsPerPage: 5,
                dialog: false,
                dialogDelete: false,
                headers:
                [

                    {
                    text: "Categorias Cadastradas",
                    align: "start",
                    sortable: false,
                    value: "controls",
                    filterable: true,
                  
                    
                    },
                    
                    {
                        text: 'Categoria', value: 'nome_categoria'
                    },
                    {
                        text: 'Ações', value: 'action', sortable: false 
                    }
           
                ],
                editedIndex: -1,
                editedItem: {
                    nome_categoria: '',
                },


            };
        },
        computed: {
            formTitle(){
                return this.editedIndex === -1 ? "New Item" : "Edit Item";
            },
        },
        watch: {
            dialog(val){
                val || this.close();
            },
            dialogDelete(val)
            {
                val || this.closeDelete();
            }
        },
        methods: {
            getItems(categorias)
            {
                var categorias = this.categorias;
                this.items = categorias;
            },
            initialize()
            {
                this.items = [];
            },
            editItem(item)
            {
                this.editedIndex = this.items.indexOf(item);
                this.editedItem = Object.assign({}, item);
                this.dialog = true;
            },
            deleteItem(item)
            {
                this.editedIndex = this.items.indexOf(item);
                this.editedItem = Object.assign({}, item);
                this.dialogDelete = true;
            },
            deleteItemConfirm(item)
            {
                this.$inertia.post(`/categorias/destroy/${this.editedItem.id}`)
                .then(function(response){
                    window.alert('Categoria removida com sucesso...');
                    window.location.href='/categorias';
                })
                .catch(function(error){
                    window.alert('Erro:' + erro + 'contate o suporte técnico...');
                });
            },
            save()
            {
                if(this.editedIndex > -1)
                {
                    var $data = Object.assign(this.items[this.editedIndex], this.editedItem);
                   
                    this.$inertia.post(`/categorias/update/${this.editedItem.id}`, $data)
                    .then(function(response){
                        window.alert('Poduto Alterado com sucesso....');
                        window.location.href='/categorias';
                    })
                    .catch(function(error){
                        window.alert('erro:' + erro + 'Contate o suporte técnico....' );
                    });
                    
                }
                else
                {
                   // $data = this.items.splice(this.itemIndex, 1, this.editedItem);
                    this.$inertia.post(`categorias/store`, this.editedItem)
                    .then(function(response){
                        window.alert('Categoria cadastrada com sucesso...');
                        window.location.href="/categorias";
                    })
                    .catch(function(error){
                        window.alert('Erro :' + error + 'Contate o suporte técnico...')
                    });
                    this.items.push(this.editedItem);
                }
                this.close();
            },
            close(){
                this.dialog = false;
                this.$nextTick(() => {
                    this.editedItem = Object.assign({}, this.defaulItem);
                    this.editedIndex = -1;
                });
            },
            closeDelete()
            {
                this.dialogDelete = false;
                this.$nextTick(() => {
                    this.editedIndex = Object.assign({}, this.defaulItem);
                    this.editedIndex = -1;
                });
            }
        },
        created()
        {
            this.initialize();
        },
        mounted()
        {
            this.getItems();
        }
        
    }
</script>
