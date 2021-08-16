require('./bootstrap');

import Vue from 'vue';
import Vuetify from 'vuetify';
import 'vuetify/dist/vuetify.min.css';
import vuetify from 'vuetify/lib';
import * as VueGoogleMaps from 'vue2-google-maps';



import { InertiaApp } from '@inertiajs/inertia-vue';
import { InertiaForm } from 'laravel-jetstream';
import PortalVue from 'portal-vue';
import colors from 'vuetify/lib/util/colors';


Vue.mixin({ methods: { route } });
Vue.use(InertiaApp);
Vue.use(InertiaForm);
Vue.use(PortalVue);
Vue.use(Vuetify);

Vue.use(VueGoogleMaps, {
    load: {
        key: 'AIzaSyBsPRryxbUkR7toTwgh9Ova-_Y1HZvnDUI',
        libraries: 'places',
        region: 'BR',
        language: 'pt_br',
    },
    installComponents: true
});




export default new Vuetify({
    theme: {
        themes: {
            light: {
                primary: colors.red.darken1, //#E53935
                secondary: colors.red.lighten4, //#FFCC FFCC
                accent: colors.indigo.base //#3F51B5

            },
        },
    },
});

const app = document.getElementById('app');



new Vue({
    vuetify : new Vuetify(),
    render: (h) =>
        h(InertiaApp, {
            props: {
                initialPage: JSON.parse(app.dataset.page),
                resolveComponent: (name) => require(`./Pages/${name}`).default,
            },
        }),
}).$mount(app);
