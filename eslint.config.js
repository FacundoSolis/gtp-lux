import globals from "globals"; // Asegúrate de instalarlo si no lo has hecho
import pluginReact from "eslint-plugin-react";
import pluginJs from "@eslint/js";

export default [
  {
    files: ["**/*.{js,mjs,cjs,jsx}"],
    languageOptions: {
      globals: {
        ...globals.browser, // Usa los globals adecuados para el entorno del navegador
      },
    },
    plugins: {
      react: pluginReact,
    },
    rules: {
      // Tus reglas personalizadas
    },
  },
  pluginJs.configs.recommended,
  pluginReact.configs.flat.recommended,
];
