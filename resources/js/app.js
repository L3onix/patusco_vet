import './bootstrap';
import { createApp } from 'vue';

// vuetify
import 'vuetify/styles';
import { createVuetify } from 'vuetify';
import * as components from 'vuetify/components';
import * as directives from 'vuetify/directives';
import * as labsComponents from 'vuetify/labs/components';

import App from './App.vue';

const vuetify = createVuetify({
    components: {
        ...components,
        ...labsComponents,
    },
    date: {
        locale: 'en',
    },
    directives,
});

createApp(App).use(vuetify).mount('#app');