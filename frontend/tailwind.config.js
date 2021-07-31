module.exports = {
  purge: ['./index.html', './src/**/*.{vue,js,ts,jsx,tsx}'],
  darkMode: false, // or 'media' or 'class'
  theme: {
    extend: {},
    colors: {
      primary: '#0a2463',
      default: '#f8f8f8',
      fetured: '#e63946'
    }
  },
  variants: {
    extend: {},
  },
  plugins: [],
}
