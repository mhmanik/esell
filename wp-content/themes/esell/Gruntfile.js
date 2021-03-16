module.exports = function(grunt) {
    require('jit-grunt')(grunt);
    grunt.initConfig({
        pkg: grunt.file.readJSON( 'package.json' ),
 

  sass: {
    dist: {
   
      files: {
        'assets/css/style.css': 'assets/scss/style.scss',
        
        
      } 
    }
  },
    postcss: {
      // Begin Post CSS Plugin
      options: {
        map: false,
        processors: [
          require('autoprefixer')({
            browsers: ['last 2 versions'],
          }),
        ],
      },
      dist: {
        src: 'assets/css/style.css',        
      },
    },
    rtlcss: {
        final: {
            options: {
              opts: {
                "autoRename": false,
                "autoRenameStrict": false,
                "blacklist":{},
                "clean": true,
                "greedy": false,
                "processUrls": false,
                "stringMap":[]
              },
              saveUnmodified: true,
            },
            expand : true,
            cwd    : 'assets/css/',
            dest   : 'assets/css-auto-rtl/',
            src    : [
                    '**/*.css',
                    '!**/owl.carousel.css',
                    '!**/owl.carousel.min.css',
                    '!**/owl.theme.default.css',
                    '!**/owl.theme.default.min.css',
                    '!**/font-awesome.min.css',
                    '!**/iconfont.css',
                    '!**/slick.css',
                    '!**/rtl.css'
            ]
        }
    },
        // Clean the build folder
        clean: {
            build: {
                src: ['__build/']
            },
            build2: {
                src: ['__build/*','!__build/<%= pkg.name %>.zip']
            }
        },
        // make pot to build folder
        makepot: {
            build: {
                options: {
                    cwd: '__build',
                    domainPath: 'languages',
                    type: 'wp-theme',
                    processPot: function( pot, options ) {
                        pot.headers['report-msgid-bugs-to'] = 'support@axiltheme.com';
                        pot.headers['last-translator'] = 'axiltheme <info@axiltheme.com>';
                        pot.headers['language-team'] = 'axiltheme <info@axiltheme.com>';
                        return pot;
                    }
                }
            }
        },
        // Copy to build folder
        copy: {
            build: {
                src: ['**', '!node_modules/**', '!__junk/**', '!src/**', '!todo.txt', '!assets/sass/**', '!Gruntfile.js','!package-lock.json','!package.json', '!sftp-config.json'],
                dest: '__build/',
            }
        },
        // Compress the build folder into an upload-ready zip file
        compress: {
            build: {
                options: {
                    archive: '__build/<%= pkg.name %>.zip'
                },
                expand: true,
                cwd: '__build/',
                src: ['**/*'],
                dest: '<%= pkg.name %>/'
            }
        },

       watch: {
            styles: {
                files: ['assets/scss/**/*.scss'], // which files to watch
                tasks: ['sass'],
                options: {
                    spawn: false
                }
            },
            
        }
    });
    
    grunt.loadNpmTasks( 'grunt-wp-i18n' );
    // Load Grunt plugins
    grunt.loadNpmTasks('grunt-contrib-sass');
    grunt.loadNpmTasks('grunt-postcss');
    grunt.registerTask('default', ['sass', 'watch']);
    // Build task
    grunt.registerTask( 'build', [ 'rtlcss', 'postcss', 'clean:build', 'copy:build', 'makepot:build', 'compress:build', 'clean:build2' 
    ]);
};
