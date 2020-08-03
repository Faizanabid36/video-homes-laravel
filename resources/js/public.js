try {
    window.Popper = require('popper.js').default;
    window.$ = window.jQuery = require('jquery');
    require('jquery-ui');

    require('bootstrap');
    require('bootstrap-select');
    require('mediaelement');

    $('#findaprobtn').click(function(e) {
        let form = $( this).parent('form');
        form.attr("action",form.attr("action")+"/"+form.find("option:selected").val()).submit();
        e.preventDefault();
    })
    $(".copylink").click(function (e) {
       console.log(e);
    });
} catch (e) {}
