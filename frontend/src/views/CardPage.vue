<template>
    <div>
        <h2>{{ animal?.name }}</h2>
        <div class="animal-card" v-if="animal">

            <div>
                <img :src="'http://localhost/storage/animals/' + animal.preview.file_name" alt="Animal Image" />
            </div>

            <div class="animal-info">
                <p><strong>Вид:</strong> {{ getLabelByValue(animalTypes, animal.type) }}</p>
                <p><strong>Пол:</strong> {{ getLabelByValue(sex, animal.sex) }}</p>
                <p><strong>Дата рождения:</strong> {{ formattedBirthday }}</p>
                <p><strong>Состояние здоровья:</strong> {{ getLabelByValue(health, animal.health) }}</p>
                <p><strong>Цвет:</strong> {{ animal?.color.name }}</p>
            </div>

        </div>

        <p><strong>Описание:</strong> {{ animal?.description }}</p>

    </div>
    <div class="buttons">
        <button @click="back" class="button-paginator">
            Назад
        </button>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: 'AnimalPage',
    data() {
        return {
            animal: null,
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
    computed: {
        formattedBirthday() {
            if (this.animal && this.animal.birthday) {
                return new Date(this.animal.birthday).toLocaleDateString();
            }
            return '';
        },
    },
    async created() {
        const animalId = this.$route.params.id;
        await this.fetchAnimalData(animalId);
    },
    methods: {
        async fetchAnimalData(id) {
            const response = await axios.get(`/api/animals/${id}`);
            this.animal = response.data.data;
        },
        async back() {
            this.$router.push('/animals') ;
        },
        getLabelByValue(optionsArray, value) {
            const option = optionsArray.find(option => option.value === value);
            return option ? option.label : 'Неизвестно';
        },
    }

}
</script>

<style scoped>
img {
    max-width: 500px;
    border-radius: 10px;
}

h2 {
    padding-right: 15px;
    max-width: fit-content;
    background-color: #9ca0ea;
    border-radius: 15px;
}

.buttons {
        background-color: #9ca0ea;
        color: white;
        font-weight: bold;
        min-height: 50px;
        min-width: 80px;
        border-radius: 15px;
}

.animal-info {
    flex-grow: 1;
    text-align: right;
    margin-left: auto;
}

.animal-card {
    display: flex;
}
</style>
