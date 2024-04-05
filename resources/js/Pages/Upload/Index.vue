<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import {router, useForm} from '@inertiajs/vue3'
import { ref } from "vue";

const form = useForm({
    file: null,
})
const fileInput = ref(null)

function selectFile() {
    fileInput.value.click()
}

function setFile(e) {
    form.file = e.target.files[0]
}

function saveFile() {
    const formData = new FormData
    formData.append('file', form.file)
    router.post('/upload', formData)
}
</script>

<template>
    <AppLayout>
        <div class="flex justify-center">
            <form>
                <input @change="setFile" type="file" name="file" ref="fileInput" class="hidden">
                <a @click.prevent="selectFile" href="#" class="w-fit p-2 pl-4 pr-4 rounded-full bg-gray-100 block mx-auto hover:bg-gray-500 hover:text-white">Upload CSV</a>
            </form>
            <div v-if="form.file" class="ml-4">
                <a @click.prevent="saveFile" href="#" class="w-fit p-2 pl-4 pr-4 rounded-full bg-gray-100 block mx-auto hover:bg-gray-500 hover:text-white">Save</a>
            </div>
        </div>
    </AppLayout>
</template>

<style scoped>

</style>
