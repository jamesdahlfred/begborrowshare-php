'use strict';

var proxySnippet = require('grunt-connect-proxy/lib/utils').proxyRequest;

module.exports = function (grunt) {
  require('load-grunt-tasks')(grunt);
  require('time-grunt')(grunt);

  // Initializing the configuration object
  grunt.initConfig({

    // Read in project settings
    pkg: grunt.file.readJSON('package.json'),

    externs: '<%-- process.env.CLOSURE_PATH %>/contrib/externs',

    // Task configuration
    concat: {
      options: {
        separator: ';\n'
      },
      lib: {
        options: {
          separator: ';\n'
        },
        src: [
          'bower_modules/modernizr/modernizr.js',
          'bower_modules/jquery/jquery.js',
          'bower_modules/bootstrap/dist/js/bootstrap.js',
          'bower_modules/angular/angular.js',
          'bower_modules/angular-route/angular-route.js',
          'bower_modules/angular-resource/angular-resource.js',
          'bower_modules/angular-animate/angular-animate.js',
          'bower_modules/angular-cookies/angular-cookies.js',
          'bower_modules/angular-touch/angular-touch.js',
          'bower_modules/angular-sanitize/angular-sanitize.js',
          'bower_modules/angular-mocks/angular-mocks.js'
        ],
        dest: 'public/assets/js/lib.js'
      },
      app: {
        options: {
          separator: ';\n',
          banner: ";(function($,window,document,undefined){'use strict';",
          footer: "})(jQuery,window,document);"
        },
        src: [
          'app/assets/js/app.js',
          'app/assets/js/**/*.js'
        ],
        dest: 'public/assets/js/app.js'
      }
    },
    'closure-compiler': {
      lib: {
        js: 'public/assets/js/lib.js',
        jsOutputFile: 'public/assets/js/lib.min.js',
        maxBuffer: 500,
        options: {
          // externs: [
          //   '<%= externs %>/angular-1.2.js',
          //   '<%= externs %>/jquery-1.9.js'
          // ],
          angular_pass: true,
          compilation_level: 'simple',
          warning_level: 'quiet',
          debug: false,
          create_source_map: '%outname%.map',
          source_map_format: 'V3',
          language_in: 'ECMASCRIPT5_STRICT',
          summary_detail_level: 0
        }
      },
      app: {
        js: 'public/assets/js/app.js',
        jsOutputFile: 'public/assets/js/app.min.js',
        maxBuffer: 500,
        options: {
          externs: [
            '<%= externs %>/angular-1.2.js',
            '<%= externs %>/jquery-1.9.js'
          ],
          angular_pass: true,
          compilation_level: 'simple',
          warning_level: 'quiet',
          debug: false,
          create_source_map: '%outname%.map',
          source_map_format: 'V3',
          language_in: 'ECMASCRIPT5_STRICT',
          summary_detail_level: 0
        }
      }      
    },    
    copy: {
      ico: {
        expand: true,
        cwd: 'app/assets/ico/',
        src: '**',
        dest: 'public/assets/ico/',
        flatten: true,
        filter: 'isFile'
      },
      fonts: {
        expand: true,
        cwd: 'bower_modules/bootstrap/dist/fonts/',
        src: '**',
        dest: 'public/assets/fonts/',
        flatten: true,
        filter: 'isFile'
      },
      images: {
        expand: true,
        cwd: 'app/assets/images/',
        src: '**',
        dest: 'public/assets/images/',
        flatten: false,
        filter: 'isFile'
      },
      partials: {
        expand: true,
        cwd: 'app/assets/partials/',
        src: '**',
        dest: 'public/assets/partials/',
        flatten: true,
        filter: 'isFile'
      }
    },
    less: {
      dev: {
        options: {
          compress: false
        },
        files: {
          'public/assets/css/app.css': 'app/assets/css/app.less',
        }
      },
      pro: {
        options: {
          compress: true
        },
        files: {
          'public/assets/css/app.css': 'app/assets/css/app.less',
        }
      }
    },
    phpunit: {
      classes: {
        dir: 'app/tests/' // location of the tests
      },
      options: {
        bin: 'vendor/bin/phpunit',
        colors: true
      }
    },
    watch: {
      configFiles: {
        files: [ 'Gruntfile.js', 'config/*.js' ],
        options: {
          reload: true
        }
      },
      js_lib: {
        files: ['bower_modules/**/*.js'],
        tasks: ['concat:lib'],
        options: {
          livereload: true
        }
      },
      js_app: {
        files: ['app/assets/js/app.js', 'app/assets/js/**/*.js'],
        tasks: ['concat:app'],
        options: {
          livereload: true
        }
      },
      images: {
        files: ['app/assets/images/**'],
        tasks: ['copy:images'],
        options: {
          livereload: true
        }
      },
      partials: {
        files: ['app/assets/partials/*.html'],
        tasks: ['copy:partials'],
        options: {
          livereload: true
        }
      },
      php: {
        files: ['app/*.php', 'app/models/*.php', 'app/controllers/*.php', 'app/views/**/*.html', 'app/views/**/*.php', 'app/views/*.html', 'app/views/*.php'],
        options: {
          livereload: true
        }
      },
      less: {
        files: ['app/assets/css/*.less'],
        tasks: ['less:dev'],
        options: {
          livereload: true
        }
      },
      tests: {
        files: ['app/controllers/*.php', 'app/models/*.php'],
        tasks: ['phpunit']
      }
    } // end watch

  });

  // Plugin loading
  grunt.loadNpmTasks('grunt-closure-compiler');
  grunt.loadNpmTasks('grunt-contrib-concat');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-contrib-less');
  grunt.loadNpmTasks('grunt-contrib-copy');
  grunt.loadNpmTasks('grunt-phpunit');

  // Task definition
  grunt.registerTask('build',      ['concat:lib', 'concat:app', 'closure-compiler:lib', 'closure-compiler:app', 'less:dev', 'copy']);
  grunt.registerTask('build-prod', ['concat:lib', 'concat:app', 'closure-compiler:lib', 'closure-compiler:app', 'less:pro', 'copy']);
  grunt.registerTask('default',    ['build', 'watch']);
};