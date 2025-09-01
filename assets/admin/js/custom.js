async function loadTemplate(file) {
   const res = await fetch(file);
   return await res.text();
}

const themeUrl = velixtechData.themeUrl;

const Home = { template: await loadTemplate(`${themeUrl}home.html`) };
const About = {
   template: await loadTemplate(`${themeUrl}about.html`),
   data() {
      return { name: 'Rubel', counter: 0 };
   },
   methods: {
      showInfo() {
         alert(`Hello, ${this.name}! Button clicked ${++this.counter} times.`);
      },
   },
};
const Contact = { template: await loadTemplate(`${themeUrl}contact.html`) };

const routes = [
   { path: '/', component: Home },
   { path: '/about', component: About },
   { path: '/contact', component: Contact },
];
const router = VueRouter.createRouter({
   history: VueRouter.createWebHashHistory(),
   routes,
});

// Vue app
const app = Vue.createApp({});
app.use(router);
app.mount('#admin-app');
