import Invoices from './components/Invoices.vue';
import Billing from './components/Billing.vue';
import Dashboard from './components/Dashboard.vue';
import ProductList from './components/Product-List.vue';
import ProductAdd from './components/Product-Add.vue';
import Productlowquantity from './components/Product-Low-Quantity.vue';
import Supplier from './components/Supplier.vue';
import SupplierInfo from './components/Supplier-Info.vue';
import Customer from './components/Customer.vue';
import CustomerDetails from './components/Customer-Details.vue';
import ProductEdit from "./components/Product-Edit.vue";
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
    },

    {
        path: '/supplier',
        component: Supplier,
        name: "Supplier"
    },

    {
        path: '/supply/:id',
        component: SupplierInfo,
        name: "SupplierInfo"
    },
    {
        path: '/customer',
        component: Customer,
        name: "Customer"
    },

    {
        path: '/customer/:id',
        component: CustomerDetails,
        name: "CustomerDetails"
    },

    {
        path: '/edit-product/:id',
        component: ProductEdit,
        name: "ProductEdit"
    },
]; 
