import AdminGuestGuard from "../shared/guards/guest-admin-guard";
import AdminLogin from "../components/dashboard/login.vue";
import DashboardLayout from '../layouts/dashboard-layout';
import ItemTable from '../components/dashboard/item/item-table';
import ManyImageTable from '../components/dashboard/many-image/item-table';
import AuthenticatedAdminGuard from "../shared/guards/authenticated-admin-guard";

export default [{
    path: "/admin",
    component: DashboardLayout,
    beforeEnter: [
        AuthenticatedAdminGuard
    ],
    children: [
        { path: "items", component: ItemTable },
        { path: "many-image", component: ManyImageTable },
    ]
},
{
    path: "/admin",
    beforeEnter: [AdminGuestGuard],
    children: [
        { path: "login", component: AdminLogin },
    ]
},
];