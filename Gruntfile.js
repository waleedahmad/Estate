module.exports = function(grunt) {

    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),

        concat: {
            dist: {
                src: [
                    'resources/assets/js/tabs.js',
                    'resources/assets/js/app.js',
                    'resources/assets/js/add_town_map.js',
                    'resources/assets/js/add_listing.js',
                    'resources/assets/js/admin_listings.js',
                    'resources/assets/js/listings.js',
                    'resources/assets/js/locations.js',
                    'resources/assets/js/messages.js',
                    'resources/assets/js/search.js',
                    'resources/assets/js/tiers.js',
                    'resources/assets/js/users.js',
                ],
                dest: 'public/assets/js/app.js',
            }
        },


        uglify: {
            build: {
                src:  'public/assets/js/app.js',
                dest: 'public/assets/js/app.min.js'
            }
        },

        sass: {
            dist: {
                options: {
                    style: 'compressed'
                },
                files: {
                    'public/assets/css/app.min.css' : 'resources/assets/sass/app.scss'
                }
            }
        },

        "babel" : {
            options: {
                sourceMap: true,
                presets: ['es2015']
            },
            dist: {
                files: {
                    'public/assets/js/app.js': 'public/assets/js/app.js'
                }
            }
        },


        watch: {
            scripts: {
                files: [
                    'resources/assets/js/*.js'
                ],
                tasks: ['concat', 'babel' ,'uglify']
            },

            css: {
                files: [
                    'resources/assets/sass/*.scss',

                ],
                tasks: ['sass'],
                options: {
                    spawn: false,
                }
            }
        }
    });

    grunt.loadNpmTasks('grunt-contrib-concat');

    grunt.loadNpmTasks('grunt-contrib-sass');

    grunt.loadNpmTasks('grunt-contrib-uglify');

    grunt.loadNpmTasks('grunt-contrib-watch');

    grunt.loadNpmTasks('grunt-babel');

    grunt.registerTask('default', ['concat', 'sass', 'babel', 'uglify', 'watch']);
};