
$(document).ready(function(){
    setTheme(localStorage.theme);

    $('#nightModeBtn, #lightModeBtn').on('click', function() {
        setTheme($(this).attr('data-theme'))
    });
    
    $('#showTrash, #itemsPerPage').on('change', function() {
        $('#searchBar').submit();
    });
    
    $('input[data-select-all]').on('change', function() {
        var inputSelector = $(this).attr('data-input-selector');
    
        if($(this).prop('checked')) {
            $(inputSelector).prop('checked', true);
        }
        else {
            $(inputSelector).prop('checked', false);
        }
    });
    
    $('#addAuthorBtn').on('click', function() {
        addAuthor();
    });
    
    $('#authorTable').on('click', '.button-delete', function() {
        removeAuthor($(this).attr('data-author'));
    });
    
    $('button.removeAuthorBtn').on('click', function() {
        var form = $(this).closest('form');
        form.find('input[type="checkbox"').prop('checked', false);

        $(this).siblings('input[name="author_id"]').prop('checked', true);
        form.submit();
    });

    $('input').each(function() {
        var label = checkForHiddenLabel($(this));

        if(!label) return;

        if($(this).prop('value') != '') label.attr('aria-hidden', false);
        else label.attr('aria-hidden', true);
    });

    $('input').on('focus', function() {
        var label = $('label[for="' + $(this).prop('name') + '"]').parent();

        if(label.length == 0) return;

        label.attr('aria-hidden', false);
    });

    $('input').on('focusout', function() {
        var label = $('label[for="' + $(this).prop('name') + '"]').parent();

        if(label.length == 0) return;

        if($(this).prop('value') != '') return;

        label.attr('aria-hidden', true);
    });

    $('button[aria-label="Close"]').on('click', function() {
        $(this).parent().remove();
    });

    $('*[data-activate-on="hover"]').on('mouseenter', function() {
        $("#" + $(this).attr('aria-controls')).attr('aria-hidden', false);
    })

    $('*[data-activate-on="hover"]').on('mouseleave', function() {
        $("#" + $(this).attr('aria-controls')).attr('aria-hidden', true);
    })
    
    /**
     * Updates buttons and checkboxes when a checkbox value changes
     */
    $('#database input[type="checkbox"]').on('change', function() {
        var selector = 'input[class~="' + $(this).prop('class') + '"]';
    
        copyChecked($(this), selector);
        updateDbButtons($('#database').attr('data-resource'));
    });
    
    /**
     * Submits form with value of associated input
     */
    $('button[data-single-submit]').on('click', function() {
        var inputSelector = '.' + $(this).attr('data-input-selector');
        var form = '#' + $(this).prop('form');
    
        $('#database input[type="checkbox"]').prop('checked', false);
        $('#database ' + inputSelector).prop('checked', true);
        $(form).submit();
    });
    
    /**
     * Updates access level of user
     */
    $('button[data-update-access-button]').on('click', function() {
        var inputSelector = '.' + $(this).attr('data-input-selector');
        var accessLevel = $(this).attr('data-access-level');
        var form = '#' + $(this).attr('data-form');
    
        $('#database input[type="checkbox"]').prop('checked', false);
        $('#database ' + inputSelector).prop('checked', true);
    
        var levelInput = document.createElement('input');
        levelInput.type = 'text';
        levelInput.name = 'level';
        levelInput.value = accessLevel;
    
        $(form).append(levelInput);
        $(form).submit();
    })
    
    $('button[aria-expanded]').on('click', function() {
        var $popUp = $('#' + $(this).attr('aria-controls'));
    
        if($popUp.attr('aria-hidden') == 'true') {
            $(this).attr('aria-expanded', true);
            $popUp.attr('aria-hidden', false);

            $(this).children('.expanded').addClass('hidden')
            $(this).children('.collapsed').removeClass('hidden')
        }
        else {
            $(this).attr('aria-expanded', false);
            $popUp.attr('aria-hidden', true);
            $(this).children('.collapsed').addClass('hidden')
            $(this).children('.expanded').removeClass('hidden')
        }
    })
});

function setTheme(theme) {
    var currentTheme = localStorage.theme;

    $('html').removeClass(currentTheme);
    $('html').addClass(theme);

    localStorage.theme = theme;
}

function checkForHiddenLabel(input) {
    var label = $('label[for="' + input.prop('name') + '"]').parent();

    if(label.length == 0)  return null;

    return label;
}

