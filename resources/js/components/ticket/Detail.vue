<template>
    <div>
        <div class="mb-3">
            <b-button-group size="sm">
                <b-button variant="outline-info">Изменить</b-button>
            </b-button-group>
        </div>
        <div class="row">
            <div class="col-9">
                <div class="mb-2">
                    <a href="#">ticket-12</a>
                    Создал <a href="#">Сережа</a> неделю назад
                    <div>Обновила <a href="#">Маша</a> сегодня в 14:23</div>
                </div>
                <div>
                    <b-badge pill variant="primary">Разработка</b-badge>
                </div>
                <h3 class="mb-2">Детальное отображение тикета в модальном окне</h3>
                <hr>
                <div class="mb-4">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi asperiores commodi cupiditate ea
                        est
                        eum excepturi illo natus quasi veritatis. Ad aspernatur blanditiis distinctio eveniet mollitia
                        officia possimus quae quam. A animi atque culpa doloremque expedita iure, nemo nisi non odit
                        officia
                        perferendis placeat possimus quidem quis similique suscipit voluptatum.</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Explicabo, possimus.</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi asperiores commodi cupiditate ea
                        est
                        eum excepturi illo natus quasi veritatis. Ad aspernatur blanditiis distinctio eveniet mollitia
                        officia possimus quae quam. A animi atque culpa doloremque expedita iure, nemo nisi non odit
                        officia
                        perferendis placeat possimus quidem quis similique suscipit voluptatum.</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Explicabo, possimus.</p>
                </div>
                <hr>
            </div>
            <div class="col-3">
                <ul class="list-group">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Срок
                        <span>9 декабря 2019</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Исполнитель
                        <span>
                            <User/>
                        </span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Приоритет
                        <span>Низкий</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Статус
                        <span>В работе</span>
                    </li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-9">
                <div class="mb-5">
                    <h4>Комментарии</h4>
                    <form>
                        <div class="form-group">
                            <textarea class="form-control" rows="3"></textarea>
                        </div>
                        <button class="btn btn-primary" type="submit">Добавить</button>
                    </form>
                    <hr>
                    <ul class="list-unstyled">
                        <li class="media mb-4">
                            <img alt="..." class="mr-3 rounded " src="https://sun9-2.userapi.com/c858428/v858428439/b1c99/u-zy4fEw_ws.jpg?ava=1" style="width:50px;">
                            <div class="media-body">
                                <div><a href="#">Сережа</a> написал вчера в 20:39</div>
                                Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin.
                                Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc
                                ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                            </div>
                        </li>
                        <li class="media mb-4">
                            <img alt="..." class="mr-3 rounded " src="https://sun9-2.userapi.com/c858428/v858428439/b1c99/u-zy4fEw_ws.jpg?ava=1" style="width:50px;">
                            <div class="media-body">
                                <div><a href="#">Сережа</a> написал вчера в 20:39</div>
                                Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin.
                                Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc
                                ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import User from '../User';

    export default {
        name: "Detail",
        components: {User}
    }
</script>

<style scoped>

</style>
