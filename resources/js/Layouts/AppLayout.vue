<template>
  <div class="wrapper">
    <Head :title="title" />
    <div
      id="s-sidebar"
      class="sidebar-content"
      data-color="purple"
      data-background-color="white"
      data-image="img/sidebar-4.jpg"
    >
        <div class="logo">
          <a href="" class="simple-text logo-normal"> مینوی سیستم </a>
          <i class="material-icons pointer" id="close">close</i>
        </div>
        <div class="sidebar-wrapper">
          <ul class="nav">
            <li
              :class="title === 'جستجوی اجناس' ? 'active' : ''"
              class="nav-item"
            >
              <Link class="nav-link" :href="route('search')">
                <i class="material-icons">search</i>
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
            <i class="material-icons pointer" id="open">menu</i>
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
.pointer {
  cursor: pointer;
}
.wrapper {
  padding-top: 60px;
}

.custom-sidebar {
  position: fixed !important;
  top: 0;
  bottom: 0;
  width: 100vw;
  right: -100%;
  background-color: rgba(0, 0, 0, 0.815) !important;
  overflow: hidden;
  z-index: 10000;
  transition: all 0.5s ease-in-out;
}

.sidebar-content {
  position: fixed !important;
  width: 250px;
  top: 0;
  right: -100%;
  bottom: 0;
  background-color: white !important;
  overflow: hidden;
  z-index: 10000;
  transition: all 0.5s ease-in-out;
}
.mk-active{
  right: 0% !important;
}
.logo {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 1rem;
  border-bottom: 1px solid gray;
}

.nav {
  display: flex;
  flex-direction: column;
}

.nav li {
  padding-block: 0.7rem;
}

.nav li p,
.nav li i,
.simple-text {
  color: #818181;
}
.nav li.active p,
.nav li.active i {
  color: white;
}
.nav li p {
  display: inline;
  padding-inline: 0.5rem;
}

.nav li.active {
  background-color: blueviolet;
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
  mounted() {
    //menu container and sidebar instances
    const sidebar = document.getElementById("s-sidebar");

    // buttons to handle menu toggle
    const close = document.getElementById("close");
    const open = document.getElementById("open");

    open.addEventListener("click", function () {
      sidebar.classList.add('mk-active');
    });
    close.addEventListener("click", function () {
      sidebar.classList.remove('mk-active');
    });
    window.addEventListener('resize',()=>{
      sidebar.classList.remove('mk-active');
    })
  },
});
</script>
