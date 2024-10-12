<template>
    <div>
        <div v-if="successMessage" class="bg-green-500 text-white p-2 mb-4 rounded">
            {{ successMessage }}
        </div>
        <Link href="/books" class="back-link">Back to List</Link>
        <form @submit.prevent="submitForm">
            <table class="min-w-full bg-white border">
                <tbody>
                <tr>
                    <td class="border">
                        <label for="title" class="block text-sm font-medium text-gray-700">Title:</label>
                        <input type="text" id="title" v-model="form.title" class="w-full p-2 border rounded border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </td>
                </tr>
                <tr>
                    <td class="p-2 border">
                        <label for="author" class="block text-sm font-medium text-gray-700">Author:</label>
                        <input type="text" id="author" v-model="form.author" class="w-full p-2 border rounded border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </td>
                </tr>
                <tr>
                    <td class="p-2 border">
                        <label for="description" class="block text-sm font-medium text-gray-700">Description:</label>
                        <textarea id="description" v-model="form.description" class="w-full p-2 border rounded border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500" rows="4"></textarea>
                    </td>
                </tr>
                <tr>
                    <td class="p-2 border">
                        <label for="published_year" class="block text-sm font-medium text-gray-700">Published Year:</label>
                        <input type="number" id="published_year" v-model="form.published_year" class="w-full p-2 border rounded border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </td>
                </tr>
                <tr>
                    <td class="p-2 border">
                        <label for="status" class="block text-sm font-medium text-gray-700">Status:</label>
                        <select id="status" v-model="form.status" class="w-full p-2 border rounded border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="available">Available</option>
                            <option value="borrowed">Borrowed</option>
                            <option value="reserved">Reserved</option>
                        </select>
                    </td>
                </tr>
                </tbody>
            </table>
            <button type="submit" class="w-full bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition mt-4">Add Book</button>
        </form>
    </div>
</template>

<script>
import { Inertia } from '@inertiajs/inertia';
import {Link} from "@inertiajs/inertia-vue3";

export default {
    components: {Link},
    data() {
        return {
            form: {
                title: '',
                author: '',
                description: '',
                published_year: '',
                status: 'available',
            },
            successMessage: '',
        };
    },
    methods: {
        submitForm() {
            Inertia.post('/books', this.form)
                .then(() => {
                    this.successMessage = 'Book added successfully!';
                    this.resetForm();
                })
                .catch(() => {
                    this.successMessage = '';
                });
        },
        resetForm() {
            this.form.title = '';
            this.form.author = '';
            this.form.description = '';
            this.form.published_year = '';
            this.form.status = 'available';
        },
    },
};
</script>

<style scoped>

form {
    max-width: 600px;
    margin: 0 auto;
    padding: 20px;
    background-color: #f9fafb;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

table {
    width: 100%;
    border-collapse: collapse;
}

thead {
    background-color: #f3f4f6;
}

th, td {
    padding: 10px;
    border: 1px solid #d1d5db;
    text-align: left;
}

th {
    font-weight: bold;
}

tr:nth-child(even) {
    background-color: #f9fafb;
}

input[type="text"],
input[type="number"],
textarea,
select {
    width: 100%;
    padding: 6px 0px 6px 0px;
    border: 1px solid #d1d5db;
    border-radius: 4px;
    transition: border-color 0.2s ease-in-out;
}

input[type="text"]:focus,
input[type="number"]:focus,
textarea:focus,
select:focus {
    border-color: gray;
    outline: none;
}


label {
    margin-bottom: 4px;
}


button {
    background-color: gray;
    color: white;
    padding: 10px 15px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s ease;
    margin-top: 10px;
}

button:hover {
    background-color: gray;
}

.bg-green-500 {
    margin-bottom: 10px;
}

.back-link {
    display: inline-block;
    margin-top: 10px;
    padding: 10px 15px;
    color: gray;
    background-color: #ffffff;
    border: 1px solid gray;
    border-radius: 5px;
    text-decoration: none;
    transition: background-color 0.3s, color 0.3s;
}

.back-link:hover {
    background-color: gray;
    color: #ffffff;
}
</style>
