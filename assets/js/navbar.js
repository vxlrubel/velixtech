const { createApp } = Vue;

const Navbar = createApp({
   data() {
      return {
         toggle: false,
      };
   },
   methods: {
      toggleMenu() {
         this.toggle = !this.toggle;
         alert(this.toggle);
      },
   },
});

Navbar.mount('#navbar');
