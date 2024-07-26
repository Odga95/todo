import '../sass/app.scss';
import { createApp } from 'vue';
import { createRouter, createWebHistory } from 'vue-router';
import FormComponent from './components/tasks/Form.vue';
import ListComponent from './components/tasks/List.vue';
import EditComponent from './components/tasks/Edit.vue';
import HomeComponent from './components/Home.vue';
import PaginationComponent from './components/Pagination.vue';

const routes = [
    { path: '/', name: 'home', component: HomeComponent },
    { path: '/form', name: 'form', component: FormComponent },
    { path: '/tasks', name: 'tasks', component: ListComponent },
    { path: '/edit/:id', name: 'edit', component: EditComponent }
];

const router = createRouter({
    history: createWebHistory(),
    routes
});

const app = createApp({});
app.use(router);
app.component('pagination-tailwind', PaginationComponent);
app.mount('#app');
