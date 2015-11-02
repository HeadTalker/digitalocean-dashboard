module.exports = function(grunt){

  // Load The Plugins
  grunt.loadNpmTasks('grunt-contrib-copy');
  grunt.loadNpmTasks('grunt-csscomb');
  grunt.loadNpmTasks('grunt-contrib-cssmin');
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-contrib-watch');

  // Configure main project settings
  grunt.initConfig({

    // basic settings and info about our plugins
    pkg: grunt.file.readJSON('package.json'),

    // copy some files from bower co dist folders
    copy: {
      main: {
        files: [
          {
            cwd: 'bower_components/bootstrap/dist/css/',
            src: 'bootstrap.min.css',
            dest: 'main/css/src/',
            expand: true
          },
          {
            cwd: 'bower_components/jquery/dist/',
            src: 'jquery.js',
            dest: 'main/js/src/',
            expand: true
          },
          {
            cwd: 'bower_components/bootstrap/dist/js/',
            src: 'bootstrap.js',
            dest: 'main/js/src/',
            expand: true
          }
        ]
      }
    },

    // make our css beautiful
    csscomb: {
      dist: {
        options: {
          config: 'csscomb.json'
        },
        files: {
          'main/css/style.css': ['main/css/style.css']
        }
      }
    },

    // minify and combine our css
    cssmin: {
      combine: {
        files: {
          'main/css/dist/all.styles.min.css':
           [
            'bower_components/bootstrap/dist/css/bootstrap.min.css',
            'main/css/src/datatables.min.css',
            'main/css/src/style.css'
          ]
        }
      }
    },

    // minify and combine our javascript
    uglify: {
      combine: {
        files: {
          'main/js/dist/all.scripts.min.js':
           [
            'bower_components/jquery/dist/jquery.js',
            'bower_components/bootstrap/dist/js/bootstrap.js',
            'main/js/src/jquery.dataTables.min.js',
            'main/js/src/main.js'
          ]
        }
      }
    },

    // watch our files for changes
    watch: {
      scripts: {
        files: ['main/css/*.css', 'main/js/*.js', 'gruntfile.js'],
        tasks: ['csscomb', 'cssmin', 'uglify'],
        options: {
          spawn: false,
          event:['all']
        }
      }
    },

  });

  // Do the tasks
  grunt.registerTask('default', ['copy', 'csscomb', 'cssmin', 'uglify', 'watch']);

};
