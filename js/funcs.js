$('#table').DataTable({
  "language": {
    "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
  }
});

// Listado de empleados
// Mediante AJAX llama la lista de empleados
function listEmployees() {
  $.ajax({
    method: "get",
    url: "employee.list.php"
  })
    .done(function (data) {
      $(".listEmployees").html(data);
    });
}

// Mediante AJAX muestra el formulario Editar empleado
function showFormEmployee(id) {
  $.ajax({
    method: "get",
    url: "employee.newedit.php?id=" + id
  })
    .done(function (data) {
      $(".modalFrmEmployee").html(data);
    });
  $(".bg, .modalFrmEmployee").show();
}

// Llama a la funcion de mostrar el formulario Editar empleado Nuevo
$(".showForm").click(function (e) {
  e.preventDefault();
  showFormEmployee(0);
});

// Cerrar formulario Editar empleado
$(".modalFrmEmployee").on("click", ".hideForm", function (e) {
  e.preventDefault();
  $(".bg, .modalFrmEmployee").hide();
});

// Grabar datos del formulario Empleado
$(document).on("submit", "#frmEmployee", function (e) {
  e.preventDefault();

  $.ajax({
    method: "post",
    url: "employee.save.php",
    data: $(this).serialize()
  })
    .done(function (data) {
      if (data.resultado) {
        $(".bg, .modalFrmEmployee").hide();
        listEmployees();
      }
      alert(data.mensaje);
    });
});

// Llama a la funcion de mostrar el formulario Editar empleado
// para editar sus datos en base a su id
$(".listEmployees").on("click", ".edit", function (e) {
  e.preventDefault();
  var employee_id = $(this).attr('data-id');
  showFormEmployee(employee_id);
});

// Eliminar empleado en base a su id
$(".listEmployees").on("click", ".delete", function (e) {
  e.preventDefault();
  var delete_employee = confirm("¿Está seguro de eliminar?");
  if (delete_employee) {
    var employee_id = $(this).attr('data-id');
    $.ajax({
      method: "get",
      url: "employee.delete.php?id=" + employee_id
    })
      .done(function (data) {
        if (data.resultado) {
          listEmployees();
        }
        alert(data.mensaje);
      });
  }
});
