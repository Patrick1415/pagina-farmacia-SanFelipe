$(document).ready(function(){
    buscar_laboratorio();
    var funcion;
    var edit=false;
    $('#form-crear-laboratorio').submit(e=>{
        let nombre_laboratorio = $('#nombre-laboratorio').val();
        let id_editado = $('#id_editar_lab').val();
        if(edit==false){
            funcion='crear';
        }else{
            funcion='editar';
        }
        $.post('../controlador/LaboratorioController.php',{nombre_laboratorio,id_editado,funcion},(response)=>{
           if(response=='add'){
            $('#add-laboratorio').hide("slow");
            $('#add-laboratorio').show(1000);
            $('#add-laboratorio').hide(2000);
            $('#form-crear-laboratorio').trigger("reset");
            buscar_laboratorio();
           }
           if(response=='noadd'){
            $('#noadd-laboratorio').hide("slow");
            $('#noadd-laboratorio').show(1000);
            $('#noadd-laboratorio').hide(2000);
            $('#form-crear-laboratorio').trigger("reset");
           }
           if(response=='edit'){
            $('#edit-lab').hide("slow");
            $('#edit-lab').show(1000);
            $('#edit-lab').hide(2000);
            $('#form-crear-laboratorio').trigger("reset");
            buscar_laboratorio();
           }
           edit==false;
        })
        e.preventDefault();
    });

    function buscar_laboratorio(consulta){
        funcion = 'buscar';
        $.post('../controlador/LaboratorioController.php',{consulta,funcion},(response)=>{
            const laboratorios=JSON.parse(response);
            let template='';
            laboratorios.forEach(laboratorio=>{
                template+=`
                  <tr labId="${laboratorio.id}" labNombre="${laboratorio.nombre}" labAvatar="${laboratorio.avatar}">
                       <td>
                         <button class="avatar btn btn-info" title="Cambiar imagen del Laboratorio" type="button" data-toggle="modal" data-target="#cambiologo">
                              <i class="far fa-image"></i>
                         </button>
                         <button class="editar btn btn-success" title="Editar" type="button" data-toggle="modal" data-target="#crearlaboratorio">
                              <i class="fas fa-pencil-alt"></i>
                         </button>
                         <button class="borrar btn btn-danger" title="Eliminar">
                              <i class="fas fa-trash"></i>
                         </button>
                      </td>
                      <td>
                         <img src="${laboratorio.avatar}" class="img-fluid rounded" width="70" height="70">
                      </td>
                      <td>${laboratorio.nombre}</td>
                      
                      

                  </tr>
                `;
            });
            $('#laboratorios').html(template);
        })
    }

    $(document).on('keyup','#buscar-laboratorio',function(){
        let valor = $(this).val();
        if(valor!=''){
           buscar_laboratorio(valor);
        }else{
           buscar_laboratorio();
        }
    })

    $(document).on('click','.avatar',(e)=>{
       funcion="cambiar_logo";
       const elemento = $(this)[0].activeElement.parentElement.parentElement;
       const id = $(elemento).attr('labId');
       const nombre = $(elemento).attr('labNombre');
       const avatar = $(elemento).attr('labAvatar');
       $('#logoactual').attr('src',avatar);
       $('#nombre_logo').html(nombre);
       $('#funcion').val(funcion);
       $('#id_logo_lab').val(id);
    })

    $("#form-logo").submit(e=>{
        let formData = new FormData($("#form-logo")[0]);
        $.ajax({
          url: "../controlador/LaboratorioController.php",
          type: "POST",
          data: formData,
          cache: false,
          processData: false,
          contentType: false
        }).done(function (response) {
           const json = JSON.parse(response);
           if(json.alert=='edit'){
              $('#logoactual').attr('src',json.ruta);
              $("#edit").hide("slow");
              $("#edit").show(1000);
              $("#edit").hide(2000);
              $('#form-logo').trigger('reset');
              buscar_laboratorio();
           }else{
              $("#noedit").hide("slow");
              $("#noedit").show(1000);
              $("#noedit").hide(2000);
              $('#form-logo').trigger('reset');
           }
        });
        e.preventDefault();
      });

      $(document).on('click','.borrar',(e)=>{
         funcion="borrar";
         const elemento = $(this)[0].activeElement.parentElement.parentElement;
         const id = $(elemento).attr('labId');
         const nombre = $(elemento).attr('labNombre');
         const avatar = $(elemento).attr('labAvatar');
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
            imageUrl:''+avatar+'',
            imageWidth:100,
            imageHeight:100,
            showCancelButton: true,
            confirmButtonText: "Si, borrar!",
            cancelButtonText: "No, cancelar!",
            reverseButtons: true
          }).then((result) => {
            if (result.isConfirmed) {
               $.post('../controlador/LaboratorioController.php',{id,funcion},(response)=>{
                  edit==false;
                  if(response=='borrado'){
                     swalWithBootstrapButtons.fire({
                        title: "Borrado!",
                        text: 'El Laboratorio '+nombre+' ha sido eliminado!',
                        icon: "success"
                      });
                      buscar_laboratorio();
                  }else{
                     swalWithBootstrapButtons.fire({
                        title: "No se pudo Eliminar!",
                        text: 'El Laboratorio '+nombre+' no se ha podido borrar, esta en uso en un Producto!',
                        icon: "error"
                      });
                  }
               })
            } else if (result.dismiss === Swal.DismissReason.cancel) {
              swalWithBootstrapButtons.fire({
                title: "Cancelado",
                text: 'El Laboratorio '+nombre+' no ha sido eliminado!',
                icon: "error"
              });
            }
          });
      })

      $(document).on('click','.editar',(e)=>{
         const elemento = $(this)[0].activeElement.parentElement.parentElement;
         const id = $(elemento).attr('labId');
         const nombre = $(elemento).attr('labNombre');
         $('#id_editar_lab').val(id);
         $('#nombre-laboratorio').val(nombre); 
         edit=true;
      })

});