import Invoice from './components/Invoice.vue';
import Dashboard from './components/Dashboard.vue';
import ProductList from './components/Product-List.vue';
import ProductAdd from './components/Product-Add.vue';
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
        path: '/product-list',
        component: ProductList,
        name: "ProductList"
    },

    {
        path: '/product-add',
        component: ProductAdd,
        name: "ProductAdd"
    }
];