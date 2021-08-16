<template>
     <v-row>
         <v-col class="auto-flex items-center py-2 px-4">
             <!-- NavBar -->
                        <v-app-bar
                            color="deep-purple"
                            dark
                            >
                            <v-app-bar-nav-icon @click="drawer = true"></v-app-bar-nav-icon>

                            <v-toolbar-title>Rua11Store</v-toolbar-title>
                            <v-spacer></v-spacer>
                            <v-tabs
                                dark
                                grow
                            >
                                <v-tab>
                                    
                                       <v-icon @click="home()">mdi-home</v-icon>

                                </v-tab>
                                <v-divider></v-divider>
                                <v-tab>
                                    <v-badge
                                       :content="countMessages()"
                                        color="green"
                                    >   
                                        <div class="text-center">

                                            <v-menu 
                                                transition="slide-y-transition"
                                                offset-y>
                                                <template v-slot:activator="{ on, attrs }">
                                                <v-icon
                                                    v-bind="attrs"
                                                    v-on="on"
                                                    max-width="24"
                                                >
                                                    mdi-facebook-messenger
                                                    
                                                </v-icon>
                                            </template>

                                            <v-list  v-if="itemMessages == 0">
                                                <v-list-item>
                                                    <v-list-item-title>No message</v-list-item-title>
                                                    
                                                </v-list-item>
                                                 
                                            </v-list>
                                            <v-list 
                                                v-for="item in itemMessages"
                                                :key="item.id"
                                            >
                                                <v-list-item
                                                    
                                                >
                                                    <v-list-item-title>
                                                       Novas Mensagens 
                                                       
                                                    </v-list-item-title>
                                                    
                                                    <v-divider></v-divider>

                                                    <v-list-item-subtitle>
                                                        {{item.body}}
                                                    </v-list-item-subtitle>
                                                    
                                                    <v-list-item-action>
                                                        <v-btn
                                                            class="mr-2"
                                                            color="purple"
                                                            dark
                                                        >
                                                        Reply    
                                                        </v-btn>
                                                    </v-list-item-action>
                                                    
                                                </v-list-item>
                                            </v-list>
                                            </v-menu>
                                        </div>
                                    </v-badge>

                              
                                </v-tab>
                                <!--<v-tab>
                                    <v-badge
                                        color="green"
                                        content="6"
                                    >
                                    <div class="text-center">

                                            <v-menu 
                                                transition="slide-y-transition"
                                                offset-y>
                                                <template v-slot:activator="{ on, attrs }">
                                                <v-icon
                                                    v-bind="attrs"
                                                    v-on="on"
                                                    max-width="24"
                                                >
                                                    mdi-bell
                                                </v-icon>
                                            </template>

                                            <v-list v-if="notifications == 0">
                                                <v-list-item>
                                                    <v-list-item-title>No notify</v-list-item-title>
                                                    </v-list-item>
                                            </v-list>
                                            <v-list 
                                                v-for="item in notifications"
                                                :key="item.id"
                                                :v-if="item.length >= 1"
                                                class="items-center"
                                            >        
                                                
                                                 <v-list-item>
                                                    <v-list-item-title>
                                                        Novas Menssagem
                                                    </v-list-item-title>

                                                    <v-divider></v-divider>

                                                    <v-list-item-subtitle>
                                                        {{item.body}}
                                                    </v-list-item-subtitle>
                                                </v-list-item>
                                            </v-list>
                                            </v-menu>
                                        </div>
                                       
                                    </v-badge>
                                </v-tab> -->
                                
                            </v-tabs>
                      </v-app-bar>


                        <v-navigation-drawer
                            v-model="drawer"
                            dark
                            absolute
                            temporary
                            src="./storage/drawer/background-drawe.jpg"
                        >
                            <v-list
                                nav
                                dense>
                                    <v-list-item-group
                                        v-model="group"
                                        active-class="deep-purple--text">
                                           <!-- <v-list-item>
                                                <v-list-item-title>
                                              <v-button v-if="$page.jetstream.managesProfilePhotos"> 
                                                     <img class="h-8 w-8 rounded-full object-cover" :src="$page.user.profile_photo_url" :alt="$page.user.name" /> 
                                                </v-button> 

                                                <div class="flex-shrink-0">
                                             <img class="h-10 w-10 rounded-full items-center" :src="$page.user.profile_photo_url" :alt="$page.user.name" /> 
                                                </div>

                                                
                                                </v-list-item-title>
                                            </v-list-item>-->
                                            <v-list-item>
                                                <v-list-item-title>
                                                    <v-icon>mdi-smoking</v-icon>
                                                        Rua11Store
                                                </v-list-item-title>
                                            </v-list-item>
                                            <v-divider></v-divider>

                                            <v-list-item>
                                                <v-list-item-title>
                                                    <v-icon>mdi-account</v-icon>
                                                        {{ users.name }}
                                                </v-list-item-title>
                                                <v-list-item-title>
                                                    <v-icon>mdi-at</v-icon>
                                                        {{ users.email }}
                                                </v-list-item-title> 
                                            </v-list-item>   
                                            

                                            <v-divider></v-divider>
                                            

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
                                            -->

                                            <v-list-item>
                                               
                                                    <v-icon>mdi-view-dashboard</v-icon>
                                               
                                                <v-list-item-title @click="dashboard()">Dashboard</v-list-item-title>
                                            </v-list-item>

                                            <v-list-item>
                                                <v-icon>mdi-shape</v-icon>
                                                <v-list-item-title 
                                                   
                                                    @click="categorias()"
                                                >
                                                    Categorias
                                                </v-list-item-title>
                                                
                                            </v-list-item>
                                            <v-list-item>
                                                
                                                <v-list-item-title
                                                    
                                                    @click="subcategorias()"
                                                >
                                                    <v-icon>mdi-subtitles</v-icon>
                                                    Subcategorias
                                                </v-list-item-title>
                                                
                                            </v-list-item>
                                            <v-list-item >
                                                
                                                <v-list-item-title 
                                                    
                                                    @click="produtos()"
                                                >
                                                <v-icon>mdi-shopping</v-icon>
                                                    Produtos
                                                </v-list-item-title>
                                                
                                            </v-list-item>
                                     <v-list-item>
                                                
                                        <v-list-item-title 
                                            
                                            @click="vendas()"
                                        >
                                        <v-icon>mdi-cart</v-icon>
                                            Vendas
                                        </v-list-item-title>
                                                
                                    </v-list-item>
                                            
                                </v-list-item-group>
                            </v-list>
                            <template v-slot:append>
                                <div class="pa-2">
                                    <v-btn 
                                        block
                                        @click="logout()"
                                        >
                                        <v-icon>mdi-logout</v-icon>
                                        Logout
                                    </v-btn>
                                </div>
                            </template>
                            </v-navigation-drawer> 
         </v-col>
     </v-row>
       
