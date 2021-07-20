<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * 
 * 
 * @package aveseguimiento
 * @author: ALTEN
 * @date: 2020
 */
require_once(__DIR__."/../../config.php");
//require_once($CFG->dirroot."/blocks/aveseguimiento/locallib.php");
//require_once('ticket_form.php');

$courseid = optional_param('courseid', SITEID, PARAM_INT);
if (! $course = $DB->get_record("course", array('id' => $courseid)) ) {
    print_error("No such course id");
}

if ($course->id == SITEID) {
    require_login();
    $context = \context_system::instance();
} else {
    require_login($course->id);
    $context = \context_course::instance($course->id);
}
$esProfesor = has_capability('moodle/course:update', $context, $USER ->id, true);

$PAGE ->set_url('/blocks/aveseguimiento/informe.php', array('courseid' => $course->id));
$PAGE ->set_context($context);
$PAGE ->set_pagelayout('incourse');

$title = 'Informe de seguimiento';
$PAGE ->navbar->add(get_string('informe', 'block_aveseguimiento'));
$PAGE ->set_title($title);
$display = $PAGE ->set_heading($title);
$PAGE ->set_cacheable(true);
$display .= $OUTPUT->header();

$sql = "SELECT DISTINCT u.id, u.firstname, u.lastname, u.email, e.timeend, e.timestart
    FROM {user} AS u
    INNER JOIN {user_enrolments} AS e ON e.userid = u.id
    INNER JOIN {enrol} AS en ON en.id = e.enrolid
    INNER JOIN {course} AS c ON c.id = en.courseid
    INNER JOIN {role_assignments} ra ON ra.userid = u.id
    INNER JOIN {context} ct ON ct.id = ra.contextid
    INNER JOIN {role} rol ON rol.id = ra.roleid
    WHERE u.deleted = 0 AND u.suspended = 0 AND rol.shortname='student' AND ct.instanceid = c.id and c.id=?
";
$pSql = [ $COURSE ->id ];
if (!$esProfesor){
    $sql .= " and u.id=?";
    $pSql[] = $USER ->id;
}
$sql .= " order by u.lastname, u.firstname";
//var_dump($sql); exit;
//var_dump($pSql); exit;
$alumnos = $DB ->get_records_sql($sql, $pSql);
//var_dump(count($alumnos)); exit;
$display .= html_writer::start_tag('style')
    .'.aveseg thead tr { background-color: #c9c9c9; font-weight: bold; }'
    .html_writer::end_tag('style')
;
$tabla = [
    'cabeceras' => [
        0 => [
            'ds1' => [7, 'Licencia', 2],
            'ds2' => [2, 'Seguimiento', 2],
        ],
        1 => [],
        2 => [
            'nombre'    => [1, 'Alumno/a', 2],
            'email'     => [1, 'Correo electrónico', 2],
            'start'     => [1, 'Fecha de inicio', 2],
            'inicio'    => [1, 'Primera conexión', 2],
            'ultima'    => [1, 'Última conexión', 2],
            'tiempo'    => [1, 'Tiempo de licencia', 2],
            'fin'       => [1, 'Fecha de finalización', 2],
            'dedicado'  => [1, 'Tiempo dedicado', 2],
            'realizado' => [1, '% realizado respecto al total del curso', 2],
            //'planifica' => [1, '% realizado respecto a la planificación (número de días que faltan) del curso', 2],
        ],
        3 => [],
        4 => [],
        5 => [],
        6 => [],
        7 => [],
        8 => [],
        9 => [],
        10 => [],
        11 => [],
        12 => [],
    ],
    'cabs' => [
        'nombre',
        'email',
        'start',
        'inicio',
        'ultima',
        'tiempo',
        'fin',
        'dedicado',
        'realizado', 
        //'planifica',
    ],
    'datos' => [],
];
foreach($alumnos as $alumno){
    $al = count($tabla['datos']);
    $tabla['datos'][$al] = [
        'userid'    => $alumno ->id,
        'nombre'    => $alumno ->lastname .', '. $alumno ->firstname,
        'email'     => $alumno ->email,
        'realizado' => '#REALIZADO#',
        'planifica' => '',
    ];
    $sql = 'select min(timemodified) as n1, max(timemodified) as n2 from {scorm_scoes_track} where userid=? and scormid in (select id from mdl_scorm where course=?)';
    $reg = $DB ->get_record_sql($sql, [ $alumno ->id, $COURSE ->id ]);
    $tabla['datos'][$al]['start'] = (empty($alumno ->timestart) ? '' : date('d/m/Y H:i', $alumno ->timestart));
    $tabla['datos'][$al]['inicio'] = (empty($reg) || empty($reg ->n1) ? '' : date('d/m/Y H:i', $reg ->n1));
    $tabla['datos'][$al]['ultima'] = (empty($reg) || empty($reg ->n2) || date('Y', $reg ->n2) < 2000 ? '' : date('d/m/Y H:i', $reg ->n2));
    if (!empty($reg) && !empty($reg ->n1) && !empty($reg ->n2)){
        $dias = (time() - $reg ->n1) / 86400;
        $dias = floor(abs($dias));
        $tabla['datos'][$al]['tiempo'] = $dias .' día' .($dias > 1 ? 's' : '');
    }
    $fin = (!empty($alumno ->timeend) ?  $alumno ->timeend : $COURSE ->enddate);
    $tabla['datos'][$al]['fin'] = date('d/m/Y H:i', $fin);
    $n =(!empty($reg ->n1) && !empty($reg ->n2) ? (time() - $reg ->n1) / ($fin - $reg ->n1) : '');
    $tabla['datos'][$al]['planifica'] = (!empty($n) ? number_format(100 * $n, 2, ',', ',') : '');
}

