<template>
    <v-app>
        <div>
            <NavigationBar/>
        </div>
        <v-spacer></v-spacer>
         <template #header>
            <h2 class="font-semibold text-xl text-green-800 leading-tight">
                Dashboard
            </h2>
            
        </template>
        
         <template v-for="item in notifications">
                            <div
                                :key="item.id"
                            >
                                <v-alert
                                    v-model="alert"
                                    dismissible
                                    color='cyan'
                                    border="left"
                                    elevation="6"
                                    colored-border
                                    icon="mdi-alert"
                                    >
                                    you've got <strong>{{item.body}}</strong> new messages on your profile
                                </v-alert>
                            </div>

                            <div 
                                :key="item.id" 
                                class="text-center"
                            >
                                <v-btn
                                    v-if="!alert"
                                    dark
                                    @click="alert = true"
                                >
                                    Reset Alert
                                </v-btn>
                            </div>
                            
                        </template>
                <v-card>
        
                    <v-container>
                        <v-row dense>
                            <v-col class="flex-auto py-2 px-4 text-justify">
                                        <v-col>
                                            <v-card 
                                                loading
                                                elevation="8"
                                                outlined
                                                dark
                                            >
                                            <v-img
                                                class="white--text align-top"
                                                src="./storage/drawer/background-drawe.jpg"
                                                height="200px"
                                            >
                                                <v-card-title transition="slide-x-reverse-transition">
                                                <v-icon large>mdi-smoking</v-icon> 
                                                    
                                            </v-card-title>


                                            
                                            </v-img>
                                            <v-card-title transition="slide-x-reverse-transition">
                                                    Bem Vindo a Rua11Store
                                            </v-card-title>
                                            <v-divider></v-divider>
                                            <v-card-subtitle>  
                                                <b>{{users.name}}</b>, é sempre um prazer recebe-lo aqui novamente !
                                            </v-card-subtitle>

                                             <v-card-text>
                                              
                                                
                                                    
                                                        Navegue em nossos menus para conhecer nossa aplicação e todo o poder que está em suas mãos.
                                                        <br>
                                                        <small float="right">
                                                            <i>Venha para o lado negro da força ...</i>
                                                        </small> 
                                                    
                                                   
                                                
                                                
                                            </v-card-text>
                                            </v-card>
                
                                        </v-col>
                                        
                                    </v-col>
                                    
                                </v-row>


                                <v-row no-gutters justify="justify" class="mb-6" dense>
                                    <v-col cols="12" sm="6" md="4" class="flex-auto items-center py-2 px-4">
                                        <v-col md='auto'>
                                            <v-card
                                                class= "pa-2"
                                                color='#1F7087'
                                                dark
                                                elevation="6"
                                                outlined
                                                tile
                                            >
                                                <v-card-title class="text-center">Estatísticas de Venda</v-card-title>

                                                <v-card 
                                                    class="mx-auto text-center"
                                                    color="#1F7087"
                                                    dark
                                                    max-width="600">
                                                    <v-card-text>
                                                        <v-sheet color="rgba(0, 0, 0, .12)">
                                                            <v-sparkline
                                                                :items="venda"
                                                                :value="value"
                                                                color="rgba(255, 255, 255, .7)" 
                                                                height="100"
                                                                padding="24"
                                                                stroke-linecap="round"
                                                                smooth
                                                                >

                                                                <template v-slot:label="item">
                                                                    {{item.value}}
                                                                </template>
                                                            </v-sparkline>
                                                        </v-sheet>
                                                    </v-card-text>

                                                    <v-card-text>
                                                        <div class="display-1 font-weight-thin">
                                                            Sales Last 24h
                                                        </div>
                                                    </v-card-text>

                                                    <v-divider></v-divider>

                                                    <v-card-actions class="justify-center">
                                                        <v-btn
                                                            block
                                                            text
                                                        >
                                                            Go to Report
                                                        </v-btn>
                                                    </v-card-actions>
                                                </v-card>
                                            </v-card>

                                            
                                        </v-col>
                                    </v-col>
                                    <v-col cols="12" sm="6" md="4" class="flex-auto items-center py-2 px-4">  

                                        <v-col md="auto">
                                            <v-card
                                                class="pa-2"
                                                color="#952175"
                                                elevation="6"
                                                outlined
                                                tile
                                                dark>
                                                <v-card-title>Estatistica de acessos</v-card-title>
                                            </v-card>
                                        </v-col>    
                                       
                                        
                                    </v-col>
                                     
                                     <v-col cols="12" sm="6" md="4" class="flex-auto items-center py-2 px-4">  

                                        <v-col md="auto">
                                            <v-card
                                                class="pa-2"
                                                color="#D3D3D3"
                                                elevation="6"
                                                outlined
                                                tile
                                                >
                                                <v-card-title> Card 4</v-card-title>
                                            </v-card>
                                        </v-col>    
                                       
                                        
                                    </v-col>
                                    
                                </v-row>
                            </v-container>

                   
                  
                </v-card>

               
                       
                   
    </v-app>
</template>

<script>
    import NavigationBar from '@/Layouts/NavigationBar'
    import AppLayout from '@/Layouts/AppLayout'
    import Welcome from '@/Jetstream/Welcome'
    
    export default {
        components: {
            NavigationBar,
            AppLayout,
            Welcome,
           
        },
        props: ['user', 'props'],
        data() {
            return {
                users: [],
                venda: [],
                notifications: [],
                loading: true,
                alert: true,
                value: [
                    423,
                    446,
                    675,
                    510,
                    610,
                    760,
                ],
            }
        },
        methods: {
            getUser(user){
                var user = this.user;
                this.users = user;
            },
            getVendas(vendas)
            {
                var vendas = this.vendas;
                this.venda = vendas;
            },
            /*
            getNotify()
            {
                Echo.channel('events')
                    .listen('RealtimeMessage', (e) => window.alert('RealtimeMessage:' + e.message));
            },
            */
            initialize()
            {
                this.users = [];
                this.venda = [];
            }

        },
        created()
        {
            this.initialize();

        },
        mounted()
        {
            this.getUser();
            this.getVendas();
            //this.getNotify();
            
            Echo.private(`App.Models.User.${this.user.id}`)
                    .notification((notification) => {
                        this.notifications.push(notification.message);                
                        console.log('Notification:' + notification.message);
                        this.itemMessages.push(e.message);
                    });
           
        }




    
    }
</script>
