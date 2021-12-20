$('#btnDeleteGame').click(function () {
    const checked = $('input[name=checked-donut]:checked');

    request = $.ajax({
        url: 'handler/delete.php',
        type: 'post',
        data: {'id': checked.val()}
    });


    request.done(function (data, textStatus, qXHR) {
        if(textStatus === 'success'){
            checked.closest('tr').remove();
            alert("Game is deleted");
        } else {
            alert("Game is not deleted");
        }
    });

    request.fail(function (jqXHR, textStatus, errorThrown) {
        console.error('Error occurred: ' + textStatus, errorThrown);
    });
});

$('#addGameForm').submit(function () {
    event.preventDefault();
    const $form = $(this);
    const serializedData = $form.serialize();

    request = $.ajax({
        url: 'handler/add.php',
        type: 'post',
        data: serializedData
    });

    request.done(function (response, textStatus, jqXHR) {
        if (textStatus === 'success') {
            alert('Game is added :)'); 
            location.reload(true);
        } else {
            alert('Game is not added :(');
            location.reload(true);
        }
    });

    request.fail(function (jqXHR, textStatus, errorThrown) {
        console.error('Error occurred: ' + textStatus, errorThrown);
    });
});

$('#btnEditGame').click(function () {
    const checked = $('input[name=checked-donut]:checked');

    request = $.ajax({
        url: 'handler/get.php',
        type: 'post',
        data: {'id': checked.val()},
        dataType: 'json'
    });

    request.done(function (response, textStatus, jqXHR) {
        $('#gameNameId').val(response[0]['name']);
        $('#gameTypeId').val(response[0]['type'].trim());
        $('#gamePriceId').val(response[0]['price'].trim());
        $('#id').val(checked.val());
    });

    request.fail(function (jqXHR, textStatus, errorThrown) {
        console.error('Error occurred: ' + textStatus, errorThrown);
        
    });

});

$('#editGameForm').submit(function () {
    event.preventDefault();
    const $form = $(this);
    const serializedData = $form.serialize();

    request = $.ajax({
        url: 'handler/update.php',
        type: 'post',
        data: serializedData
    });

    request.done(function (response, textStatus, jqXHR) {
        if (textStatus === 'success') {
            alert('Game is edited!'); 
            location.reload(true);
        } else {
            alert('Game is not edited!');
            location.reload(true);
        }
    });
    
    request.fail(function (jqXHR, textStatus, errorThrown) {
        console.error('The following error occurred: ' + textStatus, errorThrown);
    });
});



