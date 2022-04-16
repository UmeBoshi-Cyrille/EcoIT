let $collectionHolder;
let $addNewItem = $('<a href="#" class="btnAdd">Add new Section</a>');
let $removeButton = $('<a href="#" class="btnAdd">Remove</a>');
let $panel = $(
  '<div class="panel panel_section"><div class="panel-heading"></div></div>'
);
let $panelBody = $('<div class="panel-body"></div>');
let $panelFooter = $('<div class="panel_footer"></div>');

$(document).ready(function () {
  // get the collectionHolder;
  $collectionHolder = $("#section_list");

  // append the add new item to the collectionHolder
  $collectionHolder.append($addNewItem);

  $collectionHolder.data("index", $collectionHolder.find(".panel").length);

  // add remove button
  $collectionHolder.find(".panel").each(function (item) {
    addRemoveButton($(this));
  });

  // handle the click
  $addNewItem.click(function (e) {
    e.preventDefault();
    // create a new form and append it to collectionHolder
    addNewForm();
  });
});

// Add new item
function addNewForm() {
  // getting the prototype
  let prototype = $collectionHolder.data("prototype");
  // get the index
  let index = $collectionHolder.data("index");

  // create the form
  let newForm = prototype;

  newForm = newForm.replace(/_name_/g, index);

  $collectionHolder.data("index", index++);

  //create the panel

  // create the panel body and append it to the form
  $panelBody.append(newForm);
  $panel.append($panelBody);

  addRemoveButton($panel);

  // append the panel to the $addNewItem
  $addNewItem.before($panel);
}

// Remove item.
function addRemoveButton($panel) {
  // create remove button

  $panelFooter.append($removeButton);

  // handle click event
  $removeButton.click(function (e) {
    e.preventDefault();
    $(e.target)
      .parents(".panel")
      .slideUp(1000, function () {
        $(this).remove();
      });
  });

  // append footer to panel
  $panel.append($panelFooter);
}
