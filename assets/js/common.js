/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
//function generateCombo(j, object, first) {
//    var options = '';
//    if (first == 1) {
//        options += '<option value="0">--Pilih--</option>';
//    } else if (first == 2) {
//        options += '<option value="">--Semua--</option>';
//    }
//    for (var i = 0; i < j.length; i++) {
//        options += '<option ' + j[i].selected + ' value="' + j[i].id + '">' + j[i].nama + '</option>';
//    }
//    object.html(options);
//}

function loadCombo(url, data, object, pilih) {
    $.ajax({
        url: url,
        dataType: 'json',
        type: 'POST',
        data: data,
        async: true,
        success: function (json) {
            generateCombo(json, object, pilih);
        }
    });
}

function makeSublist(parent, child, json, isSubselectOptional, isAllSubselectOptional, childVal)
{
    var parentValue = $('#' + parent).val();
    if (isAllSubselectOptional)
        $('#' + child).prepend("<option value='all'> -- Semua -- </option>");
    if (isSubselectOptional)
        $('#' + child).prepend("<option value='none'> -- Pilih -- </option>");
    $.ajax({
        url: json,
        dataType: 'json',
        type: 'POST',
        data: "data=" + parentValue + "&selected=" + childVal,
        async: false,
        success: function (j) {
            options = "";
            for (var i = 0; i < j.length; i++) {
                options += '<option ' + j[i].selected + ' value="' + j[i].id + '">' + j[i].nama + '</option>';
            }
            $('#' + child).append(options);
        }
    });

    $('#' + parent).change(function () {
        var parentValue = $('#' + parent).val();
        $('#' + child).html("");
        if (isAllSubselectOptional)
            $('#' + child).prepend("<option value='all'> -- Semua -- </option>");
        if (isSubselectOptional)
            $('#' + child).prepend("<option value='none'> -- Pilih -- </option>");
        $.ajax({
            url: json,
            dataType: 'json',
            type: 'POST',
            data: "data=" + parentValue + "&selected=" + childVal,
            async: false,
            success: function (j) {
                options = "";
                for (var i = 0; i < j.length; i++) {
                    options += '<option ' + j[i].selected + ' value="' + j[i].id + '">' + j[i].nama + '</option>';
                }
                $('#' + child).append(options);
            }
        });
        $('#' + child).trigger("change");
        $('#' + child).focus();
    });
}

function postIt(url, data) {
    $('body').append($('<form/>', {
        id: 'jQueryPostItForm',
        method: 'POST',
        action: url
    }));

    for (var i in data) {
        $('#jQueryPostItForm').append($('<input/>', {
            type: 'hidden',
            name: i,
            value: data[i]
        }));
    }

    $('#jQueryPostItForm').submit();
}

new function ($) {
    $.fn.setCursorPosition = function (pos) {
        if ($(this).get(0).setSelectionRange) {
            $(this).get(0).setSelectionRange(pos, pos);
        } else if ($(this).get(0).createTextRange) {
            var range = $(this).get(0).createTextRange();
            range.collapse(true);
            range.moveEnd('character', pos);
            range.moveStart('character', pos);
            range.select();
        }
    }
}(jQuery);