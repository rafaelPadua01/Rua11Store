<template>
  <app-layout data-app>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Produtos
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
          <div class="grid-cols-1 sm:grid-cols-1 lg:grid-cols-4"></div>

          <div class="grid-cols-1 sm:grid-cols-1 lg:grid-cols-4"></div>
          <div class="grid-cols-1 sm:grid-cols-1 lg:grid-cols-4">
            <template>
              <div></div>
              <div class="flex-auto items-center py-2 px-4">
                <v-card>
                  <v-card-title>
                    <v-text-field
                      v-model="search"
                      append-icon="mdi-magnify"
                      label="Busca"
                      single-line
                      hide-details
                    ></v-text-field>
                    <br />
                    <p>
                      <small>Totais:</small>
                      <small><b>Quantidade</b> {{ countProdutos() }}</small>
                      <small><b>Valores</b> {{ countValores() }}</small>
                    </p>
                  </v-card-title>

                  <v-data-table
                    :headers="headers"
                    :items="items"
                    :items-per-page="5"
                    item-key="nome_produto"
                    :search="search"
                    class="elevation-1"
                    loading
                    loading-text="Carregando os dados...aguarde um instante !"
                  >
                    <template v-slot:top>
                      <v-toolbar flat>
                        <v-toolbar-title>Produtos</v-toolbar-title>
                        <v-divider class="mx-4" inset vertical></v-divider>
                        <v-spacer></v-spacer>

                        <v-dialog v-model="dialog" max-width="500px">
                          <template v-slot:activator="{ on, attrs }">
                            <v-btn
                              color="primary"
                              dark
                              class="mb-2"
                              v-bind="attrs"
                              v-on="on"
                            >
                                
                                Novo Produto
                             
                            </v-btn>
                          </template>
                          <v-card>
                            <v-card-title>
                              <span class="headline">{{ formTitle }}</span>
                            </v-card-title>

                            <v-card-text>
                              <v-container>
                                <v-row>
                                  <v-col cols="12" sm="6" md="4" class='flex-auto items-center py-2 px-4'>
                                 
                                    <v-img
                                      class="float-fle"
                                      :src="editedItem.imagem_produto"
                                      :alt="editedItem.nome_produto"
                                      v-model="editedItem.imagem_produto"
                                      label="Imagem do Produto:"
                                      
                                    >
                                    </v-img>
                                    
                                  </v-col>
                                </v-row>
                                <v-row>
                                  <v-col cols="12" sm="6" md="4">
                                    <v-subheader>Nome do produto: </v-subheader>
                                  </v-col>
                                  <v-col>
                                    <v-text-field
                                      v-model="editedItem.nome_produto"
                                      label="Nome do Produto:"
                                      required
                                    ></v-text-field>
                                  </v-col>
                                </v-row>
                                <v-row>
                                  <v-col cols="12" sm="6" md="4">
                                    <v-subheader>Foto do produto: </v-subheader>
                                  </v-col>
                                  <v-col cols="12" sm="6" md="4">
                                    <v-file-input
                                      v-model="editedItem.imagem_produto"
                                      label="foto do produto..."
                                      filled
                                      prepend-icon="mdi-camera"
                                      ref='file'
                                      required
                                      
                                    >
                                    </v-file-input>
                                  </v-col>
                                </v-row>
                                <v-row>
                                  <v-col cols="12" sm="6" md="4">
                                    <v-subheader>Categorias:</v-subheader>
                                  </v-col>
                                  <v-col>
                                    <v-select
                                      v-model="editedItem.id_categoria"
                                      :items="itemsCategorias"
                                      item-text="nome_categoria"
                                      item-value="id"
                                      return-object
                                      name="categorias"
                                      label="Categorias"
                                      dense
                                      required
                                    >
                                    </v-select>
                                  </v-col>
                                </v-row>
                                <v-row>
                                  <v-col cols="12" sm="6" md="4">
                                    <v-subheader>Subcategorias: </v-subheader>
                                  </v-col>
                                  <v-col>
                                    <v-select
                                      v-model="editedItem.id_subcategoria"
                                      :items="itemsSubcategorias"
                                      item-text='nome_subcategoria'
                                      item-value='id'
                                      return-object
                                      label="Subcategorias"
                                      dense
                                      requied
                                    >
                                    </v-select>
                                  </v-col>
                                </v-row>
                                <v-row>
                                  <v-col cols="12" sm="6" md="4">
                                    <v-subheader>Preço: </v-subheader>
                                  </v-col>
                                  <v-col cols="8">
                                    <v-text-field
                                      v-model="editedItem.preco"
                                      label="Preço"
                                      value="10.00"
                                      prefix="$"
                                      required
                                    ></v-text-field>
                                  </v-col>
                                  <v-col cols="8" sm="6" md="4">
                                    <v-subheader>Quantidade: </v-subheader>
                                  </v-col>
                                  <v-col>
                                    <v-text-field
                                      v-model="editedItem.quantidade"
                                      label="Quantidade: "
                                    >
                                    </v-text-field>
                                  </v-col>
                                </v-row>
                                <v-row>
                                  <v-col cols="12" sm="6" md="4">
                                    <v-subheader>Status: </v-subheader>
                                  </v-col>
                                  <v-col>
                                    <v-switch
                                      v-model="editedItem.status"
                                      :label="`status: ${editedItem.status.toString()}`"
                                      :false-value="false"
                                      required
                                    >
                                    </v-switch>
                                  </v-col>
                                </v-row>
                                <v-row>
                                  <v-col cols="12" sm="6" md="4">
                                    <v-subheader>Descrição:</v-subheader>
                                  </v-col>
                                  <v-col>
                                    <v-textarea
                                      v-model='editedItem.descricao'
                                      prepend-inner-icon="mdi-comment"
                                      class="mx-2"
                                      label="Descrição do produto..."
                                      rows="1"
                                      required
                                    >
                                    </v-textarea>
                                  </v-col>
                                </v-row>
                              </v-container>
                            </v-card-text>

                            <v-card-actions>
                              <v-spacer></v-spacer>
                              <v-btn 
                                color="blue darken-1" 
                                text
                                @click="close"
                            >
                                   Cancelar
                                
                            
                              </v-btn>
                              <v-btn 
                                color="blue darken-1" 
                                text
                                @click="save"
                              >
                              Salvar
                            
                              </v-btn>
                            </v-card-actions>
                          </v-card>
                        </v-dialog>
                        <v-dialog v-model="dialogDelete" max-width="500px">
                          <v-card>
                            <v-card-title class="headline">
                              <v-img 
                                :src="editedItem.imagem_produto" 
                                :alt="editedItem.imagem_produto"
                                class="float-fle"
                                loading ></v-img>
                              <v-subheader>{{editedItem.nome_produto}}</v-subheader>
                              Você tem certeza que deseja remover este produto ? 
                            </v-card-title>
                            <v-card-actions>
                              <v-spacer></v-spacer>
                              <v-btn
                                color="blue darken-1"
                                text
                                @click="closeDelete"
                                >Cancel</v-btn
                              >
                              <v-btn
                                color="blue darken-1"
                                text
                                @click="deleteItemConfirm"
                                >Ok</v-btn
                              >
                            </v-card-actions>
                          </v-card>
                        </v-dialog>
                      </v-toolbar>
                    </template>
                    <template v-slot:item.image="{ item }">
                      <div class="p-2">
                        <v-img
                          :src="item.imagem_produto"
                          :alt="item.nome_produto"
                          max-width="150"
                          max-height="100"
                        >
                          <template v-slot:placeholder>
                            <v-row class="fill-height ma-0" align="center">
                              <v-progress-circular
                                indeterminate
                                color="grey lighten-5"
                              ></v-progress-circular>
                            </v-row>
                          </template>
                        </v-img>
                      </div>
                    </template>
                    <template v-slot:item.action="{ item }">
                      <v-icon
                        small
                        class="mr-2"
                        color="indigo"
                        @click="editItem(item)"
                      >
                        mdi-pencil
                      </v-icon>
                      <v-icon
                        class="mr-2"
                        small
                        color="indigo"
                        @click="deleteItem(item)"
                      >
                        mdi-delete
                      </v-icon>
                    </template>
                  </v-data-table>
                </v-card>
              </div>

              <div class="grid-cols-1 sm:grid-cols-1 lg:grid-cols-4">
                <template>
                  <div></div>
                  <div class="flex-auto items-center py-2 px-4">
                    <!-- Paginação aqui -->
                    <!-- desta parte em diante, decidi utilizar o framework vuetify
                                            por conter maior documentação e facilidade nas pesquisas 
                                        <template>
                                            <div class="center">
                                              <v-container>
                                                  <v-row justify="center">
                                                      <v-col cols="8">
                                                          <v-container class="max-width">
                                                              <v-pagination
                                                                v-model="pagination.current"
                                                                class="my-4"
                                                                :length="pagination.total"
                                                                @input="onPageChange"></v-pagination>
                                                          </v-container>
                                                      </v-col>
                                                  </v-row>
                                              </v-container>
                                            </div>
                                        </template>-->
                  </div>
                  <div>Espaçamento</div>
                </template>
              </div>
            </template>
          </div>
        </div>
      </div>
    </div>
  </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";