// Estructura del curso (cursos que agrupan temas, o temas directamente). Para coger bien el orden de pantalla
$items = [];
$sql   = "SELECT id, sequence FROM {course_sections} where course=? order by id";
$secciones = $DB ->get_records_sql($sql, [ $COURSE ->id ]);
foreach($secciones as $seccion){
    $x = explode(',', $seccion ->sequence);
    foreach($x as $xx){
        $sql = "SELECT ms.id, ms.scorm, ms.title, ms.identifier, ms.parent, ms.scormtype, ms.title, ms.sortorder
            FROM {course_modules} cm 
            JOIN {modules} md ON md.id = cm.module
            JOIN {scorm} m ON m.id = cm.instance 
            join {scorm_scoes} ms on ms.scorm=m.id
            WHERE md.name = 'scorm' AND cm.course = ? and cm.id=? and ms.parent='/'
        ";
        $scos = $DB ->get_records_sql($sql, [ $COURSE ->id, $xx ]);
        if (!empty($scos)){
            foreach($scos as $sco){
                $items[ $sco ->id ] = $sco;
            }
        }
    }
}
//print("<pre>".print_r($tabla,true)."</pre>"); exit;
/*
$sql = "select id, scorm, title, identifier, parent, scormtype, title, sortorder
    from {scorm_scoes}
    where scorm in (select id from {scorm} where course=?) and parent='/'
    order by scorm,sortorder
";
$items = $DB ->get_records_sql($sql, [ $COURSE ->id ]);
 * 
 */
$indice    = [];
//print("<pre>".print_r($items,true)."</pre>"); exit;
foreach($items as $item){
    //--- buscar si está dividido en temas
    $sql = "select id, scorm, title, identifier, parent, scormtype, title, sortorder 
        from  {scorm_scoes}
        where scorm=?
        and title like 'Tema %'
        order by scorm,sortorder
    ";
    $temas = $DB ->get_records_sql($sql, [ $item ->scorm ]);
    if (empty($temas)){
        $temas = [ $item ];
    }
    $item ->total_items = 0;
    $item ->colspan     = 0;
    $primerTema = true;
    foreach($temas as $ktema => $tema){
        //---
        $item ->esTema = true;
        $scos = [];
        $test = [];
        getSCOS( $scos, $test, $tema ->scorm, $tema ->identifier );
        $tema ->scos = $scos;
        $tema ->test = $test;
        /*if (!empty($tema ->test)){
            print("<pre>".print_r($tema,true)."</pre>"); exit;
        }*/
            
        $tema ->total_items = count($tema ->scos);
        $tema ->rowspan = (count($temas) > 1 ? 1 : 2);
        if (!empty($test)){
            $tema ->colspan = (count($test) * 3 + 2);
        } else {  
            $tema ->colspan = 1;
        }
        if (count($temas) > 1){
            if ($primerTema ){
                $tema ->padre   = $item;
            } else {
                $tema ->padre = true;
            }
            $item ->total_items += $tema ->total_items;
            $item ->colspan += $tema ->colspan;
        }
        $indice[ $tema ->id ] = $tema;
        $primerTema = false;
    }
}
//print("<pre>".print_r($indice,true)."</pre>"); exit;
$conta = 0;
$temas = [];
foreach($indice as $item){
    $fila = 0;
    if (!empty($item ->padre)){
        if ($item ->padre !== true ){
            //print("<pre>".print_r($item,true)."</pre>"); exit;
            $col = count($tabla['cabeceras'][$fila]);
            $tabla['cabeceras'][$fila][ $col ] = [ 
                $item ->padre ->colspan, 
                $item ->padre ->title .'<br><small>' .$item ->padre ->total_items. ' Contenidos</small>',
                1,
                $col
            ];
        }
        $fila++;
    }
    $col = count($tabla['cabeceras'][$fila]);
    $tabla['cabeceras'][$fila][ $col ] = [ 
        $item ->colspan, 
        $item ->title .'<br><small>' .$item ->total_items. ' Contenidos</small>',
        $item ->rowspan,
        $col 
    ];
    incluir_cabeceras( $tabla, 2, $item, $col, $temas, $conta );
    $conta += $item ->colspan;
}
//print("<pre>".print_r($tabla,true)."</pre>"); exit;
$col = count($tabla['cabeceras'][0]);
$tabla['cabeceras'][0][ $col ] = [ 1, 'Media de los test del curso', 3, $col ];
$tabla['cabeceras'][3][] = [ 1, 'Nota', 1, $col ];
//print("<pre>".print_r($tabla,true)."</pre>"); exit;
//tabla_ultimos_ajustes( $tabla );
//print("<pre>".print_r($tabla['cabeceras'][3],true)."</pre>"); exit;

