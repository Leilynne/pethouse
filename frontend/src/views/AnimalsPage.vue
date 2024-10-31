<template>
    <div>
        <main>
            <h1>
                <div class="page-header">
                    Хвостатики в приюте
                </div>
            </h1>
            <div class="filter-container">
            <div class="filters">
                <div class="filter" align="center">
                    <p>Вид</p>
                    <Multiselect
                        v-model="filters.type"
                        :options="animalTypes"
                        :searchable="true">
                    </Multiselect>
                </div>

                <div class="filter" align="center">
                    <p>Цвет</p>
                    <Multiselect
                        v-model="filters.color"
                        :options="colors"
                        :searchable="true">
                    </Multiselect>
                </div>

                <div class="filter" align="center">
                    <p>Пол</p>
                    <Multiselect
                        v-model="filters.sex"
                        :options="sex"
                        :searchable="true">
                    </Multiselect>
                </div>

                <div class="filter" align="center">
                    <p>Состояние здоровья</p>
                    <Multiselect
                        v-model="filters.health"
                        :options="health"
                        :searchable="true">
                    </Multiselect>
                </div>

                <div class="filter" align="center">
                    <p>Возраст</p>
                    <Multiselect
                        v-model="filters.age"
                        :options="age"
                        :searchable="true">
                    </Multiselect>
                </div>

                <div class="filter" align="center">
                    <p>Особенности</p>
                    <Multiselect
                        v-model="filters.tags"
                        :options="tags"
                        :searchable="true"
                        mode="tags"
                        :close-on-select="false"
                    >
                    </Multiselect>
                </div>

                <div class="filter" align="center">
                    <p>Статус</p>
                    <Multiselect
                        v-model="filters.status"
                        :options="statuses"
                        :searchable="true">
                    </Multiselect>
                </div>



            </div>
                <br>
                    <button @click="search(1)" class="buttonSearch">
                        Поиск
                    </button>
            </div>

            <div class="animals">
                <div class="animal-card" v-for="animal in animals" :key="animal.id">
                    <div class="animal-content" :id="animal.id" onclick="window.location.href='/animals/' + this.getAttribute('id')">
                        <div class="animal-preview">
                            <img :src="'http://localhost/storage/animals/' + animal.preview.file_name" alt="Animal Image" />
                        </div>

                        <div class="animal-info">
                            <h2>{{ animal.name }}</h2>
                            <div class="tags">
                                <div class="tag-container" v-for="tag in animal.tags" :key="tag.id">
                                    <div class="tag">
                                        <p>{{ tag.name }}</p>
                                    </div>
                                </div>
                            </div>
                            <p><strong>Вид:</strong> {{ getLabelByValue(animalTypes, animal.type) }}</p>
                            <p><strong>Пол:</strong> {{ getLabelByValue(sex, animal.sex) }}</p>
                            <p><strong>Дата рождения:</strong> {{ animal.birthday }}</p>
                            <p><strong>Состояние здоровья:</strong> {{ getLabelByValue(health, animal.health) }}</p>
                            <p><strong>Цвет:</strong> {{ animal.color.name }}</p>
                        </div>
                    </div>
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
        </main>
    </div>
</template>

<script>
import axios from 'axios';
import Multiselect from "@vueform/multiselect";

