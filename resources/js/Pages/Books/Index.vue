<template>
    <div>
        <h1 class="text-2xl font-bold mb-4">Books List</h1>

        <div class="mb-4">
            <Link href="/books/create" class="add_book">Add New Book</Link>
        </div>

        <div v-if="books && books.length > 0">
            <table class="min-w-full bg-white border">
                <thead>
                <tr>
                    <th class="py-2 border">Title</th>
                    <th class="py-2 border">Author</th>
                    <th class="py-2 border">Published Year</th>
                    <th class="py-2 border">Status</th>
                    <th class="py-2 border">Actions</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="book in books" :key="book.id" class="border-t">
                    <td class="py-2 border">{{ book.title }}</td>
                    <td class="py-2 border">{{ book.author }}</td>
                    <td class="py-2 border">{{ book.published_year }}</td>
                    <td class="py-2 border">{{ book.status }}</td>
                    <td class="py-2 border">
                        <div class="inline-actions">
                            <Link :href="`/books/${book.id}`" class="view-button">
                                <button><i class="fa fa-eye"></i> View</button>
                            </Link>

                            <Link :href="`/books/${book.id}/edit`" class="edit-button">
                                <button><i class="fa fa-pencil"></i> Edit</button>
                            </Link>

                            <form :action="`/books/${book.id}`" method="POST" @submit.prevent="deleteBook(book.id)" class="inline-form">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="_token" :value="csrfToken">
                                <button type="submit" class="delete-button">
                                    <i class="fa fa-trash"></i> Delete
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>

        <div v-else class="text-center mt-4">
            No books available.
        </div>
    </div>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3';
import { Inertia } from '@inertiajs/inertia';

export default {
    name: 'BooksIndex',
    props: {
        books: {
            type: Array,
            default: () => []
        },
        csrfToken: {
            type: String,
            required: true
        }
    },
    methods: {
        deleteBook(id) {
            if (confirm('Are you sure you want to delete this book?')) {
                Inertia.delete(`/books/${id}`);
            }
        }
    },
    components: {
        Link
    }
}
</script>



<style scoped>
table {
    border-collapse: collapse;
    width: 100%;
}

th, td {
    border: 1px solid #dddddd;
    padding: 8px;
    text-align: left;
}

th {
    background-color: #f2f2f2;
}

.view-button {
    background: none;
    border: none;
    cursor: pointer;
    color: #3b82f6;
}

.view-button i {
    margin-right: 4px;
}

/* Add these styles to ensure buttons are displayed inline */
.inline-actions {
    display: flex;
    gap: 10px;
    align-items: center;
}

.view-button {
    color: #3b82f6;
}

.delete-button {
    color: #ef4444;
}

.view-button i, .delete-button i {
    margin-right: 4px;
}

.inline-form {
    display: inline;
}

.add_book{
    display: inline-block;
    margin-top: 10px;
    padding: 10px 15px;
    color: gray;
    background-color: #ffffff;
    border: 1px solid gray;
    border-radius: 5px;
    text-decoration: none;
    transition: background-color 0.3s, color 0.3s;
    margin-bottom: 10px;
}

.add_book:hover {
    background-color: gray;
    color: #ffffff;
}

</style>
