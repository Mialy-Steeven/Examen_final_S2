<?php
require "connexion.php";
ini_set("display_errors", "1");

/*function departement_jiaby () {
    $req1 = mysqli_query(dbconnect(),"SELECT * FROM departments "); 
    $res=array();
    while($result1 = mysqli_fetch_array($req1)){
        $res[]=$result1;
    }
    return $res;  
}

function nom_manager_encours ($dept_no) {
    $req1 = mysqli_query ( dbconnect(), "SELECT e.last_name FROM employees e JOIN dept_manager m ON e.emp_no = m.emp_no WHERE m.dept_no = '$dept_no' AND m.to_date = '9999-01-01'");
    $res=array();
    while($result1 = mysqli_fetch_array($req1)){
        $res[]=$result1;
    }
    return $res; 
}

function nb_nom_deptname () {
    $req1 = mysqli_query(dbconnect(),"SELECT * FROM v_test_quest1_vers3 "); 
    $res=array();
    while($result1 = mysqli_fetch_array($req1)){
        $res[]=$result1;
    }
    return $res;  
} 

function nb_avgSalary_title () {
    $req1 = mysqli_query(dbconnect(),"SELECT * FROM v_test_quest2_vers3 "); 
    $res=array();
    while($result1 = mysqli_fetch_array($req1)){
        $res[]=$result1;
    }
    return $res;  
} 



function NomEmployeesParDepartement ($dept_no) {
    $req1 = mysqli_query ( dbconnect(), "SELECT e.emp_no,e.last_name FROM employees e JOIN dept_emp m ON e.emp_no = m.emp_no WHERE m.dept_no = '$dept_no'");
    $res=array();
    while($result1 = mysqli_fetch_array($req1)){
        $res[]=$result1;
    }
    return $res; 
}

function NomDepartement ($dept_no) {
    $req1 = mysqli_query ( dbconnect(), "SELECT dept_name FROM departments d WHERE d.dept_no = '$dept_no'");
    $res=array();
    while($result1 = mysqli_fetch_array($req1)){
        $res[]=$result1;
    }
    return $res; 
}

function Ficheemployes($id_emp){
    $req1 = mysqli_query ( dbconnect(), "SELECT * FROM employees  WHERE emp_no = '$id_emp'");
    $res=array();
    while($result1 = mysqli_fetch_array($req1)){
        $res[]=$result1;
    }
    return $res; 
}

function historiquesalaire($id_emp){
     $req1 = mysqli_query ( dbconnect(), "SELECT * FROM salaries  WHERE emp_no = '$id_emp'");
    $res=array();
    while($result1 = mysqli_fetch_array($req1)){
        $res[]=$result1;
    }
    return $res; 
}

function titre_emp($id_emp){
    $req1 = mysqli_query ( dbconnect(), "SELECT title,from_date,to_date FROM v_emploie_long_date  WHERE emp_no = '$id_emp' Limit 1");
    $res=array();
    while($result1 = mysqli_fetch_array($req1)){
        $res[]=$result1;
    }
    return $res; 
}
function list_dep(){
    $res = [];
    $sql =mysqli_query(dbconnect(),"SELECT * FROM v_list_dep ");
    while($result = mysqli_fetch_array($sql)){
        $res[]=$result;
    }
    return $res;
}
function dep_actu($id){
    $sql = mysqli_query(dbconnect(),
        "SELECT * FROM v_list_dep_emp 
         WHERE emp_no = '$id' 
         ORDER BY from_date DESC 
         LIMIT 1"
    );
    if ($result = mysqli_fetch_array($sql)) {
        return $result;
    }
    return null;
}

function recherche($dep,$nom,$age_min,$age_ma,$par_p,$off) {
     echo "<p><b>[DEBUG]</b> dep = '$dep', nom = '$nom', age_min = '$age_min', age_ma = '$age_ma'</p>";
    $conn = dbconnect();
    //$reche = mysqli_real_escape_string($conn, $reche);
    $res = [];
    $req = mysqli_query($conn, "SELECT dep.dept_name,dep.first_name,dep.last_name,dep.gender,dep.birth_date,dep.hire_date,age.age 
    FROM v_employees_dept dep 
    Join v_employees_age age on dep.emp_no=age.emp_no  
    WHERE 1=1 
    And dep.dept_name LIKE '%$dep%' 
    And dep.first_name Like '%$nom%' 
    or  dep.last_name Like '%$nom%'
    And age.age>='$age_min'
    And age.age<='$age_ma'  
    Limit $par_p ,$off");
    if (isset($req) && mysqli_num_rows($req) > 0) {
        while ($row = mysqli_fetch_assoc($req)) {
            $res[] = $row;
        }
    }

    return $res;
}

function isa_raha($dep,$nom,$age_min,$age_ma){
       $conn = dbconnect();
    //$reche = mysqli_real_escape_string($conn, $reche);
    $req = mysqli_query($conn, "SELECT Count(*) as isa
    FROM v_employees_dept dep 
    Join v_employees_age age on dep.emp_no=age.emp_no  
    WHERE 1=1 
    And dep.dept_name LIKE '%$dep%' 
    And dep.first_name Like '%$nom%' 
    or  dep.last_name Like '%$nom%'
    And age.age>='$age_min'
    And age.age<='$age_ma'");
    $res =mysqli_fetch_assoc($req);
return $res ;
}

function  suivant($dep,$nom,$age_min,$age_ma){
 $conn = dbconnect();

    //$reche = mysqli_real_escape_string($conn, $reche);
    $res = [];
    $req = mysqli_query($conn, "SELECT dep.dept_name,dep.first_name,dep.last_name,dep.gender,dep.birth_date,dep.hire_date,age.age 
    FROM v_employees_dept dep 
    Join v_employees_age age on dep.emp_no=age.emp_no  
    WHERE 1=1 
    And dep.dept_name LIKE '%$dep%' 
    And dep.first_name Like '%$nom%' 
    or  dep.last_name Like '%$nom%'
    And age.age>=$age_min 
    And age.age<=$age_ma  
    Limit 20,20");

    if (isset($req) && mysqli_num_rows($req) > 0) {
        while ($row = mysqli_fetch_assoc($req)) {
            $res[] = $row;
        }
    }

    return $res;
}

function  precedent($reche, $type){
 $conn = dbconnect();
    $reche = mysqli_real_escape_string($conn, $reche);
    $res = [];
    $date_max = date('Y-m-d', strtotime("-$reche years"));
    if ($type == 1) {
        $req = mysqli_query($conn, "SELECT * FROM departments WHERE dept_name LIKE '%$reche%' Limit 0, 20");
    } else if ($type == 2) {
        $req = mysqli_query($conn, "SELECT * FROM employees 
            WHERE first_name LIKE '%$reche%' OR last_name LIKE '%$reche%' Limit 0, 20
        ");
    } else if ($type == 3) {
    $date_max = date('Y-m-d', strtotime("-$reche years"));
    $req = mysqli_query($conn, "SELECT  first_name,last_name,birth_date
            FROM employees 
            WHERE birth_date => '$date_max' Limit 0, 20");

    } else if ($type == 4) {
    $date_max = date('Y-m-d', strtotime("-$reche years"));
    $req = mysqli_query($conn, "SELECT  first_name,last_name,birth_date
            FROM employees 
            WHERE birth_date <= '$date_max' Limit 0, 20");
    }
    if (isset($req) && mysqli_num_rows($req) > 0) {
        while ($row = mysqli_fetch_assoc($req)) {
            $res[] = $row;
        }
    }
    return $res;
}*/

