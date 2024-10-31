<template>
    <div>
        <main>
            <h1>Приют для животных</h1>
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
</style>
