<template>
  <div>
      <h1>Menu Editor</h1>
      <router-view></router-view>
  </div>
</template>

<script>
import VueRouter from 'vue-router';
import CategoryManager from './CategoryManager.vue';
import MenuItem from './MenuItem.vue';

// Vue.use(VueRouter); // Setup plugin. Ko can vi Vue available in global scope, no tu lam

export default {
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

<style>

</style>template