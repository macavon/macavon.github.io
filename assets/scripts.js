(function() {
  var fix_height;

  fix_height = function() {
    var left_height, main_height;
    left_height = $('.leftpane').height();
    main_height = $('#main').height();
    if (left_height > main_height) {
      return $('#main').height(left_height + 8);
    }
  };

  $(function() {
    return fix_height();
  });

}).call(this);