</template>

<script>
    import Dashboard from '@/Pages/Dashboard';
    export default{
        
        components: {
            Dashboard,
        },
        
       props: ['user'],
        data()
        {
            return{
                showingNavigationDropdown: false,
                drawer: false,
                group: null,
                icons: [
                    'mdi-facebook',
                    'mdi-instagram',
                    'mdi-whatsapp',
                    'mdi-email',
                ],
                notifications: [],
                users: [], 
                itemMessages: [], 
               

            }
        },
        computed: {
            path() {
                return window.location.pathname
            }
        },
        methods: {
           home()
            {
                axios.get('/').then(response => {
                    window.location = '/'
                });
            },
            dashboard()
            {
                axios.get('/dashboard').then(response => {
                    window.location = '/dashboard'
                });
            },
            profile()
            {
                axios.get('/profile/show').then(response => {
                    window.location = '/profile/show'
                });
            },
            categorias()
            {
                axios.get('/categorias').then(response =>{
                    window.location = '/categorias'
                });
            },
            subcategorias()
            {
                axios.get('/subcategorias').then(response => {
                    window.location = '/subcategorias'
                });
            },
            produtos()
            {
                axios.get('/product').then(respose => {
                    window.location = '/product'
                });
            },
            vendas()
            {
                axios.get('/vendas').then(response => {
                    window.location = '/vendas'
                });
            },
           switchToTeam(team) {
                this.$inertia.put(route('current-team.update'), {
                    'team_id': team.id
                }, {
                    preserveState: false
                })
            },
            
            logout() {
                axios.post(route('logout').url()).then(response => {
                    window.location = '/';
                })
            },
            getUsers()
            {
               
                axios.get('/navigationbar')
                .then(response => {
                    this.users = response.data;
                Echo.private(`App.Models.User.${this.users.id}`)
                    .notification((notification) => {
                    this.notifications.push(notification.message);                
                    // console.log('Notification:' + notification.message);
                    // this.notifications.push(e.message);
                        });
                    });
            },
            getMessages()
            {
                axios.get('/navigationbar/messages')
                .then(response => {
                    this.itemMessages = response.data;
                   
                    Echo.channel('messages')
                    .listen('.messages', (e) => {
                     // console.log('Realtime Message:' + e.message);
                      this.itemMessages.push(e.message);
                    });
            
                    
                })
                .catch(function(error)
                {
                    window.alert(error);
                });
            },
            countMessages(itemMessages)
            {
                var itemMessages = this.itemMessages;
                var total = 0;
                for(var i = 0; i < itemMessages.length; i++)
                {
                    total = itemMessages[i].id + i;
                }
                return total;
            },
            initialize()
            {
                this.users = [];
                this.itemMessages = [];
                this.notifications = [];
            }
            
        },

        created()
        {
            this.initialize();
        },
        mounted()
        {
            this.getUsers();
            this.getMessages();
           
             
        }
    }
</script>