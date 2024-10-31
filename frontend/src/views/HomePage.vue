<template>
    <div>
        <main>
            <h1>
                <div class="text-header">Приют для животных</div>
            </h1>
            <div>
                <p class="text-fill">Мы уже помогли более 1000 пушистиков найти свой дом.</p>
            </div>

            <div class="text">
                <p>
                    Найди своего верного друга у нас!
                </p>
            </div>
            <div class="logo">
                <img src="../assets/cat&dog.jpg" alt="logo"/>
            </div>


        </main>
    </div>

</template>

<script>
export default {
    name: 'HomePage'
}
</script>

<style>
/* Add your styles here */
nav ul {
    display: flex;
    list-style-type: none;
    padding: 0;
}
nav li {
    margin-right: 15px;
}
.logo {
    display: flex;
    justify-content: center;
}
.text-header {
    padding-right: 15px;
    max-width: fit-content;
    background-color: #9ca0ea;
    border-radius: 15px;
}

img {
    border-radius: 15px;
    max-height: 565px;
}
.text-fill {
    font-style: italic;
}

.text {
    font-style: oblique;
}
</style>
