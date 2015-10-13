module.exports = function(grunt){

  // Configure main project settings
  grunt.initConfig({

    // basic settings and info about our plugins
    pkg: grunt.file.readJSON('package.json'),

    // css comb
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

    // cssmin
    cssmin: {
      combine: {
        files: {
          'main/css/all.styles.min.css':
           [
            'bower_components/bootstrap/dist/css/bootstrap-theme.min.css',
            'bower_components/bootstrap/dist/css/bootstrap.min.css',
            'main/css/style.css'
          ]
        }
      }
    },

    // uglify
    uglify: {
      combine: {
        files: {
          'main/js/all.scripts.min.js':
           [
            'bower_components/jquery/dist/jquery.js',
            'bower_components/bootstrap/dist/js/bootstrap.js',
            'main/js/jquery.dataTables.min.js',
            'main/js/main.js'
          ]
        }
      }
    },

    watch: {
      scripts: {
        files: ['main/css/style.css', 'main/js/main.js'],
        tasks: ['csscomb', 'cssmin', 'uglify'],
        options: {
          spawn: false,
          event:['all']
        },
      },
    },

  });

  // Load The Plugins
  grunt.loadNpmTasks('grunt-csscomb');
  grunt.loadNpmTasks('grunt-contrib-cssmin');
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-contrib-watch');

  // Do the tasks
  grunt.registerTask('default', ['csscomb', 'cssmin', 'uglify', 'watch']);

};
