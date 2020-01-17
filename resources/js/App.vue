<template>
    <div class="mod-bg-1 header-function-fixed" id="app">
        <!-- BEGIN Page Wrapper -->
        <div class="page-wrapper">
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
                            <li>
                                <a href="#" title="Application Intel">
                                    <i class="fal fa-clipboard-list"></i>
                                    <span class="nav-link-text">Доска</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" title="Application Intel">
                                    <i class="fal fa-car"></i>
                                    <span class="nav-link-text">Где машина?</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                    <!-- END PRIMARY NAVIGATION -->
                </aside>
                <!-- END Left Aside -->
                <div class="page-content-wrapper">
                    <!-- BEGIN Page Header -->
                    <header class="page-header" role="banner">
                        <!-- DOC: nav menu layout change shortcut -->
                        <div class="hidden-md-down dropdown-icon-menu position-relative">
                            <a class="header-btn btn js-waves-off" data-action="toggle" data-class="nav-function-hidden" href="#" title="Hide Navigation">
                                <i class="ni ni-menu"></i>
                            </a>
                            <ul>
                                <li>
                                    <a class="btn js-waves-off" data-action="toggle" data-class="nav-function-minify" href="#" title="Minify Navigation">
                                        <i class="ni ni-minify-nav"></i>
                                    </a>
                                </li>
                                <li>
                                    <a class="btn js-waves-off" data-action="toggle" data-class="nav-function-fixed" href="#" title="Lock Navigation">
                                        <i class="ni ni-lock-nav"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <!-- DOC: mobile button appears during mobile width -->
                        <div class="hidden-lg-up">
                            <a class="header-btn btn press-scale-down" data-action="toggle" data-class="mobile-nav-on" href="#">
                                <i class="ni ni-menu"></i>
                            </a>
                        </div>
                        <div class="ml-auto d-flex">
                            <!-- app settings -->
                            <div class="hidden-md-down">
                                <a class="header-icon" href="#">
                                    <i class="fal fa-cog"></i>
                                </a>
                            </div>
                            <!-- app notification -->
                            <div>
                                <a class="header-icon" data-toggle="dropdown" href="#" title="You got 11 notifications">
                                    <i class="fal fa-bell"></i>
                                    <span class="badge badge-icon">11</span>
                                </a>
                            </div>
                            <!-- app user menu -->
                            <div>
                                <a class="header-icon d-flex align-items-center justify-content-center ml-2" data-toggle="dropdown" href="#" title="drlantern@gotbootstrap.com">
                                    <img alt="Dr. Codex Lantern" class="profile-image rounded-circle" src="img/demo/avatars/avatar-admin.png">
                                </a>
                            </div>
                        </div>
                    </header>
                    <!-- END Page Header -->
                    <!-- the #js-page-content id is needed for some plugins to initialize -->
                    <main class="page-content">
                        <div class="subheader">
                            <h1 class="subheader-title">
                                Главная <span class='fw-300'>страница</span>
                            </h1>
                        </div>
                        <agile />
                    </main>
                    <!-- this overlay is activated only when mobile menu is triggered -->
                </div>
            </div>
        </div>
        <!-- END Page Wrapper -->
    </div>
</template>

<script>
    import Wishes from './components/ticket/Wishes'
    import Agile from './components/ticket/Agile';

    export default {
        name: 'app',
        components: {
            Wishes,
            Agile
        },
        created() {
            this.fetchSystem();
        },
        methods: {
            fetchSystem() {
                axios.get('system').then(response => {
                    this.$store.commit('SET_STATUSES', response.data.statuses);
                    this.$store.commit('SET_PRIORITIES', response.data.priorities);
                    this.$store.commit('SET_USERS', response.data.users);
                });
            }
        }
    }
</script>
