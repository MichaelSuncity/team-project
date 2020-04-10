const API_URL = 'api/expensescategories';
//компонент для списка категорий
Vue.component('expensescategory', {
    props: ['items'],
    template: `
    <div>
            <div class="totalItems" v-if="items.length==0">Категории не созданы. Создайте категорию расходов</div>
            <div class='categories' v-if="items.length!=0">
                <div id='expensesCategoryHead' class='expensesCategoryHead'>
                    <div>Название категории</div>
                    <div>Затраты за сегодня</div>
                    <div>Затраты в этом месяце</div>
                    <div>Затраты за все время</div>
                    <div></div>
                    <div></div>
                </div>
                <div>
                    <expensescategory-item class="expensescategory-item" @onremove="handleClickRemove" @onedit="handleClickEdit"  v-for="item in items" :item="item"></expensescategory-item>
                </div>
            </div>   
        </div>`,
    methods: {
        handleClickRemove(item) {
            this.$emit('onremove', item);
        },
        handleClickEdit(item) {
            this.$emit('onedit', item);
        },
    },
});
//компонент для элемента списка категорий
Vue.component('expensescategory-item', {
    props: ['item'],
    template: `
    <div>
        <div class='title'>{{ item.title }}</div>
        <div class='sum'>{{ item.totaltoday + ' $'}}</div>
        <div class='sum'>{{ item.totalmonth + ' $'}}</div>
        <div class='sum'>{{ item.total + ' $'}}</div>
        <div>
            <button class='editDeleteButton' type="button" data-toggle="modal" data-target="#exampleModalCenter" @click.prevent="handleClickEdit(item)"><i class="fas fa-edit"></i></button>
        </div>
        <div>
            <button class='editDeleteButton' @click.prevent="handleClickRemove(item)"><i class="fas fa-trash"></i></button>
        </div>
    </div>`,
    methods: {
        handleClickRemove(item) {
            this.$emit('onremove', item);
        },
        handleClickEdit(item) {
            this.$emit('onedit', item);
        },
    }
});

//компонент для формы добавления
Vue.component('addform', {
    props: [],
    template: `
        <div class="addform">
            <div class="modal-title">Название категории</div>
                <input id="addInputName" class="addInputName" type="text" placeholder="Введите название...">
            <div>
            <div>
              <button @click="handleClickAdd" type="button" class="btn btn-primary">Сохранить</button>
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
            </div>
        </div>`,
    methods: {
        handleClickAdd() {
            this.$emit('onadd');
        }
    }
});


const app = new Vue({
   el: '#app',
   data: {
      items: [],
   },
    methods: {
       //метод для добавления новой категории
        handleClickAdd() {
            const  title = document.getElementById('addInputName').value;
            console.log(title);
            fetch(`${API_URL}`, {
                method: 'POST',
                body: JSON.stringify({
                    title: title,
                }),
                headers: {
                    'Content-Type': 'application/json',
                }
            }).then((response) => response.json())
                .then((title) => {
                        this.items.push(title);
                    })
        },
        //метод для удаления выбранной категории из списка
        handleClickRemove(item) {
            const categoryItem = this.items.find(categoryItem => categoryItem.id == item.id);
            console.log(categoryItem.id);
            fetch(`${API_URL}/${categoryItem.id}`, {
                method: 'DELETE',
                body: JSON.stringify({}),
                headers: {
                    'Content-Type': 'application/json',
                }
            }).then(() => {
                    const itemIdx = this.items.findIndex(categoryItem => categoryItem.id == item.id);
                    this.items.splice(itemIdx, 1);
                });
        },
        //метод для редактирования выбранной категории из списка
        handleClickEdit(item) {
            const categoryItem = this.items.find(categoryItem => categoryItem.id == item.id);
            const  title = document.getElementById('addInputName');
            title.innerText = categoryItem.title;
            console.log(title.value);
            console.log(categoryItem.id);
            console.log(categoryItem.title);
        }
    },
    // первоначальная загрузка категорий из БД для отображения
    mounted(){
        fetch(`${API_URL}`)
            .then((response) => response.json())
            .then((items) => {
                this.items = items;
            });
    },
});