<template>
  <jet-form-section @submitted="UpdateRate">
    <template #title>
      <h5>نرخ ارز رایج در معاملات</h5>
    </template>

    <template #description>
      <small> برای ویرایش نرخ ارز در سیستم فورم ذیل را به دقت پر نمایید.</small>
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
          <select id="c.status" class="form-control" v-model="form.status">
            <option :selected="form.status === 'A' ? true : false" value="A">
              <span class="inline"> A </span>
            </option>
            <option :selected="form.status === 'B' ? true : false" value="B">
              <span class="inline"> B </span>
            </option>
            <option :selected="form.status === 'C' ? true : false" value="C">
              <span class="inline"> C </span>
            </option>
            <option :selected="form.status === 'D' ? true : false" value="E">
              <span class="inline"> D </span>
            </option>
            <option :selected="form.status === 'E' ? true : false" value="F">
              <span class="inline"> E </span>
            </option>
            <option :selected="form.status === 'F' ? true : false" value="G">
              <span class="inline"> F </span>
            </option>
            <option :selected="form.status === 'N' ? true : false" value="N">
              <span class="inline"> N </span>
            </option>
          </select>
          <jet-input-error :message="form.errors.status" class="mt-2" />
        </div>
      </div>
      <div class="clearfix"></div>
    </template>

    <template #actions>
      <jet-action-message :on="form.recentlySuccessful">
        ویرایش نرخ مورد نظر موفقانه صورت گرفت.
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
.inline {
  padding-inline: 1rem;
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

  props: ["rate"],

  data() {
    return {
      form: this.$inertia.form({
        _method: "post",
        id: this.rate.id,
        rate: this.rate.rate,
        status: this.rate.status,
      }),
    };
  },

  methods: {
    UpdateRate() {
      this.form.post(route("rate.update"), {
        errorBag: "goods",
        preserveScroll: true,
        onSuccess: () => {},
      });
    },
  },
});
</script>
