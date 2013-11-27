$(document).ready(function(){
    $(".opt_delete_account a").click(function(){
        $("#dialog-delete-account").dialog('open');
    });

    $("#dialog-delete-account").dialog({
        autoOpen: false,
        modal: true,
        buttons: [
            {
                text: bender_black.langs.delete,
                click: function() {
                    window.location = bender_black.base_url + '?page=user&action=delete&id=' + bender_black.user.id  + '&secret=' + bender_black.user.secret;
                }
            },
            {
                text: bender_black.langs.cancel,
                click: function() {
                    $(this).dialog("close");
                }
            }
        ]
    });
});