<script setup>
import Navigation from "@/Components/Navigation.vue";
</script>

<template>
    <div class="app-layout w-2/5 mx-auto mt-8">
        <h1 class="text-center">Upload Project</h1>
        <Navigation></Navigation>
        <slot/>
    </div>
</template>

<style scoped>
    @media screen and (max-width: 576px) {
        .app-layout {
            width: 90%;
        }
    }
</style>
