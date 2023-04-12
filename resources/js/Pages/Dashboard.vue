<template>
    <app-layout title="داشبورد" position="position">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                داشبورد
            </h2>
        </template>

        <div class="content">
            <welcome :goodsCount="goodsCount" :accounts="accounts" :rates="rates" :position="position"/>
        </div>
    </app-layout>
</template>

<script>
    import {defineComponent} from 'vue'
    import AppLayout from '@/Layouts/AppLayout.vue'
    import Welcome from '@/Jetstream/Welcome.vue'

    export default defineComponent({
        props: ['accounts', 'goodsCount','rates','position'],
        components: {
            AppLayout,
            Welcome,
        },
    })
</script>
