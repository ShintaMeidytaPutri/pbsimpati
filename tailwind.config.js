/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    //use font Teachers
    fontFamily: {
      'teachers': ['Teachers', 'sans-serif'],
    },
    extend: {},
  },
  plugins: [],
}