export default {
    name: 'AnimalsPage',
    components: {'Multiselect': Multiselect},
    data() {
        return {
            animals: [],
            colors: [],
            tags: [],
            pagination: null,
            filters: {
                type: null,
                color: null,
                sex: null,
                health: null,
                tags: [],
                age: null,
                status: null,
            },
            user: {
                role: 'guest',
            },
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
            age: [
                {value: 'young', label: 'До года'},
                {value: 'adult', label: 'От года до трех'},
                {value: 'old', label: 'Старше трех лет'},
            ],
            statuses: [
                {value: 'awaiting', label: 'В процессе передачи домой'},
                {value: 'looking-home', label: 'Ищем дом'},
            ]
        };
    },
    async created() {
        try {
            const response = await axios.get('/api/animals');
            this.animals = response.data.data;
            this.animals.forEach((animal) => {
                animal.birthday = new Date(animal.birthday).toLocaleDateString();
            })
            this.pagination = {
                current_page: response.data.pagination.currentPage,
                total_pages: response.data.pagination.lastPage
            };
        } catch (error) {
            console.error('Error fetching animals:', error);
        }
        try {
            const response = await axios.get('/api/colors');
            const colors = response.data.data;
            this.colors = colors.map((color) => {
                return {value: color.id, label: color.name};
            });
        } catch (error) {
            console.error('Error fetching colors:', error);
        }
        try {
            const response = await axios.get('/api/tags');
            const tags = response.data.data;
            this.tags = tags.map((tag) => {
                return {value: tag.id, label: tag.name};
            });
        } catch (error) {
            console.error('Error fetching tags:', error);
        }
        try {
            const response = await axios.get('/api/profile');
            const profile = response.data;
            this.user.role = profile.role;
            if (profile.role === 'admin') {
                this.statuses.push(
                    {value: 'adopted', label: 'Нашли дом'},
                    {value: 'household', label: 'Домашний'},
                )
            }
        } catch (error) {
            if (error.response.status !== 401) {
                console.error('Error fetching profile:', error);
            }
        }
    },
    methods: {
        async search(page = 1) {
            try {
                const response = await axios.get('/api/animals',
                    {
                        params:
                            {
                                page: page,
                                type: this.filters.type,
                                color: this.filters.color,
                                sex: this.filters.sex,
                                health: this.filters.health,
                                tags: this.filters.tags,
                                age: this.filters.age,
                                status: this.filters.status,
                            }
                    });
                console.log(response);
                this.animals = response.data.data;
                this.animals.forEach((animal) => {
                    animal.birthday = new Date(animal.birthday).toLocaleDateString();
                })
                this.pagination = {
                    current_page: response.data.pagination.currentPage,
                    total_pages: response.data.pagination.lastPage,
                };
            } catch (error) {
                console.error('Error fetching animals:', error);
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
        getLabelByValue(optionsArray, value) {
            const option = optionsArray.find(option => option.value === value);
            return option ? option.label : 'Неизвестно';
        },
    }
};
</script>
<style src="@vueform/multiselect/themes/default.css"></style>
<style>
.animals {
    flex-grow: 1;
    display: flex;
    flex-wrap: wrap;
    gap:  16px;
    padding: 50px;
}

.animal-card {
    width: 500px;
    flex-grow: 1;
    padding: 16px;
    display: flex;
    flex-direction: column;
    border: 1px solid #eee;
    border-radius: 15px;
    align-items: center;
}

.animal-content {
    flex-direction: column;
    flex-grow: 1;
    display: flex;
    align-items: center;
}
.filters {
    display: flex;
    filter: drop-shadow(0px 0px 2px rgba(0, 0, 0, 0.2));
}

.filter{
    padding-right: 10px;
    flex-grow: 1;
}
.tags {
    display: flex;
}

.tag-container {
    padding-right: 10px;
}

.tag {
    flex-grow: 1;
    padding: 3px 10px;
    background-color: #9ca0ea;
    border-radius: 15px;
    color: white;
    font-weight: bold;
    filter: drop-shadow(0px 0px 2px rgba(0, 0, 0, 0.6));
}

.animal-info {
    margin-left: 16px;
    text-align: center;
}

.animal-card img {
    max-width: 100%;
    height: auto;
    border-radius: 30px;
}

.animal-preview {
    padding-top: 30px;
    filter: drop-shadow(0px 6px 8px rgba(0, 0, 0, 0.6));
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 300px;
    max-height: 400px;
    min-width: 300px;
    max-width: 300px;
}

.animal-card img:hover {
    filter: drop-shadow(0px 6px 8px rgba(0, 0, 0, 0.6));
}

.animal-card:hover {
    cursor: pointer;
}

h2 {
    font-size: 30px;
    font-style: italic;
}

.page-header {
    padding-right: 15px;
    max-width: fit-content;
    background-color: #9ca0ea;
    border-radius: 15px;
}

.buttonSearch:hover {
    filter: drop-shadow(0px 6px 8px rgba(0, 0, 0, 0.6));
}

.buttonSearch {
    border: 0;
    background-color: #9ca0ea;
    color: white;
    font-weight: bold;
    min-height: 50px;
    min-width: 80px;
    border-radius: 15px;
    float: right;
}

.filter-container {
    border: 10px solid #9ca0ea;
    border-radius: 15px;
    padding: 60px;
}

.multiselect-tag {
    background: #9ca0ea;
}
.multiselect.is-active {
    box-shadow: 2px 4px 6px rgba(156, 160, 234, 1);
}

.button-paginator {
    background-color: #9ca0ea;
    color: white;
    font-weight: bold;
    min-height: 50px;
    min-width: 80px;
    border-radius: 15px;
}
.pagination-buttons {
    padding-right: 10px;
    display: flex;
    justify-content: center;
}

.paginator-text {
    padding-top: 15px;
}
@media (max-width: 1200px) {
    .animal-card {
        flex: 1 1 calc(50% - 16px);
    }
}

@media (max-width: 800px) {
    .animal-card {
        flex: 1 1 100%;
    }
}

</style>
