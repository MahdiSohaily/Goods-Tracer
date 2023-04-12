<template>
    <app-layout title="پروفایل" :position="user.position">
        <div class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header card-header-tabs card-header-warning">
                        <div class="nav-tabs-navigation">
                            <div class="nav-tabs-wrapper">
                                <ul class="nav nav-tabs" data-tabs="tabs">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#profile" data-toggle="tab">
                                            <i class="material-icons">sign_language</i>ویرایش حساب کاربری
                                            <div class="ripple-container"></div>
                                        </a>
                                    </li>
                                    <li v-if="user.position === 'ادمین'" class="nav-item">
                                        <a class="nav-link" href="#messages" data-toggle="tab">
                                            <i class="material-icons">person_add_alt_1</i> ایحاد حساب کاربری
                                            <div class="ripple-container"></div>
                                        </a>
                                    </li>
                                    <li v-if="user.position === 'ادمین'" class="nav-item">
                                        <a class="nav-link" href="#settings" data-toggle="tab">
                                            <i class="material-icons">reduce_capacity</i> حسای های کاربری موجود در سیستم
                                            <div class="ripple-container"></div>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div :class="tab === 'edit' ? 'active' : ''" class="tab-pane" id="profile">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div v-if="$page.props.jetstream.canUpdateProfileInformation">
                                            <update-profile-information-form :user="user" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card card-profile">
                                            <div class="card-avatar">
                                                <a href="javascript:;">
                                                    <img class="img" src="../../../../public/img/faces/avatar.jpg" />
                                                </a>
                                            </div>
                                            <div class="card-body">
                                                <h6 class="card-category text-gray">
                                                    {{ user.position }}
                                                    سیستم
                                                </h6>
                                                <h4 class="card-title">
                                                    {{ user.name }} {{ user.last_name }}
                                                </h4>
                                                <ul class="list-group  p-0">
                                                    <li class="list-group-item ">{{ user.email }}</li>
                                                    <li class="list-group-item">{{ user.boss }}</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-8">
                                        <div v-if="$page.props.jetstream.canUpdatePassword">
                                            <update-password-form class="mt-10 sm:mt-0" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div :class="tab === 'create' ? 'active' : ''" v-if="user.position === 'ادمین'" class="tab-pane"
                                id="messages">
                                <div class="row">
                                    <div class="col-md-12">
                                        <CreateAccount />
                                    </div>
                                </div>
                            </div>
                            <div :class="tab === 'list' ? 'active' : ''" v-if="user.position === 'ادمین'" class="tab-pane"
                                id="settings">
                                <div class="card">
                                    <div class="card-header card-header-primary">
                                        <h4 class="card-title">لیست حساب های کاربری ایجاد شده در سیستم</h4>
                                    </div>
                                    <div class="card-body table-responsive">
                                        <table class="table table-hover">
                                            <thead class="text-primary">
                                                <th>شماره</th>
                                                <th>اسم</th>
                                                <th>فامیلی</th>
                                                <th>نوعیت حساب کاربری</th>
                                                <th>عملیات</th>
                                            </thead>
                                            <tbody>
                                                <tr v-for="(account, index) in accounts" v-bind:key="index">
                                                    <td>{{ account.id }}</td>
                                                    <td>{{ account.name }}</td>
                                                    <td>{{ account.last_name }}</td>
                                                    <td>{{ account.position }}</td>
                                                    <td class="td-actions text-right">
                                                        <Link :href="route('edit.user', account)"
                                                            class="btn btn-primary btn-link btn-sm"
                                                            data-original-title="Edit Task">
                                                        <i class="material-icons">edit</i>
                                                        <div class="ripple-container"></div>
                                                        </Link>

                                                        <Link rel="tooltip" title="" class="btn btn-danger btn-link btn-sm"
                                                            @click="deleteAccount(account.id)">
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
import { defineComponent } from 'vue'
import { Head, Link } from '@inertiajs/inertia-vue3'
import AppLayout from '@/Layouts/AppLayout.vue'
import UpdatePasswordForm from '@/Pages/Profile/Partials/UpdatePasswordForm.vue'
import UpdateProfileInformationForm from '@/Pages/Profile/Partials/UpdateProfileInformationForm.vue'
import CreateAccount from '@/Pages/Profile/Partials/CreateAccount'

export default defineComponent({

    props:
        ['sessions', 'accounts', 'user', 'tab']
    ,

    components: {
        AppLayout,
        UpdatePasswordForm,
        UpdateProfileInformationForm,
        CreateAccount,
        Head,
        Link,
    },
    methods: {
        deleteAccount(id) {
            console.log(id);
            route('delete.profile', id), {
                errorBag: 'updateProfileInformation',
                preserveScroll: true,
                onSuccess: () => {
                    this.form.reset();
                },
            };
        },

    }
})
</script>
