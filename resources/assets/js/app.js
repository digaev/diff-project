
/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap')
var $ = require('jquery')

$(function () {
  'use strict'

  var modifiedHoverHandler = function (p, s) {
    p.hover(function () {
      p.text(s.oldData)
    }, function () {
      p.text(s.data)
    })
  }

  var form = $('#diff-form')
  form.submit(function (e) {
    $.post(form.attr('action'), form.serialize(), function (data) {
      var div = $('#difference')
      div.empty()

      data.forEach(function (s) {
        var p = $('<p>' + s.data + '</p>')

        switch (s.type) {
          case 1: // deleted
            p.addClass('red')
            break
          case 2: // modified
            p.addClass('yellow')
            modifiedHoverHandler(p, s)
            break
          case 3: // inserted
            p.addClass('green')
            break
        }

        div.append(p)
      })
    })

    e.preventDefault()
    return false
  })
})
