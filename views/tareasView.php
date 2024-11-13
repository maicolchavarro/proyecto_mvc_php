<?php

namespace App\views;


use App\controllers\TareasController;
use App\models\entities\Empleado;
use App\models\entities\Estado;
use App\models\entities\Prioridad;

class TareasViews
{
    private $controller;

    function __construct()
    {
        $this->controller = new TareasController();
    }

    function getTable($titulo, $fechaInicio, $fechaFin, $idPrioridad, $idEmpleado, $descripcion, $idEstado)
    {
        $empleados = Empleado::all();
        $estados = Estado::all();
        $prioridades = Prioridad::all();

        $rows = '';
        $tareas = $this->controller->getAlltareas($titulo, $fechaInicio, $fechaFin, $idPrioridad, $idEmpleado, $descripcion, $idEstado);

        if (!is_array($tareas)) {
            $tareas = [$tareas];
        }

        usort($tareas, function ($a, $b) {
            $result = strcmp($a->get('idPrioridad'), $b->get('idPrioridad'));
            if ($result === 0) {
                return strcmp($a->get('fechaEstimadaFinalizacion'), $b->get('fechaEstimadaFinalizacion'));
            }
            return $result;
        });

        if (count($tareas) > 0) {
            foreach ($tareas as $tarea) {
                $id = $tarea->get('id');
                $rows .= '<tr>';
                $rows .= '   <td>' . $tarea->get('titulo') . '</td>';
                $rows .= '   <td>' . $tarea->get('descripcion') . '</td>';
                $rows .= '   <td>' . $tarea->get('fechaEstimadaFinalizacion') . '</td>';
                $rows .= '   <td>' . $tarea->get('fechaFinalizacion') . '</td>';
                $rows .= '   <td>' . $tarea->get('creadorTarea') . '</td>';
                $rows .= '   <td>' . $tarea->get('observaciones') . '</td>';
                $idEmpleado = $tarea->get('idEmpleado');
                $nombreEmpleado = '';
                foreach ($empleados as $empleado) {
                    if ($empleado->id == $idEmpleado) {
                        $nombreEmpleado = $empleado->nombre;
                        break;
                    }
                }
                $rows .= '   <td>' . $nombreEmpleado . '</td>';


                $idEstado = $tarea->get('idEstado');
                $nombreEstado = '';
                foreach ($estados as $estado) {
                    if ($estado->id == $idEstado) {
                        $nombreEstado = $estado->nombre;
                        break;
                    }
                }
                if ($idEstado == 4) {
                    $rows .= '   <td style="color: red; font-weight: bold;">' . $nombreEstado . '</td>';
                } else {
                    $rows .= '   <td>' . $nombreEstado . '</td>';
                }

                $idPrioridad = $tarea->get('idPrioridad');
                $nombrePrioridad = '';
                foreach ($prioridades as $prioridad) {
                    if ($prioridad->id == $idPrioridad) {
                        $nombrePrioridad = $prioridad->nombre;
                        break;
                    }
                }
                $rows .= '   <td>' . $nombrePrioridad . '</td>';
                $rows .= '   <td>' . $tarea->get('created_at') . '</td>';
                $rows .= '   <td>' . $tarea->get('updated_at') . '</td>';
                $rows .= '   <td>';
                $rows .= '      <a href="formularioTarea.php?cod=' . $id . '">Modificar</a>';
                $rows .= '   </td>';
                $rows .= '   <td>';
                $rows .= '      <button onClick="eliminarTarea(' . $id . ')">Borrar</button>';
                $rows .= '   </td>';
                $rows .= '   <td>';
                $rows .= '      <a href="formularioTarea.php?cod=' . $id . '&campo=responsable">Responsable</a>';
                $rows .= '   </td>';
                $rows .= '   <td>';
                $rows .= '      <a href="formularioTarea.php?cod=' . $id . '&campo=estado">Estado</a>';
                $rows .= '   </td>';

                $rows .= '</tr>';
            }
        } else {
            $rows .= '<tr>';
            $rows .= '   <td colspan="12">No hay datos registrados</td>';
            $rows .= '</tr>';
        }
        $table = '<table>';
        $table .= '  <thead>';
        $table .= '     <tr>';
        $table .= '         <th>Titulo</th>';
        $table .= '         <th>Descripcion</th>';
        $table .= '         <th>Fecha Estimada de Finalización</th>';
        $table .= '         <th>Fecha de Finalización</th>';
        $table .= '         <th>Creador</th>';
        $table .= '         <th>Observaciones</th>';
        $table .= '         <th>Empleado</th>';
        $table .= '         <th>Estado</th>';
        $table .= '         <th>Prioridad</th>';
        $table .= '         <th>Creado</th>';
        $table .= '         <th>Actualizado</th>';
        $table .= '         <th>Modificar</th>';
        $table .= '         <th>Borrar</th>';
        $table .= '         <th>Responsable</th>';
        $table .= '         <th>Estado</th>';
        $table .= '     </tr>';
        $table .= '  </thead>';
        $table .= ' <tbody>';
        $table .=  $rows;
        $table .= ' </tbody>';
        $table .= '</table>';

        return $table;
    }