//print("<pre>".print_r($tabla,true)."</pre>"); exit;
$tbody = '<thead>';
foreach($tabla['cabeceras'] as $nfila => $fila ){
    if ($nfila != 1 && empty($fila)){ continue; }
    $tbody .= '<tr>';
    $conta = ($nfila == 3 ? 10 : 0);
    foreach($fila as $ncol => $col) {
        $class = '';
        if ($nfila != 3){
            for($i = 0; $i < $col[0]; $i++){
                $class .= ' ncol'.($conta+$i);
            }
            $conta += $col[0];
        } else {
            $class = 'ncol' .$col[3];
        }
        $tbody .= '<th colspan="' .$col[0]. '" rowspan="' .(isset($col[2]) ?$col[2] : 1). '" class="' .$class. '">'
            .$col[1]. '</th>'
        ;
    }
    $tbody .= '</tr>';
}
$tbody .= '</thead><tbody>';

/*
         'dedicado'  => '#TIEMPO#',
        'realizado' => '#REALIZADO#',
        'planifica' => '#PLANIFICADO#',
 */

define('TIEMPO_LIMITE', 300);
$sql = "SELECT id, scoid, userid, attempt, element, value, timemodified FROM {scorm_scoes_track} where userid=? and scormid in (select id from {scorm} where course=?) order by timemodified";
//$sqlTest = "SELECT max(value) as n FROM {scorm_scoes_track} where userid=? and scoid=? and element='cmi.core.lesson_status'";
foreach($tabla['datos'] as $k => $fila){
    $notaAlumno = [ 'tests' => 0, 'nota' => 0];
    $realizado  = [ 'items' => 0, 'superados' => 0];
    $p = [ $fila['userid'], $COURSE ->id ];
    $tracks = $DB ->get_records_sql($sql, $p);
    $regs = [];
    $t0 = null;
    $tiempoTotal = 0;
    $conta = 0;
    foreach($tracks as $track){
        //print("<pre>".print_r($tracks,true)."</pre>"); exit;
        if ($track ->element == 'cmi.core.lesson_status' && $track ->value == 'completed'){
            $regs[ $track ->scoid ] = $track;
        }
        if (isset($t0)){
            $n = $track ->timemodified - $t0;
            if ($n > TIEMPO_LIMITE) { //5 minutos como máximo
                $tiempoTotal += TIEMPO_LIMITE;
                $t0 = null;
            } else {
                $tiempoTotal += $n;
                $t0 = $track ->timemodified;
            }
        } else {
            $t0 = $track ->timemodified;
        }
    }
    $fila['dedicado'] = seg2hora($tiempoTotal);
    //print("<pre>".print_r($regs,true)."</pre>"); exit;
    
    $tLinea = '<tr>';
    foreach($tabla['cabs'] as $cab){
        $tLinea .= '<td class="' .$cab. ' ncol' .$conta. '" ncol="' .$conta. '">' .(isset($fila[$cab]) ? $fila[$cab] : ''). '</td>';
        $conta++;
    }
    //print("<pre>".print_r($regs,true)."</pre>"); exit;
    foreach($indice as $tema){
        $n = 0;
        foreach($tema ->scos as $sco){
            if (isset($regs[$sco])){
                $n++;
            }
        }
        $realizado[ 'items' ] += $tema ->total_items;
        if (empty($n) || empty($tema ->total_items)){
            $n = '';
        } else {
            $realizado[ 'superados' ] += $n;
            $n = number_format(100 * $n / $tema ->total_items, 2, ',', '.');
        }
        $tLinea .= '<td class="numero ncol' .$conta. '" ncol="' .$conta. '">' .$n. '</td>';
        $conta++;
        $notaTotal = 0;
        if (!empty($tema ->test)){
            foreach($tema ->test as $test){
                $n = '';
                $f = '';
                $intentos = 0;
                if (isset($regs[$test ->id])){
                    $f = date('d/m/Y H:i', $regs[$test ->id] ->timemodified);
                    //print("<pre>".print_r($regs[$test ->id],true)."</pre>"); exit;
                    $n = 10;
                    $sql2 = "SELECT scoid, userid, scoid, attempt, element, value, timemodified FROM {scorm_scoes_track} where userid=? and element=? and scoid=?";
                    $p = [ $fila['userid'], 'cmi.core.score.raw', $test ->id ];
                    //var_dump($p);exit;
                    $nota = $DB ->get_record_sql($sql2, $p);
                    if (!empty($nota)){
                        $n = $nota ->value / 10;
                    }
                    $notaTotal += $n;
                    $notaAlumno[ 'nota' ] += $n;
                    
                    $sql2 = "SELECT value FROM {scorm_scoes_track} where userid=? and element=? and scoid=?";
                    $p = [ $fila['userid'], 'cmi.suspend_data', $test ->id ];
                    $reg = $DB ->get_record_sql($sql2, $p);
                    if ($reg){
                        $suspend_data = json_decode($reg ->value);
                        foreach($suspend_data as $k => $v){
                            if (!empty($v ->intentos)){
                                $intentos = max($intentos, intval($v ->intentos));
                            }
                        }
                    }
                }
                $tLinea .= '<td class="numero ncol' .$conta. '" ncol="' .$conta. '">' .$n. '</td>';
                $conta++;
                $tLinea .= '<td class="ncol' .$conta. '" ncol="' .$conta. '">' .$f. '</td>';
                $conta++;
                $tLinea .= '<td class="numero ncol' .$conta. '" ncol="' .$conta. '">'.(!empty($intentos) ? $intentos : ''). '</td>';
                $conta++;
                $notaAlumno[ 'tests' ]++;
            }
            $n = '';
            if (count($tema ->test) > 0 && $notaTotal > 0){
                $n = number_format($notaTotal / count($tema ->test), 2, ',', '.');
            }
            $tLinea .= '<td class="numero ncol' .$conta. '" ncol="' .$conta. '">' .$n. '</td>';
            $conta++;
        }
    }
    $n = '';
    if (!empty($notaAlumno['tests']) && !empty($notaAlumno['nota'])){
        $n = number_format($notaAlumno['nota'] / $notaAlumno['tests'], 2, ',', '.');
    }
    $tLinea .= '<td class="numero ncol' .$conta. '" ncol="' .$conta. '">' .$n. '</td>';
    $conta++;
    $tLinea .= '</tr>';
    
    $n = (!empty($realizado['items']) ? (100 * $realizado['superados'] / $realizado['items']) : 0);
    $tLinea = str_replace('#REALIZADO#', (!empty($n) ? number_format($n, 2, ',', '.') : '') , $tLinea);
    
    $tbody .= $tLinea;
    
}
$tbody .= '</tbody>';
//var_dump($tabla); exit;

