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
                        <wishes></wishes>
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="panel">
                                    <div class="panel-hdr">
                                        <h2>
                                            <a href="#">#ticket-15</a> <span class="fw-300"><i>Просмотр тикета</i></span>
                                        </h2>
                                    </div>
                                    <div class="panel-container show">
                                        <div class="panel-content">
                                            <div class="mb-2">
                                                <div class="d-flex justify-content-between mb-2">
                                                    <h3>Lorem ipsum.</h3>
                                                    <span class="ml-2 mr-2"><button type="button" class="btn btn-outline-success dropdown-toggle">Сделана</button></span>
                                                </div>
                                                <div>
                                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab alias
                                                    asperiores beatae culpa cumque enim explicabo fugiat illo illum in iste
                                                    laboriosam necessitatibus neque nostrum optio perferendis provident quae
                                                    quam quis quisquam quod, sequi tempora tempore temporibus velit. Amet
                                                    autem doloremque doloribus eos explicabo mollitia officia officiis
                                                    provident ratione voluptate? A ad, alias, animi consectetur consequatur
                                                    cupiditate dicta dolore dolorem eaque inventore molestiae neque nobis
                                                    optio quos recusandae tempore voluptas. Adipisci atque eos fuga
                                                    molestiae sequi, tempora voluptatum. Accusantium blanditiis cupiditate
                                                    dolore doloremque dolores dolorum eos, fugit ipsa ipsam, iste itaque
                                                    labore molestiae, nam odit porro quam rerum sequi ullam.
                                                </div>
                                            </div>

                                            <div class="mb-1 text-danger">
                                                <span><i class="fal fa-stopwatch"></i></span>
                                                <span>01 января 2020</span>
                                            </div>
                                            <span><a class="profile-image-md rounded-circle d-inline-block" href="#" style="background-image:url('img/demo/avatars/avatar-g.png'); background-size: cover;"></a></span>
