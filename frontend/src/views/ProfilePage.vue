<template>
    <div>
        <h1>{{ user?.name }}</h1>
        <div class="user-card">
            <div class="user-info">
                <p><strong>Почта:</strong> {{ user?.email }}</p>
                <p><strong>Номер телефона:</strong> {{ user?.phone }}</p>
            </div>
        </div>

        <!-- Секция для отображения животных -->
        <div class="pets" v-if="animals.length > 0">
            <h3>Ваши животные:</h3>
            <div class="pet-card" v-for="animal in animals" :key="animal.id">
                <!-- Карточка животного -->
                <div class="pet-preview">
                    <img :src="'http://localhost/storage/animals/' + animal.preview.file_name" alt="Pet Image" />
                </div>
                <div class="pet-info">
                    <h3>{{ animal.name }}</h3>
                    <p><strong>Вид:</strong> {{ getLabelByValue(animalTypes, animal.type) }}</p>
                    <p><strong>Пол:</strong> {{ getLabelByValue(sex, animal.sex) }}</p>
                    <p><strong>Дата рождения:</strong> {{ animal.birthday }}</p>
                    <p><strong>Состояние здоровья:</strong> {{ getLabelByValue(health, animal.health) }}</p>
                    <p><strong>Цвет:</strong> {{ animal.color.name }}</p>
                    <p><strong>Жалобы: </strong>{{animal.description}}</p>
                </div>
                <div class="pet-button">
                    <button @click="updateAnimal(animal.id)" class="button-paginator">Редактировать</button>
                </div>
            </div>
        </div>

        <div class="pet-button">
            <button @click="addAnimal" class="button-paginator">Добавить животное</button>
        </div>



        <div class="pets" v-if="pets.length > 0">
            <h3>Опекаемые животные:</h3>
            <div class="pet-card" v-for="animal in pets" :key="animal.id" @click="goToAnimalPage(animal.id)">
                <!-- Карточка животного -->
                <div class="pet-preview">
                    <img :src="'http://localhost/storage/animals/' + animal.preview.file_name" alt="Pet Image" />
                </div>
                <div class="pet-info">
                    <h3>{{ animal.name }}</h3>
                    <p><strong>Вид:</strong> {{ getLabelByValue(animalTypes, animal.type) }}</p>
                    <p><strong>Пол:</strong> {{ getLabelByValue(sex, animal.sex) }}</p>
                    <p><strong>Дата рождения:</strong> {{ animal.birthday }}</p>
                    <p><strong>Состояние здоровья:</strong> {{ getLabelByValue(health, animal.health) }}</p>
                    <p><strong>Цвет:</strong> {{ animal.color.name }}</p>
                </div>
            </div>
        </div>


        <div class="pets" v-if="adoptionRequest.length > 0">
            <h3>Запросы на прием животного домой:</h3>
            <div class="pet-card" v-for="request in adoptionRequest" :key="request.id" @click="goToAnimalPage(request.animal.id)">
                <!-- Карточка животного -->
                <div class="pet-preview">
                    <img :src="'http://localhost/storage/animals/' + request.animal.preview.file_name" alt="Pet Image" />
                </div>

                <div class="pet-info">
                    <h3>№: {{ request.id }}</h3>
                    <p><strong>Вид:</strong> {{ getLabelByValue(animalTypes, request.animal.type) }}</p>
                    <p><strong>Пол:</strong> {{ getLabelByValue(sex, request.animal.sex) }}</p>
                    <p><strong>Дата рождения:</strong> {{ request.animal.birthday }}</p>
                    <p><strong>Состояние здоровья:</strong> {{ getLabelByValue(health, request.animal.health) }}</p>
                    <p><strong>Цвет:</strong> {{ request.animal.color.name }}</p>
                </div>
            </div>
        </div>






        <div class="buttons">
            <button @click="back" class="button-paginator">Назад</button>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import Cookies from 'js-cookie';

export default {
    name: 'ProfilePage',
    data() {
        return {
            user: null,
            animals: [],
            pets: [],
            adoptionRequest: [],

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
            ]

        };
    },

    async created() {
        await this.fetchUserData();
    },
    methods: {
        async fetchUserData() {
            const token = Cookies.get('authToken');
            try {
                const response = await axios.get(`/api/profile`, {
                    headers: { Authorization: `Bearer ${token}` },
                });
                this.user = response.data.data;

                const responseAnimal = await axios.get('/api/profile/get-animals', {
                    headers: { Authorization: `Bearer ${token}` },
                });
                this.animals = responseAnimal.data.data;
                this.animals.forEach((animal) => {
                    animal.birthday = new Date(animal.birthday).toLocaleDateString();
                });

                const responseCuration = await axios.get('/api/profile/get-supervised-animals', {
                    headers: { Authorization: `Bearer ${token}` },
                });
                this.pets = responseCuration.data.data;
                this.pets.forEach((pet) => {
                    pet.birthday = new Date(pet.birthday).toLocaleDateString();
                });


                const responseAdoption = await axios.get('api/profile/get-adoption-requests', {
                    headers: { Authorization: `Bearer ${token}` },
                })
                this.adoptionRequest = responseAdoption.data.data;
                this.adoptionRequest.forEach((request) => {
                    request.animal.birthday = new Date(request.animal.birthday).toLocaleDateString();
                });


            } catch (error) {
                console.error('Error fetching data:', error);
            }
        },

        goToAnimalPage(animalId) {
            this.$router.push(`/animals/${animalId}`);
        },

        back() {
            this.$router.push('/home');
        },
        addAnimal() {
            this.$router.push('/profile/create-animal');
        },
        updateAnimal(animalId) {
            this.$router.push(`/profile/update-animal/${animalId}`);
        },
        getLabelByValue(optionsArray, value) {
            const option = optionsArray.find(option => option.value === value);
            return option ? option.label : 'Неизвестно';
        },
    }
};
</script>

<style scoped>
img {
    max-width: 100%;
    border-radius: 10px;
}

h1 {
    margin-bottom: 20px;
}

.buttons {
    background-color: #9ca0ea;
    color: white;
    font-weight: bold;
    min-height: 50px;
    min-width: 80px;
    border-radius: 15px;
    margin-top: 20px;
}

.user-info {
    flex-grow: 1;
    text-align: left;
    margin-bottom: 20px;
}

.user-card {
    display: flex;
    margin-bottom: 20px;
}

.pets {
    display: flex;
    flex-direction: column;
    gap: 10px;
    margin-top: 20px;
}

.pet-card {
    display: flex; /* Сделать контейнер flex для горизонтального расположения */
    align-items: center;
    border: 1px solid #eee;
    border-radius: 10px;
    padding: 10px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.pet-card:hover {
    background-color: #f0f0f0;
}

.pet-preview {
    flex-shrink: 0; /* Не позволяем превью ужиматься */
    width: 100px;
    height: 100px;
    overflow: hidden;
    border-radius: 10px;
    margin-right: 15px; /* Добавляем отступ справа */
}

.pet-preview img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.pet-info {
    flex-grow: 1; /* Занимает оставшееся пространство */
    text-align: left;
}
</style>
