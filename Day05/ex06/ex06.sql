SELECT
    `title`,
    `summary`
FROM
    `db_mmbatha`.`film`
WHERE
    `summary` LIKE '%Vincent%' OR `summary` LIKE '%vincent%'
ORDER BY
    `id_film` ASC;