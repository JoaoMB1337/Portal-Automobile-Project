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

                'resources/js/Geral/create.js',
                'resources/js/Geral/edit.js',
                'resources/js/Geral/list.js',

                'resources/js/Home/home.js',

                'resources/js/Insurance/insurance-list.js',

                'resources/js/Vehicles/vehicles-list.js',
                'resources/js/Vehicles/vehicles-create.js',

                'resources/css/Geral/create.css',
                'resources/css/Geral/styles.css',

                'resources/css/Employees/employee-list.css',
                'resources/css/Employees/employee-create.css',

                'resources/css/Insurance/insurance-list.css',

                'resources/css/Modals/Modal.css',

                'resources/css/Projects/project-edit.css',

                'resources/css/Trips/trip-create.css',

                'resources/css/Vehicles/vehicle-list.css',
                'resources/js/Home/home.js',


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
