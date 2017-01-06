'use strict';

function diff(t1, t2) {
  var strings = [];
  var strings1 = t1.split('\n');
  var strings2 = t2.split('\n');

  strings1.forEach(function (s, i) {
    j = strings2.indexOf(s);
    if (j === -1) {
      strings.push(s);
    }
  });

  return strings;
}