$display .= html_writer::start_tag('div', array('style' => 'overflow:auto;'))
    //.'Fechas del curso desde el '.date('d/m/Y H:i', $COURSE ->startdate). ' hasta '.date('d/m/Y H:i', $COURSE ->enddate)
    .'<table border="1" class="aveseg" id="aveseg">' .$tbody. '</table>'
    .'<br><button type="button" class="btn btn-primary btnExcel">Descargar en excel</button><br>'
    .'<br><b><u>Leyenda:</u></b><ul><li>Tiempo de licencia = Días de diferencia entre la última conexión y la primer conexión</li></ul>'
    .html_writer::end_tag('div')
;
$display .= html_writer::start_tag('style')
    .'th {
        text-align: center;
    }
    .numero, .tiempo, .realizado, .planifica {
        padding: 3px;
        text-align: right;
    }
    table.aveseg td {
        cursor: pointer;
    }
    table.aveseg .sel {
        background-color: lightpink;
    }
    '
    .html_writer::end_tag('style')
;
$display .= html_writer::start_tag('script')
    .'window.addEventListener("load",function(event) {
        $("table.aveseg td").hover(function(){
            $(this).closest("tr").addClass("sel");
            $(".ncol"  + $(this).attr("ncol")).addClass("sel");
            var titulo = $(this).closest("tr").find("td.nombre").html();
            for(var i=1; i<=4; i++){
                var $obj =  $("table.aveseg thead tr:nth-child(" + i + ") .ncol" + $(this).attr("ncol") );
                if ($obj.length > 0){
                   titulo += "\n" + $obj.html();
                }
            }
            titulo = titulo.replace(/(<([^>]+)>)/gi, " ");
            $(this).attr("title", titulo);
        }, function(event){
            $("table.aveseg .sel").removeClass("sel");
        });
        $(".btnExcel").click(function(){
            tabletoExcel("aveseg", "Informe AVE Global")
        });
    })
    function tabletoExcel(table, name) {
       var uri = "data:application/vnd.ms-excel;base64,"
             , template = "<html xmlns:o=\"urn:schemas-microsoft-com:office:office\" xmlns:x=\"urn:schemas-microsoft-com:office:excel\" xmlns=\"http://www.w3.org/TR/REC-html40\"><meta http-equiv=\"content-type\" content=\"application/vnd.ms-excel; charset=UTF-8\"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>"
             , base64 = function (s) { return window.btoa(unescape(encodeURIComponent(s))); }
             , format = function (s, c) { return s.replace(/{(\w+)}/g, function (m, p) { return c[p]; }); };
           if (!table.nodeType) table = document.getElementById(table);
           var ctx = { worksheet: name || "Worksheet", table: table.innerHTML };
           window.location.href = uri + base64(format(template, ctx));
    }
