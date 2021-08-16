<template>

    <v-speed-dial
        v-model="fab"
        :top="top"
        :bottom="bottom"
        :right="right"
        :left="left"
        :direction="direction"
        :open-on-hover="hover"
        :transition="transition"
        fixed
        id="create"
    >
                            
                            <template v-slot:activator>
                                <v-btn
                                    v-model="fab"
                                    color="green darken-1"
                                    dark
                                    fab
                                    right
                                    
                                >
                                    <v-icon v-if="fab">
                                        mdi-close
                                    </v-icon>

                                    <v-icon v-else>
                                        mdi-plus
                                    </v-icon>
                                    <v-badge
                                    color="pink"
                                    dot
                                    
                                    >
                                    </v-badge>
                                </v-btn>
                            </template>  
        
                            <v-btn
                                fab
                                dark
                                small
                                color="indigo"
                                @click="loaderChat()"
                            >
                                
                                <v-icon>mdi-android-messages</v-icon>
                                <v-badge
                                    color="pink"
                                    content="1">
                                    </v-badge>
                            </v-btn>
                            <v-btn
                                fab
                                dark
                                small
                                color="green"
                                @click="loader = 'loading'"
                            >
                                <v-icon>mdi-whatsapp</v-icon>
                                 
                            </v-btn>
                            <v-btn
                                fab
                                dark
                                small
                                color="red"
                            >
                                <v-icon>mdi-delete</v-icon>
                            </v-btn>
                        </v-speed-dial>
</template>

<script>
    export default{
        data(){
            return{
                direction: 'top',
                fab: false,
                fling: false,
                hover: false,
                top: false,
                right: true,
                bottom: true,
                left: false,
                transition: 'slide-y-reverse-transition',
                loader: null,
                loadign: false,
            }
        },
        watch: {
            top(val){
                this.bottom = !val;
            },
            right(val){
                this.left = !val;
            },
            bottom(val){
                this.top = !val;
            },
            left(){
                this.right = !val;
            },
            loader() {
                const l = this.loader
                this[l] = !this[l]

                setTimeout(() => (this[l] = false), 3000)

                this.loader = null
                return location.href='https://wa.me/556195972328?text=Olá%20tenho%20interesse%20em%20alguns%20de%20seus%20produtos'
            },
            
        }, 
        methods:
        {
            loaderChat()
            {
                    
                    return location.href='/message';
               
            }
        }
    };

</script>

<style scoped>
  #create  .v-speed-dial{
      animation-name: "speed_dial";
      animation-duration: 3s;
      animation-fill-mode: forwards;
  }

  @keyframes speed-dial {
      from {top: 0px}
      to {top: 200px}
  }
</style>