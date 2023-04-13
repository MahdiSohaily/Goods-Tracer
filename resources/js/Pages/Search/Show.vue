<template>
    <app-layout title="جستجوی اجناس" :position="$page.props.user.position">
        <div class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header card-header-tabs card-header-warning">
                        <div class="nav-tabs-navigation">
                            <div class="nav-tabs-wrapper">
                                <div class="submitSearch">
                                    <input id="search" class="mt-1 form-control" ref="focused"
                                        placeholder="بارکد جنس مورد نظر را وارد کنید" @keyup="submit" v-model="serial" />
                                    <input :checked="this.mode" type="checkbox" name="mode" id="mode" v-model="this.mode">
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
                                                <th>سریال نمبر</th>
                                                <th>قیمت</th>
                                                <th v-for="(item, index) in rates" v-bind:key="index"
                                                v-bind:style="{ backgroundColor: colors[index] }">
                                                    <span> {{ item.rate}}</span>
                                                </th>
                                                <th>وزن</th>
                                                <th>نرخ ارز</th>
                                            </thead>
                                            <tbody>
                                                <tr v-for="(good, index) in goods" v-bind:key="index">
                                                    <td>{{ good.serial }}</td>
                                                    <td>{{ good.price }}</td>
                                                    <th v-for="(item, index) in rates" v-bind:key="index"
                                                        v-bind:style="{ backgroundColor: colors[index] }">
                                                        <span> {{ item.rate * good.price }}</span>
                                                    </th>
                                                    <td>{{ good.weigth }}</td>
                                                    <td>{{ good.dollarRate }}</td>
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
    max-width: 600px;
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

input {
    color: white;
}
</style>

<script>
import { defineComponent } from 'vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import axios from 'axios';

export default defineComponent({

    props: ['sessions', 'rates'],
    data() {
        return {
            goods: null,
            serial: 857583,
            mode: true,
            colors: ['aqua','#8bb63a','#b68f3a','#b63a95','#3a86b6']
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
            this.timer = setTimeout(async () => {
                if (this.serial.length > 3) {
                    let result = await axios.post((route("search.store")), {
                        'supermode': this.mode,
                        'serial': this.serial
                    })
                        .then(response => {
                            return (response.data);
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
        }
        ,
        getFocuse() {
            this.$refs.focused.focus();
        },
    },
    mounted() {
        this.getFocuse();
        this.submit();
    }
})
</script>
