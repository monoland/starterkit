const moduleBase = () => import(/* webpackChunkName: "scripts/module" */ '@module/module/pages/Base');
const moduleHome = () => import(/* webpackChunkName: "scripts/module" */ '@module/module/pages/Home');

export const router = { path: '/module', meta: { auth: true }, component: moduleBase, children: [
    { path: 'home', name: 'module', component: moduleHome },
]};