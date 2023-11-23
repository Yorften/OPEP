/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./index.php",
    "./index.html",
    "./getContent.php",
    "src/pages/getCountryInfo.php",
    "src/pages/footer.html",
    "src/pages/nav.html",
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
