<template>
    <div @click="pageClick" class="mod-bg-1 header-function-fixed" id="app">
        <div class="text-center p-5" v-if="!loaded">
            <div class="spinner-border text-warning" role="status" style="width: 3rem; height: 3rem;">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- BEGIN Page Wrapper -->
        <div class="page-wrapper" v-else>
            <div class="page-inner">
                <!-- BEGIN Left Aside -->
                <aside class="page-sidebar">
                    <div class="page-logo">
                        <a class="page-logo-link press-scale-down d-flex align-items-center position-relative" data-target="#modal-shortcut" data-toggle="modal" href="#">
                            <i class="fal fa-users"></i>
                            <span class="page-logo-text mr-1">Sidorovs</span>
                            <i class="fal fa-angle-down d-inline-block ml-1 fs-lg color-primary-300"></i>
                        </a>
                    </div>
                    <!-- BEGIN PRIMARY NAVIGATION -->
                    <nav class="primary-nav">
                        <ul class="nav-menu">
                            <li class="nav-title">Доски</li>
                            <router-link to="/" v-slot="{ href, navigate, isExactActive }">
                                <li :class="{'active':isExactActive}">
                                    <a :href="href" @click="navigate">Основная доска</a>
                                </li>
                            </router-link>
                            <router-link :key="agile.id" :to="{ name: 'agile', params: {agileId: agile.id}}" v-for="agile in $store.state.agiles" v-slot="{ href, navigate, isExactActive }">
                                <li :class="{'active':isExactActive}">
                                    <a :href="href" @click="navigate">{{agile.title}}</a>
                                </li>
                            </router-link>
                        </ul>
                    </nav>
                    <!-- END PRIMARY NAVIGATION -->
                </aside>
                <!-- END Left Aside -->
                <div class="page-content-wrapper">
                    <!-- BEGIN Page Header -->
                    <header class="page-header" role="banner">
                        <!-- DOC: nav menu layout change shortcut -->
                        <!--                        <div class="hidden-md-down dropdown-icon-menu position-relative">-->
                        <!--                            <a class="header-btn btn js-waves-off" data-action="toggle" data-class="nav-function-hidden" href="#" title="Hide Navigation">-->
                        <!--                                <i class="ni ni-menu"></i>-->
                        <!--                            </a>-->
                        <!--                            <ul>-->
                        <!--                                <li>-->
                        <!--                                    <a class="btn js-waves-off" data-action="toggle" data-class="nav-function-minify" href="#" title="Minify Navigation">-->
                        <!--                                        <i class="ni ni-minify-nav"></i>-->
                        <!--                                    </a>-->
                        <!--                                </li>-->
                        <!--                                <li>-->
                        <!--                                    <a class="btn js-waves-off" data-action="toggle" data-class="nav-function-fixed" href="#" title="Lock Navigation">-->
                        <!--                                        <i class="ni ni-lock-nav"></i>-->
                        <!--                                    </a>-->
                        <!--                                </li>-->
                        <!--                            </ul>-->
                        <!--                        </div>-->
                        <!-- DOC: mobile button appears during mobile width -->
                        <div class="hidden-lg-up">
                            <a @click.prevent="showMenu()" class="header-btn btn press-scale-down" data-class="mobile-nav-on" href="#">
                                <i class="ni ni-menu"></i>
                            </a>
                        </div>
                        <div class="ml-auto d-flex">
                            <!-- app settings -->
                            <!--                            <div class="hidden-md-down">-->
                            <!--                                <a class="header-icon" href="#">-->
                            <!--                                    <i class="fal fa-cog"></i>-->
                            <!--                                </a>-->
                            <!--                            </div>-->
                            <!-- app notification -->
                            <!--                            <div>-->
                            <!--                                <a class="header-icon" data-toggle="dropdown" href="#" title="You got 11 notifications">-->
                            <!--                                    <i class="fal fa-bell"></i>-->
                            <!--                                    <span class="badge badge-icon">11</span>-->
                            <!--                                </a>-->
                            <!--                            </div>-->
                            <!-- app user menu -->
                            <div>
                                <a :title="$store.state.user.name" class="header-icon d-flex align-items-center justify-content-center ml-2" href="#">
                                    <avatar :id="$store.state.user.id"/>
                                </a>
                            </div>
                        </div>
                    </header>
                    <!-- END Page Header -->
                    <!-- the #js-page-content id is needed for some plugins to initialize -->
                    <main class="page-content">
                        <router-view/>
                    </main>
                    <!-- this overlay is activated only when mobile menu is triggered -->
                </div>
            </div>
        </div>
        <!-- END Page Wrapper -->
    </div>
</template>

<script>
    import Avatar from './components/system/Avatar';

    const body = document.body;
    const className = 'mobile-nav-on';
    export default {
        name: 'app',
        components: {
            Avatar
        },
        data: function() {
            return {
                loaded: false,
                menuIsOpened: false,
            }
        },
        created() {
            this.fetchSystem();
        },
        methods: {
            pageClick() {
                if (this.menuIsOpened) {
                    body.classList.remove(className);
                    this.menuIsOpened = false;
                }
            },
            showMenu() {
                body.classList.add(className);
                setTimeout(() => {
                    this.menuIsOpened = true;
                }, 300)
            },
            fetchSystem() {
                axios.get('system').then(response => {
                    this.$store.commit('SET_AGILES', response.data.agiles);
                    this.$store.commit('SET_STATUSES', response.data.statuses);
                    this.$store.commit('SET_PRIORITIES', response.data.priorities);
                    this.$store.commit('SET_USERS', response.data.users);
                    this.$store.commit('SET_USER', response.data.user);
                    this.loaded = true;
                });
            }
        }
    }
</script>