function list_object()
{
    $req1 = mysqli_query(dbconnect(), "SELECT nom_objet,date_retour FROM v_list_object ");
    $res = array();
    while ($result1 = mysqli_fetch_array($req1)) {
        $res[] = $result1;
    }
    return $res;
}

function list_object_cat()
{
    $req1 = mysqli_query(dbconnect(), "SELECT * FROM v_liste_objet_categorie ");
    $res = array();
    while ($result1 = mysqli_fetch_array($req1)) {
        $res[] = $result1;
    }
    return $res;
}

function list_cat()
{
    $req1 = mysqli_query(dbconnect(), "SELECT * FROM v_lis_categorie ");
    $res = array();
    while ($result1 = mysqli_fetch_array($req1)) {
        $res[] = $result1;
    }
    return $res;
}

function recherche_jiaby($recherche)
{
    $req1 = mysqli_query(dbconnect(), "SELECT o.nom_objet,co.nom_categorie FROM objet o JOIN categorie_objet co ON co.id_categorie=o.id_categorie WHERE co.nom_categorie='$recherche';");
    $res = array();
    while ($result1 = mysqli_fetch_array($req1)) {
        $res[] = $result1;
    }
    return $res;
}

function recherche_par_categorie($categorie) {
    $conn = dbconnect();
    $categorie = mysqli_real_escape_string($conn, $categorie);

    $sql = "SELECT o.nom_objet, co.nom_categorie, o.disponible
            FROM objet o
            JOIN categorie_objet co ON co.id_categorie = o.id_categorie
            WHERE co.nom_categorie = '$categorie'";

    $req = mysqli_query($conn, $sql);

    $res = array();
    while ($row = mysqli_fetch_assoc($req)) {
        $res[] = $row;
    }
    return $res;
}

function recherche_par_nom($nom) {
    $conn = dbconnect();
    $nom = mysqli_real_escape_string($conn, $nom);

    $sql = "SELECT o.nom_objet, co.nom_categorie, o.disponible
            FROM objet o
            JOIN categorie_objet co ON co.id_categorie = o.id_categorie
            WHERE o.nom_objet LIKE '%$nom%'";

    $req = mysqli_query($conn, $sql);

    $res = array();
    while ($row = mysqli_fetch_assoc($req)) {
        $res[] = $row;
    }
    return $res;
}

function recherche_combinee($categorie, $nom, $disponible) {
    $conn = dbconnect();

    $conditions = array();

    if ($categorie != "") {
        $categorie = mysqli_real_escape_string($conn, $categorie);
        $conditions[] = "co.nom_categorie = '$categorie'";
    }

    if ($nom != "") {
        $nom = mysqli_real_escape_string($conn, $nom);
        $conditions[] = "o.nom_objet LIKE '%$nom%'";
    }

    $where = "";
    if (!empty($conditions)) {
        $where = "WHERE " . implode(" AND ", $conditions);
    }

    $sql = " SELECT 
            o.id_objet,
            o.nom_objet,
            co.nom_categorie,
            IF(e.id_objet IS NULL, 1, 0) AS disponible
        FROM objet o
        JOIN categorie_objet co ON co.id_categorie = o.id_categorie
        LEFT JOIN (
            SELECT DISTINCT id_objet
            FROM emprunt
            WHERE date_retour IS NULL
        ) e ON o.id_objet = e.id_objet
        $where
    ";

    if ($disponible) {
        $sql = "SELECT * FROM ($sql) as tmp WHERE tmp.disponible = 1";
    }

    $req = mysqli_query($conn, $sql);

    $res = array();
    while ($row = mysqli_fetch_assoc($req)) {
        $res[] = $row;
    }
    return $res;
}





?>