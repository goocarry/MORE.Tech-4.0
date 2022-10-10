import { About } from './about';
import { Login } from './login';
import { Articles } from './articles';
import { Article } from './article';
import { Tasks } from './tasks';
import { Profile } from './profile';
import { Shop } from './shop';
import { Create } from './create';


export const routes = [{
    path: '/',
    isExact: true,
    Component: About,
}, {
    path: '/login',
    isExact: true,
    Component: Login,
}, {
    path: '/tasks',
    isExact: true,
    Component: Tasks,
}, {
    path: '/articles',
    isExact: true,
    Component: Articles,
}, {
    path: '/article/:id',
    isExact: true,
    Component: Article,
}, {
    path: '/profile',
    isExact: true,
    Component: Profile,
}, {
    path: '/shop',
    isExact: true,
    Component: Shop,
}, {
    path: '/create',
    isExact: true,
    Component: Create,
}];
