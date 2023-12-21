$(document).ready(function(){
    buscar_pre();
    var funcion;
    var edit=false;
    $('#form-crear-presentacion').submit(e=>{
        let nombre_presentacion = $('#nombre-presentacion').val();
        let id_editado = $('#id_editar_pre').val();
        if(edit==false){
            funcion='crear';
        }else{
            funcion='editar';
        }
        $.post('../controlador/PresentacionController.php',{nombre_presentacion,id_editado,funcion},(response)=>{
           if(response=='add'){
            $('#add-pre').hide("slow");
            $('#add-pre').show(1000);
            $('#add-pre').hide(2000);
            $('#form-crear-presentacion').trigger("reset");
            buscar_pre();
           }
           if(response=='noadd'){
            $('#noadd-pre').hide("slow");
            $('#noadd-pre').show(1000);
            $('#noadd-pre').hide(2000);
            $('#form-crear-presentacion').trigger("reset");
           }
           if(response=='edit'){
            $('#edit-pre').hide("slow");
            $('#edit-pre').show(1000);
            $('#edit-pre').hide(2000);
            $('#form-crear-presentacion').trigger("reset");
            buscar_pre();
           }
           edit==false;
        })
        e.preventDefault();
    });

    function buscar_pre(consulta){
        funcion = 'buscar';
        $.post('../controlador/PresentacionController.php',{consulta,funcion},(response)=>{
            const presentaciones=JSON.parse(response);
            let template='';
            presentaciones.forEach(presentacion=>{
                template+=`
                  <tr preId="${presentacion.id}" preNombre="${presentacion.nombre}">
                       <td>
                         <button class="editar-pre btn btn-success" title="Editar" type="button" data-toggle="modal" data-target="#crearpresentacion">
                              <i class="fas fa-pencil-alt"></i>
                         </button>
                         <button class="borrar-pre btn btn-danger" title="Eliminar">
                              <i class="fas fa-trash"></i>
                         </button>
                      </td>
                      <td>${presentacion.nombre}</td>
                  </tr>
                `;
            });
            $('#presentaciones').html(template);
        })
    }

    $(document).on('keyup','#buscar-presentacion',function(){
        let valor = $(this).val();
        if(valor!=''){
           buscar_pre(valor);
        }else{
           buscar_pre();
        }
    })


    $(document).on('click','.borrar-pre',(e)=>{
         funcion="borrar";
         const elemento = $(this)[0].activeElement.parentElement.parentElement;
         const id = $(elemento).attr('preId');
         const nombre = $(elemento).attr('preNombre');
         const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
              confirmButton: "btn btn-success",
              cancelButton: "btn btn-danger mr-1"
            },
            buttonsStyling: false
          });
          swalWithBootstrapButtons.fire({
            title: "Estas seguro de Eliminar "+nombre+"?",
            text: "No podras revertir la acción a realizar!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Si, borrar!",
            cancelButtonText: "No, cancelar!",
            reverseButtons: true
          }).then((result) => {
            if (result.isConfirmed) {
               $.post('../controlador/PresentacionController.php',{id,funcion},(response)=>{
                  edit==false;
                  if(response=='borrado'){
                     swalWithBootstrapButtons.fire({
                        title: "Borrado!",
                        text: 'La Presentación de '+nombre+' ha sido eliminado!',
                        icon: "success"
                      });
                      buscar_pre();
                  }else{
                     swalWithBootstrapButtons.fire({
                        title: "No se pudo Eliminar!",
                        text: 'La Presentación de '+nombre+' no se ha podido borrar, esta en uso en un Producto!',
                        icon: "error"
                      });
                  }
               })
            } else if (result.dismiss === Swal.DismissReason.cancel) {
              swalWithBootstrapButtons.fire({
                title: "Cancelado",
                text: 'La Presentación de '+nombre+' no ha sido eliminado!',
                icon: "error"
              });
            }
          });
      })

      $(document).on('click','.editar-pre',(e)=>{
         const elemento = $(this)[0].activeElement.parentElement.parentElement;
         const id = $(elemento).attr('preId');
         const nombre = $(elemento).attr('preNombre');
         $('#id_editar_pre').val(id);
         $('#nombre-presentacion').val(nombre); 
         edit=true;
      })

});