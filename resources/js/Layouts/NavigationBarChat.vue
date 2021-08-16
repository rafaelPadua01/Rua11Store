<template>
     <v-card
        class="mx-auto overflow-hidden"
        height="700"
    >
        <v-app-bar
            color="deep-purple"
            dark
            >
            <v-app-bar-nav-icon @click="drawer = true"></v-app-bar-nav-icon>

            <v-toolbar-title>Live Chat - Rua11Store</v-toolbar-title>

            </v-app-bar>

            <v-navigation-drawer
                v-model="drawer"
                absolute
                temporary
            >
            <!--
                <v-list
                    nav
                    dense>
                        <v-list-item-group
                            v-model="group"
                            active-class="deep-purple--text">
                                <v-list-item>
                                    <v-list-item-icon>
                                        <v-icon>mdi-home</v-icon>
                                    </v-list-item-icon>
                                    <v-list-item-title>Home</v-list-item-title>
                                </v-list-item>

                                <v-list-item>
                                    <v-list-item-icon>
                                        <v-icon>mdi-account</v-icon>
                                    </v-list-item-icon>
                                    <v-list-item-title>Account</v-list-item-title>
                                </v-list-item>

                                <v-divider></v-divider>
                                <v-list-item>
                                    
                                    <v-list-item-title>Categorias</v-list-item-title>
                                    
                                </v-list-item>
                                <v-list-item>
                                    
                                    <v-list-item-title>subcategorias</v-list-item-title>
                                    
                                </v-list-item>
                                <v-list-item >
                                    
                                    <v-list-item-title>Produtos</v-list-item-title>
                                    
                                </v-list-item>
                                <v-list-item>
                                    
                                    <v-list-item-title>Vendas</v-list-item-title>
                                    
                                </v-list-item>
                                
                         </v-list-item-group>

                           
                    </v-list> -->
            </v-navigation-drawer>
    </v-card>
</template>