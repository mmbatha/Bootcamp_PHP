SELECT
    CONCAT_WS(
        ' ',
        `last_name`,
        `first_name`,
        DATE(`birthdate`)
    ) AS birthdate
FROM
    `db_mmbatha`.`user_card` AS birthdate
WHERE
    `birthdate` LIKE '1989%'
ORDER BY
    `last_name` ASC;