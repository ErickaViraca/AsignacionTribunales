/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
  /*      $(document).on('click', '#activity-index-link', (function() {
        $.get($(this).data('url'),function (data) {
        $('.modal-body').html(data);
         $('#ciudad-id_pais').val($('#pais_id').val());
        $('#modal').modal();});
        }));*/
// para validar el dato de checkBox
$(document).ready(function() {
    $("#submit").on("click", function() {
        var condiciones = $("#selecionar").is(":checked");
        if (!condiciones) {
            alert("Debe seleccionar al menos tres tribunales");
            event.preventDefault();
        }
    });
});