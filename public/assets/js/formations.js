let $collectionHolderSection;
let $addNewSection = $(
  '<button class="btn btnAddSection key_bg2">Add Section</button>'
);

$(document).ready(function () {
  $collectionHolderSection = $("#section_list");
  $collectionHolderSection.append($addNewSection);
  $collectionHolderSection.data(
    "index",
    $collectionHolderSection.find(".panel_section").length
  );

  $collectionHolderSection.find(".panel_section").each(function () {
    $addRemoveSection($(this));
  });

  $addNewSection.click(function (e) {
    e.preventDefault();
    addNewSection();
  });
});

function addNewSection() {
  let prototype = $collectionHolderSection.data("prototype");
  let index = $collectionHolderSection.data("index");
  let newForm = prototype;

  newForm = newForm.replace(/_sec_/g, index);

  $collectionHolderSection.data("index", index++);

  let $panelSection = $(
    '<div class="panel_section panel_sectionWrap key_bg2"><div class="panel_heading"></div></div>'
  );

  let $panelBody = $('<div class="panel_body"></div>').append(newForm);

  $panelSection.append($panelBody);

  addRemoveSection($panelSection);

  $addNewSection.before($panelSection);
}

/**
 * adds a remove button to the panel that is passed in the parameter
 * @param $panelSection
 */
function addRemoveSection($panelSection) {
  // create remove button
  let $removeButton = $(
    '<button class="btn btnRemoveSection key_bg3"></button>'
  );
  let $imageDelete = $('<img src="" alt="icone ajouter" title="icon by : ">');
  $imageDelete.attr("src", "../../assets/storage/icons/corbeille.png");
  $removeButton.append($imageDelete);

  // appending the removebutton to the panel footer
  let $panelFooter = $('<div class="panel_footer key_bg2"></div>').append(
    $removeButton
  );

  // handle the click event of the remove button
  $removeButton.click(function (e) {
    e.preventDefault();
    // gets the parent of the button that we clicked on "the panel" and animates it
    // after the animation is done the element (the panel) is removed from the html
    $(e.target)
      .parents(".panel_section")
      .slideUp(1000, function () {
        $(this).remove();
      });
  });
  // append the footer to the panel
  $panelSection.append($panelFooter);
}
