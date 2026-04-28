/** @type {import('tailwindcss').Config} */
export default {
  content: ['./**/*.php', './assets/**/*.js'],
  theme: {
    extend: {
      colors: {
        brand: 'var(--loomy-primary)',
        primary: 'var(--loomy-primary)',
        secondary: 'var(--loomy-secondary)',
        'site-bg': 'var(--loomy-bg)',
        'site-text': 'var(--loomy-text)',
      },
      fontFamily: {
        body: 'var(--loomy-font-body)',
        heading: 'var(--loomy-font-heading)',
      },
      spacing: {
        'header-max': 'var(--loomy-header-width)',
      },
    },
  },
  plugins: [
    require('@tailwindcss/forms'),
    require('@tailwindcss/typography')
  ],
  corePlugins: { preflight: false }
}
