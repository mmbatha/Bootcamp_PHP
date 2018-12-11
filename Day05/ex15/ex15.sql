SELECT
    REVERSE(SUBSTRING(`phone_number`, 2)) AS 'rebmunenohp'
FROM
    `db_mmbatha`.`distrib`
WHERE
    `phone_number` LIKE '05%';