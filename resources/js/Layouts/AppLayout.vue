<template>
  <div class="wrapper">
    <Head :title="title" />
    <div
      class="custom-sidebar"
      data-color="purple"
      data-background-color="white"
      data-image="img/sidebar-4.jpg"
    >
      <div class="logo">
        <a href="" class="simple-text logo-normal"> مینوی سیستم </a>
      </div>
      <div class="sidebar-wrapper">
        <ul class="nav">
          <!-- <li :class="title === 'داشبورد' ? 'active' : ''" class="nav-item">
            <Link :as="a" class="nav-link" :href="route('dashboard')">
              <i class="material-icons">dashboard</i>
              <p>داشبورد</p>
            </Link>
          </li> -->
          <li
            :class="title === 'جستجوی اجناس' ? 'active' : ''"
            class="nav-item"
          >
            <Link class="nav-link" :href="route('search')">
              <i class="material-icons">youtube_searched_for</i>
              <p>جستجوی اجناس</p>
            </Link>
          </li>
          <li
            v-if="position !== 'کاربر'"
            :class="title === 'اجناس' ? 'active' : ''"
            class="nav-item"
          >
            <Link class="nav-link" :href="route('good')">
              <i class="material-icons">class</i>
              <p>راجستر اجناس</p>
            </Link>
          </li>
          <li
            :class="title === 'نرخ تبادل ارز' ? 'active' : ''"
            class="nav-item"
          >
            <Link class="nav-link" :href="route('rate')">
              <i class="material-icons">local_atm</i>
              <p>نرخ تبادل ارز</p>
            </Link>
          </li>
          <li :class="title === 'پروفایل' ? 'active' : ''" class="nav-item">
            <Link class="nav-link" :href="route('profile')">
              <i class="material-icons">person</i>
              <p>پروفایل کاربر</p>
            </Link>
          </li>
        </ul>
      </div>
    </div>
    <!-- Page Content -->
    <div class="main-pane">
      <!-- Navbar -->
      <nav
        class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top"
      >
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <i class="material-icons">dehaze</i>
          </div>
          
          <div class="collapse navbar-collapse justify-content-end">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" href="#pablo">
                  <i class="material-icons">dashboard</i>
                  <p class="d-lg-none d-md-block">آمارها</p>
                </a>
              </li>
              <li class="nav-item dropdown">
                <a
                  class="nav-link"
                  href="http://example.com"
                  id="navbarDropdownMenuLink"
                  data-toggle="dropdown"
                  aria-haspopup="true"
                  aria-expanded="false"
                >
                  <i class="material-icons">notifications</i>
                  <span class="notification">۵</span>
                  <p class="d-lg-none d-md-block">اعلان‌ها</p>
                </a>
                <div
                  class="dropdown-menu dropdown-menu-right"
                  aria-labelledby="navbarDropdownMenuLink"
                >
                  <a class="dropdown-item" href="#"
                    >محمدرضا به ایمیل شما پاسخ داد</a
                  >
                  <a class="dropdown-item" href="#">شما ۵ وظیفه جدید دارید</a>
                  <a class="dropdown-item" href="#"
                    >از حالا شما با علیرضا دوست هستید</a
                  >
                  <a class="dropdown-item" href="#">اعلان دیگر</a>
                  <a class="dropdown-item" href="#">اعلان دیگر</a>
                </div>
              </li>
              <li class="nav-item dropdown">
                <a
                  class="nav-link"
                  href="http://example.com"
                  id="navbarDropdownProfileLink"
                  data-toggle="dropdown"
                  aria-haspopup="true"
                  aria-expanded="false"
                >
                  <i class="material-icons">person</i>
                  <p class="d-lg-none d-md-block">اعلان‌ها</p>
                </a>
                <div
                  class="dropdown-menu dropdown-menu-right"
                  aria-labelledby="navbarDropdownProfileLink"
                >
                  <Link :href="route('profile')" class="dropdown-item"
                    >پروفایل کاربری/تنظیمات
                  </Link>
                  <a @click="logout" class="dropdown-item" href="#"
                    >خروج از سیستم</a
                  >
                </div>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <slot></slot>
    </div>
  </div>
</template>
<style scoped>
.wrapper {
  padding-top: 60px;
}
.custom-sidebar {
  position: fixed !important;
  width: 250px !important;
  background-color: white !important;
  top: 0;
  bottom: 0;
  left: 100%;
  z-index: 10000;
}
</style>

<script>
import { defineComponent } from "vue";
import { Head, Link } from "@inertiajs/inertia-vue3";

export default defineComponent({
  props: {
    title: String,
    position: String,
  },

  components: {
    Head,
    Link,
  },

  data() {
    return {
      showingNavigationDropdown: false,
    };
  },

  methods: {
    logout() {
      this.$inertia.post(route("logout"));
    },
  },
});
</script>
