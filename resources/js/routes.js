import Invoice from './components/Invoice.vue';
import Dashboard from './components/Dashboard.vue';
import ProductList from './components/Product-List.vue';

export const routes = [
    {
        path: '/invoice',
        component: Invoice,
        name: "Invoice"
    },
    {
        path: '/dashboard',
        component: Dashboard,
        name: "Dashboard"
    },
    {
        path: '/productlist',
        component: ProductList,
        name: "ProductList"
    }
];