<template>
    <div>
        <button type="button" @click="handleClickShow" id="showBtn" class="showBtn">
            Добавить категорию
        </button>
        {{ error }}
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
        error: '',
       }
    },

    methods: {
        handleClickShow(item) {
            this.error ='';
            this.$modal.show(ItemForm, {item}, {width: "50%"});
        },

        handleClickAdd(item) {
            const title = document.getElementById('addInputName').value;
            const categoryItem = this.items.find(categoryItem => categoryItem.id == item.id);
            if(categoryItem){// если уже существует категория с таким id, то редактируем
                fetch(`${API_URL}/${item.id}`, {
                    method: 'PATCH',
                    body: JSON.stringify({
                    title: title,
                    }),
                    headers: {
                        'Content-Type': 'application/json',
                    }
                }).then((response) => {
                    if(response.status == 200){
                        response.json()
                        .then((result) => {
                        const idx = this.items.findIndex(categoryItem => categoryItem.id == item.id);
                        Vue.set(this.items, idx, result);
                        });
                    } else if (response.status == 422) {
                        this.error ="Категория с таким названием уже существует!";
                    }
                }); 
            } else {//если нету id, то создаем 
                    fetch(`${API_URL}`, {
                        method: 'POST',
                        body: JSON.stringify({
                        title: title,
                        }),
                    headers: {
                        'Content-Type': 'application/json',
                    }
                    }).then((response) => { 
                    if(response.status == 201){
                        response.json()
                        .then((title) => {
                            this.items.push(title);
                        });
                    } else if (response.status == 422){
                        this.error ="Категория с таким названием уже существует!";
                    }
                });
            }
        },

        handleClickRemove(item) {
            this.error ='';
            const categoryItem = this.items.find(categoryItem => categoryItem.id == item.id);
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
        fetch(`${API_URL}/auth`)
            .then((response) => response.json())
            .then((items) => {
                this.items = items;
            });
    },
}
</script>>