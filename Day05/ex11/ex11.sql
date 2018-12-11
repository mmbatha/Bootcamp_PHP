SELECT
    UPPER(`user_card`.`last_name`) AS 'NAME',
    `user_card`.`first_name`,
    `subscription`.`price`
FROM
    `db_mmbatha`.`user_card`
INNER JOIN `db_mmbatha`.`member` ON
    `user_card`.`id_user` = `member`.`id_member`
INNER JOIN `db_mmbatha`.`subscription` ON
    `member`.`id_member` = `subscription`.`id_sub`
WHERE
    `subscription`.`price` > 42
ORDER BY
    `user_card`.`last_name`,
    `user_card`.`first_name` ASC;