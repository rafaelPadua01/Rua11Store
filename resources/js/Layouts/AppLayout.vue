<template>
    <v-app>
        <v-row>
            <v-col class="flex-auto items-center py-2 px-4">
                
                        <header class="bg-white shadow">
                            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                                <slot name="header"></slot>
                            </div>
                        </header>
                        <v-divider></v-divider>
                   
            </v-col>
        </v-row>

        <v-row>
            <v-col class="flex-auto items-center py-2 px-4">
                
                    <main>
                        <slot></slot>
                    </main>
                
            </v-col>
        </v-row>

        <v-row>
            <v-col class="auto-flex items-center py-2 px-4">
                 <v-footer
                    dark
                    color='deep-purple'
                >
                    <v-card
                        flat
                        tile
                        width="100%"
                        class="deep-purple darken-1 white--text flex-auto text-center"
                    >
                        <v-card-title>
                            <strong class="subheading">Conecte-se com a gente em nossas Redes sociais</strong>
                            <v-spacer></v-spacer>

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
            </v-col>
        </v-row>
       
    </v-app>
   
</template>

    




<script>

 //   import JetApplicationLogo from '@/Jetstream/ApplicationLogo'
//    import JetApplicationMark from '@/Jetstream/ApplicationMark'
 //   import JetDropdown from '@/Jetstream/Dropdown'
 //   import JetDropdownLink from '@/Jetstream/DropdownLink'
  //  import JetNavLink from '@/Jetstream/NavLink'
   // import JetResponsiveNavLink from '@/Jetstream/ResponsiveNavLink'
    
    export default {
        components: {
       //    JetApplicationLogo,
       //    JetApplicationMark,
       //    JetDropdown,
      //     JetDropdownLink,
     //       JetNavLink,
     //      JetResponsiveNavLink,
        },
        data() {
            return {
                showingNavigationDropdown: false,
                drawer: false,
                group: null,
                icons: [
                    'mdi-facebook',
                    'mdi-instagram',
                    'mdi-whatsapp',
                    'mdi-email',
                ],
               
            }
        },

        methods: {
            home()
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
            
        },

        computed: {
            path() {
                return window.location.pathname
            }
        },
         

    }
</script>
