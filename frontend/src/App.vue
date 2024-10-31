<template>
    <div>
        <header>
            <nav>
                <ul>
                    <li><router-link class="router-link" to="/">Приют</router-link></li>
                    <li><router-link class="router-link" to="/animals">Каталог животных</router-link></li>
                    <li><router-link class="router-link" to="/posts">Наши новости</router-link></li>
                    <li><router-link class="router-link" to="/about">О приюте</router-link></li>
                    <li v-if="isAuthenticated">
                        <router-link class="router-link" to="/profile">Профиль</router-link>
                    </li>
                    <li>
                        <button v-if="isAuthenticated" class="login" @click="handleLogout">Выйти</button>
                        <router-link v-else class="login" to="/auth">Войти</router-link>
                    </li>
                </ul>
            </nav>
        </header>
        <main>
            <router-view />
        </main>
    </div>
    <footer>
        <div class="top-bottom"></div>
        <div class="bottom">

        <img src="@/assets/lapa.jpg" class="footer-image" alt="Footer Image"/>
        <div class="footer-text">
        <div class="text">
            Прием животных в приют: +7 (921) 999-99-99
        </div>

            <div class="text">
                Для попечителей: +7 (921) 921-99-99
            </div>

            <div class="text">
                E-mail: pet-house@gmail.com
            </div>

            <div class="text">
                Адрес: ул. Академика Королева д.12
            </div>
        </div>

        <div class="text-bottom">

        </div>
        </div>

    </footer>
</template>

<script>
import { useAuthStore } from "@/stores/auth";
import {computed, onMounted} from "vue";
import {useRouter} from "vue-router";
export default {
    name: 'App',
    setup() {
        const authStore = useAuthStore();

        onMounted(() => {
            authStore.fetchUser();
        });

        const router = useRouter();

        const handleLogout = async () => {
            await authStore.logout(router);
        };

        const isAuthenticated = computed(() => authStore.isAuthenticated);
        const user = computed(() => authStore.user);

        return {
            user,
            isAuthenticated,
            handleLogout,
        };
    },
};
</script>



<style>
header {
    background-color: #f8f9fa;
    padding: 10px;
    position: relative;
}

nav {
    display: flex;
    align-items: center;
    justify-content: space-between;
}

nav ul {
    display: flex;
    list-style: none;
    margin: 0;
    padding: 0;
}

nav li {
    margin-right: 15px;
}

.router-link {
    text-decoration-line: none;
}

.login {
    text-decoration-line: none;
}

.bottom {
    padding-top: 30px;
    background-color: #9ca0ea;
    position: relative;
    border-radius: 15px;
    padding-bottom: 10px;
}

.top-bottom {
    background-color: #ffffff;
    padding: 10px;
}

.footer-image {
    position: absolute;
    left: 20px;
    bottom: 20px;
    width: 100px;
    height: auto;
}

.footer-text {
    padding-bottom: 15px;
    padding-right: 40px;
    text-align: right;
    margin-left: auto;
}

</style>
