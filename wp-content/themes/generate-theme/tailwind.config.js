module.exports = {
  content: [
    "../vaiv-keyword/**/*.{html, php, js}"
  ],
  theme: {
    extend: {
      fontSize: {
        '100': '100px',
      }
    },
  },
  plugins: [
    require('@tailwindcss/typography'),
    require('@tailwindcss/forms'),
    require('@tailwindcss/line-clamp'),
    require('@tailwindcss/aspect-ratio'),
  ],
}