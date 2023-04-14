<template>
  <app-layout title="جستجوی اجناس" :position="$page.props.user.position">
    <div class="content">
      <div class="container-fluid">
        <div class="card">
          <div class="card-header card-header-tabs card-header-warning">
            <div class="nav-tabs-navigation">
              <div class="nav-tabs-wrapper">
                <div class="row pb-2">
                  <div class="col-md-12">
                    <label class="text-white">سریال نمبر</label>
                    <input
                      id="search"
                      class="mt-1 form-control"
                      ref="focused"
                      @keyup="submit"
                      v-model="serial"
                    />
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="tab-content">
              <div class="tab-pane active" id="profile">
                <div class="card">
                  <div class="card-body table-responsive">
                    <div class="col-md-12">
                      <input
                        :checked="this.mode"
                        type="checkbox"
                        name="mode"
                        id="mode"
                        v-model="this.mode"
                        @click="submit"
                      />
                      <label for="mode" class="pointer">جستجوی پیشرفته</label>
                    </div>
                    <table class="table table-hover">
                      <thead class="">
                        <th class="text-center prime-bg">سریال نمبر</th>
                        <th class="text-center prime-bg">قیمت</th>
                        <th class="text-center prime-bg">وزن</th>
                        <th
                          v-for="(item, index) in rates"
                          v-bind:key="index"
                          v-bind:style="{ backgroundColor: colors[index] }"
                        >
                          <span> {{ item.rate }}</span>
                        </th>
                      </thead>
                      <tbody>
                        <tr v-for="(good, index) in goods" v-bind:key="index">
                          <td class="prime-bg">
                            <Link :href="route('profile')">
                              <i class="material-icons pointer">help</i>
                            </Link>
                            
                            {{ good.serial }}
                          </td>
                          <td class="prime-bg">{{ good.price }}</td>
                          <td class="prime-bg">{{ good.weigth }}</td>
                          <th
                            v-for="(item, index) in rates"
                            v-bind:key="index"
                            v-bind:style="{ backgroundColor: colors[index] }"
                          >
                            <span> {{ item.rate * good.price }}</span>
                          </th>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </app-layout>
</template>
<style scoped>
::-webkit-input-placeholder {
  /* Edge */
  color: white;
}

:-ms-input-placeholder {
  /* Internet Explorer 10-11 */
  color: white;
}

::placeholder {
  color: white;
}

input {
  color: white;
}

.pointer {
  padding-inline: 0.5rem;
  cursor: pointer;
  color: rgb(0, 0, 0);
}
.prime-bg {
  background-color: #04e989;
}
</style>

<script>
import { defineComponent } from "vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import AppLayout from "@/Layouts/AppLayout.vue";
import axios from "axios";

export default defineComponent({
  props: ["sessions", "rates"],
  data() {
    return {
      goods: null,
      serial: 457544,
      mode: true,
      colors: ["#8bb63a", "aqua", "#b68f3a", "#b63a95", "#3a86b6"],
    };
  },

  components: {
    AppLayout,
    Head,
    Link,
  },
  methods: {
    submit() {
      if (this.timer) {
        clearTimeout(this.timer);
        this.timer = null;
      }
      this.timer = setTimeout(async () => {
        if (this.serial.length > 3) {
          let result = await axios
            .post(route("search.store"), {
              supermode: this.mode,
              serial: this.serial,
            })
            .then((response) => {
              return response.data;
            })
            .catch(function (error) {
              console.log(error);
            });
          this.setData(result);
        }
      }, 800);
    },
    setData(result) {
      this.goods = result;
      console.log(this.goods);
    },
    getFocuse() {
      this.$refs.focused.focus();
    },
  },
  mounted() {
    this.getFocuse();
    this.submit();
  },
});
</script>
