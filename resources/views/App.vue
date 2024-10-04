<template>
  <div id="mainbody">
    <router-view></router-view> <!-- This is where routed components will be rendered -->
  </div>
</template>

<script>
import store from "../store"; // Assuming you use Vuex for state management
import { ref } from 'vue';

  export default {
    name: 'App',
    setup(){
      const user = ref(null);

      return{
        user,
        store
      };
    },

    methods: {

      },
      mounted(){
        const storedUser = JSON.parse(localStorage.getItem('user'));
        if(storedUser){
          this.user = storedUser;
          this.store.commit('setUser', storedUser);
        }

      }


  };


</script>

<style>
  /* Global styles for your application */
  @import url('https://fonts.googleapis.com/css2?family=Figtree:ital,wght@0,300..900;1,300..900&display=swap');
  @import url('https://fonts.googleapis.com/css2?family=Gabarito:wght@400..900&display=swap');

  #mainbody, div {
    font-family: 'Gabarito', sans-serif;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    color: #000000;
    text-transform: none;
  }
h1, h2, h3, h4, h5, h6, a, p{
  font-family: 'Gabarito', sans-serif;
  color: #000000;
  text-transform: none;
}
input{
  font-family: 'Gabarito', sans-serif;
}
.error {
  color: red;
}
</style>