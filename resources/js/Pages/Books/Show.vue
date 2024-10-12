<template>
    <div class="container">
        <h1 class="text-2xl font-bold mb-4">{{ book.title }}</h1>
        <div class="details">
            <p><strong>Author:</strong> {{ book.author }}</p>
            <p><strong>Description:</strong> {{ book.description }}</p>
            <p><strong>Published Year:</strong> {{ book.published_year }}</p>
            <p><strong>Status:</strong> {{ book.status }}</p>
        </div>

        <Link href="/books" class="back-link">Back to List</Link>
    </div>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3';

export default {
    props: {
        book: Object,
    },
    components: {
        Link,
    }
};
</script>

<style scoped>
.container {
    max-width: 600px;
    margin: 20px auto;
    padding: 20px;
    background-color: #f9fafb;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.details {
    margin-bottom: 20px;
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
