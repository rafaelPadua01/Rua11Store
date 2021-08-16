<template>
    <v-app>
        <v-row>
          
            <v-col
                
                class="auto-flex items-center py-2 px-4"
            >
                <v-card>
                    <v-card-title class="deep-purple text-white" dark>
                        <span class="headline">Chat</span>

                        <v-divider></v-divider>

                        <v-menu
                            bottom
                            left
                        >
                            <template v-slot:activator="{ on, attrs }">
                                <v-btn
                                    dark
                                    icon
                                    v-bind="attrs"
                                    v-on="on"
                                >
                                    <v-icon>mdi-dots-vertical</v-icon>
                                </v-btn>
                            </template>

                            <v-list>
                                <v-list-item>
                                    <v-list-item-title>Menu</v-list-item-title>
                                </v-list-item>
                            </v-list>
                        </v-menu>
                    </v-card-title>
                    <v-card-text>
                        <template v-if="itemsMessage.length == ''">
                            <v-chip     
                                class="ma-2"
                                color="deep-purple"
                                text-color="white"
                                
                            > 
                                Olá, em que podemos lhe ajudar ?!
                            </v-chip>
                                
                        </template>
                    </v-card-text>
                    
                    <v-card-text v-for="item in itemsMessage" :key="item.id">
                        
                        <template>
                            
                            <v-chip     
                                   
                                    class="ma-2"
                                    color="deep-purple"
                                    text-color="white"
                                > 
                                    {{item}}
                                </v-chip>
                        </template>
                              
                        
                    </v-card-text>

                    <v-card-text v-for="item in itemsReply" :key="item.id" class="text-right">
                        <v-spacer></v-spacer>
                                
                                <v-chip 
                                    class="ma-2"
                                    color="deep-purple"
                                    text-color="white"
                                > 
                                    {{item}}
                                </v-chip>
                    </v-card-text>

                    <v-card-actions>
                        <v-text-field 
                                v-model='form.body'
                                color="purple"
                                :append-icon="'mdi-send'"
                                placeholder="Message"
                                clear-icon="mdi-close-circle"
                                clearable
                                filled
                                type="text"
                                @click:append="sendMessage"
                                @clik:clear="clearMessage"
                                
                            
                                >

                            </v-text-field>
                    </v-card-actions>
                </v-card>
            </v-col>
        </v-row>
   
    </v-app>
        
   
</template>

<script>
//import NavigationBarChat from '@/Layouts/NavigationBarChat';  
import AppLayout from '@/Layouts/AppLayout';

export default
{
    components:
    {  
        AppLayout,
     //  NavigationBarChat
        
    },
    props: ['user'],
    data(){
        return {
            message: '',
            itemsUser: [],
            itemsMessage: [], 
            itemsReply: [],
            form: {
                body: '',
            }
        }
    },
    methods: 
    {
        getUser(user)
        {
            let log_user = this.user;
            this.itemsUser = log_user; 
        },
        sendMessage()
        {
            const form = this.form;
            const message = this.message;
            const itemsMessage = this.itemsMessage;
            this.$inertia.post('/message/send', form)
            .then(function(response){

                itemsMessage.push(form.body);
               
               
            })
            .catch(function(error){
                window.alert('Erro no envio da mensagem:' + error + 'Contante o suporte técnico...');
                return false;
            });

           
        },
        clearMessage()
        {
            this.form = '';
        },
        initialize()
        {
            this.itemsMessage = [];
            this.itemsUser = [];
            this.itemsReply = [];
        },
    },
    mounted()
    {
        this.initialize();
        this.getUser();
        Echo.channel('reply')
        .listen('.reply', (e) => {
            this.itemsReply.push(e.reply);
            
        });
        console.log('mounted content');   
    }

}
</script>
