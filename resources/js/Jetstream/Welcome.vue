<template>
    <div class="container-fluid">
        <div class="row" v-if="position !== 'کاربر'">
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-warning card-header-icon">
                        <div class="card-icon">
                            <i class="material-icons">person</i>
                        </div>
                        <p class="card-category">حساب های کاربری </p>
                        <h3 class="card-title">{{ accounts}}
                        </h3>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <i class="material-icons text-info">info</i>
                            <Link :href="route('profile.show')">لیست تمامی حساب های ایجاد شده...</Link>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-success card-header-icon">
                        <div class="card-icon">
                            <i class="material-icons">store</i>
                        </div>
                        <p class="card-category"> اجناس راجستر شده</p>
                        <h3 class="card-title">{{ goodsCount }}</h3>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <i class="material-icons">store</i>
                            <a :href="route('profile.show')">لیست جنس های راجستر شده </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-danger card-header-icon">
                        <div class="card-icon">
                            <i class="material-icons">mail</i>
                        </div>
                        <p class="card-category">رنج های ارز</p>
                        <h3 class="card-title">{{ rates }}</h3>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <i class="material-icons">filter_list</i>
                            <Link :href="route('rate')">لیست تمامی نرخ ارزهای درج شده </Link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {defineComponent} from 'vue'
    import {Head, Link} from '@inertiajs/inertia-vue3';
    import JetApplicationLogo from '@/Jetstream/ApplicationLogo.vue'

    export default defineComponent({

        props: ['accounts', 'goodsCount','rates','position'],
        components: {
            JetApplicationLogo,
            Head,
            Link
        },
    })
</script>
