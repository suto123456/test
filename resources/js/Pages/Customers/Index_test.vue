<script setup>


import FlashMessage from '@/Components/FlashMessage.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { Link } from "@inertiajs/vue3";
import { onMounted } from "vue";
import Pagination from "@/Components/Paginatino.vue";

defineProps({
    customers:Object
})

// onMounted(() => { //ページが表示されたタイミングで実行
//    console.log(props.customers);
//    console.log(props.customers.last_page);
// })

</script>

<template>
   <ul v-for="customer in customers.data" :key="customer.id">
    <li>{{  customer.id }}</li>
    <li>{{  customer.name }}</li>
   </ul>
   <Pagination class="mt-6" :links="customers.links"></Pagination>
</template>
