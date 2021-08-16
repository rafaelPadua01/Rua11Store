<template>
  <app-layout data-app>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Vendas</h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
          <div class="grid-cols-1 sm:grid-cols-1 lg:grid-cols-4"></div>
          <div class="grid-cols-1 sm:grid-cols-1 lg:grid-cols-4"></div>
          <div class="flex-auto items-center py-2 px-4">
            <v-card>
              <!-- titulo do card com boão de busca -->
              <v-card-title>
                <!--<v-card-text-field></v-card-text-field>-->
              </v-card-title>

              <!-- oneudo principal do card -->
              <v-tabs background-color:="transparent" grow>
                <!-- Items da v-tabs -->
                <v-tab>Vender</v-tab>
                <v-tab>Histórico de vendas</v-tab>
                <v-tab>Estatistíca de vendas</v-tab>

                <v-tab-item>
                  <v-card flat>
                    <v-card-text>
                      <p>Formulário de vendas</p>
                      <v-divider></v-divider>
                      <template>
                        <v-stepper v-model="e1">
                          <v-stepper-header>
                            <v-stepper-step :complete="e1 > 1" step="1">
                              Selecione os produtos
                            </v-stepper-step>

                            <v-divider></v-divider>

                            <v-stepper-step :complete="e1 > 2" step="2">
                              Confirmar compra
                            </v-stepper-step>

                            <v-divider></v-divider>

                            <v-stepper-step step="3">
                              Finalizar compra
                            </v-stepper-step>
                          </v-stepper-header>

                          <v-stepper-items>
                            <!-- Primeiro passo  -->
                            <v-stepper-content step="1">
                              <v-card
                                class="mb-12"
                                color="grey lighten-1"
                                
                              >
                                <!-- Conteudo aqui -->

                                <v-select
                                  v-model="itemSelect"
                                  :items="items"
                                  item-text="nome_produto"
                                  label="Selecione os produtos"
                                  chips
                                  hint="Produtos selecionados"
                                  persistent-hint
                                  return-object
                                  multiple
                                >
                                 
                                  <template v-slot:selection="{ item, index }">
                                    <v-chip v-if="index === 0">
                                      <span>{{ item.nome_produto }}</span>
                                    </v-chip>

                                    <span
                                      v-if="index === 1"
                                      class="grey--text caption"
                                    >
                                      (+{{ value.length - 1 }} others)
                                    </span>
                                  </template>
                                </v-select>

                                <v-data-table
                                  :headers="headers"
                                  :items="itemSelect"
                                  :items-per-page="5"
                                  loading
                                  loading-text="Carregando os dados...aguarde um instante !"
                                  class="elevation-1"
                                >
                                  <template v-slot:top>
                                    <v-toolbar flat>
                                      <!-- Modal que defne a quantidade de cada produto -->
                                      <v-dialog
                                        v-model="dialog"
                                        max-height="500px"
                                      >
                                        <v-card>
                                          <v-card-title class="headline">
                                            <h2>
                                              Escolha a quanidade de produtos
                                              que deseja
                                            </h2>
                                          </v-card-title>

                                          <v-card-text>
                                            <v-container>
                                              <v-row>
                                                <v-col
                                                  cols="12"
                                                  sm="6"
                                                  md="4"
                                                  class="flex-auto items-center py-2 px-4"
                                                >
                                                  <v-text-field
                                                    v-model="editedItem.quantidade"
                                                    type="number"
                                                    label="Quantidade"
                                                    hide-details
                                                    single-line
                                                  >
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
                                              @click="close"
                                            >
                                              Cancelar
                                            </v-btn>

                                            <v-btn
                                              color="blue darken-1"
                                              text
                                              @click="save"
                                            ></v-btn>
                                          </v-card-actions>
                                        </v-card>
                                      </v-dialog>

                                      <!-- Modal de confirmação para remoção de produos -->
                                      <v-dialog
                                        v-model="dialogDelete"
                                        max-width="500px"
                                      >
                                        <v-card>
                                          <v-card-title class="headline">
                                            <v-img
                                              :src="removeItem.imagem_produto"
                                              :alt="removeItem.nome_produto"
                                              class="float-fle"
                                              loading
                                            >
                                            </v-img>
                                            <v-subheader>{{
                                              removeItem.nome_produto
                                            }}</v-subheader>
                                            Você tem certeza que deseja remover
                                            este produto ???
                                          </v-card-title>

                                          <v-card-actions>
                                            <v-spacer></v-spacer>
                                            <v-btn
                                              color="blue darken-1"
                                              text
                                              @click="closeDelete"
                                            >
                                              Cancel
                                            </v-btn>
                                            <v-btn
                                              color="blue darken-1"
                                              text
                                              @click="deleteItemConfirm"
                                            >
                                              Ok
                                            </v-btn>
                                          </v-card-actions>
                                        </v-card>
                                      </v-dialog>
                                    </v-toolbar>
                                  </template>


                                  <!-- Slot que carrega as magens dos produtos -->
                                  <template v-slot:item.image="{ item }">
                                    <div class="p-2">
                                      <v-img
                                        :src="item.imagem_produto"
                                        :alt="item.nome_produto"
                                        max-width="32"
                                        max-height="25"
                                      ></v-img>
                                    </div>
                                  </template>

                                  <!-- botões para seleção de quantidade -->
                                  <template
                                    v-slot:item.quantidade="{ item, index }"
                                  >
                                    
                                    <span v-if="itemIndex === 0">
                                      <v-btn
                                        type="link"
                                        color="blue darken-1"
                                        @click="editQuantidade(item)">
                                          {{item.quantidade}}
                                      </v-btn>
                                    </span>
                                    <span v-if="itemIndex === -1">
                                      <v-icon
                                        small
                                        class="mr-2"
                                        color="indigo"
                                        @click="editQuantidade(item)"
                                      >
                                        mdi-pencil
                                      </v-icon>
                                    </span>
                                  </template>

                                  <!-- botões de ação -->
                                  <template v-slot:item.action="{ item }">
                                    <v-icon
                                      small
                                      class="mr-2"
                                      indigo
                                      @click="deleteItem(item)"
                                    >
                                      mdi-delete
                                    </v-icon>
                                  </template>
                                </v-data-table>

                                <p>
                                  <small>Totais:</small>
                                  <small
                                    ><b>Quantidade: </b>
                                    {{ countProdutos() }}</small
                                  >
                                  <small
                                    ><b>Preço: </b> {{ countValores() }}</small
                                  >
                                </p>
                              </v-card>
                              <br >

                              <!-- Botão de confirmação -->
                              <v-btn color="blue darken-1" @click="e1 = 2">
                                Continuar
                              </v-btn>

                              <v-btn text> Cancel </v-btn>
                            </v-stepper-content>
                            <!-- inicio do segundo passo -->
                            <!-- aqui será exibivda a table com os produtos,    
                                                                    quantidade, e valor final -->
                            <v-stepper-content step="2">
                             
                              <v-card
                                 class="mb-12"
                                color="grey lighten-1">
                                <!-- aqui será o form do cliente -->
                                <template>
                                  <v-card-text>
                                    <v-container>
                                      <div></div>
                                      <v-row>
                                      <v-col class="flex-auto items-center py-2 px-4" cols="12" sm="6" md="4">
                                      
                                        <v-text-field 
                                          v-model="form.nome_cliente"
                                          type="text"
                                          hide-details
                                          label="Nome do Cliente"
                                          single-line
                                          required>
                                          
                                        </v-text-field>
                                           {{form.nome_cliente}}
                                      </v-col> 
                                    </v-row>
                                    <v-row>
                                      <v-col cols="12" sm="6" md="4">
                                        <v-text-field
                                          v-model="form.endereco_cliente"
                                          label="Endereço do Cliente"
                                          type="text"
                                          hide-details 
                                          single-line
                                          required>
                                       
                                        </v-text-field>
                                        {{form.endereco_cliente}}
                                      </v-col>
                                    </v-row>

                                    <v-row>
                                      <v-col cols="12" sm="6" md="4">
                                        <v-row>
                                          <v-col>
                                             <v-subheader>Formas de pagamento</v-subheader>
                                             <hr>
                                          </v-col>
                                        </v-row> 

                                          <v-row>
                                            <v-col cols="12" sm="6" md="4">
                                              
                                            <v-radio-group 
                                              v-model="form.forma_pagamento"
                                              row >
                                                
                                                <v-radio
                                                  
                                                  label="Dinheiro"
                                                  value="dinheiro">
                                                </v-radio>

                                                <v-radio
                                                  
                                                  label="Cartão"
                                                  value="cartao">
                                              
                                              </v-radio>
                                                
                                            </v-radio-group>

                                            
                                              </v-col> 
                                          </v-row>

                                          <v-row>
                                            <v-col>
                                               <template v-if="form.forma_pagamento === 'dinheiro'">
                                                  
                                                  <p>
                                                    <b>Valor da Compra:</b>
                                                    <small> 
                                                      R$ {{countValores()}}
                                                    </small>
                                                    <b>Troco:</b>
                                                    <small>
                                                      $R$ {{ valorPago - countValores()}}
                                                    </small>

                                                  </p>

                                                  <v-text-field
                                                    v-model="valorPago"
                                                    label="pagamento"
                                                    type="number"
                                                    value="0.00"
                                                    hide-details
                                                    single-line
                                                    prefix="$">

                                                  </v-text-field>

                                                 
                                              </template>

                                              <template v-if="form.forma_pagamento === 'cartao'">
                                                  
                                                  Ver formas de pagamaento para cartão :D
                                              </template>


                                            </v-col>
                                          </v-row>

                                         
                                      </v-col>
                                    </v-row>
                                    </v-container>
                                    
                                 
                                  </v-card-text>
                                  <v-container>
                                    

                                  </v-container>
                                  
                                </template>
                               
                              </v-card>

                              <v-btn color="green darken-1" @click="e1 = 3">
                                Continuar
                              </v-btn>

                              <v-btn text> Cancel </v-btn>
                            </v-stepper-content>

                            <v-stepper-content step="3">
                                <v-card
                                  class="mb-12"
                                  color="grey lighten-1"
                                >
                                  <div></div>
                                
                                    <v-container>
                                      <v-row>
                                        <v-col>
                                          <template>
                                            <p>
                                               <b>Nome do cliente:</b>
                                                <small>
                                                  {{form.nome_cliente}}  
                                                </small> 
                                                <b>Endereço do cliente:</b>
                                                <small>
                                                  {{form.endereco_cliente}}
                                                </small>

                                              <b>Valor da Compra:</b>
                                                <small> 
                                                  R$ {{countValores()}}
                                                </small>
                                                <b>Troco:</b>
                                                <small>
                                                $R$ {{ valorPago - countValores()}}
                                                </small>
                                               
                                            </p>
                                            <p>
                                              
                                            </p>
                                          </template>
                                        </v-col>
                                      </v-row>

                                      <v-row>
                                        <v-col>
                                          <v-data-table
                                            :headers="headers"
                                            :items="itemSelect"
                                            :items-per-page="5"
                                            loading
                                            loading-text="Carregando produtos...."
                                            class="elevation-1"
                                            >
                                          
                                          </v-data-table>
                                        </v-col>
                                      </v-row>
                                    </v-container>
                                    <div class="flex-auto items-center px-2 py-4" cols="12" sm="6" md="4">
                                      
                                    </div>  
                                  
                                </v-card>

                                <!-- Botão de finalização da compra -->
                                <v-btn color="blue darken-1"  @click="addCompra($event, )">
                                  Finalizar compra
                                </v-btn>
                                <v-btn color="blue darken-1" text>
                                  Cancel
                                </v-btn>
                            </v-stepper-content>
                          </v-stepper-items>
                        </v-stepper>
                      </template>
                    </v-card-text>
                  </v-card>
                </v-tab-item>

                <!-- Aqui será o item do historico de vendas -->
                <v-tab-item>
                  <v-card flat>
                    <v-card-text>
                      <v-data-table
                        v-model="itemSelectVenda"
                        :headers="headersVendas"
                        :items="itemsVenda"
                        :items-per-page="5"
                        :single-select="singleSelect"
                        item-key="id"
                        show-select
                        loading
                        loading-text="Carregando histórico de vendas..."
                        >

                        <template v-slot:top>
                          <v-row
                            align="center"
                            >

                            <v-col cols="12" sm="6" class="py-2">

                              <v-btn-toggle 
                                v-model="text"
                                tile
                                color="deep-purple accent-3"
                                group
                              >
                                <!-- Cira os caixas de seleção -->
                              <v-switch
                                v-model="singleSelect"
                                label="single select"
                                class="pa-3">
                                          
                                </v-switch>

                                <v-btn
                                  class="ma-2"
                                  outlined
                                 @click="deleteVendaAll()"
                                >
                                  <v-icon>
                                    mdi-delete
                                  </v-icon>  

                                  Remove All
                                </v-btn>
                              </v-btn-toggle>
                              
                            </v-col>
                        </v-row>
                         
                                  
                          <v-toolbar flat>
                            <v-dialog v-model="dialogVenda" max-height="500px">
                            <v-card>
                              <v-card-title>{{formTitle}}</v-card-title>

                                <v-card-text>
                                  <v-container>
                                    <v-row>
                                      <v-col cols="12" sm="6" md="4" class="flex-auto items-center py-2 px-4">
                                        <v-text-field
                                          v-model="editedItemVenda.nome_cliente"
                                          type="text"
                                          single-line
                                          hide-details
                                          label="Nome cliente">
                                          </v-text-field>
                                      </v-col>
                                    </v-row>

                                    <v-row>
                                      <v-col cols="12" sm="6" md="4" class="flex-auto items-center py-2 px-4">
                                        <v-text-field
                                          v-model="editedItemVenda.endereco_cliente"
                                          type="text"
                                          single-line
                                          hide-details
                                          label="Endereço cliente">
                                        </v-text-field>
                                      </v-col>
                                    </v-row>

                                    <v-row>
                                      <v-col cols="12" sm="6" md="4" class="flex-auto items-center py-2 px-4">
                                        <v-select
                                          v-model="itemSelectVenda"
                                          :items="items"
                                          item-text="nome_produto"
                                          label="Selecione os produtos"
                                          chips
                                          hint="Produtos selecionados"
                                          persistent-hint
                                          return-object
                                          multiple
                                        >
                                          {{editedItemVenda.nome_produto}}
                                        <template v-slot:selection="{ item, index }">
                                          <v-chip v-if="index === 0">
                                            <span>{{ item.nome_produto }}</span>
                                          </v-chip>

                                          <span
                                            v-if="index === 1"
                                            class="grey--text caption"
                                          >
                                            (+{{ value.length - 1 }} others)
                                          </span>
                                      </template>

                                        </v-select>
                                      </v-col>
                                    </v-row>

                                    <v-row>
                                      <v-col cols="12" sm="6" md="4" class="flex-auto items-center py-2 px-4">
                                        <v-text-field
                                          v-model="editedItemVenda.quantidade"
                                          type='number'
                                          single-line
                                          hide-details
                                          label="Quantidade">
                                        </v-text-field>
                                      </v-col>
                                    </v-row>
                                  </v-container>
                                </v-card-text>

                                <v-card-actions>
                                  <v-btn
                                    small
                                    color="blue darken-1"
                                    @click="closeDeleteVenda">
                                      Cancel
                                    </v-btn>

                                    <v-btn
                                      small
                                      color="blue darken-1"
                                      @click="saveVenda"
                                    >
                                      Salvar
                                  </v-btn>
                                </v-card-actions>
                              </v-card>
                          </v-dialog>
                          </v-toolbar>

                          
                          <v-dialog v-model="dialogDeleteVenda" max-width="500px">
                            <v-card>
                              <v-card-title>
                                <v-subheader>{{editedItemVenda.nome_cliente}}</v-subheader>
                              </v-card-title>

                                <v-card-text>
                                  <v-container>
                                      <v-row>
                                        <v-col cols="12" sm="6" md="4" class="flex-auto items-center py-2 px-4">
                                          
                                            Você tem certeza que deseja remover esta compra ? 
                                        </v-col>
                                      </v-row>
                                  </v-container>
                                </v-card-text>

                                <v-card-actions>
                                  <v-spacer></v-spacer>
                                  <v-btn
                                    small
                                    class="mr-2"
                                    color="blue darken-1"
                                    @click="closeDeleteVenda">
                                      Close
                                    </v-btn>
                                  <v-btn
                                    small
                                    class="mr-2"
                                    color="blue darken-1"
                                    @click="deleteItemVendaConfirm"
                                    >
                                    Remover
                                  </v-btn>
                                </v-card-actions>
                            </v-card>
                          </v-dialog>
                        </template> 

                       <!-- botões de ação -->
                        <template v-slot:item.action="{ item }">
                         

                          <v-icon
                            small
                            class="mr-2"
                            indigo
                            @click="deleteVenda(item)"
                          >
                            mdi-delete 
                            
                          </v-icon>

                          
                      </template>

                      </v-data-table>
                      </v-card-text>
                  </v-card>
                </v-tab-item>
              </v-tabs>
            </v-card>
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
  props: ["produtos", "vendas"],
  data() {
    return {
      e1: 1,
      items: [],
      itemSelect: [],
      itemSelectVenda: [],
      singleSelect: false,
      itemsForm: [],
      itemsVenda: [],
      totalValor: 0, 
      valorPago: 0,
      value: [],
      loading: true,
      page: 1,
      itemsPerpage: 5,
      itemIndex: -1,
      itemIndexVenda: -1,
      dialogDelete: false,
      dialogDeleteVenda: false,
      dialog: false,
      dialogVenda: false,
      column: null,
      row: null,
      text: 'center',
      headers: [
        {
          text: "Produtos selecionados",
          align: "start",
          sortable: false,
          value: "controls",
          filltrable: true,
          text: "imagem",
          value: "image",
          sortable: false,
        },
        { text: "Nome", value: "nome_produto" },
        { text: "preco", value: "preco" },
        { text: "status", value: "status" },
        { text: "quantidade", value: "quantidade" },
        { text: "Ações", value: "action", sortable: false },
        
      ],
      headersVendas: [
        {
          text: "Ultimas vendas realizadas",
          align: 'start',
          sortable: true,
          value: 'controls',
          filltrable: true,
        },
        {
          text: 'nome_cliente', value: 'nome_cliente' 
        },
        {
          text: "nome_produto", value: 'nome_produto',
        },
        {
          text: "quantidade", value: 'quantidade'
        },
        {
          text: 'preco', value: 'preco',
        
        },
        {
          text: 'forma_pagamento', value: 'forma_pagamento',
        },
        {
          text: 'Ações', value: 'action', sortable: false
        },


      ],
      removeItem: {
        id_produto: null,
        nome_produto: null,
        quantidade: null,
        preco: "",
        nome_cliente: "",
        endereco_cliente: "",
        forma_pagamento: "",
      },
      editedItem: {
        id_produto: "",
        nome_produto: "",
        quantidade: null,
        preco: 0,
      },
      form: {
        nome_cliente: '',
        endereco_cliente: '',
        forma_pagamento: '',
      },
      editedItemVenda: {
        id: '',
        id_user: '',
        id_produto: '',
        nome_cliente: '',
        endereco_cliente: '',
        nome_produto: '',
        quantidade: '',
        preco: '',

      }
    };
  },
  computed: {
    formTitle() {
      return this.itemIndex === -1 ? "New item" : "Edit Item";
    },
  },
  watch: {
    dialog(val) {
      val || this.close();
    },
    dialogDelete(val) {
      val || this.closeDelete();
    },
    dialogVenda(val){
      val || this.closeVenda();
    },
    dialogDeleteVenda(val)
    {
      val || this.closeDeleteVenda();
    },
    changeState(status) {
      return (this.editedItem.status = "indisponivel");
    },
  },
  methods: {
    getProdutos(produtos) {
      var produtos = this.produtos;
      this.items = produtos;
    },
    getVendas(vendas)
    {
      var vendas = this.vendas;
      this.itemsVenda = vendas;
    },
    countProdutos(itemSelect) {
      var itemSelect = this.itemSelect;
      var total = 0;
      for(var i =  0; i < itemSelect.length; i++)
      {
        total += itemSelect[i].quantidade * 1;
      }
      
      return total;
    },
    countValores(itemSelect) {
      var itemSelect = this.itemSelect;
      var totalValor = 0;
      
      for(var i = 0; i < itemSelect.length; i++)
      {
        totalValor += itemSelect[i].quantidade * itemSelect[i].preco;
      }
      
      return totalValor;
    
    },
    /*função que calcula valor da compra 
        valor do troco
        e retorna na tela */
        
    editQuantidade(item) {
      this.itemIndex = this.itemSelect.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialog = true;
    },
    /*Edita uma compra já cadastrada */
    editVenda(item){
      this.itemIndexVenda = this.itemsVenda.indexOf(item);
      this.editedItemVenda = Object.assign({}, item);
      this.dialogVenda = true;
    },
    /*Remove Iem Selecionado */
    deleteItem(item) {
      this.itemIndex = this.itemSelect.indexOf(item);
      this.removeItem = Object.assign({}, item);
      this.dialogDelete = true;
    },
    deleteItemConfirm() {
      this.itemSelect.splice(this.itemIndex, 1);
      this.closeDelete();
    },
    /*remve uma venda cadastrada */
    deleteVenda(item){
      
      this.itemIndexVenda = this.itemsVenda.indexOf(item);
      this.editedItemVenda = Object.assign({}, item);
      this.dialogDeleteVenda = true;
    },
    deleteItemVendaConfirm(editedItemVenda)
    {
      var data = this.editedItemVenda;
      
          this.$inertia.post(`/vendas/destroy/${data.id}`)
        .then(function(response){
          window.alert('Venda removida com sucesso...');
          window.location.href="/vendas";
        })
        .catch(function(error){
          window.alert('Erro' + error + 'contate o suporte técnico...');
        });

        this.itemsVenda.splice(this.itemIndexVenda, 1);
        this.closeDeleteVenda();
    },
    deleteVendaAll(itemSelectVenda)
    {
      var itemSelectVenda = this.itemSelectVenda;

      if(itemSelectVenda
       >= 1)
      {
        this.$inertia.post(`/vendas/destroyAll`, itemSelectVenda)
        .then(function(response){
          window.alert('As vendas selecionadas foram removidas com sucesso...');
          window.location.href="/vendas";
        })
        .catch(function(error){
          window.alert('Erro:' + 'entre em contato com suporte técnico...');
        });


      }
      else
      {
         window.alert('você deve selecionar uma ou mais vendas para remover....');
      }
      
    },
    save() {
      if (this.itemIndex >= 0) {
        Object.assign(this.itemSelect[this.itemIndex], this.editedItem);
      } else {
        this.itemSelect.push(this.editedItem);
      }

      this.close();
    },
    saveVenda()
    {
      if(this.itemIndex >= 0)
      {
        Object.assign({}, this.itemsVenda[this.itemIndex], this.editedItemVenda);
      }
      else
      {
        this.itemsVenda.push(this.editedItemVenda)
      }

      this.closeDeleteVenda();
    },
    addCompra(itemSelect, form)
    {
      var itemSelect = this.itemSelect;
      var form = this.form;
      let data = Object.assign({}, itemSelect, form);

     
     
      this.$inertia.post("/vendas/addCompra", data, form)
          .then(function(response){
            window.alert('Venda registrada com suesso !!!');
            window.location.href="/vendas";
          })
          .catch(function(error){
            window.alert('Erro:' + error + 'Contacte o suporte técnico');
          });
    },
    close() {
      this.dialog = false;
      this.$nextTick(() => {
        this.editedItem = Object.assign({}, this.defaultItem);
        this.itemIndex = 0;
      });
    },
    closeVenda(){
      this.dialogVenda = false;
      this.$nextTick(() => {
        this.editedItemVenda = Object.assign({}, this.defaultItem);
        this.itemIndexVenda = 0;
      });
    },
    closeDelete() {
      this.dialogDelete = false;
      this.$nextTick(() => {
        this.removeItem = Object.assign({}, this.defaultItem);
        this.itemIndex = -1;
      });
    },
    closeDeleteVenda()
    {
      this.dialogDeleteVenda = false;
      this.$nextTick(() => {
        this.editedItemVenda = Object.assign({}, this.defaultItem);
        this.itemIndexVenda = -1;
      });
    },
    initialize() {
      this.items = [];
      this.itemsSelect = [];
      this.itemsVenda = [];
    },
  },
  created() {
    this.initialize();
  },
  mounted() {
    this.getProdutos();
    this.getVendas();
  },
};
</script>