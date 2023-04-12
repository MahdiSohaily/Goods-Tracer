<template>
  <jet-form-section @submitted="RegisterGood">
    <template #title>
      <h5>مشخصات جنس مورد نظر</h5>
    </template>

    <template #description>
      <small> برای درج نمودن جنس در سیستم فورم ذیل را به دقت پر نمایید.</small>
    </template>

    <template #form>
      <div class="row pb-2">
        <div class="col-md-6">
          <jet-label for="name" value="نام جنس" />
          <jet-input
            id="name"
            type="text"
            class="mt-1 form-control"
            v-model="form.name"
            autocomplete="name"
          />
          <jet-input-error :message="form.errors.name" class="mt-2" />
        </div>
        <div class="col-md-6">
          <jet-label for="serial" value="سریال نمبر" />
          <jet-input
            id="serial"
            type="text"
            class="mt-1 form-control"
            v-model="form.serial"
            autocomplete="serial"
          />
          <jet-input-error :message="form.errors.serial" class="mt-2" />
        </div>
      </div>
      <div class="row pb-2">
        <div class="col-md-4">
          <jet-label for="price" value="قیمت" />
          <jet-input
            id="price"
            type="text"
            class="mt-1 form-control"
            v-model="form.price"
            autocomplete="price"
          />
          <jet-input-error :message="form.errors.price" class="mt-2" />
        </div>
        <div class="col-md-4">
          <jet-label for="weight" value="وزن" />
          <jet-input
            id="weight"
            type="text"
            class="mt-1 form-control"
            v-model="form.weight"
            autocomplete="weight"
          />
          <jet-input-error :message="form.errors.weight" class="mt-2" />
        </div>
        <div class="col-md-4">
          <jet-label for="dollar" value="نرخ تبادله ارز" />
          <jet-input
            id="dollar"
            type="text"
            class="mt-1 form-control"
            v-model="form.dollar"
            autocomplete="dollar"
          />
          <jet-input-error :message="form.errors.dollar" class="mt-2" />
        </div>
      </div>
      <div class="clearfix"></div>
    </template>

    <template #actions>
      <jet-action-message :on="form.recentlySuccessful">
        ذخیره سازی جنس مورد نظر موفقانه صورت گرفت.
      </jet-action-message>
      <button
        type="submit"
        class="btn btn-primary pull-right"
        :class="{ 'opacity-25': form.processing }"
        :disabled="form.processing"
      >
        ایجاد
      </button>
    </template>
  </jet-form-section>
</template>

<script>
import { defineComponent } from "vue";
import JetFormSection from "@/Jetstream/FormSection.vue";
import JetInput from "@/Jetstream/Input.vue";
import JetInputError from "@/Jetstream/InputError.vue";
import JetLabel from "@/Jetstream/Label.vue";
import JetActionMessage from "@/Jetstream/ActionMessage.vue";

export default defineComponent({
  components: {
    JetActionMessage,
    JetFormSection,
    JetInput,
    JetInputError,
    JetLabel,
  },

  props: ["categories", "unites"],

  data() {
    return {
      form: this.$inertia.form({
        _method: "post",
        name: null,
        serial: null,
        price: null,
        weight: null,
        dollar: null,
      }),
    };
  },

  methods: {
    RegisterGood() {
      this.form.post(route("good.create"), {
        errorBag: "goods",
        preserveScroll: true,
        onSuccess: () => {
          this.form.reset()
        },
      });
    },
  },
});
</script>
