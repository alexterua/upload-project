<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { router, useForm, usePage } from '@inertiajs/vue3'
import {onMounted, ref} from "vue";
import Pagination from "@/Components/Pagination.vue";

const form = useForm({
    file: null,
    isLoading: false,
})
const fileInput = ref(null)
const { props } = usePage();
function selectFile() {
    fileInput.value.click()
}

function setFile(e) {
    form.file = e.target.files[0]
}

async function saveFile() {
    form.isLoading = true;
    const formData = new FormData
    formData.append('file', form.file)
    await router.post('/upload', formData)
    form.file = null
}

onMounted(() => {
    {
        window.Echo.channel('files')
            .listen('FileUploadCompleted', e => {
                form.isLoading = false;
                location.reload()
            })
    }
})
</script>

<template>
    <AppLayout>
        <div class="flex justify-center mb-12">
            <form>
                <input @change="setFile" type="file" name="file" ref="fileInput" class="hidden">
                <a @click.prevent="selectFile" href="#" class="w-fit p-2 pl-4 pr-4 rounded-full bg-gray-100 block mx-auto hover:bg-gray-500 hover:text-white">Upload CSV</a>
            </form>
            <div v-if="form.file" class="ml-4">
                <a @click.prevent="saveFile" href="#" class="w-fit p-2 pl-4 pr-4 rounded-full bg-gray-100 block mx-auto hover:bg-gray-500 hover:text-white">Save</a>
            </div>
            <div v-if="form.isLoading" class="overlay">
                <div class="spinner"></div>
            </div>
        </div>

        <div class="flex flex-col">
            <div class="overflow-x-auto sm:mx-0.5 lg:mx-0.5">
                <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="overflow-hidden">
                        <table class="min-w-full">
                            <thead class="bg-white border-b">
                            <tr>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                    №
                                </th>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                    File Name
                                </th>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                    Count Of Rows
                                </th>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                    Count Of Incorrect Rows
                                </th>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                    Date Of Upload
                                </th>
                            </tr>
                            </thead>
                            <tbody v-for="(file, index) in props.files.data">

                                <tr class="bg-gray-100 border-b">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{ index + 1 + (props.files.meta.current_page - 1) * props.files.meta.per_page }}
                                    </td>
                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                        {{ file.fileName }}
                                    </td>
                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                        {{ file.countOfRows }}
                                    </td>
                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                        {{ file.countOfIncorrectRows }}
                                    </td>
                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                        {{ file.dateOfUpload }}
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <Pagination></Pagination>
    </AppLayout>
</template>

<style scoped>
    .overlay {
        position: fixed;
        z-index: 1000;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .spinner {
        position: absolute;
        border: 16px solid #f3f3f3;
        border-radius: 50%;
        border-top: 16px solid #3498db;
        width: 120px;
        height: 120px;
        animation: spin 2s linear infinite;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
</style>
