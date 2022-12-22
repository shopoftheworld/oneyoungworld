Drupal.behaviors.layoutContentCodeMirror = {
  hasExecuted: false,
  attach: function (content) {
    if (this.hasExecuted) {
      return;
    }

    var textarea = content.getElementById("edit-layout");
    var codeMirror = CodeMirror.fromTextArea(
      textarea,
      {
        lineNumbers: true,
        mode: "yaml",
        tabSize: 2,
        theme: "isotope",
        extraKeys: {
          // Setting for using spaces instead of tabs - https://github.com/codemirror/CodeMirror/issues/988
          Tab: function (cm) {
            var spaces = Array(cm.getOption('indentUnit') + 1).join(' ');
            cm.replaceSelection(spaces, 'end', '+element');
          },
          // On 'Escape' move to the next tabbable input.
          // @see http://bgrins.github.io/codemirror-accessible/
          Esc: function (cm) {
            // Must show and then textarea so that we can determine
            // its tabindex.
            var textarea = $(cm.getTextArea());
            $(textarea).show().addClass('visually-hidden');
            var $tabbable = $(':tabbable');
            var tabindex = $tabbable.index(textarea);
            $(textarea).hide().removeClass('visually-hidden');

            // Tabindex + 2 accounts for the CodeMirror's iframe.
            $tabbable.eq(tabindex + 2).focus();
          }
        }
      }
    );

    console.log(codeMirror);

    this.hasExecuted = true;
  }
};
