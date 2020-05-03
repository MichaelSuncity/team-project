<template>
    <div>
        <div class='title'>{{ item.title }}</div>
        <div class='sum'>{{ item.totaltoday + ' $'}}</div>
        <div class='sum'>{{ item.totalmonth + ' $'}}</div>
        <div class='sum'>{{ item.total + ' $'}}</div>
        <div>
            <button class='editDeleteButton' type="button" @click.prevent="handleClickShow(item)"><i class="fas fa-edit"></i></button>
        </div>
        <div>
            <button class='editDeleteButton' @click.prevent="handleClickRemove(item)"><i class="fas fa-trash"></i></button>
        </div>
    </div>
</template>

<script>
export default {
    name: "expenses-category-item",
    props: {
        item: {
            type: Object
        }
    },
    methods: {
        handleClickRemove(item) {
            this.$emit('onremove', item);
        },
        handleClickShow(item) {
            this.$emit('onedit', item);
        },
    }
}
</script>