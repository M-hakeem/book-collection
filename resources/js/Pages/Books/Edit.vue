<template>
    <div>
        <div v-if="successMessage" class="bg-green-500 text-white p-2 mb-4 rounded">
            {{ successMessage }}
        </div>
        <Link href="/books" class="back-link">Back to List</Link>
        <form @submit.prevent="submitForm" class="form-container">
            <table class="min-w-full bg-white border">
                <tbody>
                <tr>
                    <td class="border">
                        <label for="title" class="block text-sm font-medium text-gray-700">Title:</label>
                        <input
                            type="text"
                            id="title"
                            v-model="form.title"
                            class="input-field"
                            required
                        />
                    </td>
                </tr>
                <tr>
                    <td class="p-2 border">
                        <label for="author" class="block text-sm font-medium text-gray-700">Author:</label>
                        <input
                            type="text"
                            id="author"
                            v-model="form.author"
                            class="input-field"
                            required
                        />
                    </td>
                </tr>
                <tr>
                    <td class="p-2 border">
                        <label for="description" class="block text-sm font-medium text-gray-700">Description:</label>
                        <textarea
                            id="description"
                            v-model="form.description"
                            class="input-field"
                            rows="4"
                        ></textarea>
                    </td>
                </tr>
                <tr>
                    <td class="p-2 border">
                        <label for="published_year" class="block text-sm font-medium text-gray-700">Published Year:</label>
                        <input
                            type="number"
                            id="published_year"
                            v-model="form.published_year"
                            class="input-field"
                            required
                        />
                    </td>
                </tr>
                <tr>
                    <td class="p-2 border">
                        <label for="status" class="block text-sm font-medium text-gray-700">Status:</label>
                        <select
                            id="status"
                            v-model="form.status"
                            class="input-field"
                        >
                            <option value="available">Available</option>
                            <option value="borrowed">Borrowed</option>
                            <option value="reserved">Reserved</option>
                        </select>
                    </td>
                </tr>
                </tbody>
            </table>
            <button type="submit" class="submit-button">Update Book</button>
        </form>
    </div>
</template>

<script>
import { Inertia } from '@inertiajs/inertia';
import { Link } from '@inertiajs/inertia-vue3';

export default {
    props: {
        book: Object,
    },
    data() {
        return {
            form: {
                title: this.book.title,
                author: this.book.author,
                description: this.book.description,
                published_year: this.book.published_year,
                status: this.book.status,
            },
            successMessage: '',
            errors: {},
        };
    },
    methods: {
        submitForm() {
            // Hardcode the URL for the update
            const url = `/books/${this.book.id}`; // Ensure this matches your route

            Inertia.put(url, this.form)
                .then(() => {
                    this.successMessage = 'Book updated successfully!';
                })
                .catch((error) => {
                    console.error('Update failed:', error);
                    this.successMessage = 'Failed to update book.';
                });
        },
    },
    components: {
        Link,
    },
};
</script>

<style scoped>
.form-container {
    max-width: 600px;
    margin: 0 auto;
    padding: 20px;
    background-color: #f9fafb;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
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

table {
    width: 100%;
    border-collapse: collapse;
}

thead {
    background-color: #f3f4f6;
}

td {
    padding: 10px;
    border: 1px solid #d1d5db;
    text-align: left;
}

label {
    margin-bottom: 4px;
}

.input-field {
    width: 100%;
    padding: 6px;
    border: 1px solid #d1d5db;
    border-radius: 4px;
    transition: border-color 0.2s ease-in-out;
}

.input-field:focus {
    border-color: gray;
    outline: none;
}

.submit-button {
    width: 100%;
    background-color: gray;
    color: white;
    padding: 10px 15px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s ease;
    margin-top: 10px;
}

.submit-button:hover {
    background-color: gray;
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
