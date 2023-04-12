<template>
  <Head title="Log in"></Head>

  <section class="min-vh-100">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-6 p-6 bg-light">
          <h2 class="">ورود به سیستم</h2>
          <p class="text-gray small text-justify">
            مجموعه ی یدک شاپ از سال ١٣٩٣ قطعات و لوازم یدکی کیا را به طور مستقیم
            از کشور کره جنوبی وارد ایران میکند،یدک شاپ علاوه بر لوازم اصلی
            خودروهای کیا که با نام کیا جنیون پارت و موبیس شناخته می شود.
          </p>
          <jet-validation-errors class="mb-4" />
          <form method="post" @submit.prevent="submit">
            <label for="username">ایمیل آدرس</label>
            <div class="form-group first">
              <input
                type="text"
                class="form-control small"
                placeholder="ایمیل کاربری خویش را وارد نمایید."
                id="username"
                v-model="form.email"
              />
            </div>
            <label for="password">رمز عبور</label>
            <div class="form-group last mb-3">
              <input
                type="password"
                class="form-control small"
                placeholder="رمز عبور حساب کاربری خویش را وارد نمایید."
                id="password"
                v-model="form.password"
              />
            </div>

            <input
              type="submit"
              value="ورود"
              class="btn btn-block btn-primary"
            />
          </form>
        </div>
        <div class="col-md-6 min-vh-100" id="pic"></div>
      </div>
    </div>
  </section>
</template>
<style scoped>
.p-6 {
  padding: 6rem 2rem;
}

input {
  border-radius: 5px !important;
  height: 50px;
  background-color: white;
  border: none !important;
  outline: none !important;
  padding-right: 20px;
}

.min-vh-100 {
  height: 100vh !important;
  overflow: hidden;
}

#pic {
  background-image: url("../../../../public/img/new.jpg");
  background-size: cover;
  background-position: center;
}

label {
  color: black !important;
}

@media screen and (min-width: 786px) {
  .p-6 {
    padding: 9rem;
  }
}
</style>
<script>
import { defineComponent } from "vue";
import JetValidationErrors from "@/Jetstream/ValidationErrors.vue";

export default defineComponent({
  components: {
    JetValidationErrors,
  },

  props: {
    canResetPassword: Boolean,
    status: String,
  },

  data() {
    return {
      form: this.$inertia.form({
        email: "",
        password: "",
        remember: false,
      }),
    };
  },

  methods: {
    submit() {
      this.form
        .transform((data) => ({
          ...data,
          remember: this.form.remember ? "on" : "",
        }))
        .post(this.route("login"), {
          onFinish: () => this.form.reset("password"),
        });
    },
  },
});
</script>
