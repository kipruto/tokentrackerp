<template>
<div class="font-sans antialiased dark:bg-black dark:text-white/50">
    <div class="bg-gray-50 text-black/50 dark:bg-black dark:text-white/50">
        <img id="background" class="absolute -left-20 top-0 max-w-[877px] h-full" :src="backgroundImage" />
        <div class="relative min-h-screen flex flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white">
            <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
                <main>
                    <div class="relative container px-4 mx-auto">
                        <div class="relative max-w-4xl mx-auto">
                            <div class="absolute inset-0 -ml-4 -mr-4"></div>
                            <div class="relative px-4 sm:px-8">
                                <div class="max-w-lg mx-auto text-center">
                                    <a class="inline-block mb-14 text-3xl font-bold font-heading" href="#">
                                        <img class="h-20" :src="logo" alt="Logo" width="auto" />
                                    </a>
                                    <h3 class="mb-8 text-4xl md:text-5xl font-bold font-heading">Welcome to TokenTrackERP</h3>
                                    <p class="mb-10 font-semibold font-heading">Please Login to Continue</p>
                                    <form @submit.prevent="handleSubmit">
                                        <input v-model="email" class="w-full mb-4 px-12 py-3 border border-gray-200 focus:ring-blue-300 focus:border-blue-300 rounded-md" type="text" placeholder="Email Address" required  autocomplete="on"/>
                                        <input v-model="password" class="w-full mb-4 px-12 py-3 border border-gray-200 focus:ring-blue-300 focus:border-blue-300 rounded-md" type="password" placeholder="Password" required autocomplete="on" />
                                        <div v-if="errorMessage" class="text-red-600 font-bold text-sm">{{ errorMessage }}</div>
                                        <div v-if="emailError" class="text-red-600 font-bold text-sm">{{ emailError }}</div>
                                        <button id="loginButton" class="w-full mt-4 bg-blue-800 hover:bg-blue-900 text-white font-bold font-heading py-3 rounded-md uppercase" type="submit">
                                            SUBMIT
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>

                <p class="py-10 text-center text-md text-black dark:text-white/70">
                    By continuing you agree to our Terms of Use & Privacy Policy
                </p>
                <p class="py-12 text-center text-xs text-gray-400 dark:text-white/70">
                    TokenTrackERP v{{ appVersion }} - Built Php v{{ phpVersion }}
                </p>
            </div>
        </div>
    </div>
</div>
</template>

<script>
import logo from '../../../public/images/logo.png';
import backgroundImage from '../../../public/images/background.svg';
import axios from 'axios';
import {
    ref
} from 'vue';
import {
    mapMutations
} from 'vuex';
import {
    useRouter
} from 'vue-router';
import store from "../../store";

export default {

    setup() {
        const router = useRouter();
        const email = ref("");
        const password = ref("");
        const emailError = ref(null);
        const errorMessage = ref(null);
        const appVersion = ref(
        import.meta.env.APP_VERSION || 'unknown');
        const phpVersion = ref('loading...');

        return {
            email,
            password,
            errorMessage,
            emailError,
            appVersion,
            phpVersion,
            router,
            logo, // Adjust the path as needed
            backgroundImage,
        };
    },
    mounted() {

        axios.get('/api/php-version')
            .then(response => {
                this.phpVersion = response.data.php_version;
                this.appVersion = response.data.app_version;
            })
            .catch(error => {
                console.error("Error fetching PHP version:", error);
                this.phpVersion = 'Error fetching version';
            });
    },
    methods: {
        ...mapMutations(['setUser']),

        user() {
            return this.getUser;
        },

        validateEmail(email) {
            const pattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return pattern.test(email);
        },
        async handleSubmit() {
            this.emailError = null; // Reset email error message
            this.errorMessage = null; // Reset general error message

            // Validate email format
            if (!this.validateEmail(this.email)) {
                this.emailError = 'Please enter a valid email address.';
                return; // Exit the method if email is invalid
            }

            try {
                const response = await axios.post('/api/login', {
                    email: this.email,
                    password: this.password,
                });
                if (response.status === 200) {
                    store.dispatch("logout");
                    // Store user in local storage
                    localStorage.setItem('user', JSON.stringify(response.data.user));
                    // Redirect to the dashboard
                    store.dispatch("login", response.data.user);
                    this.router.push({
                        name: 'dashboard'
                    });

                }
            } catch (error) {
                if (error.response && error.response.status === 401) {
                    this.errorMessage = error.response.data.message;
                } else {
                    this.errorMessage = 'An error occurred. Please try again later.';
                }
                console.error(error.response ? error.response.data : error);
            }
        },

    }
}
</script>

<style scoped>
/* Add any additional component styles here */
</style>
