<template>
    <v-app>
        <v-container>
            <Navbar />
            <div class="d-flex flex-row mt-16">
                <Calendar />
            </div>
        </v-container>
    </v-app>
</template>

<script>
import Calendar from './components/Calendar.vue';
import Navbar from './components/Navbar.vue';

export default {
    name: "App",
    components: {
        Calendar,
        Navbar,
    },
};
</script>