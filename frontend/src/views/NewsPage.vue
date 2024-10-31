<template>
    <div class="page-container">
        <div class="post-list">
            <div v-for="(post) in posts" :key="post.id" class="post-card">
                <div class="post-content" :id="post.id" onclick="window.location.href='/posts/' + this.getAttribute('id')">
                <h2>{{ post.title }}</h2>
                <div class="post-preview">
                    <img
                        :src="'http://localhost/storage/posts/' + post.preview.file_name"
                        alt="Post Image"
                    />
                </div>

                <p>{{ post.description }}</p>
            </div>
            </div>
            <div v-if="pagination" class="pagination">
                <div class="pagination-buttons">
                    <button @click="loadPreviousPage" :disabled="pagination.current_page <2" class="button-paginator">
                        Назад
                    </button>
                    <div class="paginator-text">
                        Страница {{ pagination.current_page }} из {{ pagination.total_pages }}
                    </div>
                    <button @click="loadNextPage" :disabled="pagination.current_page >= pagination.total_pages" class="button-paginator">
                        Вперед
                    </button>
                </div>
            </div>
    </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    name: "NewsPage",
    data() {
        return {
            posts: [],
        };
    },

    async created() {
        try {
            const response = await axios.get("/api/posts");
            this.posts = response.data.data;
            this.pagination = {
                current_page: response.data.pagination.currentPage,
                total_pages: response.data.pagination.lastPage,
            };
        } catch (error) {
            console.error("Error fetching posts:", error);
        }
    },
    methods: {
        async search(page = 1) {
            try {
                const response = await axios.get('/api/posts',
                    {
                        params:
                            {
                                page: page,
                            }
                    });
                console.log(response);
                this.posts = response.data.data;
                this.pagination = {
                    current_page: response.data.pagination.currentPage,
                    total_pages: response.data.pagination.lastPage,
                };
            } catch (error) {
                console.error('Error fetching posts:', error);
            }
        },

        async loadNextPage() {
            if (this.pagination.current_page < this.pagination.total_pages) {
                await this.search(this.pagination.current_page + 1);
            }
        },
        async loadPreviousPage() {
            if (this.pagination.current_page > 1) {
                await this.search(this.pagination.current_page - 1);
            }
        },
    },
};
</script>

<style scoped>
.page-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    min-height: 100vh;
}

h2 {
    background-color: #9ca0ea;
    border-radius: 15px;
    padding: 10px;
    color: white;
    margin-bottom: 10px;
}

.button-paginator {
    background-color: #9ca0ea;
    color: white;
    font-weight: bold;
    min-height: 50px;
    min-width: 80px;
    border-radius: 15px;
    border: none;
    cursor: pointer;
}

.post-card {
    border: 1px solid #eee;
    border-radius: 10px;
    padding: 20px;
    margin-bottom: 20px;
    background-color: #f9f9f9;
    width: 100%;
    max-width: 1200px;
}

.post-list {
    display: flex;
    flex-direction: column;
    gap: 20px;
    width: 100%;
    align-items: center;
}

.post-preview {
    border-radius: 30px;
    filter: drop-shadow(0px 6px 8px rgba(0, 0, 0, 0.6));
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 100%;
}

.post-preview:hover {
    cursor: pointer;
}
</style>
