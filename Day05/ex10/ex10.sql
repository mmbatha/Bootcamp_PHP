SELECT
    `title` AS 'Title',
    `summary` AS 'Summary',
    `prod_year`
FROM
    `film`
INNER JOIN `db_mmbatha`.`genre` ON
    `db_mmbatha`.`film`.`id_genre` = `db_mmbatha`.`genre`.`id_genre`
WHERE
    `db_mmbatha`.`genre`.`name` = 'erotic'
ORDER BY
    `prod_year`
DESC
    ;