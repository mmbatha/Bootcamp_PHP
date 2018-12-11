SELECT
    COUNT(DISTINCT `id_film`) AS 'movies'
FROM
    `db_mmbatha`.`member_history`
WHERE
    `date` BETWEEN '2006-10-30' AND '2007-07-27' OR(
        EXTRACT(DAY
    FROM
        `date`) = 24 AND EXTRACT(MONTH
    FROM
        `date`) = 12
    );