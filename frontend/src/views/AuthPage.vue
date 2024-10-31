<template>
    <div class="auth-page">
        <div>
            <h1 class="text-header">
                Приют для животных
            </h1>
        </div>
        <div>
            <h2 align="center">Авторизация</h2>
        </div>
        <form @submit.prevent="submitForm" class="auth-form">
            <div class="form-group">
                <label for="username">Логин:</label>
                <input v-model="email" type="text" id="username" />
            </div>
            <div class="form-group">
                <label for="password">Пароль:</label>
                <input v-model="password" type="password" id="password" />
            </div>
            <button type="submit" class="submit-button">Войти</button>
        </form>
    </div>
</template>

<script>
import {useAuthStore} from "@/stores/auth";

export default {
    name: 'AuthPage',
    data() {
        return {
            email: '',
            password: '',
        };
    },
    setup() {
        const authStore = useAuthStore();

        return {
            user: authStore.user,
            isAuthenticated: authStore.isAuthenticated,
            login: (credentials) => {
                authStore.login(credentials);
            },
        };
    },
    methods: {
        async submitForm() {
            try {
                this.login({
                    email: this.email,
                    password: this.password,
                });
                this.$router.push('/');
            } catch (error) {
                console.error('Login failed:', error.response ? error.response.data : error.message);
            }
        },
    },
};
</script>

<style scoped>
.auth-page {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    height: 100vh;
    padding: 20px;
    box-sizing: border-box;
    position: relative;
}

.text-header {
    padding-right: 15px;
    max-width: fit-content;
    background-color: #9ca0ea;
    border-radius: 15px;
}

.auth-form {
    max-width: 400px;
    width: 100%;
    margin: 0 auto;
    padding: 20px;
    border-radius: 15px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    background-color: #f9f9f9;
}

.form-group {
    margin-bottom: 15px;
}

.form-group label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
}

.form-group input {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

.submit-button {
    width: 100%;
    padding: 10px;
    background-color: #9ca0ea;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-weight: bold;
}

.submit-button:hover {
    background-color: #8a9ac6;
}

.logout-button {
    position: absolute;
    top: 20px;
    right: 20px;
}

.logout {
    text-decoration: none;
    color: #9ca0ea;
    font-weight: bold;
    font-size: 16px;
}

.logout:hover {
    text-decoration: underline;
}
</style>
