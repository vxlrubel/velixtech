const { createApp } = Vue;

const Navbar = createApp({
   data() {
      return {
         toggle: false,
         fade: false,
      };
   },
   methods: {
      openMenu() {
         this.toggle = true;
         setTimeout(() => {
            this.fade = true;
         }, 1);
      },
      closeMenu() {
         this.fade = false;
         setTimeout(() => {
            this.toggle = false;
         }, 300);
      },
   },
});

Navbar.mount('#navbar');
