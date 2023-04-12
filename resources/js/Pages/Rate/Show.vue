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
                                        <a class="nav-link active" href="#profile" data-toggle="tab">
                                            <i class="material-icons">fact_check</i>درج نرخ ارز رایج در معاملات
                                            <div class="ripple-container"></div>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#goodsList" data-toggle="tab">
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
                                <div class="row">
                                    <RegisterRate :categories="categories" :unites="unites" />
                                </div>
                            </div>
                            <div :class="tab === 'list' ? 'active' : ''" class="tab-pane" id="goodsList">
                                <div class="card">
                                    <div class="card-header card-header-primary">
                                        <h4 class="card-title">درخواست های اخیر</h4>
                                        <p class="card-category">درخواست های که اخیرا ثبت سیتم گردیده اند</p>
                                    </div>
                                    <div class="card-body table-responsive">
                                        <table class="table table-hover">
                                            <thead class="text-primary">
                                                <th>شماره</th>
                                                <th>نرخ ارز</th>
                                                <th>عملیات</th>
                                            </thead>
                                            <tbody>
                                                <tr v-for="(rate, index) in rates" v-bind:key="index">
                                                    <td>{{ rate.id }}</td>
                                                    <td>{{ rate.rate }}</td>
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