    function getFormTarea($data)
    {
        $empleados = Empleado::all();
        $estados = Estado::all();
        $prioridades = Prioridad::all();

        $datos = null;
        $form = '<form action="confirmarRegistro.php" method="post">';
        if (!empty($data['cod'])) {
            $form .= '<input type="hidden" name="cod" value="' . $data['cod'] . '">';
            $datos = $this->controller->getTarea($data['cod']);
        }

        $campo = isset($data['campo']) ? $data['campo'] : '';
        $idEmpleado = empty($datos) ? '' : $datos->get('idEmpleado');
        $idEstado = empty($datos) ? '' : $datos->get('idEstado');

        $titulo = empty($datos) ? '' : $datos->get('titulo');
        $descripcion = empty($datos) ? '' : $datos->get('descripcion');
        $fechaEstimadaFinalizacion = empty($datos) ? '' : $datos->get('fechaEstimadaFinalizacion');
        $fechaFinalizacion = empty($datos) ? '' : $datos->get('fechaFinalizacion');
        $creadorTarea = empty($datos) ? '' : $datos->get('creadorTarea');
        $observaciones = empty($datos) ? '' : $datos->get('observaciones');
        $idEmpleado = empty($datos) ? '' : $datos->get('idEmpleado');
        $idEstado = empty($datos) ? '' : $datos->get('idEstado');
        $idPrioridad = empty($datos) ? '' : $datos->get('idPrioridad');

        if ($campo === 'responsable') {
            $form .= '<label for="titulo" style="display: none;">Ingrese el título</label>';
            $form .= '<input type="hidden" name="titulo" value="' . $titulo . '">';

            $form .= '<label for="descripcion" style="display: none;">Ingrese la descripción</label>';
            $form .= '<textarea name="descripcion" style="display: none;">' . $descripcion . '</textarea>';
            $form .= '<br>';

            $form .= '<label for="fechaEstimadaFinalizacion" style="display: none;">Ingrese la fecha estimada de finalización</label>';
            $form .= '<input type="hidden" name="fechaEstimadaFinalizacion" value="' . $fechaEstimadaFinalizacion . '">';
            $form .= '<br>';

            $form .= '<label for="fechaFinalizacion" style="display: none;">Ingrese la fecha de finalización</label>';
            $form .= '<input type="hidden" name="fechaFinalizacion" value="' . $fechaFinalizacion . '">';
            $form .= '<br>';

            $form .= '<label for="creadorTarea" style="display: none;">Ingrese el creador de la tarea</label>';
            $form .= '<input type="hidden" name="creadorTarea" value="' . $creadorTarea . '">';
            $form .= '<br>';

            $form .= '<label for="observaciones" style="display: none;">Ingrese las observaciones de la tarea</label>';
            $form .= '<textarea name="observaciones" style="display: none;">' . $observaciones . '</textarea>';
            $form .= '<br>';

            $form .= '<label for="idEmpleado">Ingrese el empleado a cargo</label>';
            $form .= '<select name="idEmpleado" required>';
            $form .= '    <option value="">Selecciona un empleado</option>';
            foreach ($empleados as $empleado) {
                $selected = ($empleado->id == $idEmpleado) ? 'selected' : '';
                $form .= '    <option value="' . $empleado->id . '" ' . $selected . '>' . $empleado->nombre . '</option>';
            }
            $form .= '</select>';
            $form .= '<br>';

            $form .= '<label for="idEstado" style="display: none;">Ingrese el estado actual de la tarea</label>';
            $form .= '<select name="idEstado" required style="display: none;">';
            $form .= '    <option value="">Selecciona un estado</option>';
            foreach ($estados as $estado) {
                $selected = ($estado->id == $idEstado) ? 'selected' : '';
                $form .= '    <option value="' . $estado->id . '" ' . $selected . '>' . $estado->nombre . '</option>';
            }
            $form .= '</select>';
            $form .= '<br>';

            $form .= '<label for="idPrioridad" style="display: none;">Ingrese la prioridad de la tarea</label>';
            $form .= '<select name="idPrioridad" required style="display: none;">';
            $form .= '    <option value="">Selecciona una prioridad</option>';
            foreach ($prioridades as $prioridad) {
                $selected = ($prioridad->id == $idPrioridad) ? 'selected' : '';
                $form .= '    <option value="' . $prioridad->id . '" ' . $selected . '>' . $prioridad->nombre . '</option>';
            }
            $form .= '</select>';
            $form .= '<br>';

            $form .= '<button type="submit">Guardar Tarea</button>';
            $form .= '</form>';
        } elseif ($campo === 'estado') {
            $form .= '<label for="titulo" style="display: none;">Ingrese el título</label>';
            $form .= '<input type="hidden" name="titulo" value="' . $titulo . '">';
            $form .= '<br>';

            $form .= '<label for="descripcion" style="display: none;">Ingrese la descripción</label>';
            $form .= '<textarea name="descripcion" style="display: none;">' . $descripcion . '</textarea>';
            $form .= '<br>';

            $form .= '<label for="fechaEstimadaFinalizacion" style="display: none;">Ingrese la fecha estimada de finalización</label>';
            $form .= '<input type="hidden" name="fechaEstimadaFinalizacion" value="' . $fechaEstimadaFinalizacion . '">';
            $form .= '<br>';

            $form .= '<label for="fechaFinalizacion" style="display: none;">Ingrese la fecha de finalización</label>';
            $form .= '<input type="hidden" name="fechaFinalizacion" value="' . $fechaFinalizacion . '">';
            $form .= '<br>';

            $form .= '<label for="creadorTarea" style="display: none;">Ingrese el creador de la tarea</label>';
            $form .= '<input type="hidden" name="creadorTarea" value="' . $creadorTarea . '">';
            $form .= '<br>';

            $form .= '<label for="observaciones" style="display: none;">Ingrese las observaciones de la tarea</label>';
            $form .= '<textarea name="observaciones" style="display: none;">' . $observaciones . '</textarea>';
            $form .= '<br>';

            $form .= '<label for="idEmpleado" style="display: none;">Ingrese el empleado a cargo</label>';
            $form .= '<select name="idEmpleado" required style="display: none;">';
            $form .= '    <option value="">Selecciona un empleado</option>';
            foreach ($empleados as $empleado) {
                $selected = ($empleado->id == $idEmpleado) ? 'selected' : '';
                $form .= '    <option value="' . $empleado->id . '" ' . $selected . '>' . $empleado->nombre . '</option>';
            }
            $form .= '</select>';
            $form .= '<br>';

            $form .= '<label for="idEstado">Ingrese el estado actual de la tarea</label>';
            $form .= '<select name="idEstado" required>';
            $form .= '    <option value="">Selecciona un estado</option>';
            foreach ($estados as $estado) {
                $selected = ($estado->id == $idEstado) ? 'selected' : '';
                $form .= '    <option value="' . $estado->id . '" ' . $selected . '>' . $estado->nombre . '</option>';
            }
            $form .= '</select>';
            $form .= '<br>';

            $form .= '<label for="idPrioridad" style="display: none;">Ingrese la prioridad de la tarea</label>';
            $form .= '<select name="idPrioridad" required style="display: none;">';
            $form .= '    <option value="">Selecciona una prioridad</option>';
            foreach ($prioridades as $prioridad) {
                $selected = ($prioridad->id == $idPrioridad) ? 'selected' : '';
                $form .= '    <option value="' . $prioridad->id . '" ' . $selected . '>' . $prioridad->nombre . '</option>';
            }
            $form .= '</select>';
            $form .= '<br>';

            $form .= '<button type="submit">Guardar Tarea</button>';
            $form .= '</form>';
        } else {
            $form .= '<label for="titulo">Ingrese el título</label>';
            $form .= '<input type="text" name="titulo" placeholder="Título" value="' . $titulo . '" required>';
            $form .= '<br>';

            $form .= '<label for="descripcion">Ingrese la descripción</label>';
            $form .= '<textarea name="descripcion" placeholder="Descripción">' . $descripcion . '</textarea>';
            $form .= '<br>';

            $form .= '<label for="fechaEstimadaFinalizacion">Ingrese la fecha estimada de finalización</label>';
            $form .= '<input type="date" name="fechaEstimadaFinalizacion" value="' . $fechaEstimadaFinalizacion . '">';
            $form .= '<br>';

            $form .= '<label for="fechaFinalizacion">Ingrese la fecha de finalización</label>';
            $form .= '<input type="date" name="fechaFinalizacion" value="' . $fechaFinalizacion . '">';
            $form .= '<br>';

            $form .= '<label for="creadorTarea">Ingrese el creador de la tarea</label>';
            $form .= '<input type="text" name="creadorTarea" placeholder="Creador" value="' . $creadorTarea . '">';
            $form .= '<br>';

            $form .= '<label for="observaciones">Ingrese las observaciones de la tarea</label>';
            $form .= '<textarea name="observaciones" placeholder="Observaciones">' . $observaciones . '</textarea>';
            $form .= '<br>';

            $form .= '<label for="idEmpleado">Ingrese el empleado a cargo</label>';
            $form .= '<select name="idEmpleado" required>';
            $form .= '    <option value="">Selecciona un empleado</option>';
            foreach ($empleados as $empleado) {
                $selected = ($empleado->id == $idEmpleado) ? 'selected' : '';
                $form .= '    <option value="' . $empleado->id . '" ' . $selected . '>' . $empleado->nombre . '</option>';
            }
            $form .= '</select>';
            $form .= '<br>';

            $form .= '<label for="idEstado">Ingrese el estado actual de la tarea</label>';
            $form .= '<select name="idEstado" required>';
            $form .= '    <option value="">Selecciona un estado</option>';
            foreach ($estados as $estado) {
                $selected = ($estado->id == $idEstado) ? 'selected' : '';
                $form .= '    <option value="' . $estado->id . '" ' . $selected . '>' . $estado->nombre . '</option>';
            }
            $form .= '</select>';
            $form .= '<br>';

            $form .= '<label for="idPrioridad">Ingrese la prioridad de la tarea</label>';
            $form .= '<select name="idPrioridad" required>';
            $form .= '    <option value="">Selecciona una prioridad</option>';
            foreach ($prioridades as $prioridad) {
                $selected = ($prioridad->id == $idPrioridad) ? 'selected' : '';
                $form .= '    <option value="' . $prioridad->id . '" ' . $selected . '>' . $prioridad->nombre . '</option>';
            }
            $form .= '</select>';
            $form .= '<button type="submit">Guardar Tarea</button>';
            $form .= '</form>';
        }


        return $form;
    }

