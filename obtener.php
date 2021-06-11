<?php
include_once "gestionBD.php";

$dbconn = crearConexionPG();
if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; }; 

$records = 10; // change here for records per page

$start_from = ($page-1) * $records;

$qry = pg_query($dbconn, "select count(*) as total from comidas"); 
$row_sql = pg_fetch_row($qry); 
$total_records = $row_sql[0]; 
$total_pages = ceil($total_records / $records);

$select = pg_query($dbconn, "select * from comidas limit $records offset $start_from");
while($row = pg_fetch_assoc($select )){
    echo $row['oid_c'].' | '.$row['nombrecomida'].' | '.$row['descripcion'].'<br />';
}
/*$sentencia = $conexion->query("select * from productos");
$registros = $sentencia->fetchAll(PDO::FETCH_OBJ);

foreach ( $registros as $datos) {
    echo $datos->oid_pd;
    echo $datos->nombreproducto;
    echo $datos->marca;
    echo $datos->precio;
    echo $datos->tipoproducto;
    echo $datos->pesoneto;
    echo $datos->composicion;
    echo $datos->sabor;
    echo $datos->dosisrecomendada;
    echo $datos->talla;

}*/

// try {
//     //$primera = ( $pag_num - 1 ) * $pag_size + 1;
//     //$ultima  = $pag_num * $pag_size * 10;
//     $offset = 0;
//     $limit = ($offset + 1) * 10;
//     echo "okey";
//     $query = "SELECT * FROM COMIDAS ORDER BY NombreComida";
//     $consulta_paginada = "$query LIMIT :limit OFFSET :offset";
//     //$consulta_paginada = "($query) LIMIT :ultima OFFSET :primera";
//     //$consulta_paginada = "SELECT * FROM ( SELECT ROWNUM RNUM, AUX.* FROM ( $query ) AUX WHERE ROWNUM <= :ultima) WHERE RNUM >= :primera";
//     $stmt = $conexion->prepare( $consulta_paginada );
//     $stmt->bindParam( ':limit', $limit );
//     $stmt->bindParam( ':offset',  $offset  );
//     $stmt->execute();
//     return $stmt;
// }
// catch ( PDOException $e ) {
//    //$_SESSION['excepcion'] = $e->GetMessage();
//     echo "Error";
//    // header("Location: excepcion.php");
// }

?>