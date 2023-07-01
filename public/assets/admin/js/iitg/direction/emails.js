// this variable is the list in the dom, it's initiliazed when the document is ready
var $collectionHolderEmail;
// the link which we click on to add new items
var $addNewEmail = $('<a href="#" class="btn btn-info">Add new e-mail</a>');
// when the page is loaded and ready
$(document).ready(function () {
    // get the collectionHolder, initilize the var by getting the list;
    $collectionHolderEmail = $('#email_list');
    // append the add new item link to the collectionHolder
    $collectionHolderEmail.append('<br/>',$addNewEmail);
    // add an index property to the collectionHolder which helps track the count of forms we have in the list
    $collectionHolderEmail.data('index', $collectionHolderEmail.find('.panel').length)
    // finds all the panels in the list and foreach one of them we add a remove button to it
    // add remove button to existing items
    $collectionHolderEmail.find('.panel').each(function () {
        // $(this) means the current panel that we are at
        // which means we pass the panel to the addRemoveButtonEmail function
        // inside the function we create a footer and remove link and append them to the panel
        // more informations in the function inside
        addRemoveButtonEmail($(this));
    });
    // handle the click event for addNewItem
    $addNewEmail.click(function (e) {
        // preventDefault() is your  homework if you don't know what it is
        // also look up preventPropagation both are usefull
        e.preventDefault();
        // create a new form and append it to the collectionHolder
        // and by form we mean a new panel which contains the form
        addNewFormEmail();
    })
});
/*
 * creates a new form and appends it to the collectionHolder
 */
function addNewFormEmail() {
    // getting the prototype
    // the prototype is the form itself, plain html
    var prototype = $collectionHolderEmail.data('prototype');
    // get the index
    // this is the index we set when the document was ready, look above for more info
    var index = $collectionHolderEmail.data('index');
    // create the form
    var newForm = prototype;
    // replace the __name__ string in the html using a regular expression with the index value
    newForm = newForm.replace(/__name__/g, index);
    // incrementing the index data and setting it again to the collectionHolder
    $collectionHolderEmail.data('index', index+1);
    // create the panel
    // this is the panel that will be appending to the collectionHolder
    var $panel = $('<div class="panel panel-warning border bg-info-alt"><div class="panel-heading"><strong>Email '+$collectionHolderEmail.data('index')+'</strong></div></div>');
    // create the panel-body and append the form to it
    var $panelBody = $('<div class="panel-body"></div>').append(newForm);
    // append the body to the panel
    $panel.append($panelBody);
    // append the removebutton to the new panel
    addRemoveButtonEmail($panel);
    // append the panel to the addNewItem
    // we are doing it this way to that the link is always at the bottom of the collectionHolder
    $addNewEmail.before($panel,'<br/>');
}

/**
 * adds a remove button to the panel that is passed in the parameter
 * @param $panel
 */
function addRemoveButtonEmail ($panel) {
    // create remove button
    var $removeButtonEmail = $('<a href="#" class="btn btn-danger">Remove</a>');
    // appending the removebutton to the panel footer
    var $panelFooter = $('<div class="panel-footer"></div>').append($removeButtonEmail);
    // handle the click event of the remove button
    $removeButtonEmail.click(function (e) {
        e.preventDefault();
        // gets the parent of the button that we clicked on "the panel" and animates it
        // after the animation is done the element (the panel) is removed from the html
        $(e.target).parents('.panel').slideUp(1000, function () {
            $(this).remove();
        })
    });
    // append the footer to the panel
    $panel.append($panelFooter);
}