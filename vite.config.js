import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
                'resources/css/app.css',


                'resources/css/Employees/employee-list.css',
                'resources/js/Employees/employees-list.js',
                'resources/css/Employees/employee-create.css',
                'resources/js/Employees/employees-create.js',
                'resources/js/Employees/employees-edit.js',

                'resources/css/Insurance/insurance-list.css',

                'resources/js/Vehicles/vehicles-create.js',
                'resources/js/Vehicles/vehicles-list.js',

                'resources/css/Projects/project-edit.css',

                'resources/css/Trips/trip-create.css',

                'resources/css/Modals/Modal.css',
                'resources/css/styles.css',

            ],
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
    ],
    resolve: {
        alias: {
            vue: 'vue/dist/vue.esm-bundler.js',
        },
    },
});
