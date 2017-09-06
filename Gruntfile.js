module.exports = function(grunt) {

  // Project configuration.
  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),
	 
	 // 
	 jshint: {
      files: [],
      options: {
        globals: {
          jQuery: true
        }
      }
    },
	  
	//
  uglify: {
      options: {
        banner: '/*! <%= pkg.name %> <%= grunt.template.today("yyyy-mm-dd") %> */\n'
      },
      build: {
        src: 'src/<%= pkg.name %>.js',
        dest: 'build/<%= pkg.name %>.min.js'
      }
    },
	  
	//
	sass: {
        options: {
            sourceMap: true
        },
        dist: {
			options: {
                    outputStyle: 'expand'
                },
            files: {
                'style.css': 'sass/main.scss'
			}
        }
    },
	  
	//
	watch: {
      files: ['<%= jshint.files %>', 
			  'Gruntfile.js',
			  'sass/**/*.scss'
			 ],
      tasks: ['sass']
    }
	  
  });

  // Load the plugin that provides the "uglify" task.
  grunt.loadNpmTasks('grunt-contrib-jshint');
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-sass');
  grunt.loadNpmTasks('grunt-contrib-watch');

  // Default task(s).
  grunt.registerTask('default', ['uglify','sass','jshint']);
};