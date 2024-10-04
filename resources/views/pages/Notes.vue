<template>
<div>
    <Navbar />

    <!-- start wrapper -->
    <div class="h-screen flex flex-row flex-wrap">
        <Sidebar />

        <!-- start content -->
        <div class="max-w-4xl mx-auto p-6">
            <div class="bg-yellow-200 text-yellow-800 p-4 rounded-md mb-6">
                <p>
                    <strong><i class="fad fa-exclamation-circle"></i> REMINDER:</strong> Clearing your browser's localStorage will erase your notes. This is a temporary space to help you write down your quick ideas.
                </p>
            </div>
            <!-- Display saved notes if they exist -->
            <div v-for="(savednote, index) in savedNotes" :key="index" class="bg-gray-100 p-4 mb-6 rounded-md flex flex-col">
                <h3 class="font-bold text-blue-600 mb-2 "><i class="fad fa-sticky-note"></i> My Saved Note:</h3>
                <p class="text-gray-700 whitespace-pre-line">{{ savednote }}</p>
            </div>

            <!-- Textarea for notes -->
            <div class="mb-6">
                <label for="notes" class="block text-lg font-medium text-gray-700 mb-2">
                    Scribble Your Ideas:
                </label>
                <textarea v-model="newNote" id="notes" class="w-full h-64 p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Start typing your ideas here..."></textarea>
            </div>

            <!-- Buttons -->
            <div class="flex space-x-4">
                <button @click="saveNote" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition">
                    Save Note
                </button>
                <button @click="clearNotes" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition">
                    Clear Notes
                </button>
            </div>
        </div>
        <!-- end content -->
    </div>
    <!-- end wrapper -->

    <Footer />
</div>
</template>

<script>
import {
    ref,
} from "vue";

import Navbar from '../layouts/Navbar.vue';
import Sidebar from '../layouts/Sidebar.vue';
import Footer from '../layouts/Footer.vue';

export default {
    name: "MyNotes",
    components: {
        Navbar,
        Sidebar,
        Footer,

    },

    setup() {
        const newNote = ref("");
        const savedNotes = ref([]);

        return {

            savedNotes,
            newNote,
        };

    },

    mounted() {

        const myNotes = localStorage.getItem("userNotes");
        if (myNotes) {
            this.savedNotes = JSON.parse(myNotes);
        }

    },

    methods: {

        saveNote() {
            if (this.newNote.trim() !== "") {
                this.savedNotes.push(this.newNote.trim());
                localStorage.setItem("userNotes", JSON.stringify(this.savedNotes));
                this.newNote = ""; // Clear the input after saving the note
                alert("Note saved to localStorage!");
            } else {
                alert("Please enter a note before saving.");
            }
        },

        clearNotes() {
            if (confirm("Are you sure you want to clear all your notes? This cannot be undone!")) {
                this.savedNotes = [];
                localStorage.removeItem("userNotes");
                alert("All notes cleared.");
            }
        },

    }

};
</script>

<style scoped>
/* Optional styling for the page */
textarea {
    resize: none;
}

button {
    transition: background-color 0.3s;
}
</style>