    function getFormTareaModificar()
    {
        $datos = $this->controller->getTarea($_GET['cod']);
        $titulo = empty($datos) ?: $datos->get('titulo');
        $descripcion = empty($datos) ?:  $datos->get('descripcion');
        $fechaEstimadaFinalizacion = empty($datos) ?:  $datos->get('fechaEstimadaFinalizacion');
        $fechaFinalizacion = empty($datos) ?:  $datos->get('fechaFinalizacion');
        $creadorTarea = empty($datos) ?:  $datos->get('creadorTarea');
        $observaciones = empty($datos) ?:  $datos->get('observaciones');
        $idEmpleado = empty($datos) ?:  $datos->get('idEmpleado');
        $idEstado = empty($datos) ?:  $datos->get('idEstado');
        $idPrioridad = empty($datos) ?:  $datos->get('idPrioridad');

        $form = '<form action="confirmarRegistro.php" method="post">';
        $form .= '      <input type="text" name="titulo" placeholder="Título" value="' . $titulo . '" required>';
        $form .= '      <textarea name="descripcion" placeholder="Descripción" value="' . $descripcion . '" ></textarea>';
        $form .= '      <input type="date" name="fechaEstimadaFinalizacion" value="' . $fechaEstimadaFinalizacion . '" >';
        $form .= '      <input type="date" name="fechaFinalizacion" value="' . $fechaFinalizacion . '" >';
        $form .= '      <input type="text" name="creadorTarea" placeholder="Creador" value="' . $creadorTarea . '" >';
        $form .= '      <textarea name="observaciones" placeholder="Observaciones" value="' . $observaciones . '" ></textarea>';
        $form .= '      <input type="number" name="idEmpleado" placeholder="ID Empleado"value="' . $idEmpleado . '" required>';
        $form .= '      <input type="number" name="idEstado" placeholder="ID Estado" value="' . $idEstado . '" required>';
        $form .= '      <input type="number" name="idPrioridad" placeholder="ID Prioridad" value="' . $idPrioridad . '" required>';
        $form .= '      <button type="submit">Guardar Tarea</button>';
        return $form;
    }

