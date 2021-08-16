<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Live Chat
            </h2>
        </template>
        <template>
            <v-row>
                <v-col class="auto-flex items-center py-2 px-4 text-justify">
                    <v-card
                        class="mx-auto" 
                        max-width="400"
                        elevation="6"
                    >
                        <v-card-title>New Messages</v-card-title>
                        <v-divider></v-divider>
                        <v-card-text class="pt-4"></v-card-text>
                            <v-divider></v-divider>

                            <v-virtual-scroll
                                :items="itemMessages"
                                :item-height="50"
                                height="300"
                            >
                                <template v-slot:default="{ item }">
                                    <v-list-item>
                                        <v-list-item-content>
                                            {{item.body}}
                                        </v-list-item-content>
                                        <v-list-item-content>
                                           <small>
                                               
                                                {{item.created_at}}
                                            
                                            </small>
                                        </v-list-item-content>
                                        <v-list-item-action>
                                            <v-btn
                                                    class="ma-1"
                                                    color="deep-purple"
                                                    tile
                                                    text
                                                    @click="loadMessage(item)"
                                                >   
                                                    responder
                                                </v-btn>
                                        </v-list-item-action>
                                    </v-list-item>
                                </template>
                            </v-virtual-scroll>
                            
                        
                    </v-card>
                </v-col>

                <v-col class="auto-flex items-center py-2 px-4 text-justify">
                    <v-card elevation="6" >
                        <v-card-title >Messages</v-card-title>
                        <v-divider></v-divider>

                        <v-card-text v-if="selectedItem.length <= 0">
                            Select a message to reply...
                        </v-card-text>
                        
                        <v-card-text v-else>
                            <v-spacer></v-spacer>
                            
                            <v-chip 
                                class="ma-2"
                                color="deep-purple"
                                text-color="white"
                            > 
                                {{selectedItem.body}}
                            </v-chip>
                            
                            
                                    
                            
                        </v-card-text>

                        <v-card-text v-for="item in itemsReply" :key="item.id">
                             <v-spacer></v-spacer>
                            
                            <v-chip 
                                class="ma-2"
                                color="deep-purple"
                                text-color="white"
                            > 

                                {{item}}
                            </v-chip>
                        </v-card-text>
                        <v-spacer></v-spacer>
                        <v-text-field 
                            v-model="form.body" 
                            color="purple"
                            :append-icon="'mdi-send'"
                            placeholder="reply"
                            clear-icon="mdi-close-circle"
                            clearable
                            filled
                            type="text"
                            @click:append="sendReply(selectedItem)"
                            @click:clear="clearMessage"
                            >

                        </v-text-field>

                        
                    </v-card>
                </v-col>
            </v-row>
        </template>

        <template>
            <div>
                <v-alert type='success' v-if="alert">
                    Send message sucessfuly
                </v-alert>
            </div>
        </template>
    </app-layout>
</template>

<script>
    import NavigationBar from '@/Layouts/NavigationBar';
    import AppLayout from '@/Layouts/AppLayout';

    

    export default {
        components: {
            NavigationBar,
            AppLayout
               
        },
        props: ['messages', 'user'],
        data(){
        return {
                itemMessages: [],
                itemUser: [],
                selectedItem: [],
                itemsReply: [],
                alert: '',
                form: {
                    body: '',
                },
                
            }
        },

        methods: {
            getMessage(messages)
            {
                var messages = this.messages;
                this.itemMessages = messages;
            },
            getUser(user)
            {
                var user = this.user;
                this.itemUser = user;
            },
            sendReply(selectedItem)
            {
                var form =  this.form;
                var selevtedItem = this.selectedItem;
                const itemsReply = this.itemsReply;
                this.$inertia.post(`/reply/send/${this.selectedItem.id}`, form)
                .then(function(response){
                    itemsReply.push(form.body);
                   // window.alert('Mensagem enviada');
                })
                .catch(function(error){
                    window.alert('Erro: ' + error + 'Contate o suporte técnico...');
                });

                this.clearMessage();
            },
            clearMessage()
            {
                this.form = '';
            },
            loadMessage(item)
            {
               // this.selectedItem.push(item => item.id === id);
               this.selectedItem = item;
               //window.alert(this.selectedItem) 

            },
            initialize()
            {
                this.itemMessages = [];
                this.itemUser = [];
                this.itemsReply = [];
            },
            
            
        },
        

        created()
            {
                this.initialize();
                
                
            },
            mounted()
            {
                this.getMessage();
                this.getUser();
               
                Echo.channel('messages')
                    .listen('.messages', (e) => {
                     // console.log('Realtime Message:' + e.message);
                      this.itemMessages.push(e.message);
                    });
                
                
            }
};
</script>
