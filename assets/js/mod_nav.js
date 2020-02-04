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
        /* if (target.data('new') == 1) {
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
        } */
        var id = target.data('id');
        $.ajax({
            url: baseUrl+"/admin/navigation/delete",
            type: "post",
            data: { 'id_nav': id },
            dataType: 'json',
            timeout: 5000, // sets timeout to 5 seconds
			success:function(response) {                          		                
                console.log(response);
                if(response.error === true){
                    alert(response.messages);
                    return;
                } else {
                    target.fadeOut();
                    // update JSON
                    updateOutput($('#nestable').data('output', $('#json-output')));
                    alert(response.messages);
                }                
                
            },
            error: function(xhr, textStatus, error) {
                console.log(xhr.statusText);
                console.log(textStatus);
                console.log(error);
                alert(error);
                return;
            }
        });

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

    var addToMenu = function (name, slug, group=1) {
        var newName = name;
        var newDesc = name;
        var newSlug = slug;
        var newId = 'new-' + newIdCount;

        //POST ajax request to add menu
        $.ajax({
			url: baseUrl+"/admin/navigation/addNav",
            type: "post",
            data: { 'name': newName, 'url' : newSlug, 'description' : newDesc, 'id_groups' : group },
            dataType: 'json',
            timeout: 5000, // sets timeout to 5 seconds
			success:function(response) {                          		                
                console.log(response);
                if(response.error === true){
                    alert(response.messages);
                    return;
                } else {
                    nestableList.append(
                        '<li class="dd-item" ' +
                        'data-id="' + newId + '" ' +
                        'data-name="' + newName + '" ' +
                        'data-slug="' + newSlug + '" ' +
                        'data-new="0" ' +
                        'data-deleted="0">' +
                        '<div class="dd-handle">' + newName + '</div> ' +
                        '<a href="#" class="btn button-delete btn-danger btn-sm btn-icon pull-right" ' +
                        'data-owner-id="' + newId + '"> ' +
                        '<i class="fa fa-fw fa-times" aria-hidden="true"></i> ' +
                        '</a>' +
                        '<a href="#" class="btn button-edit btn-success btn-sm btn-icon pull-right" ' +
                        'data-owner-id="' + newId + '">' +
                        '<i class="fa fa-fw fa-pencil-alt" aria-hidden="true"></i>' +
                        '</a>' +
                        '</li>'
                    );

                    newIdCount++;
                    // update JSON
                    updateOutput($('#nestable').data('output', $('#json-output')));

                    // set events
                    $("#nestable .button-delete").on("click", deleteFromMenu);
                    $("#nestable .button-edit").on("click", editMenu);

                    alert(response.messages);
                }                
                
            },
            error: function(xhr, textStatus, error) {
                console.log(xhr.statusText);
                console.log(textStatus);
                console.log(error);
                alert(error);
                return;
            }
        });
    };

    var isUrlValid = function(url) {
        return /^(https?|s?ftp):\/\/(((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:)*@)?(((\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5]))|((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?)(:\d*)?)(\/((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)?)?(\?((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|[\uE000-\uF8FF]|\/|\?)*)?(#((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|\/|\?)*)?$/i.test(url);
    }

    $('#nestable').nestable({
        maxDepth: 5
    }).on('change', updateOutput);

    $('.addToMenu').click(function(){
        var name = $(this).attr('name');
        var getGroup = $('#menu_group').val(); 

        if(name == 'PageMenu'){
            var check = $('input[name="menu_page[]"]:checked');
            //if more than 1 chekced            
            if(check.length > 0){
                check.each(function(){
                    var getTitle = $(this).next().val();                    
                    var getId = $(this).val();
                    var getUrl = $(this).data('url');
                    //add to DOM HTML Element
                    addToMenu(getTitle, getUrl, getGroup);
                });
            };
            
        } else if(name == 'CatMenu'){
            var check = $('input[name="menu_category[]"]:checked');
            //if more than 1 chekced            
            if(check.length > 0){
                check.each(function(){
                    var getTitle = $(this).next().val();                    
                    var getId = $(this).val();
                    var getUrl = $(this).data('url');
                    //add to DOM HTML
                    addToMenu(getTitle, getUrl, getGroup);
                });
            };
        } else {
            var getName = $('input[name="menu_name_external"]').val();
            var getUrl = $('input[name="menu_external"]').val();
            //add to DOM HTML Element
            if(isUrlValid(getUrl)){
                addToMenu(getName, getUrl, getGroup)
            } else {
                alert('Please insert valid URL');
                return;
            }
        }
    });

    $("#nestable .button-delete").on("click", deleteFromMenu);
    $("#nestable .button-edit").on("click", editMenu);

    $('#menu_group').change(function(){
        var group_id = $(this).val();
        window.location = baseUrl +'/admin/navigation?group='+group_id;
    });
});