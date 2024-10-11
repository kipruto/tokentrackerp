<template>
<div id="mainbody">
    <router-view></router-view> <!-- This is where routed components will be rendered -->
</div>
</template>

<script>
import store from "../store"; // Assuming you use Vuex for state management
import {
    ref
} from 'vue';

export default {
    name: 'App',
    setup() {
        const user = ref(null);

        return {
            user,
            store
        };
    },
    methods: {

    },
    mounted() {
        const storedUser = JSON.parse(localStorage.getItem('user'));
        if (storedUser) {
            this.user = storedUser;
            this.store.commit('setUser', storedUser);
        }
        this.store.dispatch('startPolling');
    }

};
</script>

<style>
/* Global styles for your application */
@import url('https://fonts.googleapis.com/css2?family=Figtree:ital,wght@0,300..900;1,300..900&display=swap');
@import url('https://fonts.googleapis.com/css2?family=Gabarito:wght@400..900&display=swap');

#mainbody,
div {
    font-family: 'Gabarito', sans-serif;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    color: #000000;
    text-transform: none;
}

h1,
h2,
h3,
h4,
h5,
h6,
a,
p {
    font-family: 'Gabarito', sans-serif;
    color: #000000;
    text-transform: none;
}

input {
    font-family: 'Gabarito', sans-serif;
}

.error {
    color: red;
}


::-webkit-scrollbar {
    width: 2px !important;
    border-radius: 30px  !important;
    background-color: #9c9c9c;
}
::-webkit-scrollbar-track {
    background: transparent;
}

::-webkit-scrollbar-thumb {
    width: 3px !important;
    background-color: #888;
    border-radius: 30px;
}

/* On hover, change the thumb color */
::-webkit-scrollbar-thumb:hover {
    background-color: #9c9c9c; /* Darker color on hover */
}

/* For Firefox */
* {
    scrollbar-width: thin;
    scrollbar-color: #888 transparent;
}

</style>
