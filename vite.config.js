import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/sass/app.scss",
                "resources/js/app.js",
                "resources/js/recetas/create.js",
                "resources/js/auth/register.js",
                "resources/js/home/home.js",
            ],
            refresh: true,
        }),
    ],
    resolve: {
        alias: {
            $: "jQuery",
        },
    },
});
