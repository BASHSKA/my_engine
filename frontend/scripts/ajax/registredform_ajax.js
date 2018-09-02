function sendAjaxForm(ajax_form, url) {
    $.ajax({
        url:     url, //url страницы (action_ajax_form.php)
        type:     "POST", //метод отправки
        dataType: "html", //формат данных
        data: $("#"+ajax_form).serialize(),  // Сеарилизуем объект
        success: function(response) { //Данные отправлены успешно
            result = $.parseJSON(response);
            alert(result);
        },
        error: function(response) { // Данные не отправлены
            alert('Не удалось доставить запрос до сервера, попробуйте позже');
        }
    });
}

$( document ).ready(function() {
    $("#btn").click(
        function(){
            sendAjaxForm('ajax_form', 'registration.php');
            return false;
        }
    );
});