/**
 * Updates database action buttons with respective text
 */
function updateDbButtons(resource) {
    var selected = $('input[data-resource="'+ resource + '"]:checked').length;
    
    if(selected == 0) {
        $('button[data-multi-select="' + resource + '"]').each(function() {
            $(this).find('span').html(
                $(this).attr('data-action') + ' ' + resource + '/s'
            )
        })
        return;
    }

    $('button[data-multi-select="'+ resource + '"]').each(function() {
        $(this).find('span').html(
            $(this).attr('data-action') + 
            ' <strong><u>' + selected + '</u></strong> ' + 
            resource + '/s'
        )
    })
}

/**
 * Submits a form with only one checkbox active
 * @param {string} input class of checkboxes
 * @param {string} form ID of form to submit
 */
function submitOne(input, form) {
    $('.' + input).prop('checked', true);
    $('#' + form).submit();
}

/**
 * Copies 'checked' value from original element to matches from selector
 * @param {HTMLElement} origin
 * @param {string} selector 
 */
function copyChecked(origin, selector) {
    if($(origin).prop('checked')) {
        $(selector).prop('checked', true);
    }
    else {
        $(selector).prop('checked' , false);
    }
}

function clearInput(element) {
    if(element.prop('type', 'text') || ('type', 'number')) {
        element.val('');
    }
}

function addAuthor() {
    var authorCount = $('#authorTable .author-row').length;
    var row = createAuthorRow(authorCount);

    $('#authorTable').append(row);
}

function createAuthorRow(index) {
    var html = '';
    html +=
        '<tr class="author-row" id="author' + index + '">' +
            '<td class="author-number p-4 text-text-light dark:text-text-dark">' +
                (index + 1) +
            '</td>' +
            '<td>' +
                '<div class="flex flex-row justify-end gap-3 px-2">' +
                    '<input ' +
                        'class="author-first-name w-80 h-10 p-2 text-base text-left border-input-border-light dark:border-input-border-dark dark:bg-transparent dark:text-text-dark border-2 rounded-xl  dark:placeholder:text-text-dark !border-0 !border-b-2 !rounded-none w-full"' +
                        'type="text"' + 
                        'name="authors[' + index + '][first_name]"' + 
                        'placeholder="First Name"' + 
                        'required="required">' +
                '</div>' +                      
            '</td>' +
            '<td>' +
                '<div class="flex flex-row justify-end gap-3 px-2">' +
                    '<input ' +
                        'class="author-last-name w-80 h-10 p-2 text-base text-left border-input-border-light dark:border-input-border-dark dark:bg-transparent dark:text-text-dark border-2 rounded-xl  dark:placeholder:text-text-dark !border-0 !border-b-2 !rounded-none w-full"' +
                        'type="text"' +
                        'name="authors[' + index + '][last_name]"' +
                        'placeholder="Last Name"' +
                        'required="required">' +
                '</div>' +                        
            '</td>' +
                '<td>' +
                    '<button class="button button-delete flex flex-row gap-1 h-fit text-base rounded-xl"' +
                        'type="button"' +
                        'data-author="author' + index + '">' +
                        '<svg class="w-6 h-6 text-inherit">' +
                            '<use width="100%" height="100%" href="https://nwssuccisarchive.online/icons/icons.svg#gg-close"></use>' +
                        '</svg>' +
                    '</button>' +                    
                '</td>' +
            '</tr>'
    ;

    return html;
}

function removeAuthor(id) {
    let authorRow = $('#' + id);

    if(!checkIfLastAuthor()) {
        authorRow.remove();
        refreshAuthors();
        return;
    }

    authorRow.find('input').val('');
    return;
}

function checkIfLastAuthor() {
    if($('#authorTable').find('.author-row').length == 1) {
        return true;
    }

    return false;
}

function refreshAuthors() {
    let index = Number(0);

    $('#authorTable').find('.author-row').each(function() {

        $(this).prop('id', 'author' + index);

        $(this).find('.author-number').html(index + 1);

        $(this).find('.author-first-name')
            .prop('name', 'authors[' + index + '][first_name]');

        $(this).find('.author-last-name')
            .prop('name', 'authors[' + index + '][last_name]');

        $(this).find('.button-delete')
            .attr('data-author', $(this).prop('id'));

        index++;
    });
}