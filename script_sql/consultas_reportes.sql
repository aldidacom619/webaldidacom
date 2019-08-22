--cantidad de ingresos por cuentas 'IN-CU'
SELECT t.denominacion_cuenta,s.denominacion_cuenta, sum(monto)as ingreso
  FROM cb_ingresos_egresos c, cb_cuentas t, cb_cuentas s 
 where c.cuenta_1 = t.codigo
   and c.cuenta_2 = s.codigo
   and c.tipo_transaccion = 'IN-CU'
group by t.denominacion_cuenta,s.denominacion_cuenta 
order by t.denominacion_cuenta,s.denominacion_cuenta asc


--cantidad de ingresos por cuentas 'IN'
SELECT t.denominacion_cuenta,s.denominacion_cuenta, sum(monto)as ingreso
  FROM cb_ingresos_egresos c, cb_cuentas t, cb_cuentas s 
 where c.cuenta_1 = t.codigo
   and c.cuenta_2 = s.codigo
   and c.tipo_transaccion = 'IN'
 group by t.denominacion_cuenta,s.denominacion_cuenta 
 order by t.denominacion_cuenta,s.denominacion_cuenta asc




 