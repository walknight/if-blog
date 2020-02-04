$(document).ready(function(){
    var getUrl = window.location;
    var baseUrl = getUrl.protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];
    var nestableList = $("#nestable > .dd-list");
    var newIdCount = 1;

    var updateOutput = function (e) {
        var list = e.length ? e : $(e.target),
            output = list.data('output');
        if (window.JSON) {
            if (output) {
            output.val(window.JSON.stringify(list.nestable('serialize')));
            }
        } else {
            alert('JSON browser support required for this page.');
        }
    };

    var deleteFromMenuHelper = function (target) {
        if (target.data('new') == 1) {
            // if it's not yet saved in the database, just remove it from DOM
            target.fadeOut(function () {
                target.remove();
                updateOutput($('#nestable').data('output', $('#json-output')));
            });
        } else {
            // otherwise hide and mark it for deletion
            target.appendTo(nestableList); // if children, move to the top level
            target.data('deleted', '1');
            target.fadeOut();
        }
    };

    var deleteFromMenu = function(e){
        var targetId = $(this).data('owner-id');
        var target = $('[data-id="' + targetId + '"]');

        var result = confirm("Delete " + target.data('name') + " and all its subitems ?");
        if (!result) {
            return;
        }
        // Remove children (if any)
        target.find("li").each(function () {
            deleteFromMenuHelper($(this));
        });

        // Remove parent
        deleteFromMenuHelper(target);

        // update JSON
        updateOutput($('#nestable').data('output', $('#json-output')));
    }

    var editMenu = function(e){
        var targetId = $(this).data('owner-id');
        var target = $('[data-id="' + targetId + '"]');
    }

    var addToMenu = function (name, slug) {
        var newName = name;
        var newSlug = slug;
        var newId = 'new-' + newIdCount;

        nestableList.append(
            '<li class="dd-item" ' +
            'data-id="' + newId + '" ' +
            'data-name="' + newName + '" ' +
            'data-slug="' + newSlug + '" ' +
            'data-new="1" ' +
            'data-deleted="0">' +
            '<div class="dd-handle">' + newName + '</div> ' +
            '<span class="button-delete btn btn-danger btn-xs pull-right" ' +
            'data-owner-id="' + newId + '"> ' +
            '<i class="fa fa-times" aria-hidden="true"></i> ' +
            '</span>' +
            '<span class="button-edit btn btn-success btn-xs pull-right" ' +
            'data-owner-id="' + newId + '">' +
            '<i class="fa fa-pencil" aria-hidden="true"></i>' +
            '</span>' +
            '</li>'
        );

        newIdCount++;

        // update JSON
        updateOutput($('#nestable').data('output', $('#json-output')));

        // set events
        $("#nestable .button-delete").on("click", deleteFromMenu);
        $("#nestable .button-edit").on("click", editMenu);
    };

    $('#nestable').nestable({
        maxDepth: 5
    }).on('change', updateOutput);

    $('.addToMenu').click(function(){
        var name = $(this).attr('name');
        if(name == 'PageMenu'){
            var checkboxname = $('#'+name).attr('name');
            $('input[name="'+checkboxname+'"]').each(function(){
                
            });
        } else if(name == 'CatMenu'){
            console.log($('#'+name).val());
        } else {
            console.log($('#'+name).val());
        }
    });

    $("#nestable .button-delete").on("click", deleteFromMenu);
    $("#nestable .button-edit").on("click", editMenu);



    
   
});