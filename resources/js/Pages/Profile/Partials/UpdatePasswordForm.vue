<template>
    <jet-form-section @submitted="updatePassword">
        <template #title>
            ویرایش رمز عبور حساب کاربری
        </template>

        <template #description>
            لطفا اطمینان حاصل نمایید تا پسورد شما طولانی بوده و متشکل از حروف و سمبول ها باشد.
        </template>

        <template #form>
            <div class="row pb-2">
                <div class="col-md-4">
                    <jet-label for="current_password" value="پسورد فعلی"/>
                    <jet-input id="current_password" type="password" class="form-control"
                               autocomplete="current-password" v-model="form.current_password"/>
                    <jet-input-error :message="form.errors.current_password" class="mt-2"/>
                </div>
                <div class="col-md-4">
                    <jet-label for="password" value="رمز جدید"/>
                    <jet-input id="password" type="password" class="form-control"
                               autocomplete="current-password" v-model="form.password"/>
                    <jet-input-error :message="form.errors.password" class="mt-2"/>
                </div>

                <div class="col-md-4">
                    <jet-label for="password_confirmation" value="تکرار رمز جدید"/>
                    <jet-input id="password_confirmation" type="password" class="form-control"
                               autocomplete="current-password" v-model="form.password_confirmation"/>
                    <jet-input-error :message="form.errors.password_confirmation" class="mt-2"/>
                </div>
            </div>
        </template>

        <template #actions>
            <jet-action-message :on="form.recentlySuccessful" class="mr-3">
                ویراش موفقانه صورت گرفت.
            </jet-action-message>
            <button type="submit" class="btn btn-primary pull-right"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing">
                ویرایش رمز عبور
            </button>
        </template>
    </jet-form-section>
</template>

<script>
    import {defineComponent} from 'vue'
    import JetActionMessage from '@/Jetstream/ActionMessage.vue'
    import JetButton from '@/Jetstream/Button.vue'
    import JetFormSection from '@/Jetstream/FormSection.vue'
    import JetInput from '@/Jetstream/Input.vue'
    import JetInputError from '@/Jetstream/InputError.vue'
    import JetLabel from '@/Jetstream/Label.vue'

    export default defineComponent({
        components: {
            JetActionMessage,
            JetFormSection,
            JetInput,
            JetInputError,
            JetLabel,
        },

        data() {
            return {
                form: this.$inertia.form({
                    current_password: '',
                    password: '',
                    password_confirmation: '',
                }),
            }
        },

        methods: {
            updatePassword() {
                this.form.put(route('password.update'), {
                    errorBag: 'updatePassword',
                    preserveScroll: true,
                    onSuccess: () => this.form.reset(),
                    onError: () => {
                        if (this.form.errors.password) {
                            this.form.reset('password', 'password_confirmation')
                            this.$refs.password.focus()
                        }

                        if (this.form.errors.current_password) {
                            this.form.reset('current_password')
                            this.$refs.current_password.focus()
                        }
                    }
                })
            },
        },
    })
</script>
