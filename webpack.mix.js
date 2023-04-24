const mix = require("laravel-mix");

mix
  .setPublicPath("public")
  .setResourceRoot("./")
  .js("resources/assets/js/FAQEditor.jsx", "public")
  .react()
  .postCss("resources/assets/css/style.css", "public", [
    require("tailwindcss"),
    require("postcss-nested"),
    require("autoprefixer"),
  ])
  .version();
