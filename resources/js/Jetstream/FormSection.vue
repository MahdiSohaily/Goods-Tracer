<template>
    <div class="card">
        <jet-section-title>
            <template #title><slot name="title"></slot></template>
            <template #description><slot name="description"></slot></template>
        </jet-section-title>
        <div class="card-body">
            <form @submit.prevent="$emit('submitted')">
                <slot name="form"></slot>
                <div class="mt-3">
                    <slot name="actions"></slot>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    import {defineComponent} from 'vue'
    import JetSectionTitle from './SectionTitle.vue'

    export default defineComponent({
        emits: ['submitted'],

        components: {
            JetSectionTitle,
        },

        computed: {
            hasActions() {
                return !!this.$slots.actions
            }
        }
    })
</script>
