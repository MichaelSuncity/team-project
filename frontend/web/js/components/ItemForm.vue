<template>
  <form>
    <div class="addform">
            <div class="modal-title" id="modal-title">Название категории</div>
            <div>
                <input id="addInputName" 
                class="addInputName" 
                :class="{invalid: ($v.titleCategory.$dirty && !$v.titleCategory.required) || ($v.titleCategory.$dirty && !$v.titleCategory.minLength)}" 
                type="text" 
                placeholder="Введите название..." 
                :value="item.title" 
                v-model="titleCategory">
                <small class="helper-text" v-if = "$v.titleCategory.$dirty && !$v.titleCategory.required">Поле не должно быть пустым!</small>
                <small class="helper-text" v-else-if = "$v.titleCategory.$dirty && !$v.titleCategory.minLength">Введите не менее 4 символов!</small>
            </div>
            <div> 
                <button @click.prevent="handleClickAdd(item)" id="handleClickAdd" type="button" class="btn btn-primary">Сохранить</button>
                <button @click="$emit('close')" type="reset" class="btn btn-secondary">Close</button>
            </div>
    </div>
  </form>
</template>

<script>
import { required, minLength } from 'vuelidate/lib/validators'
export default {
    props: {
        item: Object,
        titleCategory: '',

    },
    /*data: ()=> ({
        titleCategory: '',
    }),*/
    validations: {
    titleCategory: {
      required,
      minLength: minLength(4)
    }
  },

    methods: {
    handleClickAdd(item) { 
        if(this.$v.$invalid){
            this.$v.$touch()
            return
        }
        this.$emit('onadd', item);
        },
    }
}
</script>
