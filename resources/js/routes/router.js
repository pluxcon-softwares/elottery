import VueRouter from 'vue-router';
import Login from '../components/user/Login';
import HomePage from '../components/HomePage';
import AdminLogin from '../components/admin/Login';
import AdminHome from '../components/admin/Home';
import Dashboard from '../components/admin/Dashboard';
import LoadResult from '../components/admin/LoadResult';
import CreateLottery from '../components/admin/CreateLottery';
import ViewLotteries from '../components/admin/ViewLotteries';
import Chart from '../components/admin/Chart';

const routes = new VueRouter({
    routes: [
        {path: '/', component: HomePage, name: 'home'},
        {path: '/login', component: Login, name: 'login'},
        {path: '/admin', component: AdminLogin, name: 'admin_login'},
        {
            path: '/admin/dashboard',
            component: AdminHome,
            children:[
                {path: '', component: Dashboard, name: 'admin-dashboard'},
                {path: 'load-result', component: LoadResult, name:'load-result'},
                {path: 'create-lottery', component: CreateLottery, name:'create-lottery'},
                {path: 'view-lotteries', component: ViewLotteries, name: 'view-lotteries'},
                {path: 'chart', component: Chart, name: 'chart'},
            ],
        }
    ],
    mode: 'history',
    base: '/user'
});

export default routes;
