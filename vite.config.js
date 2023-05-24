import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

import fs from "fs";

const host = "ezralfredo.com/citrajournal";

export default defineConfig({
    server: {
        host,
        hmr: { host },
        https: {
            key: fs.readFileSync(`keys/citrajournal.key`),
            cert: fs.readFileSync(`keys/citrajournal.crt`),
        },
    },
    plugins: [
        laravel({
            input: ["resources/css/app.css", "resources/js/app.js"],
            refresh: true,
        }),
    ],
});
