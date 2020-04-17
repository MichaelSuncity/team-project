const API_URL = 'api/expensescategories';
//компоенент для поиска
Vue.component('search', {
    template: `
    <div class="searchWrap">
        <input type="text" v-model="searchQuery"><button @click ="handleSearchClick">Поиск</button>
    </div>`,
    data() {
        return {
            searchQuery: '',
        };
    },
    methods: {
        handleSearchClick() {
            this.$emit('onsearch', this.searchQuery);
        }
    }
});
//компонент для списка категорий
Vue.component('expensescategory', {
    props: ['items', 'query'],
    template: `
    <div>
            <div class="totalItems" v-if="items.length==0">Категории не созданы. Создайте категорию расходов</div>
            <div class='categories' v-if="filteredItems.length!=0">
                <div id='expensesCategoryHead' class='expensesCategoryHead'>
                    <div>Название категории</div>
                    <div>Затраты за сегодня</div>
                    <div>Затраты в этом месяце</div>
                    <div>Затраты за все время</div>
                    <div></div>
                    <div></div>
                </div>
                <div>
                    <expensescategory-item class="expensescategory-item" @onremove="handleClickRemove" @onedit="handleClickEdit"  v-for="item in filteredItems" :item="item"></expensescategory-item>
                </div>
            </div>   
        </div>`,
        computed: {
        filteredItems() { // поиск
            const regexp = new RegExp(this.query, 'i');
            return this.items.filter((item) => regexp.test(item.title))
        }
    },
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
              <button @click="handleClickAdd" id="handleClickAdd" type="button" class="btn btn-primary">Сохранить</button>
              <button @click="handleClickEditSave" type="button"  id="handleClickEditSave" value="" class="hidden btn btn-primary">Сохранить</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
            </div>
        </div>`,
    methods: {
        handleClickAdd() {
            this.$emit('onadd');
        },
        handleClickEditSave() {
            this.$emit('oneditsave');
        },
    }
});


const app = new Vue({
   el: '#app',
   data: {
       items: [],
       searchQuery: '',

   },
    methods: {
        handleSearch(query){
            this.searchQuery = query;
        },
        //метод для открытия модального окна с очисткой поля ввода и обновления названия формы
        handleClickShow() {
            document.getElementById('addInputName').value = '';
            document.getElementById('exampleModalLongTitle').textContent = 'Создать новую категорию';
            //сокрытие кнопки редактирования, проявление кнопки добавления
            document.getElementById('handleClickAdd').classList.remove('hidden');
            const handleClickEditSave = document.getElementById('handleClickEditSave');
            handleClickEditSave.classList.add('hidden');
            handleClickEditSave.value ='';
       },

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
                        //закрытие окна
                        $('#exampleModalCenter').modal('hide');
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
        //метод для изменения модального окна с добавления на редактирование с заполнением id в кнопку сохранения и title в input
        handleClickEdit(item) {
            //считывание выбранной категории по id
            const categoryItem = this.items.find(categoryItem => categoryItem.id == item.id);
            //перенос названия выбранной категории в модальное окно
            document.getElementById('addInputName').value = categoryItem.title;
            //переименование модального окна
            document.getElementById('exampleModalLongTitle').textContent = 'Редактирование записи';
            //сокрытие кнопки добавления, проявление кнопки редактирования
            const handleClickEditSave = document.getElementById('handleClickEditSave');
            handleClickEditSave.classList.remove('hidden');
            document.getElementById('handleClickAdd').classList.add('hidden');
            //прописываю в кнопку значение id выбранной категории для последующего сохранения
            handleClickEditSave.value = categoryItem.id;
            console.log(handleClickEditSave.value);
        },
        //метод для сохранения редактируемой категории
        handleClickEditSave() {
            const id = document.getElementById('handleClickEditSave').value;
            const title = document.getElementById('addInputName').value;
            fetch(`${API_URL}/${id}`, {
                method: 'PATCH',
                body: JSON.stringify({
                    title: title,
                }),
                headers: {
                    'Content-Type': 'application/json',
                }
            }).then((response) => response.json())
                .then((result) => {
                    //считываю порядковый номер элемента (категории) в массиве, чтобы обновить
                    const idx = this.items.findIndex(categoryItem => categoryItem.id == id);
                    //this.items[idx] = result; данная строка обновляет элемент, но почему-то не обновляется информация на странице
                    Vue.set(this.items, idx, result);
                    //закрытие окна
                    $('#exampleModalCenter').modal('hide');
                });
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