<template>
    <v-app>
        <v-card
        class="mx-auto overflow-hidden"
        color="gray lighten-4"
        flat
        tile
        
    >
        <v-system-bar color="purple darken-3"></v-system-bar>

        <v-app-bar
            color="deep-purple"
            dark
            >
            <v-app-bar-nav-icon @click="drawer = true"></v-app-bar-nav-icon>

            <v-toolbar-title>Rua11Store</v-toolbar-title>
            
            <v-spacer></v-spacer>
            <!--

            <v-btn icon>
                <v-icon>mdi-magnify</v-icon>
            </v-btn>

            <v-btn icon>
                <v-icon>mdi-filter</v-icon>
            </v-btn>

            <v-btn icon>
                <v-icon>mdi-dots-vertical</v-icon>
            </v-btn>
                -->
            </v-app-bar>
        
            <v-navigation-drawer
                v-model="drawer"
                absolute
                temporary
            >
                <v-list
                    nav
                    dense>
                        <!-- <v-list-item-group
                            v-model="group"
                            active-class="deep-purple--text">
                               <v-list-item>
                                    <v-list-item-title>
                                    <v-button v-if="$page.jetstream.managesProfilePhotos">
                                    <img class="h-8 w-8 rounded-full object-cover" :src="$page.user.profile_photo_url" :alt="$page.user.name" />
                                    </v-button>

                                    <div class="flex-shrink-0">
                                    <img class="h-10 w-10 rounded-full items-center" :src="$page.user.profile_photo_url" :alt="$page.user.name" />
                                    </div> 

                                    
                                    </v-list-item-title>
                                </v-list-item>
                                -->

                              <!--  <v-list-item>
                                    <v-list-item-title>{{ $page.user.name }}</v-list-item-title>
                                     <v-list-item-title>{{ $page.user.email }}</v-list-item-title> 
                                </v-list-item> -->

                                <v-divider></v-divider>
                                <!-- <v-list-item>
                                    <v-list-item-icon>
                                        <v-icon>mdi-home</v-icon>
                                    </v-list-item-icon>
                                    <v-list-item-title @click="home()">Home</v-list-item-title> 
                                </v-list-item>
                                -->

                                <!-- <v-list-item>
                                    <v-list-item-icon>
                                        <v-icon>mdi-account</v-icon>
                                    </v-list-item-icon>
                                    <v-list-item-title>
                                       
                                        <a :href="route('profile.show')" :active="$page.currentRouteName == 'profile.show'">
                                            Profile
                                        </a> 
                                      
                                     </v-list-item-title>
                                  </v-list-item>

                                <v-list-item>
                                    <v-list-item-icon>
                                        <v-icon>mdi-logout</v-icon>
                                    </v-list-item-icon>
                                    <v-list-item-title>Logout</v-list-item-title>
                                </v-list-item>
                                  -->
                                <v-divider></v-divider>
                               <!--  <v-list-item>
                                    
                                    <v-list-item-title>Categorias</v-list-item-title>
                                    
                                </v-list-item>
                                <v-list-item>
                                    
                                    <v-list-item-title>Subcategorias</v-list-item-title>
                                    
                                </v-list-item>
                                <v-list-item >
                                    
                                    <v-list-item-title>Produtos</v-list-item-title>
                                    
                                </v-list-item>
                                <v-list-item>
                                    
                                    <v-list-item-title>Vendas</v-list-item-title>
                                    
                                </v-list-item> 
                                
                         </v-list-item-group> -->
                    </v-list>

            </v-navigation-drawer>
            
            <main>
                 <v-card-text>
                    <!--Banner da Página -->
                                <v-banner>
                                    <v-card-title>
                                    <v-carousel 
                                        :show-arrows="false" 
                                        cycle
                                        height="250"
                                        hide-delimiters
                                        
                                    >
                                        <v-carousel-item
                                            v-for="(item, i) in itemImages"
                                            :key="i"
                                            :src="item.replace('public/', './storage/')"
                                            :lazy-src="item.replace('public/', './storage/')"
                                            reverse-transition="fade-transition"
                                            transition="fade-transition"
                                            max-height="200"
                                            max-width="670"
                                            :aspect-ratio="16/9"
                                        
                                        >
                                       
                                        </v-carousel-item>
                                    </v-carousel>
                                </v-card-title>
                            </v-banner>
                        
               
            </v-card-text>
                
                <v-card-text>
                    <v-card
                        dark
                        elevation="10"
                        class="flex-auto text-right">
                        <v-row dense>
                            
                            <v-col>
                                <v-img
                                    src="./storage/homepage/background_homepage.jpg"
                                    lazy-src="./storage/homepage/background_homepage.jpg"
                                    class="white--text align-right"
                                    gradient="to bottom, rgba(0,0,0,.1), rgba(0,0,0,.5)"
                                >
                                <template v-slot:placeholder>
                                    <v-row 
                                        class="fill-height ma-8"
                                        align='center'
                                        justify="center">
                                        <v-progress-circular
                                            color="green lighten-5">
                                        </v-progress-circular>
                                    </v-row>
                                </template>
                                    <v-card-title class="align-right white--text">
                                            <v-spacer></v-spacer>
                                            Bem vindo a Rua11Store - Tabacaria e HeadShop
                                        
                                    </v-card-title>
                                    
                                    <v-spacer></v-spacer>

                                    
                                    <v-card-text>
                                        Produtos de tabacaria e headshop no conforto do seu lar
                                    </v-card-text>

                                    <v-card-actions class="float-right">
                                        <v-btn
                                            class="ma-2"
                                            color="#008000"
                                            plain
                                            
                                        >
                                           <v-icon>
                                               mdi-shopping-outline
                                            </v-icon>  
                                            Acessar Loja
                                        </v-btn>
                                        <v-btn 
                                            class="ma-2"
                                           color="#4B0082"
                                            plain
                                        >
                                            <v-icon
                                             
                                            >
                                                mdi-google-play
                                            </v-icon>
                                            Baixar App
                                        </v-btn>
                                    </v-card-actions
                                    >
                                </v-img>
                            </v-col>
                        </v-row>
                      </v-card>
                </v-card-text>

                 <v-card-text>
                    <v-card>
                        <v-row no-gutter justify="center" class="mb-6" dense>
                           
                            <v-col
                                cols="12"
                                sm="6"
                                md="4"
                                class="auto-flex items-center py-2 px-4"
                            >
                                
                                <v-col md="auto">
                                    <v-hover
                                    v-slot="{ hover }"
                                    open-delay="200"
                                    >
                                        <v-card
                                            class="mx-auto"
                                            :elevation="hover ? 16 : 2"
                                            :class="{'on-hover' : hover}">

                                            <v-img
                                                src="./storage/homepage/servicos/Tabaco.jpg"
                                                lazy-src="./storage/homepage/servicos/Tabaco.jpg"
                                                class="white--text align-right"
                                                gradient="to bottom, rgba(0,0,0,.1), rgba(0,0,0,.5)"
                                                >
                                            </v-img>

                                            <template v-slot:placeholder>
                                                <v-row 
                                                    class="fill-height ma-8"
                                                    align='center'
                                                    justify="center">
                                                    <v-progress-circular
                                                        color="grey lighten-5">
                                                    </v-progress-circular>
                                                </v-row>
                                            </template>

                                            <v-card-title>
                                                <v-icon></v-icon>
                                                Tabacos Organicos
                                            </v-card-title>

                                            
                                        </v-card>
                                    
                                    </v-hover>
                                </v-col>  
                                 
                                    
                            </v-col>

                                <v-col
                                    cols="12"
                                    sm="6"
                                    md="4"
                                    class="auto-flex items-center py-2 px-4"
                                >
                                
                                <v-col md="auto">
                                    <v-hover
                                        v-slot="{ hover }"
                                        open-delay="200"
                                    >
                                     <v-card 
                                        class="mx-auto"
                                        :elevation="hover ? 16 : 2"
                                        :class="{ 'on-hover' : hover}">

                                         <v-img
                                            src="./storage/homepage/servicos/Sedas.jpg"
                                            lazy-src="./storage/homepage/servicos/Tabaco.jpg"
                                            class="white--text align-right"
                                            gradient="to bottom, rgba(0,0,0,.1), rgba(0,0,0,.5)"
                                            >
                                        </v-img>

                                        <template v-slot:placeholder>
                                            <v-row 
                                                class="fill-height ma-8"
                                                align='center'
                                                justify="center">
                                                <v-progress-circular
                                                    color="grey lighten-5">
                                                </v-progress-circular>
                                            </v-row>
                                        </template>
                                        <v-card-title>Sedas Blunts</v-card-title>
                                         
                                    </v-card>
                                   
                                    </v-hover>
                                </v-col>    
                                </v-col>

                                <v-col
                                    cols="12"
                                    sm="6"
                                    md="4"
                                    class="auto-flex items-center py-2 px-4"
                                >
                                <v-col md="auto">
                                    <v-hover
                                        v-slot="{ hover }"
                                        open-delay="200"
                                    >
                                        <v-card
                                            :elevation="hover ? 16 : 2"
                                            :class="{ 'on-hover' : hover}"
                                            class="mx-auto"
                                        >

                                            <v-img
                                                src="./storage/homepage/servicos/filtros.jpg"
                                                lazy-src="./storage/homepage/servicos/Tabaco.jpg"
                                                class="white--text align-right"
                                                gradient="to bottom, rgba(0,0,0,.1), rgba(0,0,0,.5)"
                                                >
                                            </v-img>

                                            <template v-slot:placeholder>
                                                <v-row 
                                                    class="fill-height ma-8"
                                                    align='center'
                                                    justify="center">
                                                    <v-progress-circular
                                                        color="grey lighten-5">
                                                    </v-progress-circular>
                                                </v-row>
                                            </template>

                                            <v-card-title>
                                                <v-icon></v-icon>
                                            Filtros/Piteiras
                                            </v-card-title>

                                            
                                        </v-card>
                                    </v-hover>
                                   
                                </v-col>    
                                
                                </v-col>
                                    
                           
                        </v-row>
                        
                    </v-card>
                </v-card-text>

                <v-card-text>
                    <v-card>
                        <v-card-title>Sobre nós</v-card-title>
                        <v-row>
                            <v-col>
                                <v-card class="mx-auto"> 
                                    <v-row>
                                        <v-col>
                                            <v-card-title>Novidades</v-card-title>
                                            <v-divider></v-divider>

                                            <v-card-text>
                                                <v-list three-line>
                                                    <template v-for="product in itemProdutos">
                                                       <v-subheader
                                                        v-if="product.name"
                                                        :key="product.id"
                                                        v-text="product.name"
                                                       ></v-subheader>  

                                                    <v-divider
                                                        v-else-if="product.divider"
                                                        :key="product.id"
                                                        :inset="product.inset"

                                                    ></v-divider>  

                                                    <v-list-item
                                                        v-else
                                                        :key="product.id"
                                                    >
                                                        <v-list-item-avatar
                                                    
                                                        >
                                                            <v-img :src="product.imagem_produto"></v-img>
                                                        </v-list-item-avatar>

                                                        <v-list-item-content>
                                                            <v-list-item-title>{{product.nome_produto}} - R$ {{product.preco}} </v-list-item-title>
                                                            <v-list-item-subtitle v-html="product.descricao"></v-list-item-subtitle>
                                                            <v-divider></v-divider>
                                                        </v-list-item-content>
                                                        
                                                    </v-list-item> 

                                                    
                                                    </template>

                                                    
                                                </v-list>
                                                

                                                
                                            </v-card-text> 
                                        </v-col>
                                    </v-row>
                                </v-card>    
                            </v-col>                            
                            <v-col
                                
                                class="auto-flex items-center py-2 px-4"
                            >
                            
                                <v-card class="mx-auto">
                                    <v-card-title>Localização da loja</v-card-title>

                                <v-divider></v-divider>
                                
                                <v-card class="mx-auto">
                                    <GoogleMap />
                                </v-card>
                                
                                 
                                
                                </v-card>
                                
                               
                            </v-col>

                            
                        </v-row>
                    </v-card>
                    
                    
                    <!-- dialog restrição de idade -->
                    <template>
                        <v-row justify="center">
                            <v-dialog
                                v-model="dialog"
                                persistent
                                max-width="290"
                            >
                                <v-card>
                                    <v-card-title class="headline">
                                    Você possui 18 ?
                                    </v-card-title>
                                    <v-card-text>
                                        Este site é liberado apenas para maiores de 18 anos, ao clicar no botão '+18' você concorda
                                        que é maior de idade e está ciente que esta é uma de nossa políticas de uso.
                                    </v-card-text>
                                    <v-card-actions>
                                    <v-spacer></v-spacer>
                                    <v-btn
                                        color="green darken-1"
                                        text
                                        @click="disagree()"
                                    >
                                        -18
                                    </v-btn>
                                    <v-btn
                                        color="green darken-1"
                                        text
                                        @click="dialog = false"
                                    >
                                        +18
                                    </v-btn>
                                    </v-card-actions>
                                </v-card>
                            </v-dialog>
                        </v-row>
                        
                    </template>

                    
                </v-card-text>
                <v-spacer></v-spacer>
                <v-card-text>

                </v-card-text>

                <v-card-text>
                    <v-row>
                        <v-col 
                        class="auto-flex items-center py-2 px-4" elevation="6">
                             <v-card>
                        <v-card-title class="headline">Blog</v-card-title>
                        <v-divider></v-divider>
                        <v-card-text> 
                            <v-card>
                                <v-card-subheader class="headline">Blog da Rua11</v-card-subheader>
                                <v-card-text>Blog aqui...</v-card-text>
                                    
                                   
                            </v-card>
                           
                        </v-card-text>
                    </v-card>
                        </v-col>
                    </v-row>
                </v-card-text>
               <v-card-text>
                    
               </v-card-text>
                <!-- Botões speedDial chat/whatsApp e etc. -->   
                <template>
                    <SpeedDial/>
                </template>
                
            </main>
            
            
            

            <v-spacer></v-spacer>
            <v-spacer></v-spacer>

             <v-card>
                <v-footer
                    dark
                    color="purple darken-3"
                >
                    <v-card
                        flat
                        tile
                        width="100%"
                        class="deep-purple white--text flex-auto text-center"
                    >
                        <v-card-title>
                            <strong class="subheading">Nos siga em nossas Redes sociais</strong>
                            <v-spacer></v-spacer>
                           
                            <v-btn
                                
                                class="mx-4"
                                icon
                                onclick="location.href='https://www.instagram.com/rua11store/'"
                            >
                                <v-icon size="24px">
                                    mdi-instagram
                                </v-icon>
                            </v-btn>
                             <v-btn
                                v-for="icon in icons"
                                :key="icon"
                                class="mx-4"
                                icon
                            >
                                <v-icon size="24px">
                                    {{ icon }}
                                </v-icon>
                            </v-btn>    
                        </v-card-title>
                    
                       <v-divider></v-divider>

                        <v-card-text class="white--text">
                            {{ new Date().getFullYear() }} - <strong>Vuetify</strong>
                        </v-card-text>
                    </v-card>
                </v-footer>
            </v-card>

        
        
    </v-card>
    </v-app>
    
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout';
    import GoogleMap from '@/Pages/Map/googleMapComponent';
    import SpeedDial from '@/Layouts/SpeedDial';
   
    
    export default {
        components: {
            AppLayout,
            GoogleMap,
            SpeedDial,
        },
        
        props: ['images', 'last_products'],
        

        data(){
            return {
                
                drawer: false,
                group: null,
                show: false,
                itemImages: [],
                itemProdutos: [],
                fab: false,
                hidden:false,
                show: true,
                fadeInDuration: 1000,
                maxDuration: 1500,
                dialog: true,
                icons: [
                    'mdi-facebook',
                    'mdi-email',
                ],
                
            };
            
        }, 
        methods:
        {
            sendNotify()
            {
                window.alert('Desculpe, estamos trabalhando nisso');
            },
            getImages(images)
            {
                var images = Object.assign({}, this.images);
                this.itemImages = images;
               
            },
            getProdutos(last_products){
                var produtos = Object.assign({}, this.last_products);
                this.itemProdutos = produtos;
            },
            initialize()
            {
                this.itemImages = [];
                this.itemProdutos = [];
            },
            enter(done)
            {
                var vm = this
                velocity({opacity: 1},
                {
                    duration: this.fadeInDuration,
                    complete: function() {
                        done()
                        if(!vm.stop) vm.show = false
                    } 
                })
            },
            disagree()
            {
                return window.location.href="https://www.google.com/";
            }

            
        },
        created()

        {
            this.initialize();
        },
        mounted()
        {
            this.getImages();
            this.getProdutos();
        }
    }
</script>

<style>
    .fade-enter-active, .fade-leave-active {
        transition: opacity .5s; 
    };
    .fade-enter, .fade-leave-to {
        transition: opacity .5s;
    };
    #create .v-speed-dial {
        position: fixed;
    };

    #create .v-btn--floating {
        position: relative;
    }
</style>