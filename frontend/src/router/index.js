import { createRouter, createWebHistory } from 'vue-router';
import HomePage from '../views/HomePage.vue';
import AnimalsPage from '../views/AnimalsPage.vue';
import AboutPage from "../views/AboutPage.vue";
import CardPage from "@/views/CardPage.vue";
import NewsPage from "../views/NewsPage.vue";
import PostPage from "../views/PostPage.vue";
import AuthPage from "@/views/AuthPage.vue";
import ProfilePage from "../views/ProfilePage.vue";
import AddAnimalPage from "@/views/AddAnimalPage.vue";
import UpdateAnimalPage from "../views/UpdateAnimalPage.vue";

const routes = [
    { path: '/', component: HomePage },
    { path: '/animals', component: AnimalsPage },
    { path: '/animals/:id', component: CardPage },
    { path: '/posts', component: NewsPage },
    { path: '/about', component: AboutPage },
    { path: '/posts/:id', component: PostPage },
    { path: '/auth', component: AuthPage },
    { path: '/profile', component: ProfilePage },
    { path: '/profile/create-animal', component: AddAnimalPage },
    { path: '/profile/update-animal/:id', component: UpdateAnimalPage },
];

const router = createRouter({
    history: createWebHistory(),
    routes
});

export default router;
