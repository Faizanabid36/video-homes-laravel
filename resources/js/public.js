try {
    window.Popper = require('popper.js').default;
    window.$ = window.jQuery = require('jquery');
    require('jquery-ui');

    require('bootstrap');
    require('bootstrap-select');
    require('mediaelement');

    $('#findapro').submit(function(e) {
        e.preventDefault();
        $(this).attr("action",location.toString()+"/"+$( this ).find("option:selected")).submit();
    })
} catch (e) {}
