<!DOCTYPE html>
<html lang="bg">
<head>
<meta charset="utf-8" />
<meta name="description" content="Best BattleShips game ever!" />
<link href="../src/img/favicon.ico" rel="shortcut icon" />

<title>Ferhan BattleShips</title>
<link rel='stylesheet' type='text/css' media='all' href='../src/css/style.css' />
<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
<?php

?>
<script>
$(document).ready(function() {

    // HERE AJAX calls to the Platform API are executed according to user actions.

    $("#betting").click(function(event){

        var requestUrl = '/betting/Platform/bet';
        $.ajax({
            type: 'GET',
            url: requestUrl,
            dataType: 'json',
            headers: {
                "X-Requested-With": "XMLHttpRequest"
            },
            success: function(data) {
                if(data.error) {
                    alert(data.error);
                    $("#result").html(data.error);
                } else {
                    alert(data);
                    $("#result").html(data);
                }
            },
            error: function(xhr, data) {
                console.log(data);
                $("#result").html(data.error);
            }
        });

        event.preventDefault();

    });

});
</script>
</head>
<body>

<?php
if (!empty($layoutParams['loadViews'])) {
    foreach ($layoutParams['loadViews'] as $view) {
        Betting\Models\ViewModel::LoadView($view, $layoutParams);
    }
}
?>

</body>
</html>