    function getMsgNewTarea($datosFormulario)
    {
        $datos = [
            "titulo" => $datosFormulario['titulo'],
            "descripcion" => $datosFormulario['descripcion'],
            "fechaEstimadaFinalizacion" => $datosFormulario['fechaEstimadaFinalizacion'],
            "fechaFinalizacion" => $datosFormulario['fechaFinalizacion'],
            "creadorTarea" => $datosFormulario['creadorTarea'],
            "observaciones" => $datosFormulario['observaciones'],
            "idEmpleado" => $datosFormulario['idEmpleado'],
            "idEstado" => $datosFormulario['idEstado'],
            "idPrioridad" => $datosFormulario['idPrioridad'],
        ];
        $confirmarAccion = $this->controller->saveTarea($datos);
        $msg = '<h2>Resultado de la operación</h2>';
        if ($confirmarAccion) {
            $msg .= '<p>La tarea se guardo correctamente.</p>';
        } else {
            $msg .= '<p>No se pudo guardar la tarea</p>';
        }
        return $msg;
    }

    function getMsgUpdateTarea($datosFormulario)
    {
        $datos = [
            'id' => $datosFormulario['cod'],
            "titulo" => $datosFormulario['titulo'],
            "descripcion" => $datosFormulario['descripcion'],
            "fechaEstimadaFinalizacion" => $datosFormulario['fechaEstimadaFinalizacion'],
            "fechaFinalizacion" => $datosFormulario['fechaFinalizacion'],
            "creadorTarea" => $datosFormulario['creadorTarea'],
            "observaciones" => $datosFormulario['observaciones'],
            "idEmpleado" => $datosFormulario['idEmpleado'],
            "idEstado" => $datosFormulario['idEstado'],
            "idPrioridad" => $datosFormulario['idPrioridad'],
        ];
        $confirmarAccion = $this->controller->updateTarea($datos);
        $msg = '<h2>Resultado de la operación</h2>';
        if ($confirmarAccion) {
            $msg .= '<p>Datos del contacto guardados.</p>';
        } else {
            $msg .= '<p>No se pudo guardar la información del contacto</p>';
        }
        return $msg;
    }

    function getMsgDeleteTarea($id)
    {
        $confirmarAccion = $this->controller->deleteTarea($id);
        $msg = '<h2>Resultado de la operación</h2>';
        if ($confirmarAccion) {
            $msg .= '<p>Tarea eliminada correctamente.</p>';
        } else {
            $msg .= '<p>No se pudo eliminar la tarea</p>';
        }
        return $msg;
    }
}
