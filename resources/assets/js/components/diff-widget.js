var angular = require('angular')
var template = require('./diff-widget.template.html')

function DiffWidgetController () {
}

angular
  .module('diffApp')
  .component('diffWidget', {
    template: template,
    controller: DiffWidgetController
  })