export default {
  components: {
    AppLayout,
  },
  props: ["produtos", "categorias", "subcategorias"],
  data() {
    return {
      search: "",
      switch1: false,
      items: [],
      itemsCategorias: [],
      itemsSubcategorias: [],
      loading: true,
      page: 1,
      itemsPerpage: 5,
      dialog: false,
      headers: [
        
        {
          text: "produtos cadastrados",
          align: "start",
          sortable: false,
          value: "controls",
          filterable: true,
          text: "imagem",
          value: "image",
          sortable: false,
          
        },
        { text: "Nome", value: "nome_produto" },
        { text: "Descricao", value: "descricao" },
        { text: "Quantidade", value: "quantidade" },
        { text: "preco", value: "preco" },
        { text: "status", value: "status" },
        { text: "acoes", value: "action", sortable: false },
      ],
      editedIndex: -1,
      editedItem: {
        nome_produto: "",
        descricao: '',
        quantidade: '',
        imagem_produto: '',
        preco: '',
        status: '',
        id_categoria: '',
        id_subcategoria: '',
      },
    };
  },
  computed: {
    formTitle() {
      return this.editedIndex === -1 ? "New Item" : "Edit Item";
    },
  },
  watch: {
    dialog(val) {
      val || this.close();
    },
    dialogDelete(val) {
      val || this.closeDelete();
    },
    chageState(status)
    {
      return this.editedItem.status = 'indisponível';    
    }
  },

  methods: {
    countProdutos(produtos) {
      var produtos = this.produtos;
      var total = produtos.reduce((total, sum) => (total += sum.quantidade), 0);
      return total;
    },
    countValores(produtos) {
      var produtos = this.produtos;
      var totalValor = produtos.reduce(
        (total, sum) => (total += sum.preco * sum.quantidade),
        0
      );
      return totalValor;
    },
    getItems(produtos) {
      var produtos = this.produtos;
      this.items = produtos;
    },
    getItemsCategorias(categorias) {
      var categorias = this.categorias;
      this.itemsCategorias = categorias;
    },
    getItemsSubcategorias(subcategorias){
        var subcategorias = this.subcategorias;
        this.itemsSubcategorias = this.subcategorias;
    },
    initialize() {
      this.items = [];
      this.itemsCategorias = [];
      this.itemsSubcategorias = [];
    },
    editItem(item) {
      this.editedIndex = this.items.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialog = true;
    },
    deleteItem(item) {
      this.editedIndex = this.items.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialogDelete = true;
    },
    deleteItemConfirm() {
      this.$inertia.post(`/produtos/destroy/${this.editedItem.id}`)
      .then(function(response){
        window.alert('Produto removido da lista ccom sucesso');
        window.location.href = '/product';
      
      })
      .catch(function(error){
        window.alert('Erro: ' + error + 'Contate o suporte técnico....');
        
      });
      this.items.splice(this.editedIndex, 1);
      this.closeDelete();
    },
    close() {
      this.dialog = false;
      this.$nextTick(() => {
        this.editedItem = Object.assign({}, this.defaultItem);
        this.editedIndex = -1;
      });
    },
    closeDelete() {
      this.dialogDelete = false;
      this.$nextTick(() => {
        this.editedItem = Object.assign({}, this.defaultItem);
        this.editedIndex = -1;
      });
    },
    save() {
      if(this.editedIndex > -1) {
        var item = Object.assign(this.items[this.editedIndex], this.editedItem)
        let data = new FormData();
        data.append('imagem_produto', this.editedItem.imagem_produto);
        data.append('nome_produto', this.editedItem.nome_produto);
        data.append('status', this.editedItem.status || '');
        data.append('preco', this.editedItem.preco);
        data.append('quantidade', this.editedItem.quantidade);
        data.append('descricao', this.editedItem.descricao);
        data.append('id_categoria', this.editedItem.id_categoria);
        data.append('id_subcategoria', this.editedItem.id_subcategoria);
        

        
        this.$inertia.post(`/produtos/update/${this.editedItem.id}`, data)
        .then(function(response){
          window.alert('Produto alterado com sucesso...');
           window.location.href = "/product";
        }).catch(function(error){
          window.alert('Erro:' + error + 'Contate o suporte técnico....');
          
        });
         
      } else {
        var data = new FormData();
        data.append("id_categoria", JSON.stringify(1, this.editedItem.id_categoria) || "");
        data.append("id_subcategoria", JSON.stringify(1, this.editedItem.id_subcategoria) || "");
        data.append("nome_produto", this.editedItem.nome_produto || "");
        data.append("file", this.editedItem.imagem_produto || "");
        data.append("status", this.editedItem.status || "");
        data.append("preco", this.editedItem.preco || "");
        data.append("quantidade", this.editedItem.quantidade || "");
        data.append("descricao", this.editedItem.descricao);

        this.$inertia.post("/produtos/store", data)
          .then(function(response) {
            window.alert("produto cadastrado com sucesso");
            window.location.href = "/product";
          })
          .catch(function(error) {
            window.alert("Erro: " + error + "Contate o suporte técnico....");
          });

        this.items.push(this.editedItem);
      }
      this.close();
    },
    handleFile(e) {
      this.editedItem.imagem_produto = e.target.files[0];
    },
  },
  created() {
    this.initialize();
  },
  mounted() {
    //this.getProdutos();
    this.getItems();
    this.getItemsCategorias();
    this.getItemsSubcategorias();
  },
};
</script>
