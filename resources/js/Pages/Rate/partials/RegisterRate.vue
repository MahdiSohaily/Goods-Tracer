<template>
  <jet-form-section @submitted="RegisterRate">
    <template #title>
      <h5>نرخ ارز رایج در معاملات</h5>
    </template>

    <template #description>
      <small>
        برای درج نمودن نرخ ارز در سیستم فورم ذیل را به دقت پر نمایید.</small
      >
    </template>

    <template #form>
      <div class="row pb-2">
        <div class="col-md-6">
          <jet-label for="rate" value="نرخ ارز" />
          <jet-input
            id="rate"
            type="number"
            class="mt-1 form-control"
            v-model="form.rate"
            autocomplete="rate"
          />
          <jet-input-error :message="form.errors.rate" class="mt-2" />
        </div>
        <div class="col-md-6">
          <jet-label for="c.status" value="شاخص نرخ" />
          <select
            id="c.status"
            class="form-control"
            v-model="form.status"
          >
            <option value="A">A</option>
            <option value="B">B</option>
            <option value="C">C</option>
            <option value="D">D</option>
            <option value="E">E</option>
            <option value="F">F</option>
            <option value="N" selected>N</option>
          </select>
          <jet-input-error :message="form.errors.status" class="mt-2" />
        </div>
      </div>
      <div class="clearfix"></div>
    </template>

    <template #actions>
      <jet-action-message :on="form.recentlySuccessful">
        ذخیره سازی نرخ مورد نظر موفقانه صورت گرفت.
      </jet-action-message>
      <button
        type="submit"
        class="btn btn-primary pull-right"
        :class="{ 'opacity-25': form.processing }"
        :disabled="form.processing"
      >
        ثبت
      </button>
    </template>
  </jet-form-section>
</template>
<style>
option{
  padding: 1rem !important;
}
</style>

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

  props: [],

  data() {
    return {
      form: this.$inertia.form({
        _method: "post",
        rate: null,
        status: 'N',
      }),
    };
  },

  methods: {
    RegisterRate() {
      this.form.post(route("rate.store"), {
        errorBag: "goods",
        preserveScroll: true,
        onSuccess: () => {
          this.form.reset();
        },
      });
    },
  },
});
</script>
