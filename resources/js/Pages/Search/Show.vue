<template>
    <app-layout title="جستجوی اجناس" :position="$page.props.user.position">
        <div class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header card-header-tabs card-header-warning">
                        <div class="nav-tabs-navigation">
                            <div class="nav-tabs-wrapper">
                                <div class="submitSearch">
                                    <input id="search" class="mt-1 form-control"
                                        placeholder="بارکد جنس مورد نظر را وارد کنید" @keyup="submit" v-model="serial" />
                                    <input :checked="this.super" type="checkbox" name="super" id="super">
                                    <label class="text-white">جستجوی پیشرفته</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane active" id="profile">
                                <div class="card">
                                    <div class="card-header card-header-primary">
                                        <h4 class="card-title">اجناس موجود با سریال نمبر وارد شده</h4>
                                    </div>
                                    <div class="card-body table-responsive">
                                        <table class="table table-hover">
                                            <thead class="text-primary">
                                                <th>شماره</th>
                                                <th>اسم</th>
                                                <th>سریال نمبر</th>
                                                <th>قیمت</th>
                                                <th>وزن</th>
                                                <th>نرخ ارز</th>
                                                <th>عملیات</th>
                                            </thead>
                                            <tbody>
                                                <tr v-for="(good, index) in goods" v-bind:key="index">
                                                    <td>{{ good.id }}</td>
                                                    <td>{{ good.name }}</td>
                                                    <td>{{ good.serial }}</td>
                                                    <td>{{ good.price }}</td>
                                                    <td>{{ good.weigth }}</td>
                                                    <td>{{ good.dollarRate }}</td>
                                                    <td class="td-actions text-right">
                                                        <Link :href="route('good.edit', good)"
                                                            class="btn btn-primary btn-link btn-sm"
                                                            data-original-title="Edit Task">
                                                        <i class="material-icons">edit</i>
                                                        <div class="ripple-container"></div>
                                                        </Link>
                                                        <Link :href="route('deleteGood', good)" rel="tooltip" title=""
                                                            class="btn btn-danger btn-link btn-sm"
                                                            data-original-title="Remove" data-toggle="modal"
                                                            data-target="#myModal">
                                                        <i class="material-icons">close</i>
                                                        <div class="ripple-container"></div>
                                                        </link>
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
.submitSearch {
    width: 600px;
    margin-inline: auto;
}

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

input{
color: white;
}
</style>

<script>
import { defineComponent } from 'vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import AppLayout from '@/Layouts/AppLayout.vue';

export default defineComponent({

    props: ['sessions', 'goods', 'categories', 'unites'],
    data() {
        return {
            goods: this.goods,
            serial: null,
            super: true
        }
    },

    components: {
        AppLayout,
        Head,
        Link
    },
    methods: {
        submit() {
            if (this.timer) {
                clearTimeout(this.timer);
                this.timer = null;
            }
            this.timer = setTimeout(() => {
            }, 800);

        },
    },
})
</script>
