<template>
    <div class="page-container">
        <div>
            <h2>{{ post.title }}</h2>

            <div class="post-card">
                <div class="post-preview">
                    <img :src="'http://localhost/storage/posts/' + post.preview.file_name" alt="Post Image"/>
                </div>
                <div class="post-info">
                    <p>{{ post.description }}</p>
                </div>

                <div class="post-photos" v-if="post.photos && post.photos.length">
                    <div class="carousel">
                        <button class="carousel-button left" @click="prevSlide">&#8249;</button>
                        <div class="carousel-container">
                            <div
                                class="carousel-slide"
                                v-for="(photo) in visiblePhotos"
                                :key="photo.id"
                            >
                                <img
                                    :src="'http://localhost/storage/posts/' + photo.file_name"
                                    alt="Post Photo"
                                    @click="openModal(photo)"
                                />
                            </div>
                        </div>
                        <button class="carousel-button right" @click="nextSlide">&#8250;</button>
                    </div>
                </div>
                <p v-else>No photos available for this post.</p>
            </div>
        </div>

        <div v-if="showModal" class="modal" @click.self="closeModal">
            <div class="modal-content">
                <span class="close" @click="closeModal">&times;</span>
                <img :src="'http://localhost/storage/posts/' + currentPhoto.file_name" alt="Large Photo" />
            </div>
        </div>
    </div>
    <div class="pagination-buttons">
    <div class="buttons">
        <button @click="back" class="button-paginator">Назад</button>
    </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: 'PostPage',
    data() {
        return {
            post: [],
            currentSlideIndex: 0,
            showModal: false,
            currentPhoto: null,
        };
    },
    computed: {
        visiblePhotos() {
            return this.post.photos.slice(this.currentSlideIndex, this.currentSlideIndex + 3);
        },
    },
    async created() {
        const postId = this.$route.params.id;
        await this.fetchPostData(postId);
    },
    methods: {
        async fetchPostData(id) {
            const response = await axios.get(`/api/posts/${id}`);
            this.post = response.data.data;
        },
        nextSlide() {
            if (this.currentSlideIndex < this.post.photos.length - 3) {
                this.currentSlideIndex += 1;
            }
        },
        prevSlide() {
            if (this.currentSlideIndex > 0) {
                this.currentSlideIndex -= 1;
            }
        },
        openModal(photo) {
            this.currentPhoto = photo;
            this.showModal = true;
        },
        closeModal() {
            this.showModal = false;
            this.currentPhoto = null;
        },
        back() {
            this.$router.push('/posts');
        },
    },
};
</script>

<style scoped>
.page-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: flex-start;
    min-height: 100vh;
    padding: 20px;
    box-sizing: border-box;
    max-width: 1200px;
    margin: 0 auto;
}

h2 {
    padding: 10px 15px;
    max-width: fit-content;
    background-color: #9ca0ea;
    border-radius: 15px;
    text-align: center;
    margin-bottom: 20px;
}

.post-card {
    width: 100%;
    max-width: 1200px;
    margin-bottom: 20px;
}

.buttons {
    background-color: #9ca0ea;
    color: white;
    font-weight: bold;
    min-height: 50px;
    min-width: 80px;
    border-radius: 15px;
}

.carousel {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 20px 0;
    position: relative;
    justify-content: center;
    width: 100%;
}

.carousel-container {
    display: flex;
    overflow: hidden;
    max-width: 900px;
}

.carousel-slide {
    flex: 0 0 33.33%;
    border-radius: 15px;
    overflow: hidden;
    margin-right: 10px;
}

.carousel-slide img {
    width: 100%;
    height: auto;
    display: block;
    cursor: pointer;
}

.carousel-button {
    background-color: #9ca0ea;
    color: white;
    cursor: pointer;
    padding: 10px;
    font-size: 20px;
    border-radius: 15%;
    border: none;
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    z-index: 2;
}

.carousel-button.left {
    left: -30px;
}

.carousel-button.right {
    right: -30px;
}

.modal {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.8);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 1000;
}

.modal-content {
    position: relative;
    max-width: 90%;
    max-height: 90%;
}

.modal-content img {
    width: 100%;
    height: auto;
    border-radius: 10px;
}

.close {
    position: absolute;
    top: 10px;
    right: 15px;
    font-size: 30px;
    color: white;
    cursor: pointer;
}

.post-preview {
    max-width: 100%;
    height: auto;
    border-radius: 30px;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
}

.pagination-buttons {
    display: flex;
    justify-content: center;
    margin-top: 20px;
}

.post-info {
    max-width: 1200px;
    margin-bottom: 20px;
    text-align: center;
}


@media (max-width: 720px) {
    .carousel-container {
        max-width: 100%;
    }
    .carousel-slide {
        flex: 0 0 50%;
        margin-right: 5px;
    }
    .carousel-button.left {
        left: 5px;
    }
    .carousel-button.right {
        right: 5px;
    }
    .post-card, .post-info {
        max-width: 100%;
    }
}

@media (max-width: 480px) {
    .carousel-slide {
        flex: 0 0 100%;
    }
    .carousel-button.left,
    .carousel-button.right {
        font-size: 16px;
        padding: 5px;
    }
    .buttons {
        font-size: 14px;
        min-width: 60px;
    }
}
</style>
