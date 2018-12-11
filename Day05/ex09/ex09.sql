SELECT
    COUNT(`duration`) AS 'nb_short-films'
FROM
    `db_mmbatha`.`film`
WHERE
    `duration` <= 42;