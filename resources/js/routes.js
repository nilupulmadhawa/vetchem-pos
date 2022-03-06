import Invoices from './components/Invoices.vue';
import Billing from './components/Billing.vue';
import Dashboard from './components/Dashboard.vue';
import ProductList from './components/Product-List.vue';
import ProductAdd from './components/Product-Add.vue';
import Productlowquantity from './components/Product-Low-Quantity.vue';
export const routes = [
    {
        path: '/invoices',
        component: Invoices,
        name: "Invoices"
    },
    {
        path: '/billing',
        component: Billing,
        name: "Billing"
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
    },

    {
        path: '/Product-Low-Quantity-add',
        component: Productlowquantity,
        name: "Productlowquantity"
    }
];