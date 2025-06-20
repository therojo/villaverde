<?php

namespace app\models;

use Yii;
use yii\base\Model;

class Consultas extends Model{


    public function pagosPorInmueble($idInmuebleColono, $idEjercicio){
        $sql="
            SELECT
            Calles.id as idCalle,
            incol.id as idInmuebleColono,
            incol.idColono,
            Calles.nombre as calle, inmu.numero, concat(c.nombre, '', c.apellido1, '', c.apellido2) as colono,
            ifnull(Ejercicios.numero,'') as ejercicio,
            Meses.id as idMesEnProgreso,
            ifnull(d.idMes,0) as idMes,
            ifnull(concat(lpad(d.idMes,2,0),'-',Ejercicios.numero),'') as mesAnio,
            ifnull(d.monto,0) as monto

            from Meses
            left join DetallePagos  d on Meses.id = d.idMes
            left join Pagos p on d.idPago = p.id 
            left join InmueblesColonos incol on p.idInmuebleColono = incol.id
            left join Inmuebles inmu on incol.idInmueble = inmu.id
            left join Calles on inmu.idCalle = Calles.id
            left join Colonos c on  incol.idColono = c.id
            left join Ejercicios on d.idEjercicio = Ejercicios.id
            where
            incol.id = ".$idInmuebleColono."
            and Ejercicios.id = ".$idEjercicio."
            order by d.idMes            
        ";

        $rows= Yii::$app->db->createCommand($sql)->queryAll();
        $data =[];
        
        foreach($rows as $id=>$pago){
            $data[$pago["idMes"]] = $pago;
        }

        return $data;

    }

    public function porCalle($idCalle, $idEjercicio){
        $sql="
            SELECT
            Calles.id as idCalle,
            incol.id as idInmuebleColono,
            incol.idColono,
            Calles.nombre as calle, inmu.numero, concat(c.nombre, '', c.apellido1, '', c.apellido2) as colono,
            ifnull(Ejercicios.numero,'') as ejercicio,
            Meses.id as idMesEnProgreso,
            ifnull(d.idMes,0) as idMes,
            ifnull(concat(lpad(d.idMes,2,0),'-',Ejercicios.numero),'') as mesAnio,
            ifnull(d.monto,0) as monto

            from Meses
            left join DetallePagos  d on Meses.id = d.idMes
            left join Pagos p on d.idPago = p.id 
            left join InmueblesColonos incol on p.idInmuebleColono = incol.id
            left join Inmuebles inmu on incol.idInmueble = inmu.id
            left join Calles on inmu.idCalle = Calles.id
            left join Colonos c on  incol.idColono = c.id
            left join Ejercicios on d.idEjercicio = Ejercicios.id
            where
            Ejercicios.id = 1 or d.idMes is null
            order by Calles.nombre, inmu.numero,Ejercicios.numero, d.idMes
            -- Calles.id = 1
            -- d.idEjercicio = 1
        ";

        echo "<pre>".print_r($sql, true)."</pre>";
        die();
        
        $data= Yii::$app->db->createCommand($sql)->queryAll();

        return $data;

    }
}