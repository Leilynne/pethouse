<template>
    <div class="animal-form">
        <h2>Редактировать животное</h2>

        <!-- Ошибки -->
        <div v-if="errors.length" class="error-messages">
            <ul>
                <li v-for="error in errors" :key="error">{{ error }}</li>
            </ul>
        </div>

        <!-- Name -->
        <div class="form-group">
            <label for="name">Имя:</label>
            <input type="text" id="name" v-model="animal.name" required/>
        </div>

        <!-- Animal Type -->
        <div class="form-group">
            <label for="type">Тип животного:</label>
            <select id="type" v-model="animal.type" required>
                 <option v-for="type in animalTypes" :key="type.value" :value="type.value">{{type.label}}</option>
            </select>
        </div>

        <!-- Birthday -->
        <div class="form-group">
            <label for="birthday">Дата рождения:</label>
            <input type="date" id="birthday" v-model="animal.birthday" required @change="test()" />
        </div>

        <!-- Color -->
        <div class="form-group">
            <label for="color">Цвет:</label>
            <select id="color" v-model="animal.color" required>
                <option v-for="color in colors" :key="color.id" :value="color.id">{{ color.name }}</option>
            </select>
        </div>

        <!-- Sex -->
        <div class="form-group">
            <label for="sex">Пол:</label>
            <div>
                <label><input type="radio" value="male" v-model="animal.sex" required /> Мальчик</label>
                <label><input type="radio" value="female" v-model="animal.sex" required /> Девочка</label>
            </div>
        </div>

        <!-- Health -->
        <div class="form-group">
            <label for="health">Состояние здоровья:</label>
            <select id="health" v-model="animal.health" required>
                <option v-for="item in health" :key="item.value" :value="item.value">{{item.label}}</option>
            </select>
        </div>

        <!-- Description -->
        <div class="form-group">
            <label for="description">Жалобы:</label>
            <input type="text" id="description" v-model="animal.description" required />
        </div>

        <!-- Preview Image -->
        <div class="form-group">
            <label for="preview">Изображение:</label>
            <input type="file" id="preview" @change="handleFileUpload" />
        </div>

        <div class="buttons">
            <button @click="submitAnimal">Сохранить</button>
            <button @click="back" class="button-paginator">Назад</button>

        </div>

    </div>
</template>

<script>
import axios from 'axios';
import Cookies from "js-cookie";

export default {
    name: 'AnimalForm',
    data() {
        return {
            animal: {
                name: '',
                type: '',
                birthday: '',
                color: '',
                sex: '',
                health: '',
                description: '',
                preview: null,
            },
            errors: [],
            animalTypes: [
                {value: 'cat', label: 'Кот'},
                {value: 'dog', label: 'Пес'}
            ],
            sex: [
                {value: 'male', label: 'Мальчик'},
                {value: 'female', label: 'Девочка'}
            ],
            health: [
                {value: 'great', label: 'Отличное'},
                {value: 'normal', label: 'Нормальное'},
                {value: 'poor', label: 'Тяжелое'},
            ],
            colors: [], // Список цветов, загруженный с сервера
        };
    },
    async created() {
        const animalId = this.$route.params.id; // Получение id из URL
        await this.fetchAnimal(animalId); // Загрузка данных животного
        await this.fetchColors();
    },
    methods: {
        async fetchAnimal(animalId) {
            const token = Cookies.get('authToken');
            const response = await axios.get(`/api/animals/${animalId}`, {
                headers: { Authorization: `Bearer ${token}` },
            });
            this.animal.color = response.data.data.color.id;
            const birthday = new Date(response.data.data.birthday);
            const year = birthday.getFullYear();
            const month = birthday.getMonth() + 1;
            const day = birthday.getDate();
            this.animal.birthday = year + '-' + (month <= 9 ? '0' + month : month) + '-' + (day <= 9 ? '0' + day : day);
            this.animal.name = response.data.data.name;
            this.animal.description = response.data.data.description;
            this.animal.type = response.data.data.type;
            this.animal.sex = response.data.data.sex;
            this.animal.health = response.data.data.health;
        },
        // Fetching available colors from the API
        async fetchColors() {
            try {
                const response = await axios.get('/api/colors');
                this.colors = response.data.data;
            } catch (error) {
                console.error('Error fetching colors:', error);
            }
        },
        // Handle file upload
        handleFileUpload(event) {
            const file = event.target.files[0];
            if (file) {
                this.animal.preview = file;
            }
        },

        back() {
            this.$router.push('/profile');
        },
        // Submit the form data to the server
        async submitAnimal() {
            const token = Cookies.get('authToken');
            const formData = new FormData();
            formData.append('_method', 'PUT');

            formData.append('name', this.animal.name);
            formData.append('type', this.animal.type);
            formData.append('birthday', this.animal.birthday);
            formData.append('color_id', this.animal.color);
            formData.append('sex', this.animal.sex);
            formData.append('health', this.animal.health);
            formData.append('description', this.animal.description);

            if (this.animal.preview) {
                formData.append('preview', this.animal.preview);
            }

            try {
                await axios.post(`/api/profile/update-animal/${this.$route.params.id}`, formData, {
                    headers: {
                        Authorization: `Bearer ${token}`,
                        'Content-Type': 'multipart/form-data',
                    },
                });
                this.$router.push(`/animals/${this.$route.params.id}`);
            } catch (error) {
                if (error.response && error.response.data && error.response.data.errors) {
                    this.errors = Object.values(error.response.data.errors).flat();
                } else {
                    this.errors.push('Произошла ошибка при добавлении животного.');
                }
            }
        },
    },
};
</script>

<style scoped>
.animal-form {
    max-width: 600px;
    margin: 0 auto;
    padding: 20px;
    border-radius: 10px;
    background-color: #f9f9f9;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.form-group {
    margin-bottom: 15px;
}

.form-group label {
    display: block;
    font-weight: bold;
    margin-bottom: 5px;
}

.form-group input,
.form-group select {
    width: 100%;
    padding: 8px;
    font-size: 16px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

.form-group input[type="radio"] {
    width: auto;
}

button {
    padding: 10px 20px;
    background-color: #9ca0ea;
    color: white;
    font-size: 16px;
    font-weight: bold;
    border: none;
    border-radius: 15px;
    cursor: pointer;
    min-width: 150px;
}

.buttons {
    display: flex;
    justify-content: center;
    margin-top: 20px;
    gap: 50px;
}

button:hover {
    background-color: #8387d5;
}
</style>
