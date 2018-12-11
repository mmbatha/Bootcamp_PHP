SELECT
    *
FROM
    `db_mmbatha`.`distrib`
WHERE
    `id_distrib` = 42 OR `id_distrib` BETWEEN 62 AND 69 OR `id_distrib` = 71 OR `id_distrib` BETWEEN 88 AND 90 OR LCASE(`name`) LIKE '%yy%' OR LCASE(`name`) LIKE '%y%y%'
LIMIT 2, 5;