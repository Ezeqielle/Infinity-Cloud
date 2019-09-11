select * from users;
select * from bill;
select * from subscription;

SELECT *
FROM users LEFT JOIN bill ON  users.user_id = bill.users
WHERE user_id=15
ORDER BY `bill`.`bill_date` DESC ;

SELECT name_cloudPackage, bill_date
FROM users LEFT JOIN bill ON  users.user_id = bill.users
WHERE user_id=15 AND MAX(bill_date);


SELECT *
FROM subscription LEFT JOIN users ON  subscription.name_subscription = 
WHERE user_id=15
ORDER BY `bill`.`bill_date` DESC ;