'
    .html_writer::end_tag('script')
;

echo $display;

echo $OUTPUT->footer();

/**
 * 
 */
function incluir_cabeceras( &$tabla, $fila, $item, $col, &$temas, $conta){
    $tabla['cabeceras'][ $fila ][] = [ 1, '% realizado', 2 ];
    if (!empty($item ->test)){
        $conta += 10;
        foreach($item ->test as $test){
            $tabla['cabeceras'][ $fila ][] = [ 3, $test ->title, 1 ];
            $tabla['cabeceras'][ $fila + 1 ][] = [ 1, 'Nota',     1, $conta + 0 ];
            $tabla['cabeceras'][ $fila + 1 ][] = [ 1, 'Fecha',    1, $conta + 1 ];
            $tabla['cabeceras'][ $fila + 1 ][] = [ 1, 'Intentos', 1, $conta + 2 ];
            $conta += 3;
        }
        $tabla['cabeceras'][ $fila ][] = [ 1, 'Media de los test del tema', 1, $conta ];
        $tabla['cabeceras'][ $fila + 1 ][] = [ 1, 'Nota', 1, $conta ];
    }
}
/**
 * 
 */
function seg2hora( $seg ){
    $h = floor($seg / 3600);
    $s = $seg - ($h * 3600);
    $m = floor($s / 60);
    $s = $s - ($m * 60);
    return str_pad($h,2,'0', STR_PAD_LEFT) .':'.  str_pad($m,2,'0', STR_PAD_LEFT). ':' . str_pad($s,2,'0', STR_PAD_LEFT);
}
/**
 * 
 */
function getSCOS( &$scos, &$tests, $scorm, $parent ){
    global $DB;
    $sql = "select id, identifier, scormtype, title
        from {scorm_scoes}
        where scorm=? and parent=?
    ";
    $hijos = $DB ->get_records_sql($sql, [ $scorm, $parent ]);
    foreach($hijos as $hijo){
        if ($hijo ->scormtype == 'sco'){
            $scos[] = $hijo ->id;
        }
        if (substr($hijo ->title, 0, 16) == 'Comenzar el Test'){
            $tests[ $hijo ->id ] = $hijo;
        }
    }
    if (!empty($hijos)){
        foreach($hijos as $hijo){
            getSCOS( $scos, $tests, $scorm, $hijo ->identifier );
        }
        //print("<pre>".print_r($scos,true)."</pre>"); exit;
    }
}