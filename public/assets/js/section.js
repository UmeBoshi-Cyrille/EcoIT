let $collectionLessonHolder;
let $addNewLesson = $('<a href="#" class="btnAdd">Add new</a>');

$(document).ready(function () {
  $collectionLessonHolder = $("#lesson_list"); // get the collectionLessonHolder;
  $collectionLessonHolder.append($addNewLesson); // append the add new Lesson to the collectionLessonHolder

  $collectionLessonHolder.data(
    "index",
    $collectionLessonHolder.find(".panel_lesson").length
  );

  // add remove button
  $collectionLessonHolder.find(".panel_lesson").each(function (Lesson) {
    addRemoveButton($(this));
  });

  // handle the click
  $addNewLesson.click(function (e) {
    e.preventDefault();
    addNewLessonForm(); // create a new form and append it to collectionLessonHolder
  });
});

// Add new Lesson
function addNewLessonForm() {
  let prototype = $collectionLessonHolder.data("prototype"); // getting the prototype
  let index = $collectionLessonHolder.data("index"); // get the index
  let newForm = prototype; // create the form

  newForm = newForm.replace(/_name_/g, index);
  $collectionLessonHolder.data("index", index++);

  //create the panel
  let $panel = $(
    '<div class="panel_lesson panel-lesson_warning"><div class="panel-lesson_heading"></div></div>'
  );

  // create the panel body and append it to the form
  let $panelBody = $('<div class="panel-lesson_body"></div>').append(newForm);
  $panel.append($panelBody);

  addRemoveButton($panel);

  // append the panel to the $addNewLesson
  $addNewLesson.before($panel);
}

// Remove Lesson.
function addRemoveButton($panel) {
  // create remove button
  var $removeButton = $('<a href="#" class="btnAdd">Remove</a>');

  var $panelFooter = $('<div class="panel-lesson_footer"></div>').append(
    $removeButton
  );

  // handle click event
  $removeButton.click(function (e) {
    e.preventDefault();
    $(e.target)
      .parents(".panel_lesson")
      .slideUp(1000, function () {
        $(this).remove();
      });
  });

  // append footer to panel
  $panel.append($panelFooter);
}
