/** @type {import('tailwindcss').Config} */
export default {
  content: ['./**/*.php', './assets/**/*.js'],
  theme: { extend: {} },
  plugins: [
    require('@tailwindcss/forms'),
    require('@tailwindcss/typography')
  ],
  corePlugins: { preflight: false }
}
