<template>
  <Head title="خوش آمدید"></Head>

  <div class="min-vh-100">
    <div v-if="canLogin" class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
      <Link
        v-if="$page.props.user"
        :href="route('dashboard')"
        class="btn btn-primary text-white p-3 mx-3"
      >
        داشبورد
      </Link>

      <template v-else>
        <Link
          :href="route('login')"
          class="btn btn-primary text-white p-3 mx-3"
        >
          ورود به سیستم
        </Link>
      </template>
    </div>

    <div class="text-white center">
      <H1 class="text-center">فروشگاه یدک شاپ</H1>
      <div class="limit">
        <img
          class="site-logo"
          src="../../../public/img/YadakShop.png"
          alt="site logo"
        />
        <p class="text-center site-intro">
          مجموعه ی یدک شاپ از سال ١٣٩٣ قطعات و لوازم یدکی کیا را به طور مستقیم
          از کشور کره جنوبی وارد ایران میکند،یدک شاپ علاوه بر لوازم اصلی
          خودروهای کیا که با نام کیا جنیون پارت و موبیس شناخته می شوند برای بالا
          بردن قدرت خرید مشتریان خود بعضی از قطعات کیا را با سایر برند های معتبر
          کره ای وارد کرده و حق انتخاب وسیع تری برای شما مصرف کنندگان عزیز ایجاد
          میکند. لوازم یدکی کیا وارد شده توسط یدک شاپ با نازل ترین قیمت در
          اختیار مصرف کننده گان قرار میگیرد زیرا رضایت مشتریان برای مجموعه ما از
          همه چیز مهم تر است.
        </p>
      </div>
    </div>
  </div>
</template>

<style scoped>
.min-vh-100 {
  height: 100vh !important;
  background: url("../../../public/img/bg2.jpg") bottom center;
  background-size: cover;
  overflow: hidden;
}
.limit {
  max-width: 700px;
  background-color: rgba(00, 00, 00, 0.5);
  padding: 2rem;
  margin-inline: auto;
  margin-top: 60px;
  border-radius: 0.5rem;
}

.site-logo {
  display: block;
  margin-inline: auto;
}
.site-intro {
  margin-top: 1rem;
  padding-inline: 3rem;
}
</style>

<script>
import { defineComponent } from "vue";
import { Head, Link } from "@inertiajs/inertia-vue3";

export default defineComponent({
  components: {
    Head,
    Link,
  },

  props: {
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
  },
});
</script>