<!--                                            <div class="d-flex justify-content-between align-items-center mb-2">-->
<!--                                                <span class="mr-2">Статус</span>-->
<!--                                                <span class="badge border border-success text-success">Сделана</span>-->
<!--                                            </div>-->
<!--                                            <div class="d-flex justify-content-between align-items-center mb-2">-->
<!--                                                <span class="mr-2">Приоритет</span>-->
<!--                                                <span class="badge border border-danger text-danger">Высокий</span>-->
<!--                                            </div>-->
<!--                                            <div class="d-flex justify-content-between align-items-center mb-2">-->
<!--                                                <span class="mr-2">Срок</span>-->
<!--                                            </div>-->
<!--                                            <div class="d-flex justify-content-between align-items-center mb-2">-->
<!--                                                <span class="mr-2">Исполнитель</span>-->
<!--                                                <span>-->
<!--                                                                <a class="profile-image-sm rounded-circle d-inline-block" href="#" style="background-image:url('img/demo/avatars/avatar-g.png'); background-size: cover;"></a>-->
<!--                                                            </span>-->
<!--                                            </div>-->
<!--                                            <div class="d-flex justify-content-between align-items-center mb-2">-->
<!--                                                <span class="mr-2">Создал</span>-->
<!--                                                <span>-->
<!--                                                                <a class="profile-image-sm rounded-circle d-inline-block" href="#" style="background-image:url('img/demo/avatars/avatar-g.png'); background-size: cover;"></a>-->
<!--                                                            </span>-->
<!--                                            </div>-->
<!--                                            <div class="d-flex justify-content-between align-items-center mb-2">-->
<!--                                                <span class="mr-2">Обновила</span>-->
<!--                                                <span>-->
<!--                                                                <a class="profile-image-sm rounded-circle d-inline-block" href="#" style="background-image:url('img/demo/avatars/avatar-j.png'); background-size: cover;"></a>-->
<!--                                                            </span>-->
<!--                                            </div>-->
                                        </div>
                                        <div class="panel-content border-faded border-left-0 border-right-0 border-bottom-0 bg-faded">
                                            <textarea class="form-control rounded-top border-bottom-left-radius-0 border-bottom-right-radius-0 border" placeholder="Добавить комментарий" rows="2"></textarea>
                                            <div class="d-flex justify-content-end py-2 px-2 bg-white border border-top-0 rounded-bottom">
                                                <button class="btn btn-icon fs-lg mr-2" type="button">
                                                    <i class="fal fa-paperclip"></i></button>
                                                <button class="btn btn-primary btn-sm ml-auto ml-sm-0">Отправить
                                                </button>
                                            </div>
                                        </div>
                                        <div class="panel-content border-faded border-left-0 border-right-0 border-bottom-0 p-0 pb-3">
                                            <div class="d-flex flex-column">
                                                <!-- message -->
                                                <div class="d-flex flex-row px-3 pt-3 pb-2">
                                                    <!-- profile photo : lazy loaded -->
                                                    <span>
                                                        <a class="profile-image rounded-circle d-inline-block" href="#" style="background-image:url('img/demo/avatars/avatar-j.png')"></a>
                                                    </span>
                                                    <!-- profile photo end -->
                                                    <div class="ml-3">
                                                        <div>
                                                            <a class="fw-700 text-dark" href="#" title="Lisa Hatchensen">Lisa
                                                                Hatchensen</a>
                                                            <span class="fs-nano text-muted mt-1">5 mins ago</span>
                                                        </div>
                                                        Hey did you meet the new board of director? He's a bit of a geek
                                                        if you ask me...anyway here is the report you requested. I am
                                                        off to launch with Lisa and Andrew, you wanna join?
                                                        Hey did you meet the new board of director? He's a bit of a geek
                                                        if you ask me...anyway here is the report you requested. I am
                                                        off to launch with Lisa and Andrew, you wanna join?
                                                        Hey did you meet the new board of director? He's a bit of a geek
                                                        if you ask me...anyway here is the report you requested. I am
                                                        off to launch with Lisa and Andrew, you wanna join?
                                                    </div>
                                                </div>
                                                <!-- message end -->
                                                <!-- message -->
                                                <div class="d-flex flex-row px-3 pt-3 pb-2">
                                                    <!-- profile photo : lazy loaded -->
                                                    <span>
                                                        <a class="profile-image rounded-circle d-inline-block" href="#" style="background-image:url('img/demo/avatars/avatar-j.png')"></a>
                                                    </span>
                                                    <!-- profile photo end -->
                                                    <div class="ml-3">
                                                        <div>
                                                            <a class="fw-700 text-dark" href="#" title="Lisa Hatchensen">Lisa
                                                                Hatchensen</a>
                                                            <span class="fs-nano text-muted mt-1">5 mins ago</span>
                                                        </div>
                                                        Hey did you meet the new board of director? He's a bit of a geek
                                                        if you ask me...anyway here is the report you requested. I am
                                                        off to launch with Lisa and Andrew, you wanna join?
                                                        Hey did you meet the new board of director? He's a bit of a geek
                                                        if you ask me...anyway here is the report you requested. I am
                                                        off to launch with Lisa and Andrew, you wanna join?
                                                        Hey did you meet the new board of director? He's a bit of a geek
                                                        if you ask me...anyway here is the report you requested. I am
                                                        off to launch with Lisa and Andrew, you wanna join?
                                                    </div>
                                                </div>
                                                <!-- message end -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </main>
                    <!-- this overlay is activated only when mobile menu is triggered -->
                </div>
            </div>
        </div>
        <!-- END Page Wrapper -->
    </div>
</template>

<script>
    import User from './components/User.vue'
    import Wishes from './components/ticket/Wishes'
    import Comments from './components/ticket/Comments';

    export default {
        name: 'app',
        components: {
            User,
            Wishes,
            Comments
        },
        created() {
            //this.fetchUsers();
        },
        methods: {
            fetchUsers() {
                axios.get('users').then(response => {
                    this.$store.commit('SET_USERS', response.data);
                });
            }
        }
    }
</script>
