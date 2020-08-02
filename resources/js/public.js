try {
    window.Popper = require('popper.js').default;
    window.$ = window.jQuery = require('jquery');
    require('jquery-ui');

    require('bootstrap');
    require('bootstrap-select');
    require('mediaelement');

    $('#findaprobtn').click(function(e) {
        let action = window.location.toString()+"/"+$( this ).find("option:selected").val();
        $("#findapro").attr("action",action).submit();
        e.preventDefault();
    })
} catch (e) {}
