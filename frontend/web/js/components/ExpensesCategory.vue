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
                    <expenses-category-item class="expensescategory-item" @onremove="handleClickRemove" @onedit="handleClickShow"  v-for="item in paginatedCategories" :key="item.id" :item="item"></expenses-category-item>
                </div>
            </div> 
            <div class="paginationVue">
                <div class="page" v-for="page in pages" 
                :key="page" 
                :class="{'pageSelected': page == pageNumber}"
                @click="pageClick(page)">
                    {{ page }}
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
    data() {
        return {
            notesPerPage: 5,
            pageNumber: 1,
        }
    },
    computed: {
        pages() {
            return Math.ceil(this.items.length / 5);
        },
        paginatedCategories(){
            let from  = (this.pageNumber - 1) * this.notesPerPage;
            let to  = from + this.notesPerPage;
            return this.items.slice(from, to);
        }
    },
    methods: {
        handleClickRemove(item){
            this.$emit('onremove', item);
        },
        handleClickShow(item){
            this.$emit('onedit', item);
        },
        pageClick(page){
            this.pageNumber = page;
        }
   }
};
</script>
