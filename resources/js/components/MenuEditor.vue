<template>
  <div>
      <h1>Menu Editor</h1>
      <div class="links">
          <router-link :to="{name: 'categories'}">Categories</router-link>
          <router-link :to="{name: 'add-item'}">Add Item</router-link>
      </div>
      <router-view :initial-categories="categories"></router-view>
  </div>
</template>

<script>
import VueRouter from 'vue-router';
import CategoryManager from './CategoryManager.vue';
import MenuItem from './MenuItem.vue';

// Vue.use(VueRouter); // Setup plugin. Ko can vi Vue available in global scope, no tu lam

export default {
    props: ['categories'],
    router: new VueRouter({
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
                path: '/add-item',
                name: 'add-item',
                component: MenuItem
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