/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./*.php",
    "src/pages/*.html",
    "src/php/*.php"
  ],
  theme: {
    extend: {},
  },
  plugins: [
    function ({ addVariant }) {
      addVariant("child", "& > *");
    },
  ],
};
