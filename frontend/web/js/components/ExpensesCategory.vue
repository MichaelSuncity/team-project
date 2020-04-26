<template>
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
                    <expenses-category-item class="expensescategory-item" @onremove="handleClickRemove" @onedit="handleClickShow"  v-for="item in items" :key="item.id" :item="item"></expenses-category-item>
                </div>
            </div>   
        </div>
</template>

<script>
import ExpensesCategoryItem from './ExpensesCategoryItem';

export default {
    name: "expenses-category",
    components: {
        ExpensesCategoryItem
    },
    props: {
        items:{
            type: Array
        },
    },
    methods: {
        handleClickRemove(item){
            this.$emit('onremove', item);
        },
        handleClickShow(item){
            this.$emit('onedit', item);
        }
   }
};
</script>