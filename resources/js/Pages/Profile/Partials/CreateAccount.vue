<template>
    <jet-form-section @submitted="createAccount">
        <template #title>
            ایجاد حساب کاربری
        </template>

        <template #description>
            برای ایجاد حساب کاربری معلومات ذیل را به صورت دقیق خانه پری نمایید.
        </template>

        <template #form>
            <div class="row pb-2">
                <div class="col-md-4 ">
                    <jet-label for="c.name" value="اسم"/>
                    <jet-input id="c.name" type="text" class="mt-1 form-control" v-model="form.name" required/>
                    <jet-input-error :message="form.errors.name" class="mt-2"/>
                </div>
                <div class="col-md-4">
                    <jet-label for="c.last_name" value="فامیلی"/>
                    <jet-input id="c.last_name" type="text" class="mt-1 form-control" v-model="form.last_name"
                               required/>
                    <jet-input-error :message="form.errors.last_name" class="mt-2"/>
                </div>
                <div class="col-md-4">
                    <jet-label for="c.position" value="نوعیت حساب کاربری"/>
                    <select id="c.position" class="form-control" v-model="form.position" required>
                        <option value="ادمین">ادمین</option>
                        <option value="کاربر">کاربر</option>
                    </select>
                    <jet-input-error :message="form.errors.position" class="mt-2"/>
                </div>
            </div>
            <div class="row pb-2">
                <div class="col-md-4">
                    <jet-label for="c.email" value="ایمیل آدرس"/>
                    <jet-input id="c.email" type="email" class="form-control" v-model="form.email" required/>
                    <jet-input-error :message="form.errors.email" class="mt-2"/>
                </div>
                <div class="col-md-4">
                    <jet-label for="c.password" value="پسورد"/>
                    <jet-input id="c.password" type="password" class="form-control" v-model="form.password" required/>
                    <jet-input-error :message="form.errors.password" class="mt-2"/>
                </div>
            </div>
            <div class="clearfix"></div>
        </template>

        <template #actions>
            <jet-action-message class="pb-3" :on="form.recentlySuccessful">
                حساب کاربری جدید موفقانه ایجاد گردید.
            </jet-action-message>
            <button type="submit" class="btn btn-primary pull-right"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing">
                ایجاد
            </button>
        </template>
    </jet-form-section>
</template>

<script>
    import {defineComponent} from 'vue'
    import JetFormSection from '@/Jetstream/FormSection.vue'
    import JetInput from '@/Jetstream/Input.vue'
    import JetInputError from '@/Jetstream/InputError.vue'
    import JetLabel from '@/Jetstream/Label.vue'
    import JetActionMessage from '@/Jetstream/ActionMessage.vue'

    export default defineComponent({
        components: {
            JetActionMessage,
            JetFormSection,
            JetInput,
            JetInputError,
            JetLabel,
        },

        props: [''],

        data() {
            return {
                form: this.$inertia.form({
                    _method: 'post',
                    form:'create',
                    name: '',
                    last_name: '',
                    position: '',
                    boss: '',
                    section: '',
                    email: '',
                    about: '',
                    password: '',
                }),
            }
        },

        methods: {
            createAccount() {
                this.form.post(route('profile.create'), {
                    errorBag: 'updateProfileInformation',
                    preserveScroll: true,
                    onSuccess: () => {
                        this.form.reset();
                    },
                });
            },

        }
    })
</script>
