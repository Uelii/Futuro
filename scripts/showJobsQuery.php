<?php
    include('../scripts/dbconnection.php');

    $return = array();

    $selected_liegenschaftid = $_GET['id'];

    $query = "
        SELECT t1.idmitarbeiter, t1.idrapport, t3.idrapport, t3.datum, t3.zeit, t3.kosten, t3.material, t3.zusaetzlicheArbeiten, t3.bemerkung, t3.idliegenschaft, 
        t4.idmitarbeiter, GROUP_CONCAT(t4.vorname, ' ', t4.nachname ORDER BY t4.vorname ASC) AS person_list, t4.strasse, t4.idort, t5.idaufgabe, t5.idrapport, t6.idaufgabe, 
        GROUP_CONCAT(t6.name ORDER BY t6.name ASC) AS arbeit_list, t6.idtyp
        FROM tbl_rapport_mitarbeiter as t1
        JOIN tbl_rapport as t3 ON t3.idrapport = t1.idrapport
        JOIN tbl_mitarbeiter as t4 ON t4.idmitarbeiter = t1.idmitarbeiter
        JOIN tbl_rapport_aufgabe as t5 ON t3.idrapport = t5.idrapport
        JOIN tbl_aufgabe as t6 ON t6.idaufgabe = t5.idaufgabe
        WHERE t3.idliegenschaft = (?)
        GROUP BY t3.idrapport, t6.name";
    $prepared_stmt = mysqli_prepare($conn, $query)
    or die("Unable to prepare statement: " . $conn->error);

    mysqli_stmt_bind_param($prepared_stmt, "i", $selected_liegenschaftid);
    mysqli_stmt_execute($prepared_stmt)
    or die("Unable to execute query: " . $prepared_stmt->error);

    $result = mysqli_stmt_get_result($prepared_stmt);

    while( $row = mysqli_fetch_assoc( $result)){
        $result_array[] = $row;
    }

    $prepared_stmt->close();

    header("Content-type: text/javascript");

    echo json_encode($result_array);

?>
