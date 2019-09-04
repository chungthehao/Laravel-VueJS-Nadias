<template>
  <div>
      <h1>Menu Editor</h1>
      <div class="links">
          <router-link :to="{name: 'categories'}">Categories</router-link>
          <router-link :to="{name: 'items'}">Items</router-link>
          <router-link :to="{name: 'add-item'}">Add Item</router-link>
      </div>
      <router-view></router-view>
  </div>
</template>

<script>
import VueRouter from 'vue-router';
import CategoryManager from './CategoryManager.vue';
import MenuItem from './MenuItem.vue';
import MenuItemList from './MenuItemList.vue';
import store from '../store';

// Vue.use(VueRouter); // Setup plugin. Ko can vi Vue available in global scope, no tu lam

export default {
    store, // also make it available in child components
    props: ['categories'], // Van nhan categories nay tu blade cua laravel, dung de set vo store
    created() {
        this.$store.commit('SET_CATEGORIES', _.cloneDeep(this.categories));
    },
    router: new VueRouter({
        mode: 'history',
        base: 'menu-editor',
        routes: [
            {
                path: '/categories',
                name: 'categories',
                component: CategoryManager
            },
            {
                path: '/',
                redirect: {name: 'categories'}
            },
            {
                path: '/items',
                name: 'items',
                component: MenuItemList
            },
            {
                path: '/add-item',
                name: 'add-item',
                component: MenuItem
            },
            {
                path: '/edit-item/:id',
                name: 'edit-item',
                component: MenuItem,
                props: true
            },
            // Nhung route chua match voi nhung cai tren
            {
                path: '*',
                redirect: '/'
            },
        ]
    })
}
</script>

<style scoped>
    a {
        border: 1px solid black;
        padding: 10px;
        margin: 0;
    }
    .router-link-active {
        font-weight: bold;
        border-bottom: 0;
    }
    .links {
        margin: 15px auto;
    }
</style>