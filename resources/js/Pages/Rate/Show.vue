<template>
    <app-layout title="نرخ تبادل ارز" :position="$page.props.user.position">
        <div class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header card-header-tabs card-header-warning">
                        <div class="nav-tabs-navigation">
                            <div class="nav-tabs-wrapper">
                                <ul class="nav nav-tabs" data-tabs="tabs">
                                    <li class="nav-item">
                                        <a :class="tab === 'create' ? 'active' : ''" class="nav-link" href="#profile" data-toggle="tab">
                                            <i class="material-icons">fact_check</i>درج نرخ ارز رایج در معاملات
                                            <div class="ripple-container"></div>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a :class="tab === 'list' ? 'active' : ''" class="nav-link" href="#goodsList" data-toggle="tab">
                                            <i class="material-icons">list</i> نرخ های ثبت شده
                                            <div class="ripple-container"></div>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div :class="tab === 'create' ? 'active' : ''" class="tab-pane" id="profile">
                               
                                    <RegisterRate />

                            </div>
                            <div :class="tab === 'list' ? 'active' : ''" class="tab-pane" id="goodsList">
                                <div class="card">
                                    <div class="card-header card-header-primary">
                                        <h5 class="card-title"> نرخ تبادل ارز</h5>
                                        <small class="card-decription">نرخ ارزهای که اخیرا ثبت سیتم گردیده اند</small>
                                    </div>
                                    <div class="card-body table-responsive">
                                        <table class="table table-hover">
                                            <thead class="text-primary">
                                                <th>شماره</th>
                                                <th>نرخ ارز</th>
                                                <th>شاخص نرخ</th>
                                                <th>عملیات</th>
                                            </thead>
                                            <tbody>
                                                <tr v-for="(rate, index) in rates" v-bind:key="index">
                                                    <td>{{ index+1 }}</td>
                                                    <td>{{ rate.rate }}</td>
                                                    <td>{{ rate.status }}</td>
                                                    <td class="td-actions text-right">
                                                        <Link :href="route('rate.edit', rate.id)"
                                                            class="btn btn-primary btn-link btn-sm"
                                                            data-original-title="Edit Task">
                                                        <i class="material-icons">edit</i>
                                                        <div class="ripple-container"></div>
                                                        </Link>
                                                        <Link :href="route('deleteRate', rate.id)" rel="tooltip" title=""
                                                            class="btn btn-danger btn-link btn-sm">
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

<script>
import { defineComponent } from 'vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import RegisterRate from './partials/RegisterRate.vue';

export default defineComponent({

    props: ['sessions', 'rates','tab'],
    data() {
        return {
            rates: this.rates
        }
    },

    components: {
        AppLayout,
        Head,
        Link,
        RegisterRate
    },
})
</script>
