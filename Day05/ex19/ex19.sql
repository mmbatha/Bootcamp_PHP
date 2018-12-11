SELECT
    DATEDIFF(
        DATE(MAX(`date`)),
        DATE(MIN(`date`))
    ) AS 'uptime'
FROM
    `db_mmbatha`.`member_history`;