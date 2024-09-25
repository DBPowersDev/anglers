import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers'
import MainLayout from '@/Layouts/MainLayout.vue'
import { ZiggyVue } from 'ziggy'
import { i18nVue } from 'laravel-vue-i18n'
import '../css/app.css'

createInertiaApp({
  resolve: (name) => {
    const page = resolvePageComponent(
      `./Pages/${name}.vue`,
      import.meta.glob('./Pages/**/**/*.vue')
    )
    page.then((module) => {
      // ここで設定する
      module.default.layout = module.default.layout || MainLayout
    })

    return page
  },
  setup({ el, App, props, plugin }) {
    createApp({ render: () => h(App, props) })
      .use(plugin)
      .use(ZiggyVue)
      .use(i18nVue, {
        resolve: async (lang) => {
          const langs = import.meta.glob('../../lang/*.json')
          return await langs[`../../lang/${lang}.json`]()
        }
      })
      .mount(el)
  }
})
