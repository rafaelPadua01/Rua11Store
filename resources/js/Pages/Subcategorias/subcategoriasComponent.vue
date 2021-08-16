<template>
    <app-layout data-app>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Subcategorias
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="flex-auto items-center py-2 px-4">
                        <div class="grid-cols-1 sm:grid-cols-1 lg:grid-cols-4"></div>

                         <v-card>
                             <v-card-title>
                                <v-text-field
                                    v-model="search"
                                    append-icon="mdi-magnify"
                                    single-line
                                    hide-details
                                    label="Busca">

                                </v-text-field>
                                </v-card-title>
                                <v-data-table
                                    :headers="headers"
                                    :items="items"
                                    :items-per-page="5"
                                    item-key="nome_subcategoria"
                                    :search="search"
                                    loading 
                                    loading-text="Carregando as subcategorias...."
                                    class="elevation-1">

                                    <template v-slot:top>
                                        <v-toolbar flat>
                                            <v-toolbar-title>Produtos</v-toolbar-title>
                                            <v-divider class="mx-4" insert vertical></v-divider>
                                            <v-spacer></v-spacer>

                                            <v-dialog v-model="dialog" max-width="500px">
                                               <template v-slot:activator="{ on, attrs}">
                                                   <v-btn
                                                    class="mb-2"
                                                    color="primary"
                                                    dark
                                                    v-bind="attrs"
                                                    v-on="on">
                                                        Nova Categoria
                                                    </v-btn>
                                               </template>

                                               <v-card>
                                                   <v-card-title class="headline">{{formTitle}}</v-card-title>

                                                    <v-card-text>
                                                        <v-container>
                                                            <v-row>
                                                                <v-col cols="12" sm="6" md="4" class="flex-auto items-center py-2 px-4">
                                                                    <v-subheader>Nome subcategoria</v-subheader>
                                                                </v-col>
                                                                <v-col>
                                                                    <v-text-field
                                                                        v-model="editedItem.nome_subcategoria"
                                                                        label="Nome da categoria"
                                                                        single-line
                                                                        hide-details
                                                                        required>
                                                                    </v-text-field> 
                                                                </v-col>
                                                            </v-row>

                                                            <v-row>
                                                                <v-col cols="12" sm="6" md="4">
                                                                    <v-subheader>Categorias</v-subheader>
                                                                </v-col>
                                                                <v-col>
                                                                    
                                                                    <v-select
                                                                        v-model="editedItem.id_categoria"
                                                                        :items="itemsCategorias"
                                                                        item-text="nome_categoria"
                                                                        item-value="id"
                                                                        name="categorias"
                                                                        label="Categorias disponíveis"
                                                                        dense
                                                                        required>
                                                                    </v-select>
                                                                    
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
                                                            Salvar

                                                        </v-btn>
                                                    </v-card-actions>
                                               </v-card>
                                            </v-dialog>
                                            <v-dialog v-model="dialogDelete" max-width="500px">
                                                <v-card>
                                                    <v-card-title class="headline">
                                                        <v-subheader>{{editedItem.nome_subcategoria}}</v-subheader>
                                                        <p>Você tem certeza que deseja remover esta subcategoria ??</p>
                                                    </v-card-title>

                                                     <v-card-actions>
                                                    <v-spacer></v-spacer>
                                                    <v-btn
                                                        color="blue darken-1"
                                                        text
                                                        @click="closeDelete">
                                                            Cancelar
                                                    </v-btn>
                                                    <v-btn
                                                        color="blue darken-1"
                                                        text
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
                                            class="mr-2"
                                            color="indigo"
                                            @click="editItem(item)">
                                            mdi-pencil
                                        </v-icon>
                                        <v-icon
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
    //import Welcome from '@/Jetstream/Welcome'

    export default {
        components: {
            AppLayout,
            //Welcome,
        },
        props: ['subcategorias', 'categorias'],
        data(){
            return {
                search: '',
                items: [],
                itemsCategorias: [],
                loading: true,
                page: 1,
                itemsPerPage: 5,
                dialog: false,
                dialogDelete: false,
                headers: [
                    {
                        text: 'Subcategorias cadastradas',
                        align: 'start',
                        sortable: false,
                        value: 'controls',
                        filterable: true,
                    },
                    {
                        text: 'Nome subcategoria', value: "nome_subcategoria",

                    },
                    {
                        text: 'Ações', value: 'action', sortable: false,
                    }
                ],
                editedIndex: -1,
                editedItem: {
                    id_categoria: '',
                    nome_subcategoria: '',

                },
                defaultItem: {
                    id_categoria: '',
                    nome_subcategoria: '',

                },
            }
        },
        computed: {
            formTitle(){
                return this.editedIndex === -1 ? 'New Item ' : 'Edit Item';
            }
            
        },
        watch: {
            dialog(val)
            {
                val || this.close();
            },
            dialogDelete(val)
            {
                val || this.closeDelete();
            }
        },
        methods: {
            getItems(subcategorias)
            {
                var subcategorias = this.subcategorias;
                this.items = subcategorias; 
            },
            getItemsCategorias(categorias)
            {
                var categorias = this.categorias;
                this.itemsCategorias = categorias;
            },
            initialize()
            {
                this.items = [];
                this.itemsCategorias = [];
            },
            save()
            {
                if(this.editedIndex > -1)
                {
                    var data = Object.assign(this.items[this.editedIndex], this.editedItem);
                    this.$inertia.post(`/subcategorias/update/${this.editedItem.id}`, data)
                    .then(function(response){
                        window.alert('Nova categoria alterada com sucesso...');
                        window.location.href="/subcategorias";
                    })
                    .catch(function(error){
                        window.alert('Error' + error + 'contate o supore técnico...');

                    });
                  
                }
                else
                {
                    this.$inertia.post(`/subcategorias/store`, this.editedItem)
                    .then(function(response){
                        window.alert('Nova Subcategoria cadastrada com sucesso');
                        window.location.href="/subcategorias";

                    })
                    .catch(function(error){
                        window.alert('Error' + error + 'Contate o suporte técnico');
                    });
                   
                    this.items.push(this.editedItem);
                }
                this.close();
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
                this.$inertia.post(`/subcategorias/destroy/${this.editedItem.id}`)
                .then(function(response){
                    window.alert('Subcategoria removida com sucesso...');
                    window.location.href="/subcategorias";
                }).catch(function(error){
                    window.alert('Erro' + error + 'Contate o suporte técnico');
                });
                this.items.splice(this.editedIndex, 1)
                this.closeDelete();
            },
            close()
            {
                this.dialog = false;
                this.$nextTick(() => {
                    this.editedItem = Object.assign({}, this.defaultItem);
                    this.editedIndex = -1;
                })
            },
            closeDelete()
            {
                this.dialogDelete = false;
                this.$nextTick(() => {
                    this.editedItem = Object.assing({}, this.defaultItem);
                    this.editedIndex = -1;
                })
            },
        },
        created()
        {
            this.initialize();
        },
        mounted()
        {
            this.getItems();
            this.getItemsCategorias();
        }
    };
</script>
