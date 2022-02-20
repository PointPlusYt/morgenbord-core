import { createApp } from 'vue';

const app = createApp({
    data() {
      return {
        showingForm: null,
      }
    },
    methods: {
      showForm(evt) {
        if (this.showingForm == evt.target.dataset.shortname) {
          this.showingForm = null;
        } else {
          this.showingForm = evt.target.dataset.shortname;
        }
      },
      toggleMenu(evt) {
        let selectedMenu = evt.target.nextElementSibling == undefined ? evt.target.parentElement.nextElementSibling : evt.target.nextElementSibling;
        document.querySelectorAll('.widget-menu').forEach(menuElmt => {
          if (menuElmt != selectedMenu) {
            menuElmt.classList.add('hidden');
          }
        });
        selectedMenu.classList.toggle('hidden');
      }
    },
    compilerOptions: {
      delimiters: ["${", "}$"]
    },
  })

const mountedApp = app.mount('#board')