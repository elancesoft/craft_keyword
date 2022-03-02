module.exports = function(grunt) {
  grunt.initConfig({
      pkg: grunt.file.readJSON('package.json')
  });
  grunt.registerTask('serve', [
    'php:dist',
    'watch'
]);

grunt.registerTask('default', ['uglify', 'buildcss', 'serve', 'watch']);
};
