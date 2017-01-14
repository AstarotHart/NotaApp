  $(document).ready(function(){
    
    $(document).on('click', '#getUser', function(e){
        
        e.preventDefault();
        
        var uid = $(this).data('id'); // get id of clicked row
        
        $('#dynamic-content').hide(); // hide dive for loader
        $('#modal-loader').show();  // load ajax loader
        
        $.ajax({
            url: 'getuser.php',
            type: 'POST',
            data: 'id='+uid,
            dataType: 'json'
        })
        .done(function(data){
            console.log(data);
            $('#dynamic-content').hide(); // hide dynamic div
            $('#dynamic-content').show(); // show dynamic div
            $('#id_alumno').html(data.id_alumno);
            $('#nombres').html(data.nombres);
            $('#primer_apellido').html(data.primer_apellido);
            $('#segundo_apellido').html(data.segundo_apellido);
            $('#id_sede').html(data.id_sede);
      $('#id_grado').html(data.id_grado);
      $('#desplazado').html(data.desplazado);
      $('#repitente').html(data.repitente);
      $('#nombre_acudiente').html(data.nombre_acudiente);
      $('#apellidos_acudiente').html(data.apellidos_acudiente);
      $('#telefono_acudiente').html(data.telefono_acudiente);
      $('#fecha_matricula').html(data.fecha_matricula);
            $('#modal-loader').hide();    // hide ajax loader
        })
        .fail(function(){
            $('.modal-body').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
        });
        
    });
    
});