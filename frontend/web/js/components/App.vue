<template>
    <div>
        <button type="button" @click="handleClickShow" id="showBtn" class="showBtn">
            Добавить категорию
        </button>
        <expenses-category @onremove="handleClickRemove" @onedit="handleClickShow"  :items="items"></expenses-category>
        <modals-container @onadd="handleClickAdd"/>
    </div>
</template>

<script>
const API_URL = 'api/expensescategories';

import ExpensesCategory from './ExpensesCategory';
import ItemForm from './ItemForm';
import Vue from 'vue';

export default {
    name: "App",
    components: {
        ExpensesCategory
    },
    data(){
       return {
        items: [],
       }
    },

    methods: {
        handleClickShow(item) {
            this.$modal.show(ItemForm, {item}, {width: "50%"});
        },

        handleClickAdd(item) {
            const title = document.getElementById('addInputName').value;
            const existTitle = this.items.find(categoryItem => categoryItem.title == title);
            const categoryItem = this.items.find(categoryItem => categoryItem.id == item.id);
            if(categoryItem){// если уже существует категория с таким id, то редактируем
                if(!existTitle){ // проверка на существование уже такого названия
                    fetch(`${API_URL}/${item.id}`, {
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
                    const idx = this.items.findIndex(categoryItem => categoryItem.id == item.id);
                    Vue.set(this.items, idx, result);
                }); 
                } else {
                    document.getElementById('addInputName').value ="Категория с таким названием уже существует!";
                }
            } else {//если нету id, то создаем 
            if(!existTitle){// проверка на существование уже такого названия
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
                        });
                    } else {
                        document.getElementById('addInputName').value ="Категория с таким названием уже существует!";
                    }
            }
         
        },

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
    },
    mounted(){
        fetch(`${API_URL}`)
            .then((response) => response.json())
            .then((items) => {
                this.items = items;
            });
    },
}
</script>>