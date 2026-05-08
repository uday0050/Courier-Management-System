-- trigger
-- to update delivery status when a new order is inserted
CREATE TABLE delivery_status (
    id INT AUTO_INCREMENT PRIMARY KEY,
    c_id INT,
    status VARCHAR(20),
    FOREIGN KEY (c_id) REFERENCES courier(c_id) ON DELETE CASCADE
);


-- Reset the delimiter back to semicolon 
DELIMITER ;

DELIMITER //
CREATE TRIGGER update_delivery_status
AFTER INSERT ON courier
FOR EACH ROW
BEGIN
    DECLARE delivery_status VARCHAR(20);
    IF NEW.date = CURDATE() THEN
        SET delivery_status = 'Today';
    ELSE
        SET delivery_status = 'Future';
    END IF;

    INSERT INTO delivery_status (c_id, status)
    VALUES (NEW.c_id, delivery_status);
END //
DELIMITER ;

-- Inserting a sample record into the courier table
INSERT INTO courier (c_id, u_id, semail, remail, sname, rname, sphone, rphone, saddress, raddress, weight, billno, image, date)
VALUES (1, 1, 'sender@example.com', 'receiver@example.com', 'Sender Name', 'Receiver Name', '1234567890', '9876543210', 'Sender Address', 'Receiver Address', 5, 1001, 'path/to/image.jpg', '2024-04-20');


--trigger to prevent duplicate emails
CREATE OR REPLACE TRIGGER prevent_duplicate_emails
BEFORE INSERT ON users
FOR EACH ROW
DECLARE
    email_count NUMBER;
BEGIN
    SELECT COUNT(*) INTO email_count FROM users WHERE email = :NEW.email;
    IF email_count > 0 THEN
        RAISE_APPLICATION_ERROR(-20001, 'Email already exists. Please use a different email.');
    END IF;
END;
/

-- Import has been successfully finished, 0 queries executed. (plsql.sql)

-- fetches admin data ---- 
DELIMITER //

CREATE PROCEDURE fetch_admin()
BEGIN
    DECLARE done INT DEFAULT FALSE;
    DECLARE a_id_val INT;
    DECLARE email_val VARCHAR(50);
    DECLARE name_val VARCHAR(50);

    DECLARE admin_cursor CURSOR FOR
        SELECT a_id, email, name FROM admin;
    
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;

    OPEN admin_cursor;

    read_loop: LOOP
        FETCH admin_cursor INTO a_id_val, email_val, name_val;
        IF done THEN
            LEAVE read_loop;
        END IF;
        SELECT CONCAT('Admin ID: ', a_id_val, ', Email: ', email_val, ', Name: ', name_val);
    END LOOP;

    CLOSE admin_cursor;
END //

DELIMITER ;

CALL fetch_admin();



-- Counts User number --

DELIMITER //

CREATE FUNCTION get_user_count() RETURNS INT
BEGIN
    DECLARE user_count INT;
    SELECT COUNT(*) INTO user_count FROM users;
    RETURN user_count;
END //

DELIMITER ;

SELECT get_user_count();


-- Inserts new user ----


DELIMITER //

CREATE PROCEDURE insert_user (
    p_email VARCHAR(50),
    p_name VARCHAR(50),
    p_pnumber INT
)
BEGIN
    INSERT INTO users (email, name, pnumber)
    VALUES (p_email, p_name, p_pnumber);
    SELECT 'User inserted successfully.';
END //

DELIMITER ;

CALL insert_user('Adi@yahoo.com', 'Aaditya', 123456789);

-- Exception handeling (no duplicate data) ---

DELIMITER //

DECLARE
    v_user_count INT;
BEGIN
    SELECT COUNT(*) INTO v_user_count FROM users;
    DBMS_OUTPUT.PUT_LINE('Number of users: ' || v_user_count);

EXCEPTION
    WHEN DUP_VAL_ON_INDEX THEN
        DBMS_OUTPUT.PUT_LINE('Error: Duplicate value encountered.');

    WHEN NO_DATA_FOUND THEN
        DBMS_OUTPUT.PUT_LINE('No users found.');

    WHEN OTHERS THEN
        DBMS_OUTPUT.PUT_LINE('An error occurred: ' || SQLERRM);
END;
//

DELIMITER ;