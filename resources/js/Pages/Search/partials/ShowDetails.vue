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
                                        <input id="search" class="mt-1 form-control" ref="focused" @keyup="submit"
                                            v-model="serial" />
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
                                            <input :checked="this.mode" type="checkbox" name="mode" id="mode"
                                                v-model="this.mode" @keyup="submit" />
                                            <label for="mode" class="pointer" @click="submit">جستجوی پیشرفته
                                            </label>
                                        </div>
                                        <table class="table table-hover">
                                            <thead>
                                                <th class="prime-bg-title">سریال نمبر</th>
                                                <th class="prime-bg-title">قیمت</th>
                                                <th class="prime-bg-title">وزن</th>
                                                <th v-for="(item, index) in rates" v-bind:key="index" :class="
                                                    item.status !== 'N' ? item.status : 'prime-bg-title'
                                                ">
                                                    <span> {{ item.rate }}</span>
                                                </th>
                                            </thead>
                                            <tbody>
                                                <tr v-if="goods == null">
                                                    <td class="prime-bg">
                                                        <span><i v-if="result.dollarRate"
                                                                class="material-icons">check_circle</i>
                                                            <i v-else class="material-icons">cancel</i>
                                                            {{ result.serial }}</span>
                                                    </td>
                                                    <td class="prime-bg">{{ result.price }}</td>
                                                    <td class="prime-bg">{{ result.weigth }}</td>
                                                    <td v-for="(item, index) in rates" v-bind:key="index"
                                                        :class="item.status">
                                                        <span> {{ item.rate * result.price }}</span>
                                                    </td>
                                                </tr>
                                                <tr v-if="result.dollarRate && goods == null">
                                                    <td class="dollar-bg">
                                                        <span>{{ result.serial }}-M</span>
                                                    </td>
                                                    <td class="dollar-bg">{{ result.price }}</td>
                                                    <td class="dollar-bg">{{ result.weigth }}</td>
                                                    <td class="dollar-bg" v-for="(item, index) in rates" v-bind:key="index">
                                                        <span>
                                                            {{
                                                                item.rate * result.price * result.dollarRate
                                                            }}</span>
                                                    </td>
                                                </tr>

                                                <tr class="col-12" v-for="(good, index) in goods" v-bind:key="index"
                                                    style="background-color: blue">
                                                    <td class="prime-bg">
                                                        <Link :href="route('search.show', good.id)">
                                                        <i class="material-icons pointer">help</i>
                                                        </Link>
                                                        {{ good.serial }}
                                                    </td>
                                                    <td class="prime-bg">{{ good.price }}</td>
                                                    <td class="prime-bg">{{ good.weigth }}</td>
                                                    <td v-for="(item, index) in rates" v-bind:key="index"
                                                        :class="item.status">
                                                        <span> {{ item.rate * good.price }}</span>
                                                    </td>
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

.prime-bg-title {
    background-color: #76af9c;
}

.pointer {
    padding-inline: 0.5rem;
    cursor: pointer;
    color: rgb(0, 0, 0);
}

.prime-bg {
    background-color: #a5f7db;
}

.dollar-bg {
    background-color: #767776;
}

.A {
    background-color: rgb(240, 53, 53);
}

.B {
    background-color: rgb(243, 193, 54);
}

.C {
    background-color: #b68f3a;
}

.D {
    background-color: #b63a95;
}

.E {
    background-color: #3a86b6;
}

.F {
    background-color: #de6ffa;
}

.G {
    background-color: #fc8ea0;
}

.N {
    background-color: #a5f7db;
}
</style>

<script>
import { defineComponent } from "vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import AppLayout from "@/Layouts/AppLayout.vue";
import axios from "axios";

export default defineComponent({
    props: ["sessions", "rates", "result"],
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
        // The method fiers on key up and sen serial number for check
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

        // Helper function to sync retrived data from database with local data
        setData(result) {
            this.goods = result;
        },
    },
    mounted() {
        this.submit();
    },
});
</